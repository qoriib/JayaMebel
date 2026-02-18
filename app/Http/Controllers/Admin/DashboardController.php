<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Sale;
use App\Models\User;
use Illuminate\Contracts\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        $totalCashiers = User::query()->where('role', 'kasir')->count();
        $totalProducts = Product::query()->count();
        $availableProducts = Product::query()->where('stok_status', 'tersedia')->count();
        $totalSales = Sale::query()->count();
        $todayRevenue = Sale::query()
            ->whereDate('tanggal_penjualan', now()->toDateString())
            ->sum('total_harga');
        $recentSales = Sale::query()
            ->with('cashier')
            ->latest('tanggal_penjualan')
            ->limit(5)
            ->get();

        return view('admin.dashboard', [
            'totalCashiers' => $totalCashiers,
            'totalProducts' => $totalProducts,
            'availableProducts' => $availableProducts,
            'totalSales' => $totalSales,
            'todayRevenue' => $todayRevenue,
            'recentSales' => $recentSales,
        ]);
    }
}
