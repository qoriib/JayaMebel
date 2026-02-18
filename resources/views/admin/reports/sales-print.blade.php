<!DOCTYPE html>
<html lang="id">
    <head>
        <meta charset="utf-8">
        <title>Cetak Laporan Penjualan</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
        <style>
            body {
                font-family: 'Space Grotesk', 'Segoe UI', sans-serif;
            }
            .report-header {
                border-bottom: 2px solid #f4a62a;
                margin-bottom: 1.5rem;
                padding-bottom: 0.75rem;
            }
            @media print {
                .no-print {
                    display: none;
                }
            }
        </style>
    </head>
    <body class="p-4">
        <div class="report-header d-flex justify-content-between align-items-center">
            <div>
                <h1 class="h4 mb-1">UD Jaya Mebel</h1>
                <p class="mb-0">Laporan Penjualan</p>
                <small class="text-muted">Rentang: {{ $filters['from'] ?? '-' }} s/d {{ $filters['to'] ?? '-' }}</small>
            </div>
            <button class="btn btn-warning no-print" onclick="window.print()">Cetak</button>
        </div>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Kasir</th>
                    <th>Tanggal</th>
                    <th>Total Item</th>
                    <th>Total Harga</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($sales as $sale)
                    <tr>
                        <td>{{ $sale->cashier?->nama ?? 'Tidak diketahui' }}</td>
                        <td>{{ $sale->tanggal_penjualan->format('d M Y H:i') }}</td>
                        <td>{{ $sale->details->sum('jumlah') }}</td>
                        <td>Rp {{ number_format($sale->total_harga, 0, ',', '.') }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center">Tidak ada data.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </body>
</html>
