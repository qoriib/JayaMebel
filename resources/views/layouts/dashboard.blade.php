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
        <style>
            :root {
                --bg: #f7f4ef;
                --bg-alt: #fff9f3;
                --surface: #ffffff;
                --surface-alt: #f1ede6;
                --accent: #c07a36;
                --accent-dark: #9e6029;
                --accent-soft: rgba(192, 122, 54, 0.14);
                --text-primary: #2b2b2b;
                --text-muted: rgba(43, 43, 43, 0.55);
                --border-color: rgba(27, 24, 20, 0.08);
                --sidebar-width: 260px;
                --topbar-height: 64px;
                --card-radius: 16px;
            }

            * {
                font-family: 'Plus Jakarta Sans', 'Segoe UI', sans-serif;
            }

            html, body {
                height: 100%;
                margin: 0;
                background: var(--bg);
                color: var(--text-primary);
            }

            /* ── Sidebar ── */
            #app-sidebar {
                width: var(--sidebar-width);
                min-height: 100vh;
                background: var(--surface);
                border-right: 1px solid var(--border-color);
                display: flex;
                flex-direction: column;
                position: fixed;
                top: 0;
                left: 0;
                z-index: 1040;
                transition: transform 0.3s ease;
            }

            .sidebar-logo {
                padding: 1.5rem 1.25rem 1rem;
                border-bottom: 1px solid var(--border-color);
            }

            .sidebar-logo .brand-name {
                font-size: 1rem;
                font-weight: 700;
                color: var(--text-primary);
                line-height: 1.2;
            }

            .sidebar-logo .brand-sub {
                font-size: 0.72rem;
                color: var(--text-muted);
                letter-spacing: 0.04em;
                text-transform: uppercase;
            }

            .sidebar-logo .logo-icon {
                width: 36px;
                height: 36px;
                background: var(--accent-soft);
                border-radius: 10px;
                display: flex;
                align-items: center;
                justify-content: center;
                color: var(--accent);
                font-size: 1.1rem;
            }

            .sidebar-nav {
                flex: 1;
                overflow-y: auto;
                padding: 1rem 0.75rem;
            }

            .sidebar-section-label {
                font-size: 0.68rem;
                font-weight: 600;
                letter-spacing: 0.08em;
                text-transform: uppercase;
                color: var(--text-muted);
                padding: 0.75rem 0.75rem 0.4rem;
                margin-top: 0.5rem;
            }

            .sidebar-link {
                display: flex;
                align-items: center;
                gap: 0.65rem;
                padding: 0.6rem 0.85rem;
                border-radius: 10px;
                color: var(--text-muted);
                text-decoration: none;
                font-size: 0.875rem;
                font-weight: 500;
                transition: background 0.2s, color 0.2s;
                margin-bottom: 2px;
            }

            .sidebar-link i {
                font-size: 1rem;
                width: 20px;
                text-align: center;
                flex-shrink: 0;
            }

            .sidebar-link:hover {
                background: var(--accent-soft);
                color: var(--accent);
            }

            .sidebar-link.active {
                background: var(--accent);
                color: #fff;
                font-weight: 600;
            }

            .sidebar-link.active i {
                color: #fff;
            }

            .sidebar-footer {
                padding: 1rem 0.75rem 1.5rem;
                border-top: 1px solid var(--border-color);
            }

            .sidebar-user {
                display: flex;
                align-items: center;
                gap: 0.75rem;
                padding: 0.6rem 0.85rem;
                border-radius: 12px;
                background: var(--surface-alt);
                margin-bottom: 0.75rem;
            }

            .sidebar-user .avatar {
                width: 36px;
                height: 36px;
                border-radius: 50%;
                background: var(--accent);
                color: #fff;
                display: flex;
                align-items: center;
                justify-content: center;
                font-weight: 700;
                font-size: 0.8rem;
                flex-shrink: 0;
            }

            .sidebar-user .user-name {
                font-size: 0.85rem;
                font-weight: 600;
                color: var(--text-primary);
                white-space: nowrap;
                overflow: hidden;
                text-overflow: ellipsis;
            }

            .sidebar-user .user-role {
                font-size: 0.72rem;
                color: var(--text-muted);
            }

            .btn-logout {
                width: 100%;
                display: flex;
                align-items: center;
                justify-content: center;
                gap: 0.5rem;
                padding: 0.55rem 1rem;
                border-radius: 10px;
                font-size: 0.85rem;
                font-weight: 500;
                border: 1px solid rgba(220, 53, 69, 0.25);
                background: rgba(220, 53, 69, 0.08);
                color: #dc3545;
                cursor: pointer;
                transition: background 0.2s, border-color 0.2s;
            }

            .btn-logout:hover {
                background: rgba(220, 53, 69, 0.15);
                border-color: rgba(220, 53, 69, 0.4);
            }

            /* ── Topbar ── */
            #app-topbar {
                height: var(--topbar-height);
                background: var(--surface);
                border-bottom: 1px solid var(--border-color);
                display: flex;
                align-items: center;
                padding: 0 1.75rem;
                gap: 1rem;
                position: sticky;
                top: 0;
                z-index: 1030;
            }

            .topbar-toggle {
                background: none;
                border: none;
                padding: 0.4rem;
                border-radius: 8px;
                color: var(--text-muted);
                font-size: 1.2rem;
                cursor: pointer;
                transition: background 0.2s;
                display: none;
            }

            .topbar-toggle:hover {
                background: var(--accent-soft);
                color: var(--accent);
            }

            .topbar-title {
                font-size: 1rem;
                font-weight: 600;
                color: var(--text-primary);
                flex: 1;
            }

            .topbar-badge {
                font-size: 0.75rem;
                background: var(--accent-soft);
                color: var(--accent);
                border-radius: 6px;
                padding: 0.2rem 0.55rem;
                font-weight: 600;
            }

            /* ── Main Layout ── */
            #app-wrapper {
                display: flex;
                min-height: 100vh;
            }

            #app-content {
                margin-left: var(--sidebar-width);
                flex: 1;
                display: flex;
                flex-direction: column;
                min-width: 0;
            }

            .page-body {
                flex: 1;
                padding: 2rem 1.75rem;
            }

            /* ── Content Cards ── */
            .glass-panel {
                background: var(--surface);
                border: 1px solid var(--border-color);
                border-radius: var(--card-radius);
                box-shadow: 0 2px 12px rgba(63, 48, 31, 0.06);
            }

            .metric-card {
                border-radius: var(--card-radius);
                padding: 1.5rem;
                background: var(--surface);
                border: 1px solid var(--border-color);
                box-shadow: 0 2px 12px rgba(63, 48, 31, 0.06);
                transition: transform 0.2s ease, box-shadow 0.2s ease;
            }

            .metric-card:hover {
                transform: translateY(-3px);
                box-shadow: 0 8px 24px rgba(192, 122, 54, 0.12);
            }

            .metric-value {
                font-size: clamp(1.6rem, 2.5vw, 2.4rem);
                font-weight: 700;
                color: var(--text-primary);
                line-height: 1.1;
            }

            .metric-label {
                color: var(--text-muted);
                letter-spacing: 0.04em;
                text-transform: uppercase;
                font-size: 0.72rem;
                font-weight: 600;
                margin-bottom: 0.5rem;
            }

            .accent-chip {
                background: var(--accent-soft);
                color: var(--accent);
                font-size: 0.78rem;
                font-weight: 600;
                border-radius: 999px;
                padding: 0.3rem 0.85rem;
                display: inline-flex;
                align-items: center;
                gap: 0.3rem;
            }

            .table-custom {
                --bs-table-bg: transparent;
                --bs-table-color: var(--text-primary);
                --bs-table-hover-bg: rgba(192, 122, 54, 0.06);
                --bs-table-striped-bg: rgba(192, 122, 54, 0.03);
            }

            .table-custom thead th {
                font-size: 0.72rem;
                font-weight: 700;
                text-transform: uppercase;
                letter-spacing: 0.06em;
                color: var(--text-muted);
                border-bottom: 2px solid var(--border-color);
                padding-top: 0;
            }

            .btn-primary-custom {
                background: var(--accent);
                color: #fff;
                border: none;
                border-radius: 10px;
                font-weight: 600;
                font-size: 0.875rem;
                padding: 0.55rem 1.25rem;
                transition: background 0.2s;
            }

            .btn-primary-custom:hover {
                background: var(--accent-dark);
                color: #fff;
            }

            .form-control, .form-select {
                border-radius: 10px;
                border: 1px solid var(--border-color);
                font-size: 0.875rem;
            }

            .alert {
                border-radius: 12px;
                border: none;
                font-size: 0.875rem;
            }

            /* ── Sidebar Overlay (mobile) ── */
            #sidebar-overlay {
                display: none;
                position: fixed;
                inset: 0;
                background: rgba(0,0,0,0.4);
                z-index: 1039;
            }

            /* ── Responsive ── */
            @media (max-width: 991.98px) {
                #app-sidebar {
                    transform: translateX(calc(-1 * var(--sidebar-width)));
                }

                #app-sidebar.show {
                    transform: translateX(0);
                }

                #sidebar-overlay.show {
                    display: block;
                }

                #app-content {
                    margin-left: 0;
                }

                .topbar-toggle {
                    display: block;
                }

                .page-body {
                    padding: 1.25rem 1rem;
                }
            }

            @media (min-width: 992px) {
                .page-body {
                    padding: 2rem 2rem;
                }
            }
        </style>
        @stack('styles')
    </head>
    <body>
        <div id="app-wrapper">

            {{-- ── Sidebar ── --}}
            <aside id="app-sidebar">
                {{-- Logo --}}
                <div class="sidebar-logo">
                    <a href="{{ url('/') }}" class="d-flex align-items-center gap-2 text-decoration-none">
                        <div class="logo-icon">
                            <i class="bi bi-house-heart-fill"></i>
                        </div>
                        <div>
                            <div class="brand-name">Jaya Mebel</div>
                            <div class="brand-sub">UD Jaya Mebel</div>
                        </div>
                    </a>
                </div>

                {{-- Navigation --}}
                <nav class="sidebar-nav">
                    @yield('sidebar-links')
                </nav>

                {{-- Footer: User info + Logout --}}
                <div class="sidebar-footer">
                    <div class="sidebar-user">
                        <div class="avatar">
                            {{ strtoupper(substr(auth()->user()->nama ?? 'U', 0, 1)) }}
                        </div>
                        <div class="overflow-hidden">
                            <div class="user-name">{{ auth()->user()->nama ?? 'Pengguna' }}</div>
                            <div class="user-role">
                                @if(auth()->user()->role === 'admin')
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
                        @if(auth()->user()->role === 'admin')
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
