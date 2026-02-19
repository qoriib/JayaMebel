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
        <style>
            :root {
                --bg: #f7f4ef;
                --bg-alt: #fff9f3;
                --surface: #ffffff;
                --surface-alt: #f1ede6;
                --accent: #c07a36;
                --accent-soft: rgba(192, 122, 54, 0.14);
                --text-primary: #2b2b2b;
                --text-muted: rgba(43, 43, 43, 0.6);
                --card-radius: 18px;
                --border-color: rgba(27, 24, 20, 0.08);
            }

            * {
                font-family: 'Plus Jakarta Sans', 'Segoe UI', sans-serif;
            }

            body {
                min-height: 100vh;
                background: radial-gradient(circle at 20% 20%, #fff, var(--bg-alt)), radial-gradient(circle at 80% 0, #f0e3d3, var(--bg));
                color: var(--text-primary);
            }

            .glass-panel {
                background: var(--surface);
                backdrop-filter: blur(8px);
                border: 1px solid var(--border-color);
                border-radius: var(--card-radius);
                box-shadow: 0 18px 40px rgba(63, 48, 31, 0.08);
            }

            .accent-chip {
                background: var(--accent-soft);
                color: var(--accent);
                font-size: 0.85rem;
                border-radius: 999px;
                padding: 0.45rem 1rem;
                display: inline-flex;
                align-items: center;
                gap: 0.35rem;
            }

            .metric-card {
                border-radius: var(--card-radius);
                padding: 1.5rem;
                background: linear-gradient(135deg, var(--surface), var(--surface-alt));
                border: 1px solid var(--border-color);
                transition: transform 0.3s ease, box-shadow 0.3s ease;
            }

            .metric-card:hover {
                transform: translateY(-4px);
                box-shadow: 0 25px 45px rgba(192, 122, 54, 0.15);
            }

            .metric-value {
                font-size: clamp(1.8rem, 3vw, 2.8rem);
                font-weight: 600;
            }

            .metric-label {
                color: var(--text-muted);
                letter-spacing: 0.04em;
                text-transform: uppercase;
                font-size: 0.85rem;
            }

            .table-dark-custom {
                --bs-table-bg: transparent;
                --bs-table-color: var(--text-primary);
                --bs-table-hover-bg: rgba(192, 122, 54, 0.08);
                --bs-table-striped-bg: rgba(192, 122, 54, 0.04);
            }

            .page-wrapper {
                padding: 2.5rem 1rem 4rem;
            }

            .btn-warning,
            .btn-outline-light,
            .btn-outline-info,
            .btn-outline-danger,
            .btn-outline-light:hover {
                border-radius: 999px;
            }

            .form-control,
            .form-select,
            .btn,
            .table {
                border-radius: var(--card-radius);
            }

            @media (min-width: 992px) {
                .page-wrapper {
                    padding: 3rem 2rem 4rem;
                }
            }
        </style>
        @stack('styles')
    </head>
    <body>
        <div class="page-wrapper">
            <main class="container-xl">
                @if (session('success'))
                    <div class="alert alert-success glass-panel border-0 text-dark shadow-sm mb-4">
                        {{ session('success') }}
                    </div>
                @endif

                @if ($errors->any())
                    <div class="alert alert-danger glass-panel border-0 text-dark shadow-sm mb-4">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @yield('content')
            </main>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
        @stack('scripts')
    </body>
</html>
