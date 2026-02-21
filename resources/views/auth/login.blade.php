@extends('layouts.auth')

@section('title', 'Masuk | UD Jaya Mebel')

@section('content')
    <div class="auth-card">

        {{-- Brand --}}
        <div class="d-flex align-items-center gap-3 mb-4">
            <div class="brand-mark">
                <i class="bi bi-house-heart-fill"></i>
            </div>
            <div>
                <div class="fw-bold" style="font-size:1rem;line-height:1.2">UD Jaya Mebel</div>
                <div style="font-size:.72rem;color:var(--text-muted)">Panel Manajemen</div>
            </div>
        </div>

        <h1 class="fw-bold mb-1" style="font-size:1.25rem">Selamat datang kembali</h1>
        <p class="mb-4" style="font-size:.85rem;color:var(--text-muted)">Masuk untuk melanjutkan ke dashboard.</p>

        {{-- Error --}}
        @error('email')
            <div class="d-flex align-items-center gap-2 mb-3 p-3"
                 style="background:#fff5f5;border:1px solid #fecaca;border-radius:10px;font-size:.85rem;color:#b91c1c">
                <i class="bi bi-exclamation-circle-fill flex-shrink-0"></i>
                {{ $message }}
            </div>
        @enderror

        <form action="{{ route('login.attempt') }}" method="POST" class="vstack gap-3">
            @csrf

            <div>
                <label for="email" class="form-label">Alamat Email</label>
                <input type="email" id="email" name="email"
                       value="{{ old('email') }}"
                       class="form-control @error('email') is-invalid @enderror"
                       placeholder="nama@jayamebel.id"
                       required autofocus>
            </div>

            <div>
                <label for="password" class="form-label">Password</label>
                <div class="position-relative">
                    <input type="password" id="password" name="password"
                           class="form-control pe-5"
                           placeholder="••••••••"
                           required>
                    <button type="button"
                            onclick="var i=document.getElementById('password');i.type=i.type==='password'?'text':'password';this.querySelector('i').className=i.type==='password'?'bi bi-eye':'bi bi-eye-slash'"
                            class="position-absolute top-50 end-0 translate-middle-y border-0 bg-transparent pe-3"
                            style="color:var(--text-muted);cursor:pointer;line-height:1" tabindex="-1">
                        <i class="bi bi-eye"></i>
                    </button>
                </div>
            </div>

            <div class="d-flex align-items-center justify-content-between">
                <div class="form-check mb-0">
                    <input class="form-check-input" type="checkbox" id="remember" name="remember" value="1" @checked(old('remember'))>
                    <label class="form-check-label" for="remember" style="font-size:.83rem">Ingat saya</label>
                </div>
            </div>

            <button type="submit" class="btn-submit mt-1">
                <i class="bi bi-box-arrow-in-right"></i> Masuk
            </button>
        </form>

        <div class="text-center mt-4">
            <a href="{{ route('landing') }}" class="back-link">
                <i class="bi bi-arrow-left"></i> Kembali ke beranda
            </a>
        </div>
    </div>
@endsection

