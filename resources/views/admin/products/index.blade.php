@extends('layouts.dashboard')

@section('title', 'Data Produk | UD Jaya Mebel')
@section('page-title', 'Data Produk')

@section('content')
    @if (session('success'))
        <div class="alert alert-success alert-dismissible mb-4" role="alert"
             style="border-radius:10px;border:none;background:#d1fae5;color:#065f46">
            <i class="bi bi-check-circle me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="d-flex align-items-center justify-content-between mb-4">
        <div>
            <h1 class="h5 fw-bold mb-1">Daftar Produk</h1>
            <p class="text-muted mb-0" style="font-size:.85rem">{{ $products->total() }} produk terdaftar</p>
        </div>
        <a href="{{ route('admin.products.create') }}" class="btn-accent d-flex align-items-center gap-2 text-decoration-none">
            <i class="bi bi-plus-lg"></i> Tambah Produk
        </a>
    </div>

    <div class="section-card">
        <div class="table-responsive">
            <table class="table table-custom table-hover align-middle mb-0">
                <thead>
                    <tr>
                        <th style="width:40px">#</th>
                        <th>Produk</th>
                        <th>Harga</th>
                        <th>Stok</th>
                        <th>Status</th>
                        <th class="text-end">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($products as $index => $product)
                        <tr>
                            <td class="text-muted" style="font-size:.8rem">{{ $products->firstItem() + $index }}</td>
                            <td>
                                <div class="d-flex align-items-center gap-3">
                                    @if ($product->gambar)
                                        <img src="{{ Storage::url($product->gambar) }}" alt="{{ $product->nama_produk }}"
                                             style="width:44px;height:44px;object-fit:cover;border-radius:8px;flex-shrink:0">
                                    @else
                                        <div style="width:44px;height:44px;border-radius:8px;background:var(--accent-soft);display:flex;align-items:center;justify-content:center;font-weight:700;color:var(--accent);font-size:.9rem;flex-shrink:0">
                                            {{ strtoupper(substr($product->nama_produk, 0, 1)) }}
                                        </div>
                                    @endif
                                    <div>
                                        <div class="fw-semibold" style="font-size:.9rem">{{ $product->nama_produk }}</div>
                                        @if ($product->deskripsi)
                                            <small class="text-muted">{{ Str::limit($product->deskripsi, 55) }}</small>
                                        @endif
                                    </div>
                                </div>
                            </td>
                            <td class="money">Rp {{ number_format($product->harga, 0, ',', '.') }}</td>
                            <td>{{ $product->stok }} <span class="text-muted" style="font-size:.8rem">unit</span></td>
                            <td>
                                @if ($product->stok_status === 'tersedia')
                                    <span class="badge-success">Tersedia</span>
                                @else
                                    <span class="badge-danger">Tidak Tersedia</span>
                                @endif
                            </td>
                            <td class="text-end">
                                <div class="d-flex align-items-center justify-content-end gap-2">
                                    <a href="{{ route('admin.products.edit', $product) }}"
                                       class="btn-outline-custom d-inline-flex align-items-center gap-1"
                                       style="font-size:.8rem;padding:.3rem .75rem">
                                        <i class="bi bi-pencil"></i> Edit
                                    </a>
                                    <form action="{{ route('admin.products.destroy', $product) }}" method="POST"
                                          onsubmit="return confirm('Hapus produk {{ $product->nama_produk }}?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger" style="border-radius:8px;font-size:.8rem">
                                            <i class="bi bi-trash"></i> Hapus
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center py-5">
                                <i class="bi bi-box-seam d-block mb-2" style="font-size:2rem;color:var(--text-muted)"></i>
                                <span class="text-muted">Belum ada produk.</span>
                                <div class="mt-3">
                                    <a href="{{ route('admin.products.create') }}" class="btn-accent text-decoration-none">Tambah Produk Pertama</a>
                                </div>
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