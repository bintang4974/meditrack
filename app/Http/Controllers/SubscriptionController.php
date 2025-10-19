<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\User;
use App\Notifications\ProActivatedNotification;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Notification;
use Midtrans\Config;
use Midtrans\Snap;
use Illuminate\Support\Str;

class SubscriptionController extends Controller
{
    public function __construct()
    {
        // konfigurasi midtrans global (bisa dipindah ke service provider)
        Config::$serverKey = config('services.midtrans.serverKey');
        Config::$isProduction = filter_var(config('services.midtrans.isProduction'), FILTER_VALIDATE_BOOLEAN);
        Config::$isSanitized = true;
        Config::$is3ds = true;
    }

    public function index()
    {
        $user = Auth::user();
        return view('subscription.index', compact('user'));
    }

    public function history()
    {
        $payments = Auth::user()->payments()->latest()->get();
        return view('subscription.history', compact('payments'));
    }

    public function createTransaction(Request $request)
    {
        $user = Auth::user();
        $amount = 30000;
        $orderId = 'SUB-' . strtoupper(Str::random(8)) . '-' . time();

        $params = [
            'transaction_details' => [
                'order_id' => $orderId,
                'gross_amount' => $amount,
            ],
            'customer_details' => [
                'first_name' => $user->name,
                'email' => $user->email,
            ],
            'item_details' => [
                [
                    'id' => 'SUBSCRIPTION-PRO',
                    'price' => $amount,
                    'quantity' => 1,
                    'name' => 'Langganan Akun Pro (1 Bulan)',
                ],
            ],
        ];

        try {
            // simpan record pending di DB
            Payment::create([
                'order_id' => $orderId,
                'user_id' => $user->id,
                'amount' => $amount,
                'transaction_status' => 'pending',
            ]);

            $snapToken = Snap::getSnapToken($params);

            return response()->json([
                'token' => $snapToken,
                'order_id' => $orderId,
                'amount' => $amount,
            ]);
        } catch (\Exception $e) {
            Log::error('Midtrans createTransaction error: ' . $e->getMessage(), ['trace' => $e->getTraceAsString()]);
            return response()->json(['error' => true, 'message' => $e->getMessage()], 500);
        }
    }

    /**
     * Endpoint yang dipanggil dari midtrans (server-to-server).
     * Pastikan URL ini terdaftar di Midtrans Merchant Console (notification URL).
     */
    public function callback(Request $request)
    {
        // Midtrans sends JSON or form params; ambil semua
        $payload = $request->all();
        Log::info('Midtrans callback', $payload);

        // signature verification (Midtrans docs)
        $serverKey = config('services.midtrans.serverKey');
        $orderId = $request->input('order_id');
        $statusCode = $request->input('status_code');
        $grossAmount = $request->input('gross_amount');
        $signatureKey = $request->input('signature_key');

        $calculated = hash('sha512', $orderId . $statusCode . $grossAmount . $serverKey);

        if ($calculated !== $signatureKey) {
            Log::warning('Midtrans signature mismatch', ['order_id' => $orderId]);
            return response('invalid signature', 400);
        }

        // update payment record
        $payment = Payment::where('order_id', $orderId)->first();
        if (!$payment) {
            // jika tidak ada, buat record baru (defensive)
            $payment = Payment::create([
                'order_id' => $orderId,
                'user_id' => null,
                'amount' => $grossAmount,
                'transaction_status' => $request->input('transaction_status'),
                'raw_response' => $payload,
            ]);
        } else {
            $payment->update([
                'transaction_status' => $request->input('transaction_status'),
                'payment_type' => $request->input('payment_type') ?? $payment->payment_type,
                'raw_response' => $payload,
            ]);
        }

        // bila sukses (capture/settlement) → upgrade user
        if (in_array($request->input('transaction_status'), ['capture', 'settlement'])) {
            // temukan user via payments.user_id, tapi jika null, coba customer_details.email
            $user = $payment->user ?? User::where('email', $request->input('customer_details.email'))->first();

            if ($user) {
                // perpanjang subscription (jika sudah pro, tambahkan 30 hari dari subscription_ends_at bila masih valid)
                $now = Carbon::now();
                $currentEnd = $user->subscription_ends_at;
                if ($currentEnd && $currentEnd->isFuture()) {
                    $newEnd = $currentEnd->addDays(30);
                } else {
                    $newEnd = $now->addDays(30);
                }

                $user->update([
                    'membership' => 'pro',
                    'subscription_ends_at' => $newEnd,
                ]);

                // hubungkan payment -> user bila belum
                if (!$payment->user_id) {
                    $payment->user_id = $user->id;
                    $payment->save();
                }

                // notifikasi
                Notification::send($user, new ProActivatedNotification($payment));
            }
        }

        return response()->json(['message' => 'ok']);
    }



    /**
     * Optional: dipanggil oleh client setelah snap.onSuccess untuk update DB agar UI cepat sinkron.
     * Jangan menggantikan server callback (Midtrans), tapi ini berguna untuk feedback UX.
     */
    public function clientNotify(Request $request)
    {
        $payload = $request->all();
        // contoh payload: order_id, transaction_status, raw_result
        $orderId = $payload['order_id'] ?? null;
        if (!$orderId) {
            return response()->json(['error' => 'missing order_id'], 400);
        }

        $payment = Payment::where('order_id', $orderId)->first();
        if (!$payment) return response()->json(['error' => 'payment not found'], 404);

        $payment->update([
            'transaction_status' => $payload['transaction_status'] ?? $payment->transaction_status,
            'raw_response' => $payload['raw_result'] ?? $payment->raw_response,
        ]);

        // jika client men-submit status success, kita juga bisa upgrade user di sini (duplikasi logika dengan callback)
        if (in_array($payment->transaction_status, ['capture', 'settlement'])) {
            $user = $payment->user;
            if ($user) {
                $user->update([
                    'membership' => 'pro',
                    'subscription_ends_at' => Carbon::now()->addDays(30),
                ]);
            }
        }

        return response()->json(['ok' => true]);
    }
}
