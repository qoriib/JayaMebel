<?php

namespace App\Http\Controllers\Landing;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Contracts\View\View;

class ProductController extends Controller
{
    public function index(): View
    {
        $products = Product::query()
            ->where('stok_status', 'tersedia')
            ->orderBy('nama_produk')
            ->get();

        return view('public.products', compact('products'));
    }
}
