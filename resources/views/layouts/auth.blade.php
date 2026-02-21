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
                --accent:       #c07a36;
                --accent-dark:  #9e6029;
                --accent-soft:  rgba(192, 122, 54, .13);
                --bg:           #f7f4ef;
                --surface:      #ffffff;
                --surface-alt:  #f1ede6;
                --border-color: rgba(27, 24, 20, .09);
                --text-main:    #2b2b2b;
                --text-muted:   rgba(43, 43, 43, .56);
                --card-radius:  16px;
            }

            *, *::before, *::after { box-sizing: border-box; }

            body {
                font-family: 'Plus Jakarta Sans', 'Segoe UI', sans-serif;
                background: var(--bg);
                color: var(--text-main);
                min-height: 100vh;
                display: flex;
                flex-direction: column;
                align-items: center;
                justify-content: center;
                padding: 1.5rem;
            }

            .auth-card {
                width: 100%;
                max-width: 420px;
                background: var(--surface);
                border: 1px solid var(--border-color);
                border-radius: var(--card-radius);
                box-shadow: 0 8px 40px rgba(63, 48, 31, .10);
                padding: 2.5rem 2rem;
            }

            .brand-mark {
                width: 48px;
                height: 48px;
                border-radius: 14px;
                background: linear-gradient(135deg, var(--accent), var(--accent-dark));
                display: flex;
                align-items: center;
                justify-content: center;
                color: #fff;
                font-size: 1.35rem;
                flex-shrink: 0;
            }

            .form-control {
                border-color: var(--border-color);
                border-radius: 10px;
                font-size: .9rem;
                padding: .65rem .9rem;
                transition: border-color .2s, box-shadow .2s;
            }

            .form-control:focus {
                border-color: var(--accent);
                box-shadow: 0 0 0 3px var(--accent-soft);
            }

            .form-label {
                font-size: .82rem;
                font-weight: 600;
                color: var(--text-main);
                margin-bottom: .35rem;
            }

            .btn-submit {
                width: 100%;
                padding: .75rem;
                background: var(--accent);
                color: #fff;
                border: none;
                border-radius: 10px;
                font-size: .95rem;
                font-weight: 700;
                cursor: pointer;
                transition: background .2s, transform .15s;
                display: flex;
                align-items: center;
                justify-content: center;
                gap: .5rem;
            }

            .btn-submit:hover {
                background: var(--accent-dark);
                transform: translateY(-1px);
            }

            .back-link {
                font-size: .82rem;
                color: var(--text-muted);
                text-decoration: none;
                transition: color .2s;
                display: inline-flex;
                align-items: center;
                gap: .3rem;
            }

            .back-link:hover { color: var(--accent); }
        </style>
    </head>
    <body>

        @yield('content')

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
    </body>
</html>
