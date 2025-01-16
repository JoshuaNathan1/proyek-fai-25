@extends('layouts.main')

@section('content')
@php
    use Carbon\Carbon;
    $title = "History Supplier ";
@endphp

<div class="container mt-4">
    <h2 class="mb-4">History Transaksi</h2>

    @if($transactions->isEmpty())
        <div class="alert alert-info">
            Belum ada transaksi produk yang dibeli oleh admin.
        </div>
    @else
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Admin</th>
                    <th>Produk</th>
                    <th>Jumlah</th>
                    <th>Harga Satuan</th>
                    <th>Subtotal</th>
                    <th>Tanggal Transaksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($transactions as $transaction)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $transaction->admin_name }}</td>
                    <td>{{ $transaction->product_name }}</td>
                    <td>{{ $transaction->quantity }}</td>
                    <td>Rp{{ number_format($transaction->price, 0, ',', '.') }}</td>
                    <td>Rp{{ number_format($transaction->subtotal, 0, ',', '.') }}</td>
                    <td>{{ Carbon::parse($transaction->created_at)->format('d M Y, H:i') }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>

<div class="d-flex justify-content-center">
    {{ $transactions->links() }}
</div>

@endsection