@extends('layouts.dashboard')

@section('title', 'Catat Penjualan | UD Jaya Mebel')
@section('page-title', 'Catat Penjualan')

@section('content')
    @if ($errors->any())
        <div class="alert alert-danger alert-dismissible mb-4" role="alert"
             style="border-radius:10px;border:none;background:#fee2e2;color:#991b1b">
            <i class="bi bi-exclamation-triangle me-2"></i>
            <strong>Periksa kembali isian di bawah:</strong>
            <ul class="mb-0 mt-1 ps-3">
                @foreach ($errors->all() as $err)
                    <li style="font-size:.875rem">{{ $err }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="row g-4">
        {{-- Form --}}
        <div class="col-12 col-xl-7">
            <div class="glass-panel p-4">
                <form id="sale-form" action="{{ route('dashboard.sales.store') }}" method="POST">
                    @csrf

                    <div class="mb-4">
                        <label for="tanggal_penjualan" class="form-label fw-semibold">Tanggal & Waktu Transaksi</label>
                        <input type="datetime-local" id="tanggal_penjualan" name="tanggal_penjualan"
                               class="form-control @error('tanggal_penjualan') is-invalid @enderror"
                               value="{{ old('tanggal_penjualan', now()->format('Y-m-d\TH:i')) }}" required>
                        @error('tanggal_penjualan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <div class="d-flex align-items-center justify-content-between mb-2">
                            <label class="form-label fw-semibold mb-0">Daftar Produk Terjual</label>
                            <button type="button" id="btn-add-item" class="btn btn-primary-custom">
                                <i class="bi bi-plus-lg"></i> Tambah Item
                            </button>
                        </div>

                        <div id="items-container" class="vstack gap-3">
                            {{-- Item slot filled via JS template; initial slot rendered here --}}
                            <div class="item-row" data-index="0" style="background:var(--surface-alt);border:1px solid var(--border-color);border-radius:12px;padding:1rem">
                                <div class="d-flex align-items-center justify-content-between mb-2">
                                    <span class="fw-semibold item-label" style="font-size:.85rem;color:var(--text-muted)">Item #1</span>
                                    <button type="button" class="btn-remove-item btn btn-sm btn-outline-danger d-none"
                                            style="border-radius:6px;font-size:.75rem;padding:.15rem .5rem">
                                        <i class="bi bi-x-lg"></i>
                                    </button>
                                </div>
                                <div class="row g-2">
                                    <div class="col-12 col-sm-7">
                                        <label class="form-label" style="font-size:.8rem">Produk</label>
                                        <select name="items[0][product_id]" class="form-select form-select-sm product-select" required>
                                            <option value="">Pilih produk...</option>
                                            @foreach ($products as $product)
                                                <option value="{{ $product->id }}"
                                                        data-harga="{{ $product->harga }}"
                                                        data-stok="{{ $product->stok }}">
                                                    {{ $product->nama_produk }} (Stok: {{ $product->stok }})
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-6 col-sm-2">
                                        <label class="form-label" style="font-size:.8rem">Qty</label>
                                        <input type="number" name="items[0][jumlah]"
                                               class="form-control form-control-sm qty-input"
                                               min="1" placeholder="0" required>
                                    </div>
                                    <div class="col-6 col-sm-3">
                                        <label class="form-label" style="font-size:.8rem">Subtotal</label>
                                        <div class="form-control form-control-sm subtotal-display"
                                             style="background:#f8f7f4;font-size:.8rem;color:var(--accent);font-weight:600">
                                            Rp 0
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Grand total --}}
                    <div class="d-flex align-items-center justify-content-between py-3 px-1"
                         style="border-top:2px solid var(--border-color)">
                        <span class="fw-semibold" style="font-size:.95rem">Total Keseluruhan</span>
                        <span id="grand-total" class="fw-bold money" style="font-size:1.2rem">Rp 0</span>
                    </div>

                    <div class="d-flex gap-2 pt-2">
                        <button type="submit" class="btn btn-primary flex-grow-1">
                            <i class="bi bi-check-lg me-1"></i> Simpan Transaksi
                        </button>
                        <a href="{{ route('dashboard.sales.index') }}" class="btn btn-outline-danger">Batal</a>
                    </div>
                </form>
            </div>
        </div>

        {{-- Product reference panel --}}
        <div class="col-12 col-xl-5">
            <div class="glass-panel p-4">
                <h2 class="h5 fw-bold mb-1">Referensi Produk</h2>
                <p class="text-muted mb-3" style="font-size:.8rem">Stok dan harga produk tersedia</p>
                <div class="table-responsive">
                    <table class="table table-sm table-custom align-middle mb-0" style="font-size:.82rem">
                        <thead>
                            <tr>
                                <th>Nama</th>
                                <th class="text-center">Stok</th>
                                <th class="text-end">Harga</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($products as $product)
                                <tr>
                                    <td>{{ $product->nama_produk }}</td>
                                    <td class="text-center">
                                        @if ($product->stok > 5)
                                            <span class="badge-success">{{ $product->stok }}</span>
                                        @elseif ($product->stok > 0)
                                            <span style="background:#fff3cd;color:#856404;border-radius:6px;padding:.15rem .5rem;font-size:.75rem;font-weight:600">{{ $product->stok }}</span>
                                        @else
                                            <span class="badge-danger">Habis</span>
                                        @endif
                                    </td>
                                    <td class="text-end money">Rp {{ number_format($product->harga, 0, ',', '.') }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="text-center text-muted py-3">Tidak ada produk tersedia.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script>
    (function () {
        const container   = document.getElementById('items-container');
        const btnAdd      = document.getElementById('btn-add-item');
        const grandTotalEl = document.getElementById('grand-total');

        // Product data map: id → harga
        const productData = {
            @foreach ($products as $p)
            {{ $p->id }}: { harga: {{ (float) $p->harga }}, stok: {{ $p->stok }} },
            @endforeach
        };

        function formatRp(val) {
            return 'Rp ' + Math.round(val).toLocaleString('id-ID');
        }

        function updateSubtotal(row) {
            const sel  = row.querySelector('.product-select');
            const qty  = row.querySelector('.qty-input');
            const disp = row.querySelector('.subtotal-display');
            const id   = parseInt(sel.value);
            const q    = parseInt(qty.value) || 0;
            if (id && productData[id]) {
                disp.textContent = formatRp(productData[id].harga * q);
            } else {
                disp.textContent = 'Rp 0';
            }
            updateGrandTotal();
        }

        function updateGrandTotal() {
            let total = 0;
            document.querySelectorAll('.item-row').forEach(row => {
                const sel = row.querySelector('.product-select');
                const qty = row.querySelector('.qty-input');
                const id  = parseInt(sel.value);
                const q   = parseInt(qty.value) || 0;
                if (id && productData[id]) total += productData[id].harga * q;
            });
            grandTotalEl.textContent = formatRp(total);
        }

        function reindex() {
            document.querySelectorAll('.item-row').forEach((row, i) => {
                row.dataset.index = i;
                row.querySelector('.item-label').textContent = 'Item #' + (i + 1);
                row.querySelector('.product-select').name = 'items[' + i + '][product_id]';
                row.querySelector('.qty-input').name = 'items[' + i + '][jumlah]';
                // Show remove only if more than 1 item
                const btn = row.querySelector('.btn-remove-item');
                btn.classList.toggle('d-none', document.querySelectorAll('.item-row').length <= 1);
            });
        }

        function addRow() {
            const template = document.querySelector('.item-row');
            const clone    = template.cloneNode(true);
            clone.querySelector('.product-select').value = '';
            clone.querySelector('.qty-input').value = '';
            clone.querySelector('.subtotal-display').textContent = 'Rp 0';
            clone.querySelector('.btn-remove-item').classList.remove('d-none');
            attachListeners(clone);
            container.appendChild(clone);
            reindex();
        }

        function attachListeners(row) {
            row.querySelector('.product-select').addEventListener('change', () => updateSubtotal(row));
            row.querySelector('.qty-input').addEventListener('input', () => updateSubtotal(row));
            row.querySelector('.btn-remove-item').addEventListener('click', () => {
                if (document.querySelectorAll('.item-row').length > 1) {
                    row.remove();
                    reindex();
                    updateGrandTotal();
                }
            });
        }

        // Attach to initial row
        attachListeners(document.querySelector('.item-row'));

        btnAdd.addEventListener('click', addRow);
    })();
    </script>
@endsection