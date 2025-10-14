<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Notifications\ProActivatedNotification;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;
use Midtrans\Config;
use Midtrans\Snap;
use Illuminate\Support\Str;

class SubscriptionController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        return view('subscription.index', compact('user'));
    }

    public function createTransaction(Request $request)
    {
        $user = Auth::user();

        // konfigurasi Midtrans
        Config::$serverKey = config('services.midtrans.serverKey');
        Config::$isProduction = config('services.midtrans.isProduction');
        Config::$isSanitized = true;
        Config::$is3ds = true;

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
            'enabled_payments' => ['gopay', 'qris', 'bank_transfer'],
        ];

        try {
            $snapToken = Snap::getSnapToken($params);
            return response()->json(['token' => $snapToken]);
        } catch (\Exception $e) {
            dd('Midtrans error: ' . $e->getMessage());
            return response()->json(['error' => true, 'message' => $e->getMessage()], 500);
        }
    }

    // Callback dari Midtrans setelah pembayaran selesai
    public function callback(Request $request)
    {
        $serverKey = config('services.midtrans.serverKey');
        $calculated = hash('sha512', $request->order_id . $request->status_code . $request->gross_amount . $serverKey);

        if (
            $calculated === $request->signature_key &&
            in_array($request->transaction_status, ['capture', 'settlement'])
        ) {

            $user = User::where('email', $request->customer_details['email'])->first();

            if ($user) {
                $user->update([
                    'membership' => 'pro',
                    'subscription_ends_at' => Carbon::now()->addDays(30),
                ]);

                Notification::send($user, new ProActivatedNotification());
            }
        }

        return response()->json(['message' => 'Callback processed']);
    }
}
