<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class CashierDashboardController extends Controller
{
    public function index(Request $request): View
    {
        $cashier = $request->user();

        $totalSales = $cashier->sales()->count();
        $todayRevenue = $cashier->sales()
            ->whereDate('tanggal_penjualan', now()->toDateString())
            ->sum('total_harga');
        $latestSales = $cashier->sales()
            ->with('details.product')
            ->latest('tanggal_penjualan')
            ->limit(5)
            ->get();

        return view('dashboard.cashier', [
            'cashier' => $cashier,
            'totalSales' => $totalSales,
            'todayRevenue' => $todayRevenue,
            'latestSales' => $latestSales,
        ]);
    }
}
