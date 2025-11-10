@extends('layouts.master')
@section('content')
    <div class="pagetitle">
        <h1>Riwayat Pembayaran</h1>
    </div>
    <section class="section">
        <div class="card p-4">
            <h5>History</h5>
            <table class="table datatable">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Order ID</th>
                        <th>Amount</th>
                        <th>Status</th>
                        <th>Tanggal</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($payments as $p)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $p->order_id }}</td>
                            <td>Rp{{ number_format($p->amount, 0, ',', '.') }}</td>
                            <td>{{ ucfirst($p->transaction_status) }}</td>
                            <td>{{ $p->created_at->format('d M Y H:i') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </section>
@endsection
