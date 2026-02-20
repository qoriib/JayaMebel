@extends('layouts.dashboard')

@section('title', 'Dashboard Admin | UD Jaya Mebel')
@section('page-title', 'Dashboard')

@section('sidebar-links')
    <div class="sidebar-section-label">Utama</div>
    <a href="{{ route('admin.dashboard') }}" class="sidebar-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
        <i class="bi bi-speedometer2"></i> Dashboard
    </a>

    <div class="sidebar-section-label">Manajemen</div>
    <a href="{{ route('admin.cashiers.index') }}" class="sidebar-link {{ request()->routeIs('admin.cashiers.*') ? 'active' : '' }}">
        <i class="bi bi-people"></i> Data Kasir
    </a>
    <a href="{{ route('admin.products.index') }}" class="sidebar-link {{ request()->routeIs('admin.products.*') ? 'active' : '' }}">
        <i class="bi bi-box-seam"></i> Produk
    </a>

    <div class="sidebar-section-label">Laporan</div>
    <a href="{{ route('admin.reports.sales') }}" class="sidebar-link {{ request()->routeIs('admin.reports.*') ? 'active' : '' }}">
        <i class="bi bi-bar-chart-line"></i> Laporan Penjualan
    </a>
@endsection

@section('content')
    {{-- Welcome Banner --}}
    <div class="glass-panel p-4 mb-4 d-flex flex-column flex-sm-row align-items-sm-center gap-3">
        <div class="flex-grow-1">
            <span class="accent-chip mb-2"><i class="bi bi-lightning-charge-fill"></i> Ringkasan Hari Ini</span>
            <h1 class="h4 fw-bold mb-1 mt-2">Selamat datang, Admin 👋</h1>
            <p class="text-muted mb-0" style="font-size:.875rem">Pantau performa kasir, stok, dan pendapatan toko UD Jaya Mebel.</p>
        </div>
        <div class="text-sm-end">
            <div class="metric-label">Pendapatan Hari Ini</div>
            <div class="metric-value" style="color:var(--accent)">Rp {{ number_format($todayRevenue, 0, ',', '.') }}</div>
        </div>
    </div>

    {{-- Stat Cards --}}
    <div class="row g-3 mb-4">
        <div class="col-6 col-xl-3">
            <div class="metric-card h-100">
                <div class="d-flex align-items-center gap-2 mb-3">
                    <div style="width:38px;height:38px;border-radius:10px;background:rgba(13,110,253,.1);display:flex;align-items:center;justify-content:center">
                        <i class="bi bi-people-fill" style="color:#0d6efd"></i>
                    </div>
                    <div class="metric-label mb-0">Total Kasir</div>
                </div>
                <div class="metric-value">{{ $totalCashiers }}</div>
                <p class="text-muted mb-0" style="font-size:.8rem">Akun aktif</p>
            </div>
        </div>
        <div class="col-6 col-xl-3">
            <div class="metric-card h-100">
                <div class="d-flex align-items-center gap-2 mb-3">
                    <div style="width:38px;height:38px;border-radius:10px;background:rgba(192,122,54,.12);display:flex;align-items:center;justify-content:center">
                        <i class="bi bi-box-seam-fill" style="color:var(--accent)"></i>
                    </div>
                    <div class="metric-label mb-0">Produk Terdaftar</div>
                </div>
                <div class="metric-value">{{ $totalProducts }}</div>
                <p class="text-muted mb-0" style="font-size:.8rem">Total katalog</p>
            </div>
        </div>
        <div class="col-6 col-xl-3">
            <div class="metric-card h-100">
                <div class="d-flex align-items-center gap-2 mb-3">
                    <div style="width:38px;height:38px;border-radius:10px;background:rgba(25,135,84,.1);display:flex;align-items:center;justify-content:center">
                        <i class="bi bi-check-circle-fill" style="color:#198754"></i>
                    </div>
                    <div class="metric-label mb-0">Produk Tersedia</div>
                </div>
                <div class="metric-value" style="color:#198754">{{ $availableProducts }}</div>
                <p class="text-muted mb-0" style="font-size:.8rem">Siap dijual</p>
            </div>
        </div>
        <div class="col-6 col-xl-3">
            <div class="metric-card h-100">
                <div class="d-flex align-items-center gap-2 mb-3">
                    <div style="width:38px;height:38px;border-radius:10px;background:rgba(111,66,193,.1);display:flex;align-items:center;justify-content:center">
                        <i class="bi bi-receipt" style="color:#6f42c1"></i>
                    </div>
                    <div class="metric-label mb-0">Total Penjualan</div>
                </div>
                <div class="metric-value">{{ $totalSales }}</div>
                <p class="text-muted mb-0" style="font-size:.8rem">Semua transaksi</p>
            </div>
        </div>
    </div>

    {{-- Recent Transactions --}}
    <div class="glass-panel p-4">
        <div class="d-flex align-items-center mb-4">
            <div class="flex-grow-1">
                <h2 class="h5 fw-bold mb-0">Transaksi Terbaru</h2>
                <p class="text-muted mb-0" style="font-size:.8rem">5 transaksi terakhir dari seluruh kasir</p>
            </div>
            <a href="{{ route('admin.reports.sales') }}" class="btn-primary-custom text-decoration-none">
                <i class="bi bi-arrow-right me-1"></i> Lihat Semua
            </a>
        </div>
        <div class="table-responsive">
            <table class="table table-custom table-hover align-middle mb-0">
                <thead>
                    <tr>
                        <th>Kasir</th>
                        <th>Tanggal</th>
                        <th class="text-end">Total</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($recentSales as $sale)
                        <tr>
                            <td>
                                <div class="d-flex align-items-center gap-2">
                                    <div style="width:30px;height:30px;border-radius:50%;background:var(--accent-soft);display:flex;align-items:center;justify-content:center;font-size:.75rem;font-weight:700;color:var(--accent)">
                                        {{ strtoupper(substr($sale->cashier?->nama ?? 'U', 0, 1)) }}
                                    </div>
                                    {{ $sale->cashier?->nama ?? 'Tidak diketahui' }}
                                </div>
                            </td>
                            <td class="text-muted" style="font-size:.875rem">{{ $sale->tanggal_penjualan->format('d M Y, H:i') }}</td>
                            <td class="text-end fw-semibold" style="color:var(--accent)">Rp {{ number_format($sale->total_harga, 0, ',', '.') }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="text-center text-muted py-5">
                                <i class="bi bi-inbox d-block mb-2" style="font-size:2rem"></i>
                                Belum ada transaksi.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
