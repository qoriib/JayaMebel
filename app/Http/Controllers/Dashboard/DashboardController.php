<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Sale;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request): View
    {
        $user = $request->user();

        if ($user->role === 'admin') {
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

        $totalSales = $user->sales()->count();
        $latestSales = $user->sales()
            ->with('details.product')
            ->latest('tanggal_penjualan')
            ->limit(5)
            ->get();

        return view('dashboard.cashier', [
            'cashier' => $user,
            'totalSales' => $totalSales,
            'latestSales' => $latestSales,
        ]);
    }
}
