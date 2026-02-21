@extends('layouts.app')

@section('title', 'Katalog Produk')

@section('content')

    {{-- ── Hero ── --}}
    <section class="glass-panel p-4 p-lg-5 mb-4">
        <div class="row g-4 g-lg-5 align-items-center">
            <div class="col-lg-6">
                <h1 class="fw-bold mb-3" style="font-size:clamp(1.8rem,4vw,2.6rem);line-height:1.2">
                    Rancang Ruang Idaman Bersama <span style="color:var(--accent)">UD Jaya Mebel</span>
                </h1>
                <p class="mb-4" style="font-size:.95rem;color:var(--text-muted);line-height:1.7">
                    Sofa, meja, hingga lemari dengan finishing premium. Semua stok tersedia untuk pesanan cepat dan bisa disesuaikan mengikuti ukuran ruangan Anda.
                </p>

                <div class="d-flex flex-wrap gap-3 mb-4" style="font-size:.875rem;color:var(--text-muted)">
                    <span><i class="bi bi-palette2 me-2" style="color:var(--accent)"></i>Finishing custom</span>
                    <span><i class="bi bi-truck me-2" style="color:var(--accent)"></i>Pengiriman se-Indonesia</span>
                    <span><i class="bi bi-shield-check me-2" style="color:var(--accent)"></i>Garansi 30 hari</span>
                </div>

                <div class="row g-3 mb-4">
                    <div class="col-4">
                        <div class="stat-item">
                            <div class="stat-value">{{ number_format($stats['ready_products']) }}</div>
                            <div class="stat-label">Produk siap kirim</div>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="stat-item">
                            <div class="stat-value">{{ number_format($stats['orders_served']) }}</div>
                            <div class="stat-label">Pesanan berhasil</div>
                        </div>
                    </div>
                </div>

                <div class="d-flex flex-wrap gap-2">
                    <a href="#catalogue" class="btn-accent" style="padding:.6rem 1.4rem;font-size:.9rem">
                        <i class="bi bi-grid-3x3-gap"></i> Lihat Katalog
                    </a>
                    <a href="https://wa.me/{{ config('company.whatsapp') }}" target="_blank"
                       class="btn-outline-accent" style="padding:.55rem 1.4rem;font-size:.9rem">
                        <i class="bi bi-whatsapp"></i> Hubungi Kami
                    </a>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="glass-panel p-4" style="background:var(--surface-alt)">
                    <h2 class="h5 fw-bold mb-4">
                        <i class="bi bi-search me-2" style="color:var(--accent)"></i>Cari furnitur yang pas
                    </h2>
                    <form method="GET" action="{{ route('landing') }}" class="vstack gap-3">
                        <div>
                            <label for="search" class="form-label fw-semibold" style="font-size:.82rem">Kata kunci</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-search"></i></span>
                                <input type="text" id="search" name="search"
                                       value="{{ $filters['search'] ?? '' }}"
                                       class="form-control"
                                       placeholder="Kursi minimalis, meja makan, lemari...">
                            </div>
                        </div>
                        <div class="row g-3">
                            <div class="col-6">
                                <label class="form-label fw-semibold" style="font-size:.82rem">Harga minimum</label>
                                <div class="input-group">
                                    <span class="input-group-text" style="font-size:.8rem">Rp</span>
                                    <input type="number" min="0" name="min_price"
                                           value="{{ $filters['min_price'] ?? '' }}"
                                           class="form-control"
                                           placeholder="{{ number_format($priceRange['min'] ?? 0) }}">
                                </div>
                            </div>
                            <div class="col-6">
                                <label class="form-label fw-semibold" style="font-size:.82rem">Harga maksimum</label>
                                <div class="input-group">
                                    <span class="input-group-text" style="font-size:.8rem">Rp</span>
                                    <input type="number" min="0" name="max_price"
                                           value="{{ $filters['max_price'] ?? '' }}"
                                           class="form-control"
                                           placeholder="{{ number_format($priceRange['max'] ?? 0) }}">
                                </div>
                            </div>
                        </div>
                        <div>
                            <label for="sort" class="form-label fw-semibold" style="font-size:.82rem">Urutkan</label>
                            <select id="sort" name="sort" class="form-select">
                                <option value="latest"     @selected(($filters['sort'] ?? 'latest') === 'latest')>Produk terbaru</option>
                                <option value="popular"    @selected(($filters['sort'] ?? '') === 'popular')>Terlaris</option>
                                <option value="price_low"  @selected(($filters['sort'] ?? '') === 'price_low')>Harga terendah</option>
                                <option value="price_high" @selected(($filters['sort'] ?? '') === 'price_high')>Harga tertinggi</option>
                            </select>
                        </div>
                        <div class="d-flex gap-2">
                            <button type="submit" class="btn-accent flex-grow-1 justify-content-center"
                                    style="padding:.6rem 1rem;font-size:.875rem;border-radius:999px;border:none;cursor:pointer">
                                <i class="bi bi-funnel"></i> Temukan Furnitur
                            </button>
                            @if (($filters['search'] ?? '') !== '' || ($filters['min_price'] ?? null) !== null || ($filters['max_price'] ?? null) !== null)
                                <a href="{{ route('landing') }}" class="btn-outline-accent"
                                   style="padding:.55rem .9rem;font-size:.875rem" title="Reset filter">
                                    <i class="bi bi-x-lg"></i>
                                </a>
                            @endif
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    {{-- ── Best Sellers ── --}}
    @if ($bestSellers->isNotEmpty())
        <section class="mb-4">
            <div class="d-flex flex-wrap align-items-end justify-content-between mb-3 py-3 gap-2">
                <h2 class="h4 fw-bold mb-0">Koleksi paling banyak diminati</h2>
                <a href="#catalogue" class="btn-outline-accent" style="padding:.4rem 1rem;font-size:.82rem">Lihat semua &rarr;</a>
            </div>
            <div class="row g-3">
                @foreach ($bestSellers as $item)
                    <div class="col-12 col-md-4">
                        <article class="glass-panel p-3 d-flex gap-3 h-100 align-items-center">
                            <a href="{{ route('product.show', $item) }}"
                               style="flex-shrink:0;width:90px;height:90px;border-radius:12px;overflow:hidden;border:1px solid var(--border-color);display:block">
                                @if ($item->gambar)
                                    <img src="{{ asset('storage/'.$item->gambar) }}" alt="{{ $item->nama_produk }}"
                                         style="width:100%;height:100%;object-fit:cover">
                                @else
                                    <img src="https://placehold.co/90x90/f1ede6/c07a36"
                                         alt="{{ $item->nama_produk }}" style="width:100%;height:100%;object-fit:cover">
                                @endif
                            </a>
                            <div class="flex-grow-1 overflow-hidden">
                                <h3 class="fw-semibold mb-1 text-truncate" style="font-size:.9rem">
                                    <a href="{{ route('product.show', $item) }}" style="color:inherit;text-decoration:none">{{ $item->nama_produk }}</a>
                                </h3>
                                <p class="mb-2" style="font-size:.78rem;color:var(--text-muted);display:-webkit-box;-webkit-line-clamp:2;-webkit-box-orient:vertical;overflow:hidden">
                                    {{ $item->deskripsi ?? 'Produk furnitur berkualitas dari UD Jaya Mebel.' }}
                                </p>
                                <div class="d-flex align-items-center justify-content-between gap-2 flex-wrap">
                                    <span class="fw-bold" style="color:var(--accent);font-size:.9rem">Rp {{ number_format($item->harga, 0, ',', '.') }}</span>
                                    <span class="badge text-bg-warning" style="font-size:.7rem;border-radius:999px">
                                        <i class="bi bi-fire me-1"></i>{{ number_format($item->total_terjual) }} terjual
                                    </span>
                                </div>
                            </div>
                        </article>
                    </div>
                @endforeach
            </div>
        </section>
    @endif

    {{-- ── Catalogue ── --}}
    <section class="glass-panel p-4 p-lg-5 mb-4" id="catalogue">
        <div class="d-flex flex-wrap align-items-start justify-content-between gap-3 mb-4">
            <div>
                <h2 class="h4 fw-bold mb-1">Katalog Produk</h2>
                @if ($products->total() > 0)
                    <p class="mb-0" style="font-size:.82rem;color:var(--text-muted)">
                        Menampilkan {{ $products->firstItem() }}–{{ $products->lastItem() }} dari {{ number_format($products->total()) }} produk
                    </p>
                @else
                    <p class="mb-0" style="font-size:.82rem;color:var(--text-muted)">Tidak ada produk ditemukan</p>
                @endif
            </div>
            @if (($filters['search'] ?? '') !== '' || ($filters['min_price'] ?? null) !== null || ($filters['max_price'] ?? null) !== null)
                <div class="d-flex align-items-center gap-2 flex-wrap">
                    <span style="font-size:.78rem;color:var(--text-muted)">Filter aktif:</span>
                    @if (($filters['search'] ?? '') !== '')
                        <span class="accent-chip" style="font-size:.75rem;padding:.2rem .65rem">"{{ $filters['search'] }}"</span>
                    @endif
                    @if (($filters['min_price'] ?? null) !== null || ($filters['max_price'] ?? null) !== null)
                        <span class="accent-chip" style="font-size:.75rem;padding:.2rem .65rem">
                            Rp {{ number_format($filters['min_price'] ?? 0) }} – {{ $filters['max_price'] ? 'Rp '.number_format($filters['max_price']) : '∞' }}
                        </span>
                    @endif
                    <a href="{{ route('landing') }}" style="font-size:.78rem;color:var(--accent);text-decoration:none">Hapus semua</a>
                </div>
            @endif
        </div>

        <div class="row g-4">
            @forelse ($products as $product)
                <div class="col-12 col-md-6 col-xl-4">
                    <article class="product-card">
                        <a href="{{ route('product.show', $product) }}">
                            @if ($product->gambar)
                                <img src="{{ asset('storage/'.$product->gambar) }}"
                                     alt="{{ $product->nama_produk }}" class="card-img">
                            @else
                                <img src="https://placehold.co/600x400/f1ede6/c07a36"
                                     alt="{{ $product->nama_produk }}" class="card-img">
                            @endif
                        </a>
                        <div class="card-body">
                            <div class="d-flex align-items-center gap-2 mb-2 flex-wrap">
                                @if ($product->stok > 0)
                                    <span class="badge-stock text-bg-success">{{ $product->stok }} unit tersedia</span>
                                @else
                                    <span class="badge-stock text-bg-danger">Habis</span>
                                @endif
                                @if ($product->total_terjual > 0)
                                    <span style="font-size:.72rem;color:var(--text-muted)">
                                        <i class="bi bi-fire"></i> {{ number_format($product->total_terjual) }} terjual
                                    </span>
                                @endif
                            </div>
                            <h3 class="fw-semibold mb-1" style="font-size:.95rem">
                                <a href="{{ route('product.show', $product) }}" style="color:inherit;text-decoration:none">{{ $product->nama_produk }}</a>
                            </h3>
                            <p class="flex-grow-1 mb-3" style="font-size:.82rem;color:var(--text-muted);display:-webkit-box;-webkit-line-clamp:2;-webkit-box-orient:vertical;overflow:hidden">
                                {{ $product->deskripsi ?? 'Produk furnitur berkualitas dari UD Jaya Mebel.' }}
                            </p>
                            <div class="mb-3">
                                <span class="fw-bold" style="color:var(--accent);font-size:1.1rem">
                                    Rp {{ number_format($product->harga, 0, ',', '.') }}
                                </span>
                            </div>
                            <div class="d-flex gap-2">
                                <a href="{{ route('product.show', $product) }}"
                                   class="btn-outline-accent flex-grow-1 justify-content-center"
                                   style="padding:.5rem .8rem;font-size:.82rem;border-radius:10px">
                                    <i class="bi bi-eye"></i> Detail
                                </a>
                                <a href="https://wa.me/{{ config('company.whatsapp') }}?text=Halo%20UD%20Jaya%20Mebel,%20saya%20ingin%20pesan%20{{ urlencode($product->nama_produk) }}"
                                   target="_blank" class="btn-accent flex-grow-1 justify-content-center"
                                   style="padding:.55rem .8rem;font-size:.82rem;border-radius:10px">
                                    <i class="bi bi-whatsapp"></i> Pesan
                                </a>
                            </div>
                        </div>
                    </article>
                </div>
            @empty
                <div class="col-12">
                    <div class="text-center py-5">
                        <i class="bi bi-inbox d-block mb-3" style="font-size:2.5rem;color:var(--text-muted)"></i>
                        <p class="mb-3" style="color:var(--text-muted)">Produk tidak ditemukan sesuai pencarian Anda.</p>
                        <a href="{{ route('landing') }}" class="btn-accent" style="padding:.55rem 1.4rem;font-size:.875rem">
                            Reset pencarian
                        </a>
                    </div>
                </div>
            @endforelse
        </div>

        @if ($products->hasPages())
            <div class="mt-4 pt-2" style="border-top:1px solid var(--border-color)">
                {{ $products->links() }}
            </div>
        @endif
    </section>

    
    {{-- ── New Arrivals ── --}}
    @if ($newArrivals->isNotEmpty())
        <section class="mb-4">
            <div class="d-flex flex-wrap align-items-end justify-content-between mb-3 py-3 gap-2">
                <h2 class="h4 fw-bold mb-0">Produk terbaru minggu ini</h2>
                <span style="font-size:.82rem;color:var(--text-muted)">
                    Mulai dari Rp {{ number_format($newArrivals->min('harga'), 0, ',', '.') }}
                </span>
            </div>
            <div class="row g-3">
                @foreach ($newArrivals as $arrival)
                    <div class="col-6 col-lg-3">
                        <article class="product-card">
                            <a href="{{ route('product.show', $arrival) }}">
                                @if ($arrival->gambar)
                                    <img src="{{ asset('storage/'.$arrival->gambar) }}"
                                         alt="{{ $arrival->nama_produk }}" class="card-img">
                                @else
                                    <img src="https://placehold.co/400x300/f1ede6/c07a36"
                                         alt="{{ $arrival->nama_produk }}" class="card-img">
                                @endif
                            </a>
                            <div class="card-body">
                                <div class="mb-1">
                                    <span class="badge text-bg-success" style="font-size:.68rem;border-radius:999px">Baru</span>
                                </div>
                                <h3 class="fw-semibold mb-1 text-truncate" style="font-size:.88rem">
                                    <a href="{{ route('product.show', $arrival) }}" style="color:inherit;text-decoration:none">{{ $arrival->nama_produk }}</a>
                                </h3>
                                <div class="d-flex align-items-center justify-content-between gap-2">
                                    <span class="fw-bold" style="color:var(--accent);font-size:.9rem">Rp {{ number_format($arrival->harga, 0, ',', '.') }}</span>
                                    <a href="{{ route('product.show', $arrival) }}" style="font-size:.75rem;color:var(--accent);text-decoration:none">
                                        Detail <i class="bi bi-arrow-right"></i>
                                    </a>
                                </div>
                            </div>
                        </article>
                    </div>
                @endforeach
            </div>
        </section>
    @endif

    {{-- ── Custom Order CTA ── --}}
    <section class="glass-panel p-4 p-lg-5 mb-2" id="custom" style="background:linear-gradient(135deg,var(--surface),var(--surface-alt))">
        <div class="row g-4 g-lg-5 align-items-center">
            <div class="col-lg-7">
                <span class="accent-chip mb-3"><i class="bi bi-pencil-square"></i> Pesanan Kustom</span>
                <h2 class="fw-bold mb-3" style="font-size:clamp(1.4rem,3vw,2rem)">Mau custom ukuran? Sampaikan sketsa Anda.</h2>
                <p class="mb-4" style="font-size:.9rem;color:var(--text-muted);line-height:1.7">
                    Tim kami siap membantu menghitung kebutuhan material, warna finishing, hingga estimasi pengiriman. Kirimkan foto referensi atau jadwalkan kunjungan showroom.
                </p>
                <div class="row g-3">
                    <div class="col-sm-4">
                        <div class="p-3 text-center" style="background:var(--surface);border:1px solid var(--border-color);border-radius:12px">
                            <div class="mb-2" style="width:36px;height:36px;border-radius:10px;background:var(--accent-soft);display:flex;align-items:center;justify-content:center;margin:0 auto">
                                <i class="bi bi-image" style="color:var(--accent)"></i>
                            </div>
                            <p class="mb-0 fw-semibold" style="font-size:.82rem">Bagikan inspirasi</p>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="p-3 text-center" style="background:var(--surface);border:1px solid var(--border-color);border-radius:12px">
                            <div class="mb-2" style="width:36px;height:36px;border-radius:10px;background:var(--accent-soft);display:flex;align-items:center;justify-content:center;margin:0 auto">
                                <i class="bi bi-palette2" style="color:var(--accent)"></i>
                            </div>
                            <p class="mb-0 fw-semibold" style="font-size:.82rem">Pilih bahan &amp; warna</p>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="p-3 text-center" style="background:var(--surface);border:1px solid var(--border-color);border-radius:12px">
                            <div class="mb-2" style="width:36px;height:36px;border-radius:10px;background:var(--accent-soft);display:flex;align-items:center;justify-content:center;margin:0 auto">
                                <i class="bi bi-truck" style="color:var(--accent)"></i>
                            </div>
                            <p class="mb-0 fw-semibold" style="font-size:.82rem">Produksi &amp; kirim</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-5">
                <div class="glass-panel p-4">
                    <h3 class="h5 fw-bold mb-1">Butuh konsultasi cepat?</h3>
                    <p class="mb-4" style="font-size:.875rem;color:var(--text-muted)">
                        Tim sales kami online setiap hari kerja <strong>09.00–20.00 WIB</strong>.
                    </p>
                    <div class="vstack gap-2">
                        <a href="https://wa.me/{{ config('company.whatsapp') }}" target="_blank"
                           class="btn-accent justify-content-center"
                           style="padding:.65rem 1rem;font-size:.9rem;border-radius:12px">
                            <i class="bi bi-whatsapp"></i> Chat WhatsApp Sekarang
                        </a>
                        <a href="mailto:{{ config('company.email') }}"
                           class="btn-outline-accent justify-content-center"
                           style="padding:.6rem 1rem;font-size:.9rem;border-radius:12px">
                            <i class="bi bi-envelope"></i> Kirim Email Penawaran
                        </a>
                        <a href="tel:{{ config('company.phone') }}"
                           class="btn-outline-accent justify-content-center"
                           style="padding:.6rem 1rem;font-size:.9rem;border-radius:12px">
                            <i class="bi bi-telephone"></i> Telepon Langsung
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
