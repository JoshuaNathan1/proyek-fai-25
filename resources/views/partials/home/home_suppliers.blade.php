@extends('layouts.main') 
 
@section('content') 
<div class="container mt-4"> 
    <h2 class="mb-4">Dashboard Supplier</h2> 
 
    <!-- Pesan Sukses --> 
    @if(session('success')) 
    <div class="alert alert-success"> 
        {{ session('success') }} 
    </div> 
    @endif 
 
    <!-- Tabel Produk --> 
    <div class="table-responsive"> 
        <table class="table table-striped table-bordered"> 
            <thead> 
                <tr> 
                    <th>#</th> 
                    <th>Nama Produk</th> 
                    <th>Harga</th> 
                    <th>Stok</th> 
                    <th>Gambar</th> 
                    <th>Aksi</th> 
                </tr> 
            </thead> 
            <tbody> 
                @forelse($products as $product) 
                <tr> 
                    <td>{{ $loop->iteration }}</td> 
                    <td>{{ $product->product_name }}</td> 
                    <td>Rp{{ number_format($product->price, 0, ',', '.') }}</td> 
                    <td>{{ $product->stock }}</td> 
                    <td> 
                        <!-- Thumbnail --> 
                        <img src="{{ asset('storage/' . $product->image) }}" alt="Gambar Produk" class="img-thumbnail" 
                            style="width: 100px; cursor: pointer;" data-bs-toggle="modal" 
                            data-bs-target="#imageModal-{{ $product->id }}"> 
 
                        <!-- Modal --> 
                        <div class="modal fade" id="imageModal-{{ $product->id }}" tabindex="-1" 
                            aria-labelledby="imageModalLabel-{{ $product->id }}" aria-hidden="true"> 
                            <div class="modal-dialog modal-dialog-centered modal-xl"> 
                                <!-- Class modal-xl untuk ukuran besar --> 
                                <div class="modal-content"> 
                                    <div class="modal-header"> 
                                        <h5 class="modal-title" id="imageModalLabel-{{ $product->id }}">Gambar Produk 
                                        </h5> 
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" 
                                            aria-label="Close"></button> 
                                    </div> 
                                    <div class="modal-body text-center"> 
                                        <!-- Fullscreen Image --> 
                                        <img src="{{ asset('storage/' . $product->image) }}" alt="Gambar Produk Full" 
                                            class="img-fluid"> 
                                    </div> 
                                </div> 
                            </div> 
                        </div> 
                    </td> 
 
 
                    <td> 
                        <!-- Tombol Edit --> 
                        <a href="{{ route('supplier.editProduct', $product->id) }}" class="btn btn-warning btn-sm">
                            <i class="fa-solid fa-pen-to-square"></i>
                        </a>

                        <!-- Tombol Delete -->
                        <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteModal-{{ $product->id }}">
                            <i class="fa-solid fa-trash"></i>
                        </button>

                        <!-- Modal Konfirmasi -->
                        <div class="modal fade" id="deleteModal-{{ $product->id }}" tabindex="-1" aria-labelledby="deleteModalLabel-{{ $product->id }}" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="deleteModalLabel-{{ $product->id }}">Konfirmasi Hapus</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        Apakah Anda yakin ingin menghapus produk <strong>{{ $product->product_name }}</strong>? Tindakan ini tidak dapat dibatalkan.
                                    </div>
                                    <div class="modal-footer">
                                        <!-- Tombol Batal -->
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                        
                                        <!-- Form Hapus -->
                                        <form action="{{ route('supplier.deleteProduct', $product->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">Hapus</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </td> 
                </tr> 
                @empty 
                <tr> 
                    <td colspan="7" class="text-center">Belum ada produk yang diinputkan.</td> 
                </tr> 
                @endforelse 
            </tbody> 
        </table> 
    </div> 
</div> 
@endsection 