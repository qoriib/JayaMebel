@extends('layouts.dashboard')

@section('title', 'Tambah Kasir | UD Jaya Mebel')
@section('page-title', 'Tambah Kasir')

@section('content')
    <div class="row justify-content-center">
        <div class="col-12 col-md-8 col-lg-6">
            <div class="glass-panel p-4">
                <form action="{{ route('dashboard.cashiers.store') }}" method="POST" class="vstack gap-3">
                    @csrf

                    <div>
                        <label for="nama" class="form-label fw-semibold">Nama Lengkap</label>
                        <input type="text" id="nama" name="nama" value="{{ old('nama') }}"
                               class="form-control @error('nama') is-invalid @enderror"
                               placeholder="Contoh: Dinda Rahma" required autofocus>
                        @error('nama')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div>
                        <label for="email" class="form-label fw-semibold">Email</label>
                        <input type="email" id="email" name="email" value="{{ old('email') }}"
                               class="form-control @error('email') is-invalid @enderror"
                               placeholder="kasir@jayamebel.id" required>
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div>
                        <label for="password" class="form-label fw-semibold">Password</label>
                        <input type="password" id="password" name="password"
                               class="form-control @error('password') is-invalid @enderror"
                               placeholder="Minimal 8 karakter" minlength="8" required>
                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <div class="form-text">Minimal 8 karakter.</div>
                    </div>

                    <div>
                        <label for="password_confirmation" class="form-label fw-semibold">Konfirmasi Password</label>
                        <input type="password" id="password_confirmation" name="password_confirmation"
                               class="form-control" placeholder="Ulangi password" minlength="8" required>
                    </div>

                    <div class="d-flex gap-2 pt-2">
                        <button type="submit" class="btn btn-primary flex-grow-1">
                            <i class="bi bi-person-plus me-1"></i> Simpan Data
                        </button>
                        <a href="{{ route('dashboard.cashiers.index') }}" class="btn btn-outline-danger">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
