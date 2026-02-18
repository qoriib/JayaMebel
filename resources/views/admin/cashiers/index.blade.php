@extends('layouts.app')

@section('title', 'Manajemen Kasir | UD Jaya Mebel')

@section('content')
    <div class="row g-4">
        <div class="col-12 col-lg-4">
            <section class="glass-panel p-4 h-100">
                <h1 class="h4 fw-semibold mb-3">Tambah Kasir Baru</h1>
                <form action="{{ route('admin.cashiers.store') }}" method="POST" class="vstack gap-3">
                    @csrf
                    <div>
                        <label for="nama" class="form-label">Nama Lengkap</label>
                        <input type="text" id="nama" name="nama" class="form-control" placeholder="Contoh: Dinda Rahma" required>
                    </div>
                    <div>
                        <label for="email" class="form-label">Email</label>
                        <input type="email" id="email" name="email" class="form-control" placeholder="kasir@jayamebel.id" required>
                    </div>
                    <div>
                        <label for="password" class="form-label">Password</label>
                        <input type="password" id="password" name="password" class="form-control" minlength="8" required>
                        <small class="text-muted">Minimal 8 karakter dan kombinasi angka.</small>
                    </div>
                    <div>
                        <label for="password_confirmation" class="form-label">Konfirmasi Password</label>
                        <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" minlength="8" required>
                    </div>
                    <button type="submit" class="btn btn-warning text-dark fw-semibold">Simpan Kasir</button>
                </form>
            </section>
        </div>
        <div class="col-12 col-lg-8">
            <section class="glass-panel p-4">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <div>
                        <p class="accent-chip mb-2"><span aria-hidden="true">👥</span> Akun Kasir Aktif</p>
                        <h2 class="h4 mb-0">Daftar Kasir</h2>
                    </div>
                    <span class="text-muted">Total: {{ $cashiers->total() }}</span>
                </div>
                <div class="table-responsive">
                    <table class="table table-dark table-dark-custom align-middle">
                        <thead>
                            <tr>
                                <th>Nama</th>
                                <th>Email</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($cashiers as $cashier)
                                <tr>
                                    <td colspan="3">
                                        <form action="{{ route('admin.cashiers.update', $cashier) }}" method="POST" class="row g-3 align-items-end">
                                            @csrf
                                            @method('PUT')
                                            <div class="col-md-4">
                                                <label class="form-label" for="nama-{{ $cashier->id }}">Nama</label>
                                                <input id="nama-{{ $cashier->id }}" type="text" name="nama" value="{{ $cashier->nama }}" class="form-control" required>
                                            </div>
                                            <div class="col-md-4">
                                                <label class="form-label" for="email-{{ $cashier->id }}">Email</label>
                                                <input id="email-{{ $cashier->id }}" type="email" name="email" value="{{ $cashier->email }}" class="form-control" required>
                                            </div>
                                            <div class="col-md-3">
                                                <label class="form-label" for="password-{{ $cashier->id }}">Password Baru</label>
                                                <input id="password-{{ $cashier->id }}" type="password" name="password" class="form-control" placeholder="Opsional" minlength="8">
                                            </div>
                                            <div class="col-md-3">
                                                <label class="form-label" for="password-confirm-{{ $cashier->id }}">Konfirmasi</label>
                                                <input id="password-confirm-{{ $cashier->id }}" type="password" name="password_confirmation" class="form-control" placeholder="Opsional" minlength="8">
                                            </div>
                                            <div class="col-md-2 d-flex gap-2">
                                                <button type="submit" class="btn btn-sm btn-outline-light flex-fill">Simpan</button>
                                            </div>
                                        </form>
                                        <div class="mt-2 d-flex justify-content-end">
                                            <form action="{{ route('admin.cashiers.destroy', $cashier) }}" method="POST" onsubmit="return confirm('Hapus kasir ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-outline-danger">Hapus</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="text-center text-muted">Belum ada akun kasir.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="mt-3">
                    {{ $cashiers->links() }}
                </div>
            </section>
        </div>
    </div>
@endsection
