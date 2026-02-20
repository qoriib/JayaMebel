<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Sale;
use App\Models\User;
use Illuminate\Contracts\View\View;

class AdminDashboardController extends Controller
{
    public function index(): View
    {
        $totalCashiers = User::query()->where('role', 'kasir')->count();
        $totalProducts = Product::query()->count();
        $availableProducts = Product::query()->where('stok_status', 'tersedia')->count();
        $totalSales = Sale::query()->count();
        $recentSales = Sale::query()
            ->with('cashier')
            ->latest('tanggal_penjualan')
            ->limit(5)
            ->get();

        return view('dashboard.admin', [
            'totalCashiers' => $totalCashiers,
            'totalProducts' => $totalProducts,
            'availableProducts' => $availableProducts,
            'totalSales' => $totalSales,
            'recentSales' => $recentSales,
        ]);
    }
}
