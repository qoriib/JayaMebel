@extends('layouts.dashboard')

@section('title', 'Data Produk')

@section('content')
    <div class="glass-panel p-4">
        <div class="d-flex align-items-center justify-content-between mb-4">
            <div>
                <h2 class="h5 fw-bold mb-0">Daftar Produk</h2>
                <p class="text-muted mb-0">{{ $products->total() }} produk terdaftar</p>
            </div>
            <a href="{{ route('dashboard.products.create') }}" class="btn btn-primary-custom">
                <i class="bi bi-plus-lg"></i> Tambah Produk
            </a>
        </div>
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
                            <td class="text-muted">{{ $products->firstItem() + $index }}</td>
                            <td>
                                <div class="d-flex align-items-center gap-3">
                                    <div>
                                        <div class="fw-semibold" style="font-size:.9rem">{{ $product->nama_produk }}</div>
                                        @if ($product->deskripsi)
                                            <small class="text-muted">{{ Str::limit($product->deskripsi, 55) }}</small>
                                        @endif
                                    </div>
                                </div>
                            </td>
                            <td class="money text-nowrap">Rp {{ number_format($product->harga, 0, ',', '.') }}</td>
                            <td>{{ $product->stok }}</td>
                            <td>
                                @if ($product->stok_status === 'tersedia')
                                    <span class="badge text-bg-success">Tersedia</span>
                                @else
                                    <span class="badge text-bg-danger">Tidak Tersedia</span>
                                @endif
                            </td>
                            <td class="text-end text-nowrap">
                                <div class="d-flex align-items-center justify-content-end gap-2">
                                    <a href="{{ route('dashboard.products.edit', $product) }}" class="btn btn-sm btn-outline-primary">
                                        <i class="bi bi-pencil"></i> Edit
                                    </a>
                                    <form action="{{ route('dashboard.products.destroy', $product) }}" method="POST"
                                          onsubmit="return confirm('Hapus produk {{ $product->nama_produk }}?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger">
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
                                    <a href="{{ route('dashboard.products.create') }}" class="btn btn-primary">Tambah Produk Pertama</a>
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
