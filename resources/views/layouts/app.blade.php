<!DOCTYPE html>
<html lang="id">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>@yield('title', 'UD Jaya Mebel')</title>
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@400;500;600;700&display=swap" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
        <style>
            :root {
                --surface: #061622;
                --surface-alt: #0f2737;
                --accent: #f4a62a;
                --accent-soft: rgba(244, 166, 42, 0.12);
                --text-primary: #f3f6fb;
                --text-muted: rgba(243, 246, 251, 0.7);
                --card-radius: 20px;
            }

            * {
                font-family: 'Space Grotesk', 'Segoe UI', sans-serif;
            }

            body {
                min-height: 100vh;
                background: radial-gradient(circle at top, #0e3a52, #041018 55%);
                color: var(--text-primary);
            }

            .glass-panel {
                background: rgba(15, 39, 55, 0.75);
                backdrop-filter: blur(16px);
                border: 1px solid rgba(255, 255, 255, 0.08);
                border-radius: var(--card-radius);
                box-shadow: 0 20px 60px rgba(0, 0, 0, 0.35);
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
                background: rgba(255, 255, 255, 0.02);
                border: 1px solid rgba(255, 255, 255, 0.07);
                transition: transform 0.3s ease, border-color 0.3s ease;
            }

            .metric-card:hover {
                transform: translateY(-4px);
                border-color: var(--accent);
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
                --bs-table-hover-bg: rgba(255, 255, 255, 0.05);
            }

            .page-wrapper {
                padding: 2.5rem 1rem 4rem;
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
