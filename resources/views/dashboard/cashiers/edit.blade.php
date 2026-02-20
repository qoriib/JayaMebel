@extends('layouts.dashboard')

@section('title', 'Edit Kasir | UD Jaya Mebel')
@section('page-title', 'Edit Kasir')

@section('content')
    <div class="row justify-content-center">
        <div class="col-12 col-md-8 col-lg-6">
            <div class="glass-panel p-4">
                <form action="{{ route('admin.cashiers.update', $cashier) }}" method="POST" class="vstack gap-3">
                    @csrf
                    @method('PUT')

                    <div>
                        <label for="nama" class="form-label fw-semibold">Nama Lengkap</label>
                        <input type="text" id="nama" name="nama" value="{{ old('nama', $cashier->nama) }}"
                               class="form-control @error('nama') is-invalid @enderror"
                               placeholder="Nama lengkap kasir" required>
                        @error('nama')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div>
                        <label for="email" class="form-label fw-semibold">Email</label>
                        <input type="email" id="email" name="email" value="{{ old('email', $cashier->email) }}"
                               class="form-control @error('email') is-invalid @enderror"
                               placeholder="Email kasir" required>
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div style="background:var(--surface-alt);border:1px solid var(--border-color);border-radius:12px;padding:1.25rem">
                        <p class="text-muted mb-3" style="font-size:.78rem;font-weight:600;text-transform:uppercase;letter-spacing:.05em">
                            <i class="bi bi-shield-lock me-1"></i> Ganti Password
                        </p>
                        <div class="vstack gap-3">
                            <div>
                                <label for="password" class="form-label fw-semibold">Password Baru</label>
                                <input type="password" id="password" name="password"
                                       class="form-control @error('password') is-invalid @enderror"
                                       placeholder="Kosongkan jika tidak diubah" minlength="8">
                                @error('password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div>
                                <label for="password_confirmation" class="form-label fw-semibold">Konfirmasi Password Baru</label>
                                <input type="password" id="password_confirmation" name="password_confirmation"
                                       class="form-control" placeholder="Ulangi password baru" minlength="8">
                            </div>
                        </div>
                    </div>

                    <div class="d-flex gap-2 pt-2">
                        <button type="submit" class="btn btn-primary flex-grow-1">
                            <i class="bi bi-check-lg me-1"></i> Simpan Perubahan
                        </button>
                        <a href="{{ route('admin.cashiers.index') }}" class="btn btn-outline-danger">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
