<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\StockReportFilterRequest;
use App\Models\Product;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Builder;

class StockReportController extends Controller
{
    public function index(StockReportFilterRequest $request): View
    {
        $filters = $request->validated();
        $query = $this->applyFilters($filters);

        $totalProducts = (clone $query)->count();
        $totalStock = (clone $query)->sum('stok');
        $availableProducts = (clone $query)->where('stok_status', 'tersedia')->count();
        $outOfStockProducts = (clone $query)->where('stok_status', 'tidak')->count();

        $products = $query->paginate(20)->withQueryString();

        return view('dashboard.reports.stock', [
            'products' => $products,
            'filters' => $filters,
            'totalProducts' => $totalProducts,
            'totalStock' => $totalStock,
            'availableProducts' => $availableProducts,
            'outOfStockProducts' => $outOfStockProducts,
        ]);
    }

    public function print(StockReportFilterRequest $request): View
    {
        $filters = $request->validated();
        $query = $this->applyFilters($filters);

        $totalProducts = (clone $query)->count();
        $totalStock = (clone $query)->sum('stok');
        $availableProducts = (clone $query)->where('stok_status', 'tersedia')->count();
        $outOfStockProducts = (clone $query)->where('stok_status', 'tidak')->count();

        $products = $query->get();

        return view('dashboard.reports.stock-print', [
            'products' => $products,
            'filters' => $filters,
            'totalProducts' => $totalProducts,
            'totalStock' => $totalStock,
            'availableProducts' => $availableProducts,
            'outOfStockProducts' => $outOfStockProducts,
        ]);
    }

    /**
     * @param  array<string, mixed>  $filters
     */
    private function applyFilters(array $filters): Builder
    {
        return Product::query()
            ->orderBy('nama_produk')
            ->when(
                ! empty($filters['search']),
                fn ($q) => $q->where('nama_produk', 'like', '%'.$filters['search'].'%')
            )
            ->when(
                ! empty($filters['stok_status']),
                fn ($q) => $q->where('stok_status', $filters['stok_status'])
            )
            ->when(
                isset($filters['stok_min']) && $filters['stok_min'] !== null,
                fn ($q) => $q->where('stok', '>=', $filters['stok_min'])
            )
            ->when(
                isset($filters['stok_max']) && $filters['stok_max'] !== null,
                fn ($q) => $q->where('stok', '<=', $filters['stok_max'])
            );
    }
}
