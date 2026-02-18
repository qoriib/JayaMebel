@extends('layouts.app')

@section('title', 'Manajemen Stok Produk | UD Jaya Mebel')

@section('content')
    <section class="glass-panel p-4 p-lg-5 mb-4">
        <div class="d-flex flex-column flex-lg-row justify-content-between gap-3">
            <div>
                <p class="accent-chip mb-2"><span aria-hidden="true">📦</span> Pengendalian Stok</p>
                <h1 class="h4 mb-0">Kelola Ketersediaan Produk</h1>
            </div>
            <span class="text-muted">Total produk: {{ $products->total() }}</span>
        </div>
    </section>

    <section class="glass-panel p-3">
        <div class="table-responsive">
            <table class="table table-dark table-dark-custom align-middle mb-0">
                <thead>
                    <tr>
                        <th>Produk</th>
                        <th>Status</th>
                        <th>Stok</th>
                        <th>Harga</th>
                        <th class="text-end">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($products as $product)
                        <tr>
                            <td>
                                <div class="d-flex align-items-center gap-3">
                                    <div class="rounded-circle bg-dark bg-opacity-50 d-flex align-items-center justify-content-center" style="width:48px;height:48px;">
                                        {{ strtoupper(substr($product->nama_produk, 0, 1)) }}
                                    </div>
                                    <div>
                                        <div class="fw-semibold">{{ $product->nama_produk }}</div>
                                        <small class="text-muted">{{ \Illuminate\Support\Str::limit($product->deskripsi, 60) }}</small>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <span class="badge {{ $product->stok_status === 'tersedia' ? 'bg-success' : 'bg-danger' }}">
                                    {{ ucfirst($product->stok_status) }}
                                </span>
                            </td>
                            <td>{{ $product->stok }} unit</td>
                            <td>Rp {{ number_format($product->harga, 0, ',', '.') }}</td>
                            <td class="text-end">
                                <form action="{{ route('admin.products.update-status', $product) }}" method="POST" class="d-inline-flex gap-2 align-items-center justify-content-end">
                                    @csrf
                                    @method('PATCH')
                                    <select name="stok_status" class="form-select form-select-sm w-auto">
                                        <option value="tersedia" @selected($product->stok_status === 'tersedia')>Tersedia</option>
                                        <option value="tidak" @selected($product->stok_status === 'tidak')>Tidak Tersedia</option>
                                    </select>
                                    <input type="number" name="stok" value="{{ $product->stok }}" min="0" class="form-control form-control-sm w-25" placeholder="Stok">
                                    <button type="submit" class="btn btn-sm btn-outline-light">Perbarui</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center text-muted">Belum ada produk.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="mt-3">
            {{ $products->links() }}
        </div>
    </section>
@endsection
