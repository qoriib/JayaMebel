<!DOCTYPE html>
<html lang="id">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>@yield('title', 'Halaman') | UD Jaya Mebel</title>
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
        @stack('styles')
    </head>
    <body>

        {{-- ── Navbar ── --}}
        <nav id="site-navbar">
            <div class="container-xl d-flex align-items-center gap-2">

                {{-- Logo --}}
                <a href="{{ route('landing') }}" class="navbar-brand-logo me-auto">
                    <div class="logo-icon"><i class="bi bi-house-heart-fill"></i></div>
                    <div>
                        <div class="brand-name">Jaya Mebel</div>
                        <div class="brand-sub">UD Jaya Mebel</div>
                    </div>
                </a>

                {{-- Desktop nav links (md+) --}}
                <div class="d-none d-md-flex align-items-center gap-1">
                    <a href="{{ route('landing') }}" class="nav-link-custom {{ request()->routeIs('landing') ? 'active' : '' }}">Beranda</a>
                    <a href="{{ route('landing') }}#catalogue" class="nav-link-custom">Katalog</a>
                    <a href="{{ route('landing') }}#custom" class="nav-link-custom">Custom</a>
                    <a href="{{ route('landing') }}#kontak" class="nav-link-custom">Kontak</a>
                </div>

                {{-- Mobile hamburger (< md) --}}
                <button id="nav-toggler" class="d-md-none"
                        data-bs-toggle="offcanvas"
                        data-bs-target="#mobile-nav"
                        aria-controls="mobile-nav"
                        aria-label="Buka menu">
                    <i class="bi bi-list"></i>
                </button>
            </div>
        </nav>

        {{-- ── Mobile Offcanvas ── --}}
        <div class="offcanvas offcanvas-end" tabindex="-1" id="mobile-nav" aria-labelledby="mobile-nav-label">
            <div class="offcanvas-header" style="border-bottom:1px solid var(--border-color);padding:1.1rem 1.25rem">
                <div class="navbar-brand-logo">
                    <div class="logo-icon" style="width:34px;height:34px;font-size:1rem"><i class="bi bi-house-heart-fill"></i></div>
                    <div>
                        <div class="brand-name" id="mobile-nav-label">Jaya Mebel</div>
                        <div class="brand-sub">UD Jaya Mebel</div>
                    </div>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Tutup"></button>
            </div>
            <div class="offcanvas-body d-flex flex-column p-3 gap-1">

                {{-- Nav links --}}
                <p class="offcanvas-section-label">Menu</p>
                <a href="{{ route('landing') }}" class="nav-link-custom {{ request()->routeIs('landing') ? 'active' : '' }}" data-bs-dismiss="offcanvas">
                    <i class="bi bi-house me-2"></i>Beranda
                </a>
                <a href="{{ route('landing') }}#catalogue" class="nav-link-custom" data-bs-dismiss="offcanvas">
                    <i class="bi bi-grid me-2"></i>Katalog Produk
                </a>
                <a href="{{ route('landing') }}#custom" class="nav-link-custom" data-bs-dismiss="offcanvas">
                    <i class="bi bi-pencil-square me-2"></i>Custom Order
                </a>
                <a href="{{ route('landing') }}#kontak" class="nav-link-custom" data-bs-dismiss="offcanvas">
                    <i class="bi bi-telephone me-2"></i>Kontak
                </a>
            </div>
        </div>

        {{-- ── Main Content ── --}}
        <main id="site-content">
            <div class="container-xl">
                @if (session('success'))
                    <div class="alert alert-success mb-4" style="border-radius:12px">{{ session('success') }}</div>
                @endif
                @if ($errors->any())
                    <div class="alert alert-danger mb-4" style="border-radius:12px">
                        <ul class="mb-0 ps-3">@foreach ($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
                    </div>
                @endif
                @yield('content')
            </div>
        </main>

        {{-- ── Footer ── --}}
        <footer id="site-footer">
            <div class="container-xl">
                <div class="row g-4">
                    <div class="col-12 col-md-4">
                        <div class="footer-brand d-flex align-items-center gap-3 mb-3">
                            <div class="logo-icon"><i class="bi bi-house-heart-fill"></i></div>
                            <div>
                                <div class="fw-bold" style="font-size:1rem">Jaya Mebel</div>
                                <div style="font-size:.72rem;color:var(--text-muted)">UD Jaya Mebel</div>
                            </div>
                        </div>
                        <p style="font-size:.875rem;color:var(--text-muted);line-height:1.65">
                            Furnitur berkualitas dengan bahan terbaik. Melayani pesanan custom dan siap kirim ke seluruh Indonesia.
                        </p>
                        <div class="d-flex gap-2 mt-3">
                            <a href="https://wa.me/{{ config('company.whatsapp') }}" target="_blank"
                               style="width:34px;height:34px;border-radius:8px;background:var(--surface-alt);border:1px solid var(--border-color);display:flex;align-items:center;justify-content:center;color:var(--text-muted);text-decoration:none;font-size:.95rem;transition:color .2s,background .2s"
                               onmouseover="this.style.background='var(--accent-soft)';this.style.color='var(--accent)'"
                               onmouseout="this.style.background='var(--surface-alt)';this.style.color='var(--text-muted)'">
                                <i class="bi bi-whatsapp"></i>
                            </a>
                            <a href="mailto:{{ config('company.email') }}"
                               style="width:34px;height:34px;border-radius:8px;background:var(--surface-alt);border:1px solid var(--border-color);display:flex;align-items:center;justify-content:center;color:var(--text-muted);text-decoration:none;font-size:.95rem;transition:color .2s,background .2s"
                               onmouseover="this.style.background='var(--accent-soft)';this.style.color='var(--accent)'"
                               onmouseout="this.style.background='var(--surface-alt)';this.style.color='var(--text-muted)'">
                                <i class="bi bi-envelope"></i>
                            </a>
                        </div>
                    </div>

                    <div class="col-6 col-md-3 offset-md-1">
                        <p class="footer-heading">Menu</p>
                        <a href="{{ route('landing') }}" class="footer-link">Beranda</a>
                        <a href="{{ route('landing') }}#catalogue" class="footer-link">Katalog Produk</a>
                        <a href="{{ route('landing') }}#custom" class="footer-link">Custom Order</a>
                        <a href="{{ route('landing') }}#kontak" class="footer-link">Hubungi Kami</a>
                    </div>

                    <div class="col-12 col-md-3" id="kontak">
                        <p class="footer-heading">Kontak</p>
                        <p style="font-size:.875rem;color:var(--text-muted);margin-bottom:.5rem">
                            <i class="bi bi-geo-alt me-2" style="color:var(--accent)"></i>Jl. Raya Mebel No.1, Jepara
                        </p>
                        <p style="font-size:.875rem;color:var(--text-muted);margin-bottom:.5rem">
                            <i class="bi bi-telephone me-2" style="color:var(--accent)"></i>{{ config('company.phone_display') }}
                        </p>
                        <p style="font-size:.875rem;color:var(--text-muted);margin-bottom:.5rem">
                            <i class="bi bi-envelope me-2" style="color:var(--accent)"></i>{{ config('company.email') }}
                        </p>
                        <p style="font-size:.875rem;color:var(--text-muted);margin-bottom:0">
                            <i class="bi bi-clock me-2" style="color:var(--accent)"></i>Sen–Sab, 09.00–20.00 WIB
                        </p>
                    </div>
                </div>

                <div class="footer-bottom d-flex flex-wrap align-items-center justify-content-between gap-2">
                    <span>&copy; {{ date('Y') }} UD Jaya Mebel. Hak cipta dilindungi.</span>
                    <span>Dibuat untuk pelanggan setia kami</span>
                </div>
            </div>
        </footer>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
        @stack('scripts')
    </body>
</html>
