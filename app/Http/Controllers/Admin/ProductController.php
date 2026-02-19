<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UpdateProductStockRequest;
use App\Models\Product;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'role:admin']);
    }

    public function index(): View
    {
        $products = Product::query()->orderBy('nama_produk')->paginate(12);

        return view('admin.products.index', compact('products'));
    }

    public function updateStatus(UpdateProductStockRequest $request, Product $product): RedirectResponse
    {
        $data = $request->validated();

        $product->update([
            'stok_status' => $data['stok_status'],
            'stok' => $data['stok'] ?? $product->stok,
        ]);

        return back()->with('success', 'Status stok produk diperbarui.');
    }
}
