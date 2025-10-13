@extends('layouts.master')

@section('content')
    <div class="pagetitle">
        <h1>Langganan Akun Pro</h1>
    </div>

    <section class="section">
        <div class="card p-4 shadow-sm text-center">
            @if ($user->membership === 'pro' && $user->subscription_ends_at > now())
                <h4 class="text-success">🎉 Akun Pro aktif hingga {{ $user->subscription_ends_at->format('d F Y') }}</h4>
            @else
                <h4>Upgrade ke Akun Pro</h4>
                <p>Dapatkan fitur tanpa batas dan upload file!</p>
                <h3 class="mt-3 mb-4">Rp30.000 / bulan</h3>
                <button id="pay-button" class="btn btn-success btn-lg">Bayar Sekarang</button>
            @endif
        </div>
    </section>
@endsection

@push('scripts')
    <script src="https://app.sandbox.midtrans.com/snap/snap.js"
        data-client-key="{{ config('services.midtrans.clientKey') }}"></script>
    <script>
        document.getElementById('pay-button')?.addEventListener('click', function() {
            fetch("{{ route('subscription.create') }}", {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Content-Type': 'application/json'
                    },
                })
                .then(res => res.json())
                .then(data => {
                    if (data.token) {
                        snap.pay(data.token, {
                            onSuccess: function(result) {
                                alert("Pembayaran berhasil! Akun Pro aktif 30 hari.");
                                location.reload();
                            },
                            onPending: function(result) {
                                alert("Menunggu pembayaran...");
                            },
                            onError: function(result) {
                                alert("Pembayaran gagal!");
                            }
                        });
                    } else {
                        alert("Gagal membuat transaksi");
                    }
                });
        });
    </script>
@endpush
