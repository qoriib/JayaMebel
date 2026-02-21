@extends('layouts.app')

@section('title', $product->nama_produk)

@section('content')

    {{-- ── Breadcrumb ── --}}
    <nav aria-label="breadcrumb" class="mb-4">
        <ol class="breadcrumb mb-0" style="font-size:.82rem">
            <li class="breadcrumb-item">
                <a href="{{ route('landing') }}" style="color:var(--accent);text-decoration:none">Beranda</a>
            </li>
            <li class="breadcrumb-item">
                <a href="{{ route('landing') }}#catalogue" style="color:var(--accent);text-decoration:none">Katalog</a>
            </li>
            <li class="breadcrumb-item active text-truncate" style="max-width:220px" aria-current="page">
                {{ $product->nama_produk }}
            </li>
        </ol>
    </nav>

    {{-- ── Main Detail ── --}}
    <div class="glass-panel p-4 p-lg-5 mb-4">
        <div class="row g-4 g-lg-5">

            {{-- Image --}}
            <div class="col-lg-5">
                <div id="product-image-wrapper"
                     style="border-radius:var(--card-radius);overflow:hidden;border:1px solid var(--border-color);background:var(--surface-alt);aspect-ratio:4/3;display:flex;align-items:center;justify-content:center">
                    @if ($product->gambar)
                        <img id="product-main-img"
                             src="{{ $product->gambar_url }}"
                             alt="{{ $product->nama_produk }}"
                             style="width:100%;height:100%;object-fit:cover;cursor:zoom-in;transition:transform .3s">
                    @else
                        <img id="product-main-img"
                             src="https://placehold.co/800x600/f1ede6/c07a36"
                             alt="{{ $product->nama_produk }}"
                             style="width:100%;height:100%;object-fit:cover">
                    @endif
                </div>

                {{-- Lightbox (only when real image exists) --}}
                @if ($product->gambar)
                    <div id="img-lightbox"
                         style="display:none;position:fixed;inset:0;z-index:9999;background:rgba(0,0,0,.82);align-items:center;justify-content:center;cursor:zoom-out">
                        <img src="{{ $product->gambar_url }}"
                             alt="{{ $product->nama_produk }}"
                             style="max-width:90vw;max-height:90vh;border-radius:12px;object-fit:contain">
                    </div>
                    <script>
                        document.getElementById('img-lightbox').addEventListener('click', function () {
                            this.style.display = 'none';
                        });
                        document.getElementById('product-main-img').addEventListener('click', function () {
                            var lb = document.getElementById('img-lightbox');
                            lb.style.display = 'flex';
                        });
                    </script>
                @endif

                {{-- Social share --}}
                <div class="mt-3 d-flex align-items-center gap-2 flex-wrap" style="font-size:.8rem;color:var(--text-muted)">
                    <span>Bagikan:</span>
                    <a href="https://wa.me/?text={{ urlencode($product->nama_produk.' - Rp '.number_format($product->harga,0,',','.').' | '.url()->current()) }}"
                       target="_blank"
                       class="btn-outline-accent" style="padding:.3rem .75rem;font-size:.78rem;border-radius:999px">
                        <i class="bi bi-whatsapp"></i> WhatsApp
                    </a>
                    <button onclick="navigator.clipboard.writeText(window.location.href);this.innerHTML='<i class=\'bi bi-check2\'></i> Disalin'"
                            class="btn-outline-accent" style="padding:.3rem .75rem;font-size:.78rem;border-radius:999px;cursor:pointer">
                        <i class="bi bi-link-45deg"></i> Salin tautan
                    </button>
                </div>
            </div>

            {{-- Info --}}
            <div class="col-lg-7 d-flex flex-column">

                {{-- Badges --}}
                <div class="d-flex align-items-center gap-2 flex-wrap mb-3">
                    @if ($product->stok_status === 'tersedia' && $product->stok > 0)
                        <span class="badge text-bg-success" style="border-radius:999px;font-size:.75rem">
                            <i class="bi bi-check-circle me-1"></i>Tersedia
                        </span>
                    @else
                        <span class="badge text-bg-danger" style="border-radius:999px;font-size:.75rem">
                            <i class="bi bi-x-circle me-1"></i>Stok Habis
                        </span>
                    @endif
                    @if ($product->total_terjual > 0)
                        <span class="badge text-bg-warning" style="border-radius:999px;font-size:.75rem">
                            <i class="bi bi-fire me-1"></i>{{ number_format($product->total_terjual) }} terjual
                        </span>
                    @endif
                </div>

                <h1 class="fw-bold mb-2" style="font-size:clamp(1.3rem,3vw,1.8rem);line-height:1.3">
                    {{ $product->nama_produk }}
                </h1>

                {{-- Price --}}
                <div class="mb-4 py-3 px-4" style="background:var(--accent-soft);border-radius:12px;display:inline-block;align-self:flex-start">
                    <p class="mb-0" style="font-size:.75rem;color:var(--text-muted)">Harga mulai dari</p>
                    <p class="mb-0 fw-bold" style="font-size:1.75rem;color:var(--accent);line-height:1.2">
                        Rp {{ number_format($product->harga, 0, ',', '.') }}
                    </p>
                    <p class="mb-0" style="font-size:.72rem;color:var(--text-muted)">Belum termasuk ongkos kirim</p>
                </div>

                {{-- Specs --}}
                <div class="row g-2 mb-4">
                    <div class="col-6 col-sm-4">
                        <div class="p-3 text-center" style="background:var(--surface-alt);border-radius:12px;border:1px solid var(--border-color)">
                            <i class="bi bi-boxes d-block mb-1" style="color:var(--accent);font-size:1.1rem"></i>
                            <p class="mb-0 fw-semibold" style="font-size:.82rem">{{ $product->stok > 0 ? $product->stok.' unit' : '—' }}</p>
                            <p class="mb-0" style="font-size:.7rem;color:var(--text-muted)">Stok tersedia</p>
                        </div>
                    </div>
                    <div class="col-6 col-sm-4">
                        <div class="p-3 text-center" style="background:var(--surface-alt);border-radius:12px;border:1px solid var(--border-color)">
                            <i class="bi bi-shield-check d-block mb-1" style="color:var(--accent);font-size:1.1rem"></i>
                            <p class="mb-0 fw-semibold" style="font-size:.82rem">30 hari</p>
                            <p class="mb-0" style="font-size:.7rem;color:var(--text-muted)">Garansi produk</p>
                        </div>
                    </div>
                    <div class="col-6 col-sm-4">
                        <div class="p-3 text-center" style="background:var(--surface-alt);border-radius:12px;border:1px solid var(--border-color)">
                            <i class="bi bi-truck d-block mb-1" style="color:var(--accent);font-size:1.1rem"></i>
                            <p class="mb-0 fw-semibold" style="font-size:.82rem">Se-Indonesia</p>
                            <p class="mb-0" style="font-size:.7rem;color:var(--text-muted)">Pengiriman</p>
                        </div>
                    </div>
                </div>

                {{-- Description --}}
                @if ($product->deskripsi)
                    <div class="mb-4">
                        <h2 class="h6 fw-bold mb-2" style="color:var(--text-main)">Deskripsi Produk</h2>
                        <p style="font-size:.9rem;color:var(--text-muted);line-height:1.8;white-space:pre-wrap">{{ $product->deskripsi }}</p>
                    </div>
                @endif

                {{-- CTA --}}
                <div class="mt-auto vstack gap-2">
                    <a href="https://wa.me/{{ config('company.whatsapp') }}?text=Halo%20UD%20Jaya%20Mebel%2C%20saya%20ingin%20memesan%3A%0A*{{ urlencode($product->nama_produk) }}*%0AHarga%3A%20Rp%20{{ urlencode(number_format($product->harga,0,',','.')) }}%0A%0AMohon%20informasi%20lebih%20lanjut."
                       target="_blank"
                       class="btn-accent justify-content-center"
                       style="padding:.75rem 1rem;font-size:.95rem;border-radius:12px;font-weight:700">
                        <i class="bi bi-whatsapp"></i> Pesan via WhatsApp
                    </a>
                    <div class="d-flex gap-2">
                        <a href="tel:{{ config('company.phone') }}"
                           class="btn-outline-accent flex-grow-1 justify-content-center"
                           style="padding:.65rem 1rem;font-size:.9rem;border-radius:12px">
                            <i class="bi bi-telephone"></i> Telepon
                        </a>
                        <a href="mailto:{{ config('company.email') }}?subject=Pertanyaan%20Produk%3A%20{{ urlencode($product->nama_produk) }}"
                           class="btn-outline-accent flex-grow-1 justify-content-center"
                           style="padding:.65rem 1rem;font-size:.9rem;border-radius:12px">
                            <i class="bi bi-envelope"></i> Email
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- ── Related Products ── --}}
    @if ($related->isNotEmpty())
        <section class="mb-2">
            <div class="d-flex align-items-end justify-content-between mb-3 py-3 gap-2">
                <h2 class="h4 fw-bold mb-0">Mungkin Anda suka</h2>
                <a href="{{ route('landing') }}#catalogue" class="btn-outline-accent" style="padding:.4rem 1rem;font-size:.82rem">
                    Lihat semua &rarr;
                </a>
            </div>
            <div class="row g-3">
                @foreach ($related as $item)
                    <div class="col-6 col-lg-3">
                        <article class="product-card">
                            @if ($item->gambar)
                                <img src="{{ $item->gambar_url }}"
                                     alt="{{ $item->nama_produk }}" class="card-img">
                            @else
                                <img src="https://placehold.co/400x300/f1ede6/c07a36"
                                     alt="{{ $item->nama_produk }}" class="card-img">
                            @endif
                            <div class="card-body">
                                <h3 class="fw-semibold mb-1 text-truncate" style="font-size:.88rem">{{ $item->nama_produk }}</h3>
                                <p class="mb-2 flex-grow-1" style="font-size:.78rem;color:var(--text-muted);display:-webkit-box;-webkit-line-clamp:2;-webkit-box-orient:vertical;overflow:hidden">
                                    {{ $item->deskripsi ?? 'Produk furnitur berkualitas dari UD Jaya Mebel.' }}
                                </p>
                                <div class="d-flex align-items-center justify-content-between gap-2">
                                    <span class="fw-bold" style="color:var(--accent);font-size:.9rem">
                                        Rp {{ number_format($item->harga, 0, ',', '.') }}
                                    </span>
                                    @if ($item->total_terjual > 0)
                                        <span style="font-size:.7rem;color:var(--text-muted)">
                                            <i class="bi bi-fire"></i> {{ number_format($item->total_terjual) }}
                                        </span>
                                    @endif
                                </div>
                                <a href="{{ route('product.show', $item) }}"
                                   class="btn-accent mt-2 justify-content-center"
                                   style="padding:.45rem .8rem;font-size:.78rem;border-radius:8px;width:100%">
                                    <i class="bi bi-eye"></i> Lihat Detail
                                </a>
                            </div>
                        </article>
                    </div>
                @endforeach
            </div>
        </section>
    @endif

@endsection
