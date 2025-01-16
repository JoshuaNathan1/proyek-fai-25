@extends('layouts.main')

@section('content')
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
    <h2 class="mb-4">Tambah Supplier</h2>
    <form action="{{ route('admin.addSupplier') }}" method="POST">
        @csrf

        <!-- Full Name -->
        <div class="mb-3">
            <label for="fullname" class="form-label">Nama Lengkap</label>
            <input type="text" name="fullname" id="fullname" class="form-control @error('fullname') is-invalid @enderror" 
                   placeholder="Masukkan nama lengkap" value="{{ old('fullname') }}" required>
            @error('fullname')
            <div class="text-danger mt-1">{{ $message }}</div>
            @enderror
        </div>

        <!-- Username -->
        <div class="mb-3">
            <label for="username" class="form-label">Username</label>
            <input type="text" name="username" id="username" class="form-control @error('username') is-invalid @enderror" 
                   placeholder="Masukkan username" value="{{ old('username') }}" required>
            @error('username')
            <div class="text-danger mt-1">{{ $message }}</div>
            @enderror
        </div>

        <!-- Email -->
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror" 
                   placeholder="Masukkan email" value="{{ old('email') }}" required>
            @error('email')
            <div class="text-danger mt-1">{{ $message }}</div>
            @enderror
        </div>

        <!-- Password -->
        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" name="password" id="password" class="form-control @error('password') is-invalid @enderror" 
                       placeholder="Masukkan password" required>
                @error('password')
                <div class="text-danger mt-1">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-md-6 mb-3">
                <label for="password_confirmation" class="form-label">Konfirmasi Password</label>
                <input type="password" name="password_confirmation" id="password_confirmation" 
                       class="form-control @error('password_confirmation') is-invalid @enderror" 
                       placeholder="Konfirmasi password" required>
                @error('password_confirmation')
                <div class="text-danger mt-1">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <!-- Gender -->
        <div class="mb-3">
            <label for="gender" class="form-label">Jenis Kelamin</label>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="gender" id="male" value="M" 
                       {{ old('gender') == 'M' ? 'checked' : '' }}>
                <label class="form-check-label" for="male">Laki-laki</label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="gender" id="female" value="F" 
                       {{ old('gender') == 'F' ? 'checked' : '' }}>
                <label class="form-check-label" for="female">Perempuan</label>
            </div>
            @error('gender')
            <div class="text-danger mt-1">{{ $message }}</div>
            @enderror
        </div>

        <!-- Phone -->
        <div class="mb-3">
            <label for="phone" class="form-label">Telepon</label>
            <input type="text" name="phone" id="phone" class="form-control @error('phone') is-invalid @enderror" 
                   placeholder="Masukkan nomor telepon" value="{{ old('phone') }}" required>
            @error('phone')
            <div class="text-danger mt-1">{{ $message }}</div>
            @enderror
        </div>

        <!-- Address -->
        <div class="mb-3">
            <label for="address" class="form-label">Alamat</label>
            <textarea name="address" id="address" class="form-control @error('address') is-invalid @enderror" 
                      rows="3" placeholder="Masukkan alamat" required>{{ old('address') }}</textarea>
            @error('address')
            <div class="text-danger mt-1">{{ $message }}</div>
            @enderror
        </div>

        <!-- Submit Button -->
        <button type="submit" class="btn btn-primary" style="background-color: #a77057; border: none">
            Simpan Supplier
        </button>
    </form>
</div>
@endsection
