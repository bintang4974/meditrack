@extends('layouts.master')
@section('content')
    <div class="pagetitle">
        <h1>Langganan Akun Pro</h1>
    </div>
    <section class="section">
        <div class="card p-4 text-center">
            @if ($user->membership === 'pro' && $user->subscription_ends_at > now())
                <h4 class="text-success">🎉 Akun Pro aktif hingga {{ Carbon\Carbon::parse($user->subscription_ends_at)->format('Y-m-d') }}</h4>
            @else
                <h4>Upgrade ke Akun Pro</h4>
                <p>Dapatkan fitur tanpa batas dan upload file!</p>
                <h3 class="mt-3 mb-4">Rp30.000 / bulan</h3>
                <button id="pay-button" class="btn btn-success btn-lg">Bayar Sekarang</button>
                <pre><div id="result-json">JSON result will appear here after payment:<br></div></pre>
            @endif
        </div>
    </section>
@endsection

@push('scripts')
    <script src="https://app.sandbox.midtrans.com/snap/snap.js"
        data-client-key="{{ config('services.midtrans.clientKey') }}"></script>
    <script>
        document.getElementById('pay-button')?.addEventListener('click', async function() {
            try {
                const res = await fetch("{{ route('subscription.create') }}", {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Accept': 'application/json',
                    }
                });

                if (!res.ok) {
                    const txt = await res.text();
                    console.error('createTransaction error:', txt);
                    alert('Gagal membuat transaksi. Cek log.');
                    return;
                }

                const data = await res.json();
                const token = data.token;
                const orderId = data.order_id;

                snap.pay(token, {
                    onSuccess: function(result) {
                        document.getElementById('result-json').innerText += JSON.stringify(result,
                            null, 2);
                        // optional: kirim ke server agar UI cepat sinkron
                        fetch("{{ route('subscription.clientNotify') }}", {
                            method: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                'Content-Type': 'application/json'
                            },
                            body: JSON.stringify({
                                order_id: orderId,
                                transaction_status: result.transaction_status,
                                raw_result: result
                            })
                        }).catch(e => console.warn('clientNotify failed', e));

                        alert("Pembayaran berhasil! Mohon tunggu, status akan diperbarui.");
                        location.reload();
                    },
                    onPending: function(result) {
                        document.getElementById('result-json').innerText += JSON.stringify(result,
                            null, 2);
                        alert("Transaksi pending. Silakan selesaikan pembayaran.");
                    },
                    onError: function(result) {
                        document.getElementById('result-json').innerText += JSON.stringify(result,
                            null, 2);
                        alert("Terjadi kesalahan pada pembayaran.");
                    }
                });
            } catch (err) {
                console.error(err);
                alert('Terjadi error saat komunikasi ke server.');
            }
        });
    </script>
@endpush
