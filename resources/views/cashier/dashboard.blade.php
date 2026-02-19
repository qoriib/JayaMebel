@extends('layouts.app')

@section('title', 'Dashboard Kasir | UD Jaya Mebel')

@section('content')
    <section class="glass-panel p-4 p-lg-5 mb-4">
        <div class="d-flex flex-column flex-lg-row align-items-lg-center gap-3">
            <div class="flex-grow-1">
                <p class="accent-chip mb-2"><span aria-hidden="true">💼</span> Mode Kasir</p>
                <h1 class="h4 mb-1">Hai, {{ $cashier->nama }}</h1>
                <p class="text-muted mb-0">Pantau kinerja pribadi dan lanjutkan transaksi yang tertunda.</p>
            </div>
                <div class="text-lg-end">
                    <p class="text-muted mb-1">Pendapatan kamu hari ini</p>
                    <p class="fs-3 fw-semibold text-warning">Rp {{ number_format($todayRevenue, 0, ',', '.') }}</p>
                    <form action="{{ route('logout') }}" method="POST" class="mt-3 d-inline">
                        @csrf
                        <button type="submit" class="btn btn-outline-danger">Keluar Akun</button>
                    </form>
            </div>
        </div>
    </section>

    <section class="row g-4 mb-4">
        <div class="col-12 col-md-6">
            <article class="metric-card h-100">
                <div class="metric-label">Total Transaksi</div>
                <div class="metric-value">{{ $totalSales }}</div>
                <p class="text-muted mb-0">Semua transaksi yang kamu catat.</p>
            </article>
        </div>
        <div class="col-12 col-md-6">
            <article class="metric-card h-100">
                <div class="metric-label">Transaksi Terbaru</div>
                <div class="metric-value">{{ $latestSales->count() }}</div>
                <p class="text-muted mb-0">Dalam 5 catatan terakhir.</p>
            </article>
        </div>
    </section>

    <section class="glass-panel p-4">
        <h2 class="h5 mb-3">Riwayat Singkat</h2>
        <div class="table-responsive">
            <table class="table table-dark table-dark-custom align-middle">
                <thead>
                    <tr>
                        <th>Tanggal</th>
                        <th>Total Item</th>
                        <th>Total Harga</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($latestSales as $sale)
                        <tr>
                            <td>{{ $sale->tanggal_penjualan->format('d M Y H:i') }}</td>
                            <td>{{ $sale->details->sum('jumlah') }} item</td>
                            <td class="text-warning">Rp {{ number_format($sale->total_harga, 0, ',', '.') }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="text-center text-muted">Belum ada transaksi.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </section>
@endsection
