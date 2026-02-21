<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\StoreProductRequest;
use App\Http\Requests\Dashboard\UpdateProductRequest;
use App\Models\Product;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index(): View
    {
        $products = Product::query()
            ->orderBy('nama_produk')
            ->paginate(12);

        return view('dashboard.products.index', compact('products'));
    }

    public function create(): View
    {
        return view('dashboard.products.create');
    }

    public function store(StoreProductRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $gambarPath = null;

        if ($request->hasFile('gambar')) {
            $gambarPath = $request->file('gambar')->store('products', 'r2');
        }

        Product::query()->create([
            'nama_produk' => $data['nama_produk'],
            'deskripsi' => $data['deskripsi'] ?? null,
            'gambar' => $gambarPath,
            'harga' => $data['harga'],
            'stok' => $data['stok'],
            'stok_status' => $data['stok_status'],
        ]);

        return redirect()->route('dashboard.products.index')->with('success', 'Produk baru berhasil ditambahkan.');
    }

    public function edit(Product $product): View
    {
        return view('dashboard.products.edit', compact('product'));
    }

    public function update(UpdateProductRequest $request, Product $product): RedirectResponse
    {
        $data = $request->validated();
        $payload = [
            'nama_produk' => $data['nama_produk'],
            'deskripsi' => $data['deskripsi'] ?? null,
            'harga' => $data['harga'],
            'stok' => $data['stok'],
            'stok_status' => $data['stok_status'],
        ];

        if ($request->hasFile('gambar')) {
            if ($product->gambar) {
                Storage::disk('r2')->delete($product->gambar);
            }
            $payload['gambar'] = $request->file('gambar')->store('products', 'r2');
        }

        $product->update($payload);

        return redirect()->route('dashboard.products.index')->with('success', 'Data produk berhasil diperbarui.');
    }

    public function destroy(Product $product): RedirectResponse
    {
        if ($product->gambar) {
            Storage::disk('r2')->delete($product->gambar);
        }

        $product->delete();

        return redirect()->route('dashboard.products.index')->with('success', 'Produk berhasil dihapus.');
    }
}
