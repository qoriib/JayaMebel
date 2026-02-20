@extends('layouts.dashboard')

@section('title', 'Laporan Stok | UD Jaya Mebel')
@section('page-title', 'Laporan Stok')

@section('content')
    {{-- Stat Cards --}}
    <div class="row g-3 mb-4">
        <div class="col-6 col-sm-3">
            <div class="section-card d-flex align-items-center gap-3 py-3">
                <div style="width:48px;height:48px;border-radius:12px;background:var(--accent-soft);display:flex;align-items:center;justify-content:center;flex-shrink:0">
                    <i class="bi bi-box-seam" style="font-size:1.3rem;color:var(--accent)"></i>
                </div>
                <div>
                    <p class="text-muted mb-0" style="font-size:.75rem;text-transform:uppercase;letter-spacing:.05em;font-weight:600">Total Produk</p>
                    <p class="fw-bold mb-0" style="font-size:1.4rem">{{ number_format($totalProducts) }}</p>
                </div>
            </div>
        </div>
        <div class="col-6 col-sm-3">
            <div class="section-card d-flex align-items-center gap-3 py-3">
                <div style="width:48px;height:48px;border-radius:12px;background:#d1fae5;display:flex;align-items:center;justify-content:center;flex-shrink:0">
                    <i class="bi bi-check-circle" style="font-size:1.3rem;color:#059669"></i>
                </div>
                <div>
                    <p class="text-muted mb-0" style="font-size:.75rem;text-transform:uppercase;letter-spacing:.05em;font-weight:600">Tersedia</p>
                    <p class="fw-bold mb-0" style="font-size:1.4rem;color:#059669">{{ number_format($availableProducts) }}</p>
                </div>
            </div>
        </div>
        <div class="col-6 col-sm-3">
            <div class="section-card d-flex align-items-center gap-3 py-3">
                <div style="width:48px;height:48px;border-radius:12px;background:#fee2e2;display:flex;align-items:center;justify-content:center;flex-shrink:0">
                    <i class="bi bi-x-circle" style="font-size:1.3rem;color:#dc2626"></i>
                </div>
                <div>
                    <p class="text-muted mb-0" style="font-size:.75rem;text-transform:uppercase;letter-spacing:.05em;font-weight:600">Tidak Tersedia</p>
                    <p class="fw-bold mb-0" style="font-size:1.4rem;color:#dc2626">{{ number_format($outOfStockProducts) }}</p>
                </div>
            </div>
        </div>
        <div class="col-6 col-sm-3">
            <div class="section-card d-flex align-items-center gap-3 py-3">
                <div style="width:48px;height:48px;border-radius:12px;background:var(--accent-soft);display:flex;align-items:center;justify-content:center;flex-shrink:0">
                    <i class="bi bi-stack" style="font-size:1.3rem;color:var(--accent)"></i>
                </div>
                <div>
                    <p class="text-muted mb-0" style="font-size:.75rem;text-transform:uppercase;letter-spacing:.05em;font-weight:600">Total Unit Stok</p>
                    <p class="fw-bold mb-0" style="font-size:1.4rem">{{ number_format($totalStock) }}</p>
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
            <div class="col-12 col-sm-6 col-lg-4">
                <label for="search" class="form-label fw-semibold" style="font-size:.85rem">Cari Nama Produk</label>
                <input type="text" id="search" name="search" value="{{ $filters['search'] ?? '' }}"
                       placeholder="Cari produk..." class="form-control">
            </div>
            <div class="col-12 col-sm-6 col-lg-2">
                <label for="stok_status" class="form-label fw-semibold" style="font-size:.85rem">Status Stok</label>
                <select id="stok_status" name="stok_status" class="form-select">
                    <option value="">Semua Status</option>
                    <option value="tersedia" @selected(($filters['stok_status'] ?? '') === 'tersedia')>Tersedia</option>
                    <option value="tidak" @selected(($filters['stok_status'] ?? '') === 'tidak')>Tidak Tersedia</option>
                </select>
            </div>
            <div class="col-6 col-sm-3 col-lg-2">
                <label for="stok_min" class="form-label fw-semibold" style="font-size:.85rem">Stok Min</label>
                <input type="number" id="stok_min" name="stok_min" value="{{ $filters['stok_min'] ?? '' }}"
                       min="0" placeholder="0" class="form-control">
            </div>
            <div class="col-6 col-sm-3 col-lg-2">
                <label for="stok_max" class="form-label fw-semibold" style="font-size:.85rem">Stok Maks</label>
                <input type="number" id="stok_max" name="stok_max" value="{{ $filters['stok_max'] ?? '' }}"
                       min="0" placeholder="∞" class="form-control">
            </div>
            <div class="col-12 col-sm-6 col-lg-2">
                <div class="d-flex gap-2">
                    <button type="submit" class="btn-accent flex-grow-1 d-flex align-items-center justify-content-center gap-1">
                        <i class="bi bi-search"></i> Terapkan
                    </button>
                    <a href="{{ route('admin.reports.stock') }}" class="btn-outline-custom text-decoration-none d-flex align-items-center" title="Reset">
                        <i class="bi bi-arrow-counterclockwise"></i>
                    </a>
                    <a href="{{ route('admin.reports.stock.print', array_filter(request()->query())) }}"
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
                        <th>Nama Produk</th>
                        <th class="text-end">Harga</th>
                        <th class="text-center">Stok</th>
                        <th class="text-center">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($products as $index => $product)
                        <tr>
                            <td class="text-muted" style="font-size:.8rem">{{ $products->firstItem() + $index }}</td>
                            <td>
                                <div class="d-flex align-items-center gap-3">
                                    @if ($product->gambar)
                                        <img src="{{ asset('storage/'.$product->gambar) }}"
                                             alt="{{ $product->nama_produk }}"
                                             style="width:40px;height:40px;border-radius:8px;object-fit:cover;flex-shrink:0">
                                    @else
                                        <div style="width:40px;height:40px;border-radius:8px;background:var(--surface-alt);display:flex;align-items:center;justify-content:center;flex-shrink:0">
                                            <i class="bi bi-image text-muted"></i>
                                        </div>
                                    @endif
                                    <div>
                                        <div style="font-size:.875rem;font-weight:600">{{ $product->nama_produk }}</div>
                                        @if ($product->deskripsi)
                                            <small class="text-muted" style="font-size:.78rem">{{ Str::limit($product->deskripsi, 60) }}</small>
                                        @endif
                                    </div>
                                </div>
                            </td>
                            <td class="text-end money" style="font-size:.875rem">Rp {{ number_format($product->harga, 0, ',', '.') }}</td>
                            <td class="text-center">
                                <span style="font-size:.875rem;font-weight:600;
                                    color: {{ $product->stok === 0 ? '#dc2626' : ($product->stok <= 5 ? '#d97706' : 'inherit') }}">
                                    {{ number_format($product->stok) }} unit
                                </span>
                            </td>
                            <td class="text-center">
                                @if ($product->stok_status === 'tersedia')
                                    <span class="badge" style="background:#d1fae5;color:#065f46;border-radius:6px;padding:.3rem .65rem;font-size:.78rem;font-weight:600">
                                        <i class="bi bi-check-circle me-1"></i> Tersedia
                                    </span>
                                @else
                                    <span class="badge" style="background:#fee2e2;color:#991b1b;border-radius:6px;padding:.3rem .65rem;font-size:.78rem;font-weight:600">
                                        <i class="bi bi-x-circle me-1"></i> Tidak Tersedia
                                    </span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center py-5">
                                <i class="bi bi-inbox d-block mb-2" style="font-size:2rem;color:var(--text-muted)"></i>
                                <span class="text-muted">Tidak ada produk yang sesuai filter.</span>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if ($products->hasPages())
            <div class="mt-3 px-2">{{ $products->links() }}</div>
        @endif
    </div>
@endsection
