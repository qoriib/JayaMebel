@extends('layouts.dashboard')

@section('title', 'Laporan Penjualan | UD Jaya Mebel')
@section('page-title', 'Laporan Penjualan')

@section('content')
    {{-- Stat Cards --}}
    <div class="row g-3 mb-4">
        <div class="col-12 col-sm-4">
            <div class="metric-card h-100">
                <div class="d-flex align-items-center gap-2 mb-3">
                    <div style="width:38px;height:38px;border-radius:10px;background:rgba(111,66,193,.1);display:flex;align-items:center;justify-content:center">
                        <i class="bi bi-receipt" style="color:#6f42c1"></i>
                    </div>
                    <div class="metric-label mb-0">Total Transaksi</div>
                </div>
                <div class="metric-value">{{ number_format($totalTransactions) }}</div>
                <p class="text-muted mb-0" style="font-size:.8rem">Semua transaksi tercatat</p>
            </div>
        </div>
        <div class="col-12 col-sm-4">
            <div class="metric-card h-100">
                <div class="d-flex align-items-center gap-2 mb-3">
                    <div style="width:38px;height:38px;border-radius:10px;background:rgba(192,122,54,.12);display:flex;align-items:center;justify-content:center">
                        <i class="bi bi-cash-stack" style="color:var(--accent)"></i>
                    </div>
                    <div class="metric-label mb-0">Total Pendapatan</div>
                </div>
                <div class="metric-value money" style="font-size:1.35rem">Rp {{ number_format($totalRevenue, 0, ',', '.') }}</div>
                <p class="text-muted mb-0" style="font-size:.8rem">Keseluruhan omzet</p>
            </div>
        </div>
        <div class="col-12 col-sm-4">
            <div class="metric-card h-100">
                <div class="d-flex align-items-center gap-2 mb-3">
                    <div style="width:38px;height:38px;border-radius:10px;background:rgba(25,135,84,.1);display:flex;align-items:center;justify-content:center">
                        <i class="bi bi-graph-up" style="color:#198754"></i>
                    </div>
                    <div class="metric-label mb-0">Rata-rata / Transaksi</div>
                </div>
                <div class="metric-value money" style="font-size:1.35rem">Rp {{ number_format($averageOrder, 0, ',', '.') }}</div>
                <p class="text-muted mb-0" style="font-size:.8rem">Per transaksi</p>
            </div>
        </div>
    </div>

    {{-- Filter --}}
    <div class="glass-panel p-4 mb-4">
        <div class="d-flex align-items-center mb-3">
            <div>
                <h2 class="h5 fw-bold mb-0">Filter Laporan</h2>
                <p class="text-muted mb-0" style="font-size:.8rem">Saring data berdasarkan periode atau kasir</p>
            </div>
        </div>
        <form method="GET">
            <div class="row g-3 mb-3">
                <div class="col-12 col-sm-6 col-lg-4">
                    <label for="from" class="form-label fw-semibold" style="font-size:.85rem">Dari Tanggal</label>
                    <input type="date" id="from" name="from" value="{{ $filters['from'] ?? '' }}" class="form-control">
                </div>
                <div class="col-12 col-sm-6 col-lg-4">
                    <label for="to" class="form-label fw-semibold" style="font-size:.85rem">Sampai Tanggal</label>
                    <input type="date" id="to" name="to" value="{{ $filters['to'] ?? '' }}" class="form-control">
                </div>
                <div class="col-12 col-sm-6 col-lg-4">
                    <label for="cashier_id" class="form-label fw-semibold" style="font-size:.85rem">Kasir</label>
                    <select id="cashier_id" name="cashier_id" class="form-select">
                        <option value="">Semua Kasir</option>
                        @foreach ($cashiers as $cashier)
                            <option value="{{ $cashier->id }}" @selected(($filters['cashier_id'] ?? '') == $cashier->id)>
                                {{ $cashier->nama }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="d-flex flex-wrap gap-2">
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-search me-1"></i> Terapkan Filter
                </button>
                <a href="{{ route('dashboard.reports.sales') }}" class="btn btn-outline-secondary">
                    <i class="bi bi-arrow-counterclockwise me-1"></i> Reset
                </a>
                <a href="{{ route('dashboard.reports.sales.print', array_filter(request()->query())) }}"
                   target="_blank" class="btn btn-dark ms-auto">
                    <i class="bi bi-printer me-1"></i> Cetak PDF
                </a>
            </div>
        </form>
    </div>

    {{-- Table --}}
    <div class="glass-panel p-4">
        <div class="d-flex align-items-center mb-4">
            <div class="flex-grow-1">
                <h2 class="h5 fw-bold mb-0">Data Penjualan</h2>
                <p class="text-muted mb-0" style="font-size:.8rem">{{ $sales->total() }} transaksi ditemukan</p>
            </div>
        </div>
        <div class="table-responsive">
            <table class="table table-custom table-hover align-middle mb-0">
                <thead>
                    <tr>
                        <th style="width:40px">#</th>
                        <th>Tanggal</th>
                        <th>Kasir</th>
                        <th class="text-center">Jenis Produk</th>
                        <th class="text-center">Total Item</th>
                        <th class="text-end">Total Harga</th>
                        <th class="text-center" style="width:80px">Detail</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($sales as $index => $sale)
                        <tr>
                            <td class="text-muted" style="font-size:.8rem">{{ $sales->firstItem() + $index }}</td>
                            <td>
                                <div style="font-size:.88rem">{{ $sale->tanggal_penjualan->format('d M Y') }}</div>
                                <small class="text-muted">{{ $sale->tanggal_penjualan->format('H:i') }}</small>
                            </td>
                            <td>{{ $sale->cashier?->nama ?? 'Tidak diketahui' }}</td>
                            <td class="text-center" style="font-size:.875rem">{{ $sale->details->count() }} produk</td>
                            <td class="text-center" style="font-size:.875rem">{{ $sale->details->sum('jumlah') }} unit</td>
                            <td class="text-end money">Rp {{ number_format($sale->total_harga, 0, ',', '.') }}</td>
                            <td class="text-center">
                                <button class="btn btn-sm btn-outline-secondary"
                                        style="border-radius:8px;font-size:.78rem;padding:.2rem .6rem"
                                        type="button"
                                        data-bs-toggle="collapse"
                                        data-bs-target="#detail-{{ $sale->id }}"
                                        aria-expanded="false">
                                    <i class="bi bi-chevron-down"></i>
                                </button>
                            </td>
                        </tr>
                        <tr class="collapse" id="detail-{{ $sale->id }}">
                            <td colspan="7" style="background:var(--surface-alt);padding:0">
                                <div class="px-4 py-3">
                                    <p class="text-muted mb-2" style="font-size:.75rem;font-weight:600;text-transform:uppercase;letter-spacing:.05em">
                                        <i class="bi bi-list-ul me-1"></i> Rincian Produk
                                    </p>
                                    <table class="table table-sm mb-0" style="font-size:.85rem">
                                        <thead style="background:var(--border-color)">
                                            <tr>
                                                <th class="fw-semibold">Nama Produk</th>
                                                <th class="text-center fw-semibold">Qty</th>
                                                <th class="text-end fw-semibold">Subtotal</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($sale->details as $detail)
                                                <tr>
                                                    <td>{{ $detail->product?->nama_produk ?? 'Produk dihapus' }}</td>
                                                    <td class="text-center">{{ $detail->jumlah }} unit</td>
                                                    <td class="text-end money">Rp {{ number_format($detail->subtotal, 0, ',', '.') }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center py-5">
                                <i class="bi bi-inbox d-block mb-2" style="font-size:2rem;color:var(--text-muted)"></i>
                                <span class="text-muted">Tidak ada transaksi pada rentang ini.</span>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if ($sales->hasPages())
            <div class="mt-3 px-2">{{ $sales->links() }}</div>
        @endif
    </div>
@endsection
