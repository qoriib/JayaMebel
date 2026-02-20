@extends('layouts.dashboard')

@section('title', 'Dashboard Kasir | UD Jaya Mebel')
@section('page-title', 'Dashboard')

@section('sidebar-links')
    <div class="sidebar-section-label">Utama</div>
    <a href="{{ route('cashier.dashboard') }}" class="sidebar-link {{ request()->routeIs('cashier.dashboard') ? 'active' : '' }}">
        <i class="bi bi-speedometer2"></i> Dashboard
    </a>
    <div class="sidebar-section-label">Transaksi</div>
    <a href="{{ route('cashier.sales.create') }}" class="sidebar-link {{ request()->routeIs('cashier.sales.create') ? 'active' : '' }}">
        <i class="bi bi-cart-plus"></i> Catat Penjualan
    </a>
    <a href="{{ route('cashier.sales.index') }}" class="sidebar-link {{ request()->routeIs('cashier.sales.index') ? 'active' : '' }}">
        <i class="bi bi-clock-history"></i> Riwayat Penjualan
    </a>
@endsection

@section('content')
    {{-- Welcome Banner --}}
    <div class="glass-panel p-4 mb-4 d-flex flex-column flex-sm-row align-items-sm-center gap-3">
        <div class="flex-grow-1">
            <span class="accent-chip mb-2"><i class="bi bi-briefcase-fill"></i> Mode Kasir</span>
            <h1 class="h4 fw-bold mb-1 mt-2">Hai, {{ $cashier->nama }} 👋</h1>
            <p class="text-muted mb-0" style="font-size:.875rem">Pantau kinerja pribadi dan lanjutkan transaksi yang tertunda.</p>
        </div>
        <div class="text-sm-end">
            <div class="metric-label">Pendapatan Hari Ini</div>
            <div class="metric-value" style="color:var(--accent)">Rp {{ number_format($todayRevenue, 0, ',', '.') }}</div>
        </div>
    </div>

    {{-- Stat Cards --}}
    <div class="row g-3 mb-4">
        <div class="col-12 col-sm-6">
            <div class="metric-card h-100">
                <div class="d-flex align-items-center gap-2 mb-3">
                    <div style="width:38px;height:38px;border-radius:10px;background:rgba(192,122,54,.12);display:flex;align-items:center;justify-content:center">
                        <i class="bi bi-receipt" style="color:var(--accent)"></i>
                    </div>
                    <div class="metric-label mb-0">Total Transaksi</div>
                </div>
                <div class="metric-value">{{ $totalSales }}</div>
                <p class="text-muted mb-0" style="font-size:.8rem">Semua transaksi yang kamu catat</p>
            </div>
        </div>
        <div class="col-12 col-sm-6">
            <div class="metric-card h-100">
                <div class="d-flex align-items-center gap-2 mb-3">
                    <div style="width:38px;height:38px;border-radius:10px;background:rgba(13,110,253,.1);display:flex;align-items:center;justify-content:center">
                        <i class="bi bi-clock-history" style="color:#0d6efd"></i>
                    </div>
                    <div class="metric-label mb-0">Transaksi Terbaru</div>
                </div>
                <div class="metric-value">{{ $latestSales->count() }}</div>
                <p class="text-muted mb-0" style="font-size:.8rem">Dalam 5 catatan terakhir</p>
            </div>
        </div>
    </div>

    {{-- Recent History --}}
    <div class="glass-panel p-4">
        <div class="d-flex align-items-center mb-4">
            <div class="flex-grow-1">
                <h2 class="h5 fw-bold mb-0">Riwayat Transaksi</h2>
                <p class="text-muted mb-0" style="font-size:.8rem">5 transaksi terakhir yang kamu catat</p>
            </div>
            <a href="{{ route('cashier.sales.create') }}" class="btn-primary-custom text-decoration-none">
                <i class="bi bi-plus-lg me-1"></i> Transaksi Baru
            </a>
        </div>
        <div class="table-responsive">
            <table class="table table-custom table-hover align-middle mb-0">
                <thead>
                    <tr>
                        <th>Tanggal</th>
                        <th>Total Item</th>
                        <th class="text-end">Total Harga</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($latestSales as $sale)
                        <tr>
                            <td class="text-muted" style="font-size:.875rem">{{ $sale->tanggal_penjualan->format('d M Y, H:i') }}</td>
                            <td>
                                <span class="badge rounded-pill" style="background:var(--accent-soft);color:var(--accent)">
                                    {{ $sale->details->sum('jumlah') }} item
                                </span>
                            </td>
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
