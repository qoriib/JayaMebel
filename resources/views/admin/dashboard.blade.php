@extends('layouts.app')

@section('title', 'Dashboard Admin | UD Jaya Mebel')

@section('content')
    <section class="glass-panel p-4 p-lg-5 mb-4">
        <div class="d-flex flex-column flex-lg-row align-items-lg-center gap-4">
            <div class="flex-grow-1">
                <div class="accent-chip mb-2">
                    <span aria-hidden="true">⚡</span>
                    Ringkasan Penjualan
                </div>
                <h1 class="display-5 fw-semibold mb-3">Halo, Admin 👋</h1>
                <p class="lead text-light mb-0">
                    Pantau performa kasir, stok produk, serta pendapatan toko UD Jaya Mebel secara real-time.
                </p>
            </div>
            <div class="text-lg-end">
                <div class="metric-label">Pendapatan Hari Ini</div>
                <div class="metric-value text-warning">Rp {{ number_format($todayRevenue, 0, ',', '.') }}</div>
                <form action="{{ route('logout') }}" method="POST" class="mt-3 d-inline">
                    @csrf
                    <button type="submit" class="btn btn-outline-danger">Keluar Akun</button>
                </form>
            </div>
        </div>
    </section>

    <section class="row g-4 mb-4">
        <div class="col-12 col-md-6 col-xl-3">
            <article class="metric-card h-100">
                <div class="metric-label">Total Kasir</div>
                <div class="metric-value">{{ $totalCashiers }}</div>
                <p class="text-muted mb-0">Akun aktif yang siap mencatat transaksi.</p>
            </article>
        </div>
        <div class="col-12 col-md-6 col-xl-3">
            <article class="metric-card h-100">
                <div class="metric-label">Produk Terdaftar</div>
                <div class="metric-value">{{ $totalProducts }}</div>
                <p class="text-muted mb-0">Total katalog furnitur dalam sistem.</p>
            </article>
        </div>
        <div class="col-12 col-md-6 col-xl-3">
            <article class="metric-card h-100">
                <div class="metric-label">Produk Tersedia</div>
                <div class="metric-value text-success">{{ $availableProducts }}</div>
                <p class="text-muted mb-0">Siap ditampilkan kepada pelanggan.</p>
            </article>
        </div>
        <div class="col-12 col-md-6 col-xl-3">
            <article class="metric-card h-100">
                <div class="metric-label">Total Penjualan</div>
                <div class="metric-value">{{ $totalSales }}</div>
                <p class="text-muted mb-0">Transaksi yang terekam sepanjang waktu.</p>
            </article>
        </div>
    </section>

    <section class="glass-panel p-4 p-lg-5">
        <div class="d-flex flex-column flex-lg-row align-items-lg-center mb-4">
            <div class="flex-grow-1">
                <h2 class="h4 mb-1">Transaksi Terbaru</h2>
                <p class="text-muted mb-0">5 transaksi terakhir dari seluruh kasir.</p>
            </div>
            <a href="{{ route('admin.reports.sales') }}" class="btn btn-warning text-dark fw-semibold mt-3 mt-lg-0">
                Lihat Laporan
            </a>
        </div>
        <div class="table-responsive">
            <table class="table table-dark table-dark-custom align-middle mb-0">
                <thead>
                    <tr>
                        <th class="text-uppercase small">Kasir</th>
                        <th class="text-uppercase small">Tanggal</th>
                        <th class="text-uppercase small">Total</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($recentSales as $sale)
                        <tr>
                            <td>{{ $sale->cashier?->nama ?? 'Tidak diketahui' }}</td>
                            <td>{{ $sale->tanggal_penjualan->format('d M Y H:i') }}</td>
                            <td class="text-warning">Rp {{ number_format($sale->total_harga, 0, ',', '.') }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="text-center text-muted py-4">Belum ada transaksi.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </section>
@endsection
