@extends('layouts.dashboard')

@section('title', 'Tambah Kasir | UD Jaya Mebel')
@section('page-title', 'Tambah Kasir')

@section('content')
    <div class="d-flex align-items-center gap-3 mb-4">
        <a href="{{ route('admin.cashiers.index') }}" class="btn-outline-custom d-flex align-items-center gap-1 text-decoration-none" style="font-size:.85rem">
            <i class="bi bi-arrow-left"></i> Kembali
        </a>
        <div>
            <h1 class="h5 fw-bold mb-0">Tambah Kasir Baru</h1>
            <p class="text-muted mb-0" style="font-size:.8rem">Buat akun kasir untuk mencatat transaksi</p>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-12 col-md-8 col-lg-6">
            <div class="section-card">
                <form action="{{ route('admin.cashiers.store') }}" method="POST" class="vstack gap-4">
                    @csrf

                    <div>
                        <label for="nama" class="form-label fw-600">Nama Lengkap</label>
                        <input type="text" id="nama" name="nama" value="{{ old('nama') }}"
                               class="form-control @error('nama') is-invalid @enderror"
                               placeholder="Contoh: Dinda Rahma" required autofocus>
                        @error('nama')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div>
                        <label for="email" class="form-label fw-600">Email</label>
                        <input type="email" id="email" name="email" value="{{ old('email') }}"
                               class="form-control @error('email') is-invalid @enderror"
                               placeholder="kasir@jayamebel.id" required>
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div>
                        <label for="password" class="form-label fw-600">Password</label>
                        <input type="password" id="password" name="password"
                               class="form-control @error('password') is-invalid @enderror"
                               placeholder="Minimal 8 karakter" minlength="8" required>
                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <small class="text-muted">Minimal 8 karakter.</small>
                    </div>

                    <div>
                        <label for="password_confirmation" class="form-label fw-600">Konfirmasi Password</label>
                        <input type="password" id="password_confirmation" name="password_confirmation"
                               class="form-control" placeholder="Ulangi password" minlength="8" required>
                    </div>

                    <div class="d-flex gap-3 pt-2">
                        <button type="submit" class="btn-accent flex-grow-1">
                            <i class="bi bi-person-plus me-1"></i> Simpan Kasir
                        </button>
                        <a href="{{ route('admin.cashiers.index') }}" class="btn-outline-custom text-decoration-none">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection