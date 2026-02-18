@extends('layouts.app')

@section('title', 'UD Jaya Mebel | Katalog Produk')

@section('content')
    <header class="glass-panel p-4 p-lg-5 mb-5 text-center text-lg-start">
        <p class="accent-chip mb-3 mx-auto mx-lg-0">
            <span aria-hidden="true">🛋️</span>
            Furnitur Kustom untuk Rumah Anda
        </p>
        <h1 class="display-5 fw-semibold mb-3">Temukan Koleksi Terbaru UD Jaya Mebel</h1>
        <p class="lead text-muted">
            Semua produk yang tampil di halaman ini siap dipesan. Hubungi toko kami untuk detail finishing, ukuran kustom,
            dan penawaran terbaik.
        </p>
        <div class="d-flex gap-3 flex-wrap">
            <a href="tel:+620000000000" class="btn btn-warning text-dark fw-semibold px-4">Hubungi Kami</a>
            <a href="#catalogue" class="btn btn-outline-light fw-semibold px-4">Lihat Produk</a>
        </div>
    </header>

    <section id="catalogue" class="row g-4">
        @forelse ($products as $product)
            <div class="col-12 col-md-6 col-xl-4">
                <article class="glass-panel h-100 overflow-hidden">
                    <div class="ratio ratio-4x3 mb-3">
                        @if ($product->gambar)
                            <img src="{{ asset('storage/'.$product->gambar) }}" alt="{{ $product->nama_produk }}" class="w-100 h-100 object-fit-cover">
                        @else
                            <div class="d-flex align-items-center justify-content-center bg-dark bg-opacity-25">
                                <span class="display-4">{{ strtoupper(substr($product->nama_produk, 0, 1)) }}</span>
                            </div>
                        @endif
                    </div>
                    <div class="px-3 pb-4">
                        <h2 class="h4 fw-semibold">{{ $product->nama_produk }}</h2>
                        <p class="text-muted">{{ \Illuminate\Support\Str::limit($product->deskripsi, 120) }}</p>
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="text-warning fw-semibold">Rp {{ number_format($product->harga, 0, ',', '.') }}</span>
                            <span class="badge {{ $product->stok > 0 ? 'bg-success' : 'bg-danger' }}">
                                {{ $product->stok > 0 ? $product->stok.' Unit' : 'Habis' }}
                            </span>
                        </div>
                    </div>
                </article>
            </div>
        @empty
            <div class="col-12">
                <div class="glass-panel p-5 text-center">
                    <p class="mb-0 text-muted">Produk belum tersedia. Silakan kembali lagi nanti.</p>
                </div>
            </div>
        @endforelse
    </section>
@endsection
