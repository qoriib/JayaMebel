@extends('layouts.dashboard')

@section('title', 'Riwayat Penjualan | UD Jaya Mebel')
@section('page-title', 'Riwayat Penjualan')

@section('content')
    {{-- Stat Cards --}}
    <div class="row g-3 mb-4">
        <div class="col-12 col-sm-6">
            <div class="metric-card h-100">
                <div class="d-flex align-items-center gap-2 mb-3">
                    <div style="width:38px;height:38px;border-radius:10px;background:rgba(111,66,193,.1);display:flex;align-items:center;justify-content:center">
                        <i class="bi bi-receipt" style="color:#6f42c1"></i>
                    </div>
                    <div class="metric-label mb-0">Total Transaksi</div>
                </div>
                <div class="metric-value">{{ number_format($totalTransactions) }}</div>
                <p class="text-muted mb-0" style="font-size:.8rem">Semua transaksi yang kamu catat</p>
            </div>
        </div>
        <div class="col-12 col-sm-6">
            <div class="metric-card h-100">
                <div class="d-flex align-items-center gap-2 mb-3">
                    <div style="width:38px;height:38px;border-radius:10px;background:rgba(192,122,54,.12);display:flex;align-items:center;justify-content:center">
                        <i class="bi bi-cash-stack" style="color:var(--accent)"></i>
                    </div>
                    <div class="metric-label mb-0">Pendapatan Hari Ini</div>
                </div>
                <div class="metric-value money" style="font-size:1.35rem">Rp {{ number_format($todayRevenue, 0, ',', '.') }}</div>
                <p class="text-muted mb-0" style="font-size:.8rem">Total penjualan hari ini</p>
            </div>
        </div>
    </div>

    {{-- Table --}}
    <div class="glass-panel p-4">
        <div class="d-flex align-items-center justify-content-between mb-4">
            <div>
                <h2 class="h5 fw-bold mb-0">Semua Transaksi</h2>
                <p class="text-muted mb-0" style="font-size:.8rem">{{ $sales->total() }} catatan ditemukan</p>
            </div>
            <a href="{{ route('dashboard.sales.create') }}" class="btn btn-primary-custom">
                <i class="bi bi-plus-lg"></i> Transaksi Baru
            </a>
        </div>
        <div class="table-responsive">
            <table class="table table-custom table-hover align-middle mb-0">
                <thead>
                    <tr>
                        <th style="width:40px">#</th>
                        <th>Tanggal</th>
                        <th class="text-center">Jenis Produk</th>
                        <th class="text-center">Total Item</th>
                        <th class="text-end">Total Harga</th>
                        <th class="text-center" style="width:100px">Aksi</th>
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
                            <td class="text-center" style="font-size:.875rem">{{ $sale->details->count() }} produk</td>
                            <td class="text-center" style="font-size:.875rem">{{ $sale->details->sum('jumlah') }} unit</td>
                            <td class="text-end money">Rp {{ number_format($sale->total_harga, 0, ',', '.') }}</td>
                            <td class="text-center">
                                <div class="d-flex align-items-center justify-content-center gap-1">
                                    <button class="btn btn-sm btn-outline-secondary"
                                            style="border-radius:8px;font-size:.78rem;padding:.2rem .55rem"
                                            type="button"
                                            data-bs-toggle="collapse"
                                            data-bs-target="#detail-{{ $sale->id }}"
                                            aria-expanded="false"
                                            title="Lihat detail">
                                        <i class="bi bi-chevron-down"></i>
                                    </button>
                                    <form action="{{ route('dashboard.sales.destroy', $sale) }}" method="POST"
                                          onsubmit="return confirm('Hapus transaksi ini? Stok produk akan dipulihkan.')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger"
                                                style="border-radius:8px;font-size:.78rem;padding:.2rem .55rem"
                                                title="Hapus transaksi">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        <tr class="collapse" id="detail-{{ $sale->id }}">
                            <td colspan="6" style="background:var(--surface-alt);padding:0">
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
                                        <tfoot>
                                            <tr>
                                                <td colspan="2" class="text-end fw-semibold" style="font-size:.85rem">Total</td>
                                                <td class="text-end fw-bold money">Rp {{ number_format($sale->total_harga, 0, ',', '.') }}</td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center py-5">
                                <i class="bi bi-inbox d-block mb-2" style="font-size:2rem;color:var(--text-muted)"></i>
                                <span class="text-muted">Belum ada transaksi.</span>
                                <div class="mt-3">
                                    <a href="{{ route('dashboard.sales.create') }}" class="btn btn-primary">Catat Transaksi Pertama</a>
                                </div>
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
