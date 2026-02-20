@extends('layouts.dashboard')

@section('title', 'Laporan Penjualan | UD Jaya Mebel')
@section('page-title', 'Laporan Penjualan')

@section('content')
    {{-- Stat Cards --}}
    <div class="row g-3 mb-4">
        <div class="col-12 col-sm-4">
            <div class="section-card d-flex align-items-center gap-3 py-3">
                <div style="width:48px;height:48px;border-radius:12px;background:var(--accent-soft);display:flex;align-items:center;justify-content:center;flex-shrink:0">
                    <i class="bi bi-receipt" style="font-size:1.3rem;color:var(--accent)"></i>
                </div>
                <div>
                    <p class="text-muted mb-0" style="font-size:.75rem;text-transform:uppercase;letter-spacing:.05em;font-weight:600">Total Transaksi</p>
                    <p class="fw-bold mb-0" style="font-size:1.4rem">{{ number_format($totalTransactions) }}</p>
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-4">
            <div class="section-card d-flex align-items-center gap-3 py-3">
                <div style="width:48px;height:48px;border-radius:12px;background:var(--accent-soft);display:flex;align-items:center;justify-content:center;flex-shrink:0">
                    <i class="bi bi-cash-stack" style="font-size:1.3rem;color:var(--accent)"></i>
                </div>
                <div>
                    <p class="text-muted mb-0" style="font-size:.75rem;text-transform:uppercase;letter-spacing:.05em;font-weight:600">Total Pendapatan</p>
                    <p class="fw-bold mb-0 money" style="font-size:1.2rem">Rp {{ number_format($totalRevenue, 0, ',', '.') }}</p>
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-4">
            <div class="section-card d-flex align-items-center gap-3 py-3">
                <div style="width:48px;height:48px;border-radius:12px;background:var(--accent-soft);display:flex;align-items:center;justify-content:center;flex-shrink:0">
                    <i class="bi bi-graph-up" style="font-size:1.3rem;color:var(--accent)"></i>
                </div>
                <div>
                    <p class="text-muted mb-0" style="font-size:.75rem;text-transform:uppercase;letter-spacing:.05em;font-weight:600">Rata-rata / Transaksi</p>
                    <p class="fw-bold mb-0 money" style="font-size:1.2rem">Rp {{ number_format($averageOrder, 0, ',', '.') }}</p>
                </div>
            </div>
        </div>
    </div>

    {{-- Filter --}}
    <div class="section-card mb-4">
        <p class="fw-semibold mb-3" style="font-size:.85rem;text-transform:uppercase;letter-spacing:.05em;color:var(--text-muted)">
            <i class="bi bi-funnel me-1"></i> Filter Laporan
        </p>
        <form method="GET" class="row g-3 align-items-end">
            <div class="col-12 col-sm-6 col-lg-3">
                <label for="from" class="form-label fw-semibold" style="font-size:.85rem">Dari Tanggal</label>
                <input type="date" id="from" name="from" value="{{ $filters['from'] ?? '' }}" class="form-control">
            </div>
            <div class="col-12 col-sm-6 col-lg-3">
                <label for="to" class="form-label fw-semibold" style="font-size:.85rem">Sampai Tanggal</label>
                <input type="date" id="to" name="to" value="{{ $filters['to'] ?? '' }}" class="form-control">
            </div>
            <div class="col-12 col-sm-6 col-lg-3">
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
            <div class="col-12 col-sm-6 col-lg-3">
                <div class="d-flex gap-2">
                    <button type="submit" class="btn-accent flex-grow-1 d-flex align-items-center justify-content-center gap-1">
                        <i class="bi bi-search"></i> Terapkan
                    </button>
                    <a href="{{ route('admin.reports.sales') }}" class="btn-outline-custom text-decoration-none d-flex align-items-center" title="Reset">
                        <i class="bi bi-arrow-counterclockwise"></i>
                    </a>
                    <a href="{{ route('admin.reports.sales.print', array_filter(request()->query())) }}"
                       target="_blank"
                       class="btn btn-sm d-flex align-items-center gap-1 text-decoration-none"
                       style="background:#1a1a2e;color:#fff;border-radius:10px;padding:.45rem .75rem;font-size:.85rem;white-space:nowrap">
                        <i class="bi bi-printer"></i> Cetak PDF
                    </a>
                </div>
            </div>
        </form>
    </div>

    {{-- Table --}}
    <div class="section-card">
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
                            <td>
                                <div class="d-flex align-items-center gap-2">
                                    <div style="width:32px;height:32px;border-radius:50%;background:var(--accent-soft);display:flex;align-items:center;justify-content:center;font-weight:700;color:var(--accent);font-size:.75rem;flex-shrink:0">
                                        {{ strtoupper(substr($sale->cashier?->nama ?? '?', 0, 1)) }}
                                    </div>
                                    <span style="font-size:.875rem">{{ $sale->cashier?->nama ?? 'Tidak diketahui' }}</span>
                                </div>
                            </td>
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