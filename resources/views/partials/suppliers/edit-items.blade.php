@extends('layouts.main')

@section('content')
@php
    $title = "Edit Item";
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
    <h2 class="mb-4">Edit Produk</h2>
    <form action="{{ route('supplier.updateProduct', $product->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        
        <!-- Nama Produk -->
        <div class="mb-3">
            <label for="product_name" class="form-label">Nama Produk</label>
            <input type="text" name="product_name" id="product_name" class="form-control" value="{{ $product->product_name }}" required>
        </div>

        <!-- Deskripsi -->
        <div class="mb-3">
            <label for="description" class="form-label">Deskripsi Produk</label>
            <textarea name="description" id="description" class="form-control" rows="5" required>{{ $product->description }}</textarea>
        </div>
        
        <!-- Harga -->
        <div class="mb-3">
            <label for="price" class="form-label">Harga (Rp)</label>
            <input type="number" name="price" id="price" class="form-control" value="{{ $product->price }}" required>
        </div>

        <!-- Stok -->
        <div class="mb-3">
            <label for="stock" class="form-label">Stok</label>
            <input type="number" name="stock" id="stock" class="form-control" value="{{ $product->stock }}" required>
        </div>

        <!-- Gambar Produk -->
        <div class="mb-3">
            <label for="image" class="form-label">Gambar Produk</label>
            <input type="file" name="image" id="image" class="form-control">
            <small style="font-weight: bold">*Biarkan kosong jika tidak ingin mengubah gambar.</small>
        </div>

        <!-- Tombol Submit -->
        <button type="submit" class="btn btn-primary" style="background-color: #a77057; border: none">Simpan Perubahan</button>
    </form>
</div>
@endsection
