@extends('layouts.app')

@section('title', 'Masuk | UD Jaya Mebel')

@section('content')
    <section class="row justify-content-center min-vh-100 align-items-center">
        <div class="col-12 col-lg-8">
            <div class="glass-panel p-4 p-lg-5">
                <div class="row g-4 align-items-center">
                    <div class="col-12 col-lg-6">
                        <p class="accent-chip mb-3"><span aria-hidden="true">🔑</span> Masuk Dashboard</p>
                        <h1 class="h3 fw-semibold mb-3">Selamat datang kembali!</h1>
                        <p class="text-muted mb-4">Masuk untuk mengelola penjualan, memantau stok, dan melayani pelanggan UD Jaya Mebel.</p>
                        <ul class="list-unstyled text-muted small vstack gap-2">
                            <li>• Pantau performa penjualan real-time.</li>
                            <li>• Kelola kasir dan status stok produk.</li>
                            <li>• Catat transaksi kasir lebih cepat.</li>
                        </ul>
                    </div>
                    <div class="col-12 col-lg-6">
                        <form action="{{ route('login.attempt') }}" method="POST" class="vstack gap-3">
                            @csrf
                            <div>
                                <label for="email" class="form-label">Email</label>
                                <input type="email" id="email" name="email" value="{{ old('email') }}" class="form-control form-control-lg" placeholder="admin@jayamebel.id" required autofocus>
                            </div>
                            <div>
                                <label for="password" class="form-label">Password</label>
                                <input type="password" id="password" name="password" class="form-control form-control-lg" placeholder="••••••••" required>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="1" id="remember" name="remember" @checked(old('remember'))>
                                <label class="form-check-label" for="remember">
                                    Ingat saya di perangkat ini
                                </label>
                            </div>
                            <button type="submit" class="btn btn-warning text-dark fw-semibold py-3">Masuk Sekarang</button>
                        </form>
                        @error('email')
                            <div class="alert alert-danger mt-3">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
