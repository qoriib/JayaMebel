@extends('layouts.app')

@section('title', 'Laporan Penjualan | UD Jaya Mebel')

@section('content')
    <section class="glass-panel p-4 p-lg-5 mb-4">
        <div class="d-flex flex-column flex-lg-row align-items-lg-center gap-3">
            <div class="flex-grow-1">
                <p class="accent-chip mb-2"><span aria-hidden="true">📈</span> Rekap Penjualan</p>
                <h1 class="h4 mb-1">Laporan Penjualan</h1>
                <p class="text-muted mb-0">Gunakan filter tanggal untuk menelusuri transaksi tertentu.</p>
            </div>
            <div class="text-lg-end">
                <p class="text-muted mb-1">Total Pendapatan</p>
                <p class="fs-3 fw-semibold text-warning">Rp {{ number_format($totalRevenue, 0, ',', '.') }}</p>
            </div>
        </div>
        <form method="GET" class="row g-3 mt-3">
            <div class="col-12 col-md-4">
                <label for="from" class="form-label">Dari Tanggal</label>
                <input type="date" id="from" name="from" value="{{ $filters['from'] ?? '' }}" class="form-control">
            </div>
            <div class="col-12 col-md-4">
                <label for="to" class="form-label">Sampai Tanggal</label>
                <input type="date" id="to" name="to" value="{{ $filters['to'] ?? '' }}" class="form-control">
            </div>
            <div class="col-12 col-md-4 d-flex align-items-end gap-2">
                <button type="submit" class="btn btn-warning text-dark fw-semibold flex-grow-1">Terapkan Filter</button>
                <a href="{{ route('admin.reports.sales') }}" class="btn btn-outline-light">Reset</a>
                <a href="{{ route('admin.reports.sales.print', request()->query()) }}" target="_blank" class="btn btn-outline-info">Cetak</a>
            </div>
        </form>
    </section>

    <section class="glass-panel p-3">
        <div class="table-responsive">
            <table class="table table-dark table-dark-custom align-middle">
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
                            <td>{{ $sale->details->sum('jumlah') }} item</td>
                            <td class="text-warning">Rp {{ number_format($sale->total_harga, 0, ',', '.') }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center text-muted">Tidak ada transaksi pada rentang ini.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="mt-3">
            {{ $sales->links() }}
        </div>
    </section>
@endsection
