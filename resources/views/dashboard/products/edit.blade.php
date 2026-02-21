@extends('layouts.dashboard')

@section('title', 'Edit Produk | UD Jaya Mebel')
@section('page-title', 'Edit Produk')

@section('content')
    <div class="row justify-content-center">
        <div class="col-12 col-lg-8">
            <div class="glass-panel p-4">
                <form action="{{ route('cashier.products.update', $product) }}" method="POST" enctype="multipart/form-data" class="vstack gap-4">
                    @csrf
                    @method('PUT')

                    <div>
                        <label for="nama_produk" class="form-label fw-semibold">Nama Produk</label>
                        <input type="text" id="nama_produk" name="nama_produk"
                               value="{{ old('nama_produk', $product->nama_produk) }}"
                               class="form-control @error('nama_produk') is-invalid @enderror"
                               placeholder="Nama produk" required autofocus>
                        @error('nama_produk')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div>
                        <label for="deskripsi" class="form-label fw-semibold">Deskripsi <span class="text-muted fw-normal">(opsional)</span></label>
                        <textarea id="deskripsi" name="deskripsi" rows="3"
                                  class="form-control @error('deskripsi') is-invalid @enderror"
                                  placeholder="Deskripsi produk...">{{ old('deskripsi', $product->deskripsi) }}</textarea>
                        @error('deskripsi')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div style="background:var(--surface-alt);border:1px solid var(--border-color);border-radius:12px;padding:1.25rem">
                        <p class="text-muted mb-3" style="font-size:.78rem;font-weight:600;text-transform:uppercase;letter-spacing:.05em">
                            <i class="bi bi-image me-1"></i> Foto Produk
                        </p>
                        @if ($product->gambar)
                            <div class="mb-3 d-flex align-items-center gap-3">
                                <img src="{{ Storage::url($product->gambar) }}" alt="{{ $product->nama_produk }}"
                                     style="width:80px;height:80px;object-fit:cover;border-radius:10px;border:1px solid var(--border-color)">
                                <div>
                                    <p class="mb-0 fw-semibold" style="font-size:.85rem">Foto saat ini</p>
                                    <div class="form-text">Upload foto baru untuk menggantinya.</div>
                                </div>
                            </div>
                        @endif
                        <div>
                            <input type="file" id="gambar" name="gambar" accept="image/jpg,image/jpeg,image/png,image/webp"
                                   class="form-control @error('gambar') is-invalid @enderror">
                            @error('gambar')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <div class="form-text">Format JPG, PNG, atau WebP. Maks. 2 MB. Kosongkan jika tidak ingin mengubah foto.</div>
                        </div>
                    </div>

                    <div class="row g-3">
                        <div class="col-sm-6">
                            <label for="harga" class="form-label fw-semibold">Harga (Rp)</label>
                            <input type="number" id="harga" name="harga"
                                   value="{{ old('harga', $product->harga) }}"
                                   class="form-control @error('harga') is-invalid @enderror"
                                   placeholder="0" min="0" step="1000" required>
                            @error('harga')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-sm-6">
                            <label for="stok" class="form-label fw-semibold">Jumlah Stok</label>
                            <input type="number" id="stok" name="stok"
                                   value="{{ old('stok', $product->stok) }}"
                                   class="form-control @error('stok') is-invalid @enderror"
                                   placeholder="0" min="0" required>
                            @error('stok')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div>
                        <label for="stok_status" class="form-label fw-semibold">Status Ketersediaan</label>
                        <select id="stok_status" name="stok_status"
                                class="form-select @error('stok_status') is-invalid @enderror" required>
                            <option value="tersedia" @selected(old('stok_status', $product->stok_status) === 'tersedia')>Tersedia</option>
                            <option value="tidak" @selected(old('stok_status', $product->stok_status) === 'tidak')>Tidak Tersedia</option>
                        </select>
                        @error('stok_status')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-flex gap-2 pt-2">
                        <button type="submit" class="btn btn-primary flex-grow-1">
                            <i class="bi bi-check-lg me-1"></i> Simpan Perubahan
                        </button>
                        <a href="{{ route('cashier.products.index') }}" class="btn btn-outline-danger">Batal</a>
                    </div>
                </form>
            </div>

        </div>
    </div>
@endsection
