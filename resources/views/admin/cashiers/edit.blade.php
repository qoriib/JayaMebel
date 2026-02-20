@extends('layouts.dashboard')

@section('title', 'Edit Kasir | UD Jaya Mebel')
@section('page-title', 'Edit Kasir')

@section('content')
    <div class="d-flex align-items-center gap-3 mb-4">
        <a href="{{ route('admin.cashiers.index') }}" class="btn-outline-custom d-flex align-items-center gap-1 text-decoration-none" style="font-size:.85rem">
            <i class="bi bi-arrow-left"></i> Kembali
        </a>
        <div>
            <h1 class="h5 fw-bold mb-0">Edit Kasir</h1>
            <p class="text-muted mb-0" style="font-size:.8rem">Perbarui data akun kasir <span class="fw-600" style="color:var(--accent)">{{ $cashier->nama }}</span></p>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-12 col-md-8 col-lg-6">
            <div class="section-card">
                <form action="{{ route('admin.cashiers.update', $cashier) }}" method="POST" class="vstack gap-4">
                    @csrf
                    @method('PUT')

                    <div>
                        <label for="nama" class="form-label fw-600">Nama Lengkap</label>
                        <input type="text" id="nama" name="nama" value="{{ old('nama', $cashier->nama) }}"
                               class="form-control @error('nama') is-invalid @enderror"
                               placeholder="Nama lengkap kasir" required>
                        @error('nama')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div>
                        <label for="email" class="form-label fw-600">Email</label>
                        <input type="email" id="email" name="email" value="{{ old('email', $cashier->email) }}"
                               class="form-control @error('email') is-invalid @enderror"
                               placeholder="Email kasir" required>
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div style="background:var(--surface-alt);border:1px solid var(--border-color);border-radius:12px;padding:1.25rem">
                        <p class="text-muted mb-3" style="font-size:.78rem;font-weight:600;text-transform:uppercase;letter-spacing:.05em">
                            <i class="bi bi-shield-lock me-1"></i> Ganti Password (Opsional)
                        </p>
                        <div class="vstack gap-3">
                            <div>
                                <label for="password" class="form-label fw-600">Password Baru</label>
                                <input type="password" id="password" name="password"
                                       class="form-control @error('password') is-invalid @enderror"
                                       placeholder="Kosongkan jika tidak diubah" minlength="8">
                                @error('password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div>
                                <label for="password_confirmation" class="form-label fw-600">Konfirmasi Password Baru</label>
                                <input type="password" id="password_confirmation" name="password_confirmation"
                                       class="form-control" placeholder="Ulangi password baru" minlength="8">
                            </div>
                        </div>
                    </div>

                    <div class="d-flex gap-3 pt-2">
                        <button type="submit" class="btn-accent flex-grow-1">
                            <i class="bi bi-check-lg me-1"></i> Simpan Perubahan
                        </button>
                        <a href="{{ route('admin.cashiers.index') }}" class="btn-outline-custom text-decoration-none">Batal</a>
                    </div>
                </form>
            </div>

            {{-- Danger Zone --}}
            <div class="section-card mt-4" style="border-color:rgba(220,53,69,.2)">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <p class="fw-600 mb-0" style="color:#dc3545">Hapus Kasir</p>
                        <p class="text-muted mb-0" style="font-size:.8rem">Akun kasir akan dihapus permanen dan tidak bisa dipulihkan.</p>
                    </div>
                    <form action="{{ route('admin.cashiers.destroy', $cashier) }}" method="POST"
                          onsubmit="return confirm('Hapus kasir {{ $cashier->nama }} secara permanen?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-outline-danger" style="border-radius:10px;font-size:.85rem">
                            <i class="bi bi-trash me-1"></i> Hapus Akun
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection