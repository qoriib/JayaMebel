@extends('layouts.dashboard')

@section('title', 'Laporan Stok | UD Jaya Mebel')
@section('page-title', 'Laporan Stok')

@section('content')
    {{-- Stat Cards --}}
    <div class="row g-3 mb-4">
        <div class="col-6 col-xl-3">
            <div class="metric-card h-100">
                <div class="d-flex align-items-center gap-2 mb-3">
                    <div style="width:38px;height:38px;border-radius:10px;background:rgba(192,122,54,.12);display:flex;align-items:center;justify-content:center">
                        <i class="bi bi-box-seam-fill" style="color:var(--accent)"></i>
                    </div>
                    <div class="metric-label mb-0">Total Produk</div>
                </div>
                <div class="metric-value">{{ number_format($totalProducts) }}</div>
                <p class="text-muted mb-0" style="font-size:.8rem">Total katalog</p>
            </div>
        </div>
        <div class="col-6 col-xl-3">
            <div class="metric-card h-100">
                <div class="d-flex align-items-center gap-2 mb-3">
                    <div style="width:38px;height:38px;border-radius:10px;background:rgba(25,135,84,.1);display:flex;align-items:center;justify-content:center">
                        <i class="bi bi-check-circle-fill" style="color:#198754"></i>
                    </div>
                    <div class="metric-label mb-0">Tersedia</div>
                </div>
                <div class="metric-value" style="color:#198754">{{ number_format($availableProducts) }}</div>
                <p class="text-muted mb-0" style="font-size:.8rem">Siap dijual</p>
            </div>
        </div>
        <div class="col-6 col-xl-3">
            <div class="metric-card h-100">
                <div class="d-flex align-items-center gap-2 mb-3">
                    <div style="width:38px;height:38px;border-radius:10px;background:rgba(220,53,69,.1);display:flex;align-items:center;justify-content:center">
                        <i class="bi bi-x-circle-fill" style="color:#dc3545"></i>
                    </div>
                    <div class="metric-label mb-0">Tidak Tersedia</div>
                </div>
                <div class="metric-value" style="color:#dc3545">{{ number_format($outOfStockProducts) }}</div>
                <p class="text-muted mb-0" style="font-size:.8rem">Stok habis</p>
            </div>
        </div>
        <div class="col-6 col-xl-3">
            <div class="metric-card h-100">
                <div class="d-flex align-items-center gap-2 mb-3">
                    <div style="width:38px;height:38px;border-radius:10px;background:rgba(13,110,253,.1);display:flex;align-items:center;justify-content:center">
                        <i class="bi bi-stack" style="color:#0d6efd"></i>
                    </div>
                    <div class="metric-label mb-0">Total Unit Stok</div>
                </div>
                <div class="metric-value">{{ number_format($totalStock) }}</div>
                <p class="text-muted mb-0" style="font-size:.8rem">Unit tersimpan</p>
            </div>
        </div>
    </div>

    {{-- Filter --}}
    <div class="glass-panel p-4 mb-4">
        <div class="d-flex align-items-center mb-3">
            <div>
                <h2 class="h5 fw-bold mb-0">Filter Laporan</h2>
                <p class="text-muted mb-0" style="font-size:.8rem">Saring data berdasarkan nama, status, atau jumlah stok</p>
            </div>
        </div>
        <form method="GET">
            <div class="row g-3 mb-3">
                <div class="col-12 col-sm-6 col-lg-4">
                    <label for="search" class="form-label fw-semibold" style="font-size:.85rem">Cari Nama Produk</label>
                    <input type="text" id="search" name="search" value="{{ $filters['search'] ?? '' }}"
                           placeholder="Cari produk..." class="form-control">
                </div>
                <div class="col-12 col-sm-6 col-lg-4">
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
            </div>
            <div class="d-flex flex-wrap gap-2">
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-search me-1"></i> Terapkan Filter
                </button>
                <a href="{{ route('dashboard.reports.stock') }}" class="btn btn-outline-secondary">
                    <i class="bi bi-arrow-counterclockwise me-1"></i> Reset
                </a>
                <a href="{{ route('dashboard.reports.stock.print', array_filter(request()->query())) }}"
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
                <h2 class="h5 fw-bold mb-0">Data Stok Produk</h2>
                <p class="text-muted mb-0" style="font-size:.8rem">{{ $products->total() }} produk ditemukan</p>
            </div>
        </div>
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
                                    <div>
                                        <div class="fw-semibold" style="font-size:.9rem">{{ $product->nama_produk }}</div>
                                        @if ($product->deskripsi)
                                            <small class="text-muted">{{ Str::limit($product->deskripsi, 60) }}</small>
                                        @endif
                                    </div>
                                </div>
                            </td>
                            <td class="text-end money" style="font-size:.875rem">Rp {{ number_format($product->harga, 0, ',', '.') }}</td>
                            <td class="text-center">
                                <span class="fw-semibold" style="font-size:.875rem;color:{{ $product->stok === 0 ? '#dc3545' : ($product->stok <= 5 ? '#d97706' : 'inherit') }}">
                                    {{ number_format($product->stok) }} unit
                                </span>
                            </td>
                            <td class="text-center">
                                @if ($product->stok_status === 'tersedia')
                                    <span class="badge-success">Tersedia</span>
                                @else
                                    <span class="badge-danger">Tidak Tersedia</span>
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
