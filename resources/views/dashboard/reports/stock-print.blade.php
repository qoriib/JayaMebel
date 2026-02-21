<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laporan Stok – UD Jaya Mebel</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            font-family: 'Plus Jakarta Sans', 'Segoe UI', sans-serif;
            font-size: 12px;
            color: #1a1a2e;
            background: #fff;
            padding: 32px 40px;
        }

        /* ── Header ── */
        .print-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            padding-bottom: 16px;
            border-bottom: 3px solid #c07a36;
            margin-bottom: 20px;
        }
        .print-header .brand { font-size: 20px; font-weight: 700; color: #1a1a2e; }
        .print-header .subtitle { font-size: 13px; font-weight: 600; color: #4a4a6a; margin-top: 2px; }
        .print-header .meta { text-align: right; font-size: 11px; color: #6b6b8a; line-height: 1.6; }

        /* ── Summary cards ── */
        .summary-row {
            display: flex;
            gap: 16px;
            margin-bottom: 20px;
        }
        .summary-card {
            flex: 1;
            border: 1px solid #e8e5e0;
            border-radius: 8px;
            padding: 12px 16px;
        }
        .summary-card .label { font-size: 10px; font-weight: 600; text-transform: uppercase; letter-spacing: .05em; color: #8a7a6a; }
        .summary-card .value { font-size: 16px; font-weight: 700; color: #1a1a2e; margin-top: 2px; }
        .summary-card .value.available { color: #059669; }
        .summary-card .value.out { color: #dc2626; }

        /* ── Filters applied ── */
        .filter-info {
            font-size: 11px;
            color: #6b6b8a;
            margin-bottom: 16px;
            padding: 8px 14px;
            background: #f8f7f4;
            border-radius: 6px;
            display: flex;
            gap: 24px;
            flex-wrap: wrap;
        }
        .filter-info strong { color: #1a1a2e; }

        /* ── Table ── */
        table { width: 100%; border-collapse: collapse; }

        thead th {
            background: #f8f7f4;
            font-weight: 600;
            font-size: 11px;
            text-transform: uppercase;
            letter-spacing: .04em;
            padding: 9px 10px;
            border-top: 1px solid #d8d5d0;
            border-bottom: 1px solid #d8d5d0;
            color: #4a4a6a;
        }
        thead th:first-child { border-left: 3px solid #c07a36; }

        tbody tr { page-break-inside: avoid; }

        tbody td {
            padding: 8px 10px;
            border-bottom: 1px solid #f0ede8;
            font-size: 12px;
            color: #1a1a2e;
            vertical-align: middle;
        }

        .col-no    { width: 36px; text-align: center; color: #8a7a6a; }
        .col-harga { width: 130px; text-align: right; }
        .col-stok  { width: 90px; text-align: center; }
        .col-status { width: 110px; text-align: center; }

        .text-right  { text-align: right; }
        .text-center { text-align: center; }
        .text-muted  { color: #8a7a6a; }

        .badge-available {
            display: inline-block;
            background: #d1fae5;
            color: #065f46;
            border-radius: 5px;
            padding: 2px 8px;
            font-size: 10.5px;
            font-weight: 600;
        }
        .badge-out {
            display: inline-block;
            background: #fee2e2;
            color: #991b1b;
            border-radius: 5px;
            padding: 2px 8px;
            font-size: 10.5px;
            font-weight: 600;
        }

        .stok-low  { color: #d97706; font-weight: 600; }
        .stok-zero { color: #dc2626; font-weight: 600; }

        .total-row td {
            background: #1a1a2e;
            color: #fff;
            font-weight: 700;
            padding: 10px;
            font-size: 12.5px;
            border-top: 2px solid #c07a36;
        }

        .print-footer {
            margin-top: 28px;
            padding-top: 12px;
            border-top: 1px solid #e0ddd8;
            font-size: 10px;
            color: #aaa;
            display: flex;
            justify-content: space-between;
        }

        /* ── Screen-only: action bar ── */
        .screen-bar {
            display: flex;
            gap: 10px;
            justify-content: flex-end;
            margin-bottom: 24px;
        }
        .btn-print {
            background: #c07a36;
            color: #fff;
            border: none;
            border-radius: 8px;
            padding: 8px 20px;
            font-size: 13px;
            font-weight: 600;
            cursor: pointer;
            font-family: inherit;
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }
        .btn-back {
            background: #f0ede8;
            color: #1a1a2e;
            border: none;
            border-radius: 8px;
            padding: 8px 20px;
            font-size: 13px;
            font-weight: 600;
            cursor: pointer;
            font-family: inherit;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }

        @media print {
            @page {
                size: A4 portrait;
                margin: 1.5cm 1.5cm;
            }
            body { padding: 0; }
            .screen-bar { display: none !important; }
        }
    </style>
</head>
<body>

    {{-- Screen action bar --}}
    <div class="screen-bar">
        <a href="{{ route('admin.reports.stock', array_filter(request()->query())) }}" class="btn-back">
            Kembali
        </a>
        <button class="btn-print" onclick="window.print()">
            Cetak / Simpan PDF
        </button>
    </div>

    {{-- Header --}}
    <div class="print-header">
        <div>
            <div class="brand">UD Jaya Mebel</div>
            <div class="subtitle">Laporan Data Stok Produk</div>
        </div>
        <div class="meta">
            Dicetak: {{ now()->format('d M Y, H:i') }} WIB<br>
            @if (!empty($filters['stok_status']))
                Status: <strong>{{ $filters['stok_status'] === 'tersedia' ? 'Tersedia' : 'Tidak Tersedia' }}</strong><br>
            @endif
            @if (!empty($filters['search']))
                Kata kunci: <strong>{{ $filters['search'] }}</strong>
            @endif
        </div>
    </div>

    {{-- Filter info --}}
    <div class="filter-info">
        <span>Kata kunci: <strong>{{ !empty($filters['search']) ? $filters['search'] : 'Semua' }}</strong></span>
        <span>Status: <strong>
            @if (!empty($filters['stok_status']))
                {{ $filters['stok_status'] === 'tersedia' ? 'Tersedia' : 'Tidak Tersedia' }}
            @else
                Semua
            @endif
        </strong></span>
        @if (isset($filters['stok_min']) || isset($filters['stok_max']))
            <span>Range stok: <strong>{{ $filters['stok_min'] ?? '0' }} – {{ $filters['stok_max'] ?? '∞' }}</strong></span>
        @endif
        <span>Total entri: <strong>{{ $totalProducts }}</strong> produk</span>
    </div>

    {{-- Summary --}}
    <div class="summary-row">
        <div class="summary-card">
            <div class="label">Total Produk</div>
            <div class="value">{{ number_format($totalProducts) }}</div>
        </div>
        <div class="summary-card">
            <div class="label">Tersedia</div>
            <div class="value available">{{ number_format($availableProducts) }}</div>
        </div>
        <div class="summary-card">
            <div class="label">Tidak Tersedia</div>
            <div class="value out">{{ number_format($outOfStockProducts) }}</div>
        </div>
        <div class="summary-card">
            <div class="label">Total Unit Stok</div>
            <div class="value">{{ number_format($totalStock) }}</div>
        </div>
    </div>

    {{-- Table --}}
    @if ($products->isNotEmpty())
        <table>
            <thead>
                <tr>
                    <th class="col-no">#</th>
                    <th>Nama Produk</th>
                    <th class="col-harga">Harga</th>
                    <th class="col-stok">Stok</th>
                    <th class="col-status">Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($products as $index => $product)
                    <tr>
                        <td class="col-no">{{ $index + 1 }}</td>
                        <td>
                            <div style="font-weight:600">{{ $product->nama_produk }}</div>
                            @if ($product->deskripsi)
                                <div class="text-muted" style="font-size:10.5px;margin-top:2px">{{ Str::limit($product->deskripsi, 80) }}</div>
                            @endif
                        </td>
                        <td class="col-harga">Rp {{ number_format($product->harga, 0, ',', '.') }}</td>
                        <td class="col-stok text-center">
                            <span class="{{ $product->stok === 0 ? 'stok-zero' : ($product->stok <= 5 ? 'stok-low' : '') }}">
                                {{ number_format($product->stok) }} unit
                            </span>
                        </td>
                        <td class="col-status text-center">
                            @if ($product->stok_status === 'tersedia')
                                <span class="badge-available">Tersedia</span>
                            @else
                                <span class="badge-out">Tidak Tersedia</span>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        {{-- Grand total row --}}
        <table style="margin-top:8px">
            <tbody>
                <tr class="total-row">
                    <td>TOTAL — {{ $totalProducts }} Produk</td>
                    <td class="col-harga text-right" style="width:130px"></td>
                    <td class="col-stok text-center" style="width:90px">{{ number_format($totalStock) }} unit</td>
                    <td class="col-status" style="width:110px"></td>
                </tr>
            </tbody>
        </table>
    @else
        <p style="text-align:center;color:#aaa;padding:32px 0">Tidak ada produk yang sesuai dengan filter yang dipilih.</p>
    @endif

    {{-- Footer --}}
    <div class="print-footer">
        <span>UD Jaya Mebel — Sistem Informasi Penjualan</span>
        <span>{{ now()->format('d/m/Y') }}</span>
    </div>

</body>
</html>
