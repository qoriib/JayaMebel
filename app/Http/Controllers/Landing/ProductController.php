<?php

namespace App\Http\Controllers\Landing;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Sale;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request): View
    {
        $search = trim((string) $request->query('search', ''));
        $minPrice = $request->filled('min_price') ? (int) $request->query('min_price') : null;
        $maxPrice = $request->filled('max_price') ? (int) $request->query('max_price') : null;
        $sort = $request->query('sort', 'latest');

        $productsQuery = Product::query()
            ->where('stok_status', 'tersedia')
            ->withCount('saleDetails as total_terjual');

        if ($search !== '') {
            $productsQuery->where(function ($query) use ($search): void {
                $query->where('nama_produk', 'like', "%{$search}%")
                    ->orWhere('deskripsi', 'like', "%{$search}%");
            });
        }

        if ($minPrice !== null) {
            $productsQuery->where('harga', '>=', $minPrice);
        }

        if ($maxPrice !== null) {
            $productsQuery->where('harga', '<=', $maxPrice);
        }

        switch ($sort) {
            case 'popular':
                $productsQuery->orderByDesc('total_terjual');
                break;
            case 'price_low':
                $productsQuery->orderBy('harga');
                break;
            case 'price_high':
                $productsQuery->orderByDesc('harga');
                break;
            default:
                $productsQuery->latest();
        }

        $products = $productsQuery
            ->paginate(9)
            ->withQueryString();

        $bestSellers = Product::query()
            ->withCount('saleDetails as total_terjual')
            ->orderByDesc('total_terjual')
            ->limit(3)
            ->get();

        $newArrivals = Product::query()
            ->where('stok_status', 'tersedia')
            ->latest()
            ->limit(4)
            ->get();

        $priceRange = [
            'min' => (int) (Product::query()->min('harga') ?? 0),
            'max' => (int) (Product::query()->max('harga') ?? 0),
        ];

        $totalOrders = Sale::query()->count();
        $recentOrders = Sale::query()
            ->whereDate('created_at', '>=', now()->subDays(30))
            ->count();

        return view('public.products', [
            'products' => $products,
            'bestSellers' => $bestSellers,
            'newArrivals' => $newArrivals,
            'priceRange' => $priceRange,
            'filters' => [
                'search' => $search,
                'min_price' => $minPrice,
                'max_price' => $maxPrice,
                'sort' => $sort,
            ],
            'stats' => [
                'ready_products' => Product::query()->where('stok_status', 'tersedia')->count(),
                'orders_served' => $totalOrders,
                'custom_requests' => $recentOrders,
            ],
        ]);
    }
}
