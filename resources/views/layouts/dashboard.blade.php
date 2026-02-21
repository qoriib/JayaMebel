@php
    $user = auth()->user();
@endphp

<!DOCTYPE html>
<html lang="id">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>@yield('title', 'UD Jaya Mebel')</title>
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
        <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
        @stack('styles')
    </head>
    <body>
        <div id="app-wrapper">

            {{-- ── Sidebar ── --}}
            <aside id="app-sidebar">
                {{-- Logo --}}
                <div class="sidebar-logo">
                    <div class="d-flex align-items-center gap-2 text-decoration-none">
                        <div class="logo-icon">
                            <i class="bi bi-house-heart-fill"></i>
                        </div>
                        <div>
                            <div class="brand-name">Jaya Mebel</div>
                            <div class="brand-sub">UD Jaya Mebel</div>
                        </div>
                    </div>
                </div>

                {{-- Navigation --}}
                <nav class="sidebar-nav">
                    @if($user->role === 'admin')
                        <div class="sidebar-section-label">Utama</div>
                        <a href="{{ route('admin.dashboard') }}" class="sidebar-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                            <i class="bi bi-speedometer2"></i> Dashboard
                        </a>
                        <div class="sidebar-section-label">Manajemen</div>
                        <a href="{{ route('admin.cashiers.index') }}" class="sidebar-link {{ request()->routeIs('admin.cashiers.*') ? 'active' : '' }}">
                            <i class="bi bi-people"></i> Data Kasir
                        </a>
                        <div class="sidebar-section-label">Laporan</div>
                        <a href="{{ route('admin.reports.sales') }}" class="sidebar-link {{ request()->routeIs('admin.reports.sales*') ? 'active' : '' }}">
                            <i class="bi bi-bar-chart-line"></i> Laporan Penjualan
                        </a>
                        <a href="{{ route('admin.reports.stock') }}" class="sidebar-link {{ request()->routeIs('admin.reports.stock') ? 'active' : '' }}">
                            <i class="bi bi-boxes"></i> Laporan Stok
                        </a>
                    @else
                        <div class="sidebar-section-label">Utama</div>
                        <a href="{{ route('cashier.dashboard') }}" class="sidebar-link {{ request()->routeIs('cashier.dashboard') ? 'active' : '' }}">
                            <i class="bi bi-speedometer2"></i> Dashboard
                        </a>
                        <div class="sidebar-section-label">Transaksi</div>
                        <a href="{{ route('cashier.sales.index') }}" class="sidebar-link {{ request()->routeIs('cashier.sales.*') ? 'active' : '' }}">
                            <i class="bi bi-cart3"></i> Penjualan
                        </a>
                        <div class="sidebar-section-label">Inventori</div>
                        <a href="{{ route('cashier.products.index') }}" class="sidebar-link {{ request()->routeIs('cashier.products.*') ? 'active' : '' }}">
                            <i class="bi bi-box-seam"></i> Data Produk
                        </a>
                    @endif
                </nav>

                {{-- Footer: User info + Logout --}}
                <div class="sidebar-footer">
                    <div class="sidebar-user">
                        <div class="avatar">
                            {{ strtoupper(substr($user->nama ?? 'U', 0, 1)) }}
                        </div>
                        <div class="overflow-hidden">
                            <div class="user-name">{{ $user->nama ?? 'Pengguna' }}</div>
                            <div class="user-role">
                                @if($user->role === 'admin')
                                    Administrator
                                @else
                                    Kasir
                                @endif
                            </div>
                        </div>
                    </div>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="btn-logout">
                            <i class="bi bi-box-arrow-right"></i>
                            Keluar Akun
                        </button>
                    </form>
                </div>
            </aside>

            {{-- ── Main Content Area ── --}}
            <div id="app-content">
                {{-- Topbar --}}
                <header id="app-topbar">
                    <button class="topbar-toggle" id="sidebarToggle" aria-label="Toggle sidebar">
                        <i class="bi bi-list"></i>
                    </button>
                    <div class="topbar-title">@yield('page-title', 'Dashboard')</div>
                    <span class="topbar-badge d-none d-sm-inline">
                        @if($user->role === 'admin')
                            <i class="bi bi-shield-check me-1"></i>Admin
                        @else
                            <i class="bi bi-person-badge me-1"></i>Kasir
                        @endif
                    </span>
                </header>

                {{-- Alerts --}}
                <div class="page-body pb-0">
                    @if (session('success'))
                        <div class="alert alert-success d-flex align-items-center gap-2 mb-4 shadow-sm">
                            <i class="bi bi-check-circle-fill text-success"></i>
                            {{ session('success') }}
                        </div>
                    @endif

                    @if ($errors->any())
                        <div class="alert alert-danger mb-4 shadow-sm">
                            <ul class="mb-0 ps-3">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </div>

                {{-- Page Content --}}
                <main class="page-body pt-0">
                    @yield('content')
                </main>
            </div>
        </div>

        {{-- Sidebar overlay for mobile --}}
        <div id="sidebar-overlay"></div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
        <script>
            const sidebar = document.getElementById('app-sidebar');
            const overlay = document.getElementById('sidebar-overlay');
            const toggle  = document.getElementById('sidebarToggle');

            function openSidebar() {
                sidebar.classList.add('show');
                overlay.classList.add('show');
            }

            function closeSidebar() {
                sidebar.classList.remove('show');
                overlay.classList.remove('show');
            }

            toggle?.addEventListener('click', () => {
                sidebar.classList.contains('show') ? closeSidebar() : openSidebar();
            });

            overlay?.addEventListener('click', closeSidebar);
        </script>
        @stack('scripts')
    </body>
</html>
