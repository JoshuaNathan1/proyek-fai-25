@extends('layouts.main')

@push('css-dependencies')
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css" />
@endpush

@push('scripts-dependencies')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const quantities = document.querySelectorAll('.quantity-input');
            const totalElement = document.getElementById('total');
            const modalTotal = document.getElementById('modalTotal');

            let total = 0;

            quantities.forEach(input => {
                input.addEventListener('input', function () {
                    const price = parseFloat(this.dataset.price);
                    const id = this.dataset.id;
                    const quantity = parseInt(this.value) || 0;
                    const subtotalElement = document.getElementById(`subtotal-${id}`);

                    // Update subtotal
                    const subtotal = price * quantity;
                    subtotalElement.textContent = `Rp${subtotal.toLocaleString('id-ID')}`;

                    // Update total
                    updateTotal();
                });
            });

            function updateTotal() {
                total = 0;

                quantities.forEach(input => {
                    const price = parseFloat(input.dataset.price);
                    const quantity = parseInt(input.value) || 0;
                    total += price * quantity;
                });

                totalElement.textContent = `Rp${total.toLocaleString('id-ID')}`;
                modalTotal.textContent = `Rp${total.toLocaleString('id-ID')}`;
            }
        });
    </script>
@endpush

@section('content')
@php
    $title = 'Suppplier Product '
@endphp

@if(session('success'))
<div class="alert alert-success mt-4">
    {{ session('success') }}
</div>
@endif

@if($errors->any())
<div class="alert alert-danger">
    <ul class="mb-0">
        @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<div class="container mt-4">
    <a href="{{ route('admin.suppliers') }}" style="text-decoration: none;"><i class="fa-classic fa-solid fa-arrow-left fa-fw"></i> Back</a>
    <h2 class="mb-4">Produk Supplier: {{ $supplier->fullname }}</h2>

    <!-- Tabel Produk -->
    <form id="purchaseForm" action="{{ route('admin.purchaseProduct') }}" method="POST">
        @csrf
        <input type="hidden" name="supplier_id" value="{{ $supplier->id }}">

        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nama Produk</th>
                    <th>Harga</th>
                    <th>Stok</th>
                    <th>Gambar</th>
                    <th>Jumlah Beli</th>
                    <th>Subtotal</th>
                </tr>
            </thead>
            <tbody>
                @foreach($products as $product)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $product->product_name }}</td>
                    <td>Rp{{ number_format($product->price, 0, ',', '.') }}</td>
                    <td>{{ $product->stock }}</td>
                    <td>
                        <img src="{{ asset('storage/' . $product->image) }}" alt="Gambar Produk" class="img-thumbnail" style="width: 100px;">
                    </td>
                    <td>
                        <input type="number" name="quantities[{{ $product->id }}]" 
                               class="form-control quantity-input" 
                               data-price="{{ $product->price }}" 
                               data-id="{{ $product->id }}" 
                               placeholder="Jumlah" 
                               min="0" max="{{ $product->stock }}">
                    </td>
                    <td>
                        <span id="subtotal-{{ $product->id }}" class="subtotal">Rp0</span>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Total -->
        <div class="text-end mt-3">
            <h4>Total: <span id="total">Rp0</span></h4>
        </div>

        <!-- Tombol Beli -->
        <div class="text-end mt-3">
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#confirmPurchaseModal">
                <i class="fa-solid fa-cart-shopping"></i> Beli Sekarang
            </button>
        </div>

        <!-- Modal Konfirmasi -->
        <div class="modal fade" id="confirmPurchaseModal" tabindex="-1" aria-labelledby="confirmPurchaseModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="confirmPurchaseModalLabel">Konfirmasi Pembelian</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        Apakah Anda yakin ingin membeli produk dari supplier ini dengan total <strong id="modalTotal">Rp0</strong>?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Konfirmasi Beli</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection