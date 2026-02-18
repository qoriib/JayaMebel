@extends('layouts.app')

@section('title', 'Transaksi Kasir | UD Jaya Mebel')

@section('content')
    <div class="row g-4">
        <div class="col-12 col-lg-5">
            <section class="glass-panel p-4 h-100">
                <h1 class="h5 fw-semibold mb-3">Catat Penjualan</h1>
                <form action="{{ route('cashier.sales.store') }}" method="POST" class="vstack gap-3">
                    @csrf
                    <div>
                        <label for="tanggal_penjualan" class="form-label">Tanggal & Waktu</label>
                        <input type="datetime-local" id="tanggal_penjualan" name="tanggal_penjualan" class="form-control" value="{{ now()->format('Y-m-d\TH:i') }}" required>
                    </div>
                    @for ($i = 0; $i < 3; $i++)
                        <div class="border rounded-4 border-secondary-subtle p-3">
                            <p class="text-muted small mb-3">Item #{{ $i + 1 }}</p>
                            <div class="mb-3">
                                <label class="form-label" for="product-{{ $i }}">Produk</label>
                                <select id="product-{{ $i }}" name="items[{{ $i }}][product_id]" class="form-select">
                                    <option value="">Pilih produk</option>
                                    @foreach ($products as $product)
                                        <option value="{{ $product->id }}">{{ $product->nama_produk }} (Stok: {{ $product->stok }})</option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <label class="form-label" for="qty-{{ $i }}">Jumlah</label>
                                <input type="number" id="qty-{{ $i }}" name="items[{{ $i }}][jumlah]" class="form-control" min="1" placeholder="0">
                            </div>
                        </div>
                    @endfor
                    <p class="small text-muted">Kosongkan item yang tidak digunakan. Tambahkan sisanya nanti setelah transaksi tersimpan.</p>
                    <button type="submit" class="btn btn-warning text-dark fw-semibold">Simpan Transaksi</button>
                </form>
            </section>
        </div>
        <div class="col-12 col-lg-7">
            <section class="glass-panel p-4">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <div>
                        <p class="accent-chip mb-2"><span aria-hidden="true">🗂️</span> Arsip Transaksi</p>
                        <h2 class="h5 mb-0">Riwayat Penjualan</h2>
                    </div>
                    <span class="text-muted">{{ $sales->total() }} catatan</span>
                </div>
                <div class="table-responsive">
                    <table class="table table-dark table-dark-custom align-middle">
                        <thead>
                            <tr>
                                <th>Tanggal</th>
                                <th>Total Item</th>
                                <th>Total Harga</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($sales as $sale)
                                <tr>
                                    <td>{{ $sale->tanggal_penjualan->format('d M Y H:i') }}</td>
                                    <td>{{ $sale->details->sum('jumlah') }} item</td>
                                    <td class="text-warning">Rp {{ number_format($sale->total_harga, 0, ',', '.') }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="text-center text-muted">Belum ada transaksi.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="mt-3">
                    {{ $sales->links() }}
                </div>
            </section>
        </div>
    </div>
@endsection
