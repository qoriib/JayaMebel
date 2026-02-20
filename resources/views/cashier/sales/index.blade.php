@extends('layouts.dashboard')

@section('title', 'Riwayat Penjualan | UD Jaya Mebel')
@section('page-title', 'Riwayat Penjualan')

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
    @if (session('success'))
        <div class="alert alert-success alert-dismissible mb-4" role="alert"
             style="border-radius:10px;border:none;background:#d1fae5;color:#065f46">
            <i class="bi bi-check-circle me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

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
                    <p class="text-muted mb-0" style="font-size:.75rem;text-transform:uppercase;letter-spacing:.05em;font-weight:600">Pendapatan Hari Ini</p>
                    <p class="fw-bold mb-0 money" style="font-size:1.2rem">Rp {{ number_format($todayRevenue, 0, ',', '.') }}</p>
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-4">
            <div class="section-card d-flex align-items-center gap-3 py-3">
                <div style="width:48px;height:48px;border-radius:12px;background:var(--accent-soft);display:flex;align-items:center;justify-content:center;flex-shrink:0">
                    <i class="bi bi-plus-square" style="font-size:1.3rem;color:var(--accent)"></i>
                </div>
                <div>
                    <a href="{{ route('cashier.sales.create') }}" class="btn-accent text-decoration-none d-inline-flex align-items-center gap-1" style="font-size:.85rem">
                        <i class="bi bi-plus-lg"></i> Transaksi Baru
                    </a>
                </div>
            </div>
        </div>
    </div>

    {{-- Table --}}
    <div class="section-card">
        <div class="d-flex align-items-center justify-content-between mb-3">
            <div>
                <h2 class="h6 fw-bold mb-0">Semua Transaksi</h2>
                <p class="text-muted mb-0" style="font-size:.8rem">{{ $sales->total() }} catatan ditemukan</p>
            </div>
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
                                    <form action="{{ route('cashier.sales.destroy', $sale) }}" method="POST"
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
                                    <a href="{{ route('cashier.sales.create') }}" class="btn-accent text-decoration-none">Catat Transaksi Pertama</a>
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