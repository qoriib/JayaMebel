@extends('layouts.app')

@section('title', 'UD Jaya Mebel | Katalog Produk')

@section('content')
    <header class="glass-panel p-4 p-lg-5 mb-5">
        <div class="row g-4 align-items-center">
            <div class="col-lg-7">
                <p class="accent-chip mb-3">
                    <span aria-hidden="true">🛋️</span>
                    Furnitur kustom & siap kirim
                </p>
                <h1 class="display-5 fw-semibold mb-3">Rancang Ruang Idaman Bersama UD Jaya Mebel</h1>
                <p class="lead text-muted mb-4">
                    Kurasi sofa, meja, hingga lemari dengan finishing premium. Semua stok tersedia untuk pesanan cepat dan
                    bisa disesuaikan mengikuti ukuran ruangan Anda.
                </p>
                <ul class="list-unstyled d-flex flex-wrap gap-3 text-muted mb-4">
                    <li><i class="bi bi-palette2 text-warning me-2"></i>Finishing custom</li>
                    <li><i class="bi bi-truck text-warning me-2"></i>Pengiriman se-Indonesia</li>
                    <li><i class="bi bi-shield-check text-warning me-2"></i>Garansi pengerjaan 30 hari</li>
                </ul>

                <div class="row g-3 text-center text-lg-start">
                    <div class="col-4">
                        <div class="fw-bold h3 mb-0">{{ number_format($stats['ready_products']) }}</div>
                        <small class="text-muted">Produk siap kirim</small>
                    </div>
                    <div class="col-4">
                        <div class="fw-bold h3 mb-0">{{ number_format($stats['orders_served']) }}</div>
                        <small class="text-muted">Pesanan berhasil</small>
                    </div>
                    <div class="col-4">
                        <div class="fw-bold h3 mb-0">{{ number_format($stats['custom_requests']) }}</div>
                        <small class="text-muted">Proyek kustom/bulan</small>
                    </div>
                </div>

                <div class="d-flex gap-3 flex-wrap mt-4">
                    <a href="tel:+620000000000" class="btn btn-warning text-dark fw-semibold px-4"><i class="bi bi-telephone me-2"></i>Hubungi Kami</a>
                    <a href="#catalogue" class="btn btn-outline-light fw-semibold px-4">Lihat Katalog</a>
                </div>
            </div>
            <div class="col-lg-5">
                <div class="glass-panel h-100 p-4" style="background:rgba(255,255,255,0.08)">
                    <h2 class="h5 fw-semibold mb-3">Cari furnitur yang pas</h2>
                    <form method="GET" action="{{ route('landing') }}" class="vstack gap-3">
                        <div>
                            <label for="search" class="form-label text-muted small mb-1">Cari produk</label>
                            <div class="input-group">
                                <span class="input-group-text bg-transparent border-end-0"><i class="bi bi-search"></i></span>
                                <input type="text" id="search" name="search" value="{{ $filters['search'] ?? '' }}" class="form-control border-start-0" placeholder="Kursi minimalis, bufet, meja...">
                            </div>
                        </div>
                        <div class="row g-3">
                            <div class="col-sm-6">
                                <label class="form-label text-muted small mb-1">Harga minimum</label>
                                <div class="input-group">
                                    <span class="input-group-text">Rp</span>
                                    <input type="number" min="0" name="min_price" value="{{ $filters['min_price'] ?? '' }}" class="form-control" placeholder="{{ number_format($priceRange['min'] ?? 0) }}">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <label class="form-label text-muted small mb-1">Harga maksimum</label>
                                <div class="input-group">
                                    <span class="input-group-text">Rp</span>
                                    <input type="number" min="0" name="max_price" value="{{ $filters['max_price'] ?? '' }}" class="form-control" placeholder="{{ number_format($priceRange['max'] ?? 0) }}">
                                </div>
                            </div>
                        </div>
                        <div>
                            <label for="sort" class="form-label text-muted small mb-1">Urutkan</label>
                            <select id="sort" name="sort" class="form-select">
                                <option value="latest" @selected(($filters['sort'] ?? 'latest') === 'latest')>Produk terbaru</option>
                                <option value="popular" @selected(($filters['sort'] ?? '') === 'popular')>Terlaris</option>
                                <option value="price_low" @selected(($filters['sort'] ?? '') === 'price_low')>Harga terendah</option>
                                <option value="price_high" @selected(($filters['sort'] ?? '') === 'price_high')>Harga tertinggi</option>
                            </select>
                        </div>

                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-warning flex-grow-1 text-dark fw-semibold">Temukan Furnitur</button>
                            <a href="{{ route('landing') }}" class="btn btn-outline-light" title="Reset filter"><i class="bi bi-arrow-counterclockwise"></i></a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </header>

    @if ($bestSellers->isNotEmpty())
        <section class="mb-5">
            <div class="d-flex flex-wrap align-items-center justify-content-between mb-3">
                <div>
                    <p class="text-muted text-uppercase small fw-semibold mb-1">Best Seller</p>
                    <h2 class="h4 fw-semibold mb-0">Koleksi yang paling banyak diminati</h2>
                </div>
                <a href="#catalogue" class="btn btn-sm btn-outline-light">Lihat semua</a>
            </div>
            <div class="row g-3">
                @foreach ($bestSellers as $item)
                    <div class="col-md-4">
                        <article class="glass-panel h-100 p-3 d-flex gap-3">
                            <div class="ratio ratio-1x1" style="max-width:96px">
                                @if ($item->gambar)
                                    <img src="{{ asset('storage/'.$item->gambar) }}" alt="{{ $item->nama_produk }}" class="rounded object-fit-cover">
                                @else
                                    <div class="rounded bg-dark bg-opacity-25 d-flex align-items-center justify-content-center fw-bold">
                                        {{ strtoupper(substr($item->nama_produk, 0, 1)) }}
                                    </div>
                                @endif
                            </div>
                            <div class="flex-grow-1">
                                <h3 class="h6 fw-semibold mb-1">{{ $item->nama_produk }}</h3>
                                <p class="text-muted small mb-2">{{ \Illuminate\Support\Str::limit($item->deskripsi, 70) }}</p>
                                <div class="d-flex align-items-center justify-content-between">
                                    <span class="text-warning fw-semibold">Rp {{ number_format($item->harga, 0, ',', '.') }}</span>
                                    <span class="badge bg-primary-subtle text-primary">{{ number_format($item->total_terjual) }} terjual</span>
                                </div>
                            </div>
                        </article>
                    </div>
                @endforeach
            </div>
        </section>
    @endif

    @if ($newArrivals->isNotEmpty())
        <section class="mb-5">
            <p class="text-muted text-uppercase small fw-semibold mb-1">Baru tiba</p>
            <div class="d-flex flex-wrap align-items-center justify-content-between mb-3">
                <h2 class="h4 fw-semibold mb-0">Produk terbaru minggu ini</h2>
                <div class="text-muted small">Harga mulai Rp {{ number_format($newArrivals->min('harga'), 0, ',', '.') }}</div>
            </div>
            <div class="row g-3">
                @foreach ($newArrivals as $arrival)
                    <div class="col-6 col-lg-3">
                        <article class="glass-panel h-100 p-3">
                            <div class="ratio ratio-4x3 mb-3">
                                @if ($arrival->gambar)
                                    <img src="{{ asset('storage/'.$arrival->gambar) }}" alt="{{ $arrival->nama_produk }}" class="rounded object-fit-cover">
                                @else
                                    <div class="rounded bg-dark bg-opacity-25 d-flex align-items-center justify-content-center fw-bold">
                                        {{ strtoupper(substr($arrival->nama_produk, 0, 1)) }}
                                    </div>
                                @endif
                            </div>
                            <h3 class="h6 fw-semibold mb-1">{{ $arrival->nama_produk }}</h3>
                            <span class="text-warning fw-semibold">Rp {{ number_format($arrival->harga, 0, ',', '.') }}</span>
                        </article>
                    </div>
                @endforeach
            </div>
        </section>
    @endif

    <section class="glass-panel p-4 p-lg-5 mb-5" id="catalogue">
        <div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-4">
            <div>
                <p class="text-muted text-uppercase small fw-semibold mb-1">Katalog utama</p>
                <h2 class="h4 fw-semibold mb-0">{{ number_format($products->total()) }} produk ditemukan</h2>
                <p class="text-muted small mb-0">Menampilkan {{ $products->firstItem() }}-{{ $products->lastItem() }} dari {{ $products->total() }} produk</p>
            </div>
            @if (($filters['search'] ?? '') !== '' || ($filters['min_price'] ?? null) !== null || ($filters['max_price'] ?? null) !== null)
                <div class="badge bg-dark-subtle text-dark">
                    Filter aktif: kata kunci "{{ $filters['search'] ?? '—' }}" · harga {{ $filters['min_price'] ?? '0' }} - {{ $filters['max_price'] ?? '∞' }}
                </div>
            @endif
        </div>

        <div class="row g-4">
            @forelse ($products as $product)
                <div class="col-12 col-md-6 col-xl-4">
                    <article class="glass-panel h-100 overflow-hidden d-flex flex-column">
                        <div class="ratio ratio-4x3 mb-3">
                            @if ($product->gambar)
                                <img src="{{ asset('storage/'.$product->gambar) }}" alt="{{ $product->nama_produk }}" class="w-100 h-100 object-fit-cover">
                            @else
                                <div class="d-flex align-items-center justify-content-center bg-dark bg-opacity-25">
                                    <span class="display-6 fw-bold text-white">{{ strtoupper(substr($product->nama_produk, 0, 1)) }}</span>
                                </div>
                            @endif
                        </div>
                        <div class="px-3 pb-4 d-flex flex-column flex-grow-1">
                            <h3 class="h5 fw-semibold">{{ $product->nama_produk }}</h3>
                            <p class="text-muted flex-grow-1">{{ \Illuminate\Support\Str::limit($product->deskripsi, 130) }}</p>
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <div>
                                    <span class="text-warning fw-semibold d-block">Rp {{ number_format($product->harga, 0, ',', '.') }}</span>
                                    <small class="text-muted">{{ number_format($product->total_terjual ?? 0) }} produk terjual</small>
                                </div>
                                <span class="badge {{ $product->stok > 0 ? 'bg-success' : 'bg-danger' }}">
                                    {{ $product->stok > 0 ? $product->stok.' Unit tersisa' : 'Habis' }}
                                </span>
                            </div>
                            <div class="d-flex gap-2">
                                <a href="https://wa.me/620000000000?text=Halo%20UD%20Jaya%20Mebel,%20saya%20ingin%20pesan%20{{ urlencode($product->nama_produk) }}" target="_blank" class="btn btn-warning text-dark fw-semibold flex-grow-1">
                                    <i class="bi bi-whatsapp me-1"></i>Pesan via WhatsApp
                                </a>
                                <a href="tel:+620000000000" class="btn btn-outline-light" title="Telepon"><i class="bi bi-telephone"></i></a>
                            </div>
                        </div>
                    </article>
                </div>
            @empty
                <div class="col-12">
                    <div class="glass-panel p-5 text-center">
                        <p class="mb-3 text-muted">Produk tidak ditemukan sesuai pencarian Anda.</p>
                        <a href="{{ route('landing') }}" class="btn btn-warning text-dark fw-semibold">Reset pencarian</a>
                    </div>
                </div>
            @endforelse
        </div>

        @if ($products->hasPages())
            <div class="mt-4">
                {{ $products->links() }}
            </div>
        @endif
    </section>

    <section class="glass-panel p-4 p-lg-5 mb-5">
        <div class="row g-4 align-items-center">
            <div class="col-lg-7">
                <h2 class="h3 fw-bold mb-3">Mau custom ukuran? Sampaikan sketsa Anda.</h2>
                <p class="text-muted mb-4">Tim kami siap membantu menghitung kebutuhan material, warna finishing, hingga estimasi pengiriman. Kirimkan foto referensi atau jadwalkan kunjungan showroom.</p>
                <div class="row g-3">
                    <div class="col-sm-4">
                        <div class="p-3 rounded-4 bg-white bg-opacity-5">
                            <div class="badge bg-warning text-dark mb-2">1</div>
                            <p class="mb-0 fw-semibold">Bagikan inspirasi</p>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="p-3 rounded-4 bg-white bg-opacity-5">
                            <div class="badge bg-warning text-dark mb-2">2</div>
                            <p class="mb-0 fw-semibold">Pilih bahan & warna</p>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="p-3 rounded-4 bg-white bg-opacity-5">
                            <div class="badge bg-warning text-dark mb-2">3</div>
                            <p class="mb-0 fw-semibold">Produksi & kirim</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-5">
                <div class="glass-panel h-100 p-4">
                    <h3 class="h5 fw-semibold mb-2">Butuh konsultasi cepat?</h3>
                    <p class="text-muted">Tim sales kami online setiap hari kerja 09.00-20.00 WIB.</p>
                    <div class="d-flex flex-column gap-2">
                        <a href="https://wa.me/620000000000" target="_blank" class="btn btn-success d-flex align-items-center justify-content-center gap-2">
                            <i class="bi bi-whatsapp"></i>Chat WhatsApp
                        </a>
                        <a href="mailto:cs@jayamebel.id" class="btn btn-outline-light d-flex align-items-center justify-content-center gap-2">
                            <i class="bi bi-envelope"></i>Email Penawaran
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
