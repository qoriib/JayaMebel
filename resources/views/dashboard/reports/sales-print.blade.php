<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laporan Penjualan – UD Jaya Mebel</title>
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
        .summary-card .value.accent { color: #c07a36; }

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
        }
        .filter-info strong { color: #1a1a2e; }

        /* ── Table ── */
        table { width: 100%; border-collapse: collapse; }

        .sale-group { page-break-inside: avoid; }

        .sale-header td {
            background: #f8f7f4;
            font-weight: 600;
            padding: 9px 10px;
            border-top: 1px solid #d8d5d0;
            border-bottom: 1px solid #d8d5d0;
            font-size: 12px;
        }
        .sale-header td:first-child { border-left: 3px solid #c07a36; }

        .product-row td {
            padding: 5px 10px 5px 24px;
            border-bottom: 1px solid #f0ede8;
            font-size: 11.5px;
            color: #3a3a5a;
        }

        .col-date  { width: 110px; }
        .col-kasir { width: 130px; }
        .col-qty   { width: 80px; text-align: center; }
        .col-harga { width: 120px; text-align: right; }

        .text-right  { text-align: right; }
        .text-center { text-align: center; }
        .text-muted  { color: #8a7a6a; }
        .fw-bold { font-weight: 700; }

        .total-row td {
            background: #1a1a2e;
            color: #fff;
            font-weight: 700;
            padding: 10px 10px;
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
        <a href="{{ route('dashboard.reports.sales', array_filter(request()->query())) }}" class="btn-back">
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
            <div class="subtitle">Laporan Data Penjualan</div>
        </div>
        <div class="meta">
            Dicetak: {{ now()->format('d M Y, H:i') }} WIB<br>
            @if (!empty($filters['from']) || !empty($filters['to']))
                Periode: {{ $filters['from'] ? \Carbon\Carbon::parse($filters['from'])->format('d M Y') : '—' }}
                s/d {{ $filters['to'] ? \Carbon\Carbon::parse($filters['to'])->format('d M Y') : '—' }}
            @else
                Periode: Semua Waktu
            @endif
        </div>
    </div>

    {{-- Filter info --}}
    <div class="filter-info">
        <span>Dari: <strong>{{ !empty($filters['from']) ? \Carbon\Carbon::parse($filters['from'])->format('d M Y') : 'Semua' }}</strong></span>
        <span>Sampai: <strong>{{ !empty($filters['to']) ? \Carbon\Carbon::parse($filters['to'])->format('d M Y') : 'Semua' }}</strong></span>
        <span>Total entri: <strong>{{ $totalTransactions }}</strong> transaksi</span>
    </div>

    {{-- Summary --}}
    <div class="summary-row">
        <div class="summary-card">
            <div class="label">Total Transaksi</div>
            <div class="value">{{ number_format($totalTransactions) }}</div>
        </div>
        <div class="summary-card">
            <div class="label">Total Pendapatan</div>
            <div class="value accent">Rp {{ number_format($totalRevenue, 0, ',', '.') }}</div>
        </div>
        <div class="summary-card">
            <div class="label">Rata-rata / Transaksi</div>
            <div class="value">Rp {{ $totalTransactions > 0 ? number_format($totalRevenue / $totalTransactions, 0, ',', '.') : '0' }}</div>
        </div>
    </div>

    {{-- Transactions --}}
    @forelse ($sales as $i => $sale)
        <div class="sale-group">
            <table>
                <tbody>
                    <tr class="sale-header">
                        <td class="col-date">{{ $sale->tanggal_penjualan->format('d M Y H:i') }}</td>
                        <td class="col-kasir">Kasir: {{ $sale->cashier?->nama ?? 'Tidak diketahui' }}</td>
                        <td>{{ $sale->details->count() }} produk · {{ $sale->details->sum('jumlah') }} unit</td>
                        <td class="col-harga">Rp {{ number_format($sale->total_harga, 0, ',', '.') }}</td>
                    </tr>
                    @foreach ($sale->details as $detail)
                        <tr class="product-row">
                            <td colspan="2">
                                <span class="text-muted">└</span> {{ $detail->product?->nama_produk ?? 'Produk dihapus' }}
                            </td>
                            <td class="col-qty text-center">{{ $detail->jumlah }} unit</td>
                            <td class="col-harga text-right">Rp {{ number_format($detail->subtotal, 0, ',', '.') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @empty
        <p style="text-align:center;color:#aaa;padding:32px 0">Tidak ada data transaksi untuk rentang yang dipilih.</p>
    @endforelse

    {{-- Grand total --}}
    @if ($sales->isNotEmpty())
        <table style="margin-top:8px">
            <tbody>
                <tr class="total-row">
                    <td colspan="2">TOTAL KESELURUHAN — {{ $totalTransactions }} Transaksi</td>
                    <td class="col-qty text-center">
                        {{ $sales->sum(fn($s) => $s->details->sum('jumlah')) }} unit
                    </td>
                    <td class="col-harga text-right">Rp {{ number_format($totalRevenue, 0, ',', '.') }}</td>
                </tr>
            </tbody>
        </table>
    @endif

    {{-- Footer --}}
    <div class="print-footer">
        <span>UD Jaya Mebel — Sistem Informasi Penjualan</span>
        <span>Hal. <span class="page-number"></span> · {{ now()->format('d/m/Y') }}</span>
    </div>

</body>
</html>