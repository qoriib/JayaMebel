@extends('layouts.dashboard')

@section('title', 'Tambah Produk')

@section('content')
    <div class="row justify-content-center">
        <div class="col-12 col-lg-8">
            <div class="glass-panel p-4">
                <form action="{{ route('dashboard.products.store') }}" method="POST" enctype="multipart/form-data" class="vstack gap-4">
                    @csrf

                    <div>
                        <label for="nama_produk" class="form-label fw-semibold">Nama Produk</label>
                        <input type="text" id="nama_produk" name="nama_produk" value="{{ old('nama_produk') }}"
                               class="form-control @error('nama_produk') is-invalid @enderror"
                               placeholder="Contoh: Kursi Minimalis Kayu Jati" required autofocus>
                        @error('nama_produk')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div>
                        <label for="deskripsi" class="form-label fw-semibold">Deskripsi <span class="text-muted fw-normal">(opsional)</span></label>
                        <textarea id="deskripsi" name="deskripsi" rows="3"
                                  class="form-control @error('deskripsi') is-invalid @enderror"
                                  placeholder="Jelaskan jenis bahan, ukuran, dan keunggulan produk...">{{ old('deskripsi') }}</textarea>
                        @error('deskripsi')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div>
                        <label for="gambar" class="form-label fw-semibold">Foto Produk <span class="text-muted fw-normal">(opsional)</span></label>
                        <input type="file" id="gambar" name="gambar" accept="image/jpg,image/jpeg,image/png,image/webp"
                               class="form-control @error('gambar') is-invalid @enderror">
                        @error('gambar')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <div class="form-text">Format JPG, PNG, atau WebP. Maks. 2 MB.</div>
                    </div>

                    <div class="row g-3">
                        <div class="col-sm-6">
                            <label for="harga" class="form-label fw-semibold">Harga (Rp)</label>
                            <input type="number" id="harga" name="harga" value="{{ old('harga') }}"
                                   class="form-control @error('harga') is-invalid @enderror"
                                   placeholder="0" min="0" step="1000" required>
                            @error('harga')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-sm-6">
                            <label for="stok" class="form-label fw-semibold">Jumlah Stok</label>
                            <input type="number" id="stok" name="stok" value="{{ old('stok', 0) }}"
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
                            <option value="tersedia" @selected(old('stok_status', 'tersedia') === 'tersedia')>Tersedia</option>
                            <option value="tidak" @selected(old('stok_status') === 'tidak')>Tidak Tersedia</option>
                        </select>
                        @error('stok_status')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-flex gap-2 pt-2">
                        <button type="submit" class="btn btn-primary flex-grow-1">
                            <i class="bi bi-box-seam me-1"></i> Simpan Produk
                        </button>
                        <a href="{{ route('dashboard.products.index') }}" class="btn btn-outline-danger">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
