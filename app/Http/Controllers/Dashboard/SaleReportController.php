<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\SaleReportFilterRequest;
use App\Models\Sale;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Carbon;

class SaleReportController extends Controller
{
    public function index(SaleReportFilterRequest $request): View
    {
        $filters = $request->validated();
        $query = $this->applyFilters($filters);
        $cashiers = User::query()->where('role', 'kasir')->orderBy('nama')->get();

        $totalRevenue = (clone $query)->sum('total_harga');
        $totalTransactions = (clone $query)->count();
        $averageOrder = $totalTransactions > 0 ? $totalRevenue / $totalTransactions : 0;

        $sales = $query->paginate(20)->withQueryString();

        return view('dashboard.reports.sales', [
            'sales' => $sales,
            'cashiers' => $cashiers,
            'totalRevenue' => $totalRevenue,
            'totalTransactions' => $totalTransactions,
            'averageOrder' => $averageOrder,
            'filters' => $filters,
        ]);
    }

    public function print(SaleReportFilterRequest $request): View
    {
        $filters = $request->validated();
        $query = $this->applyFilters($filters);

        $totalRevenue = (clone $query)->sum('total_harga');
        $totalTransactions = (clone $query)->count();
        $sales = $query->get();

        return view('dashboard.reports.sales-print', [
            'sales' => $sales,
            'filters' => $filters,
            'totalRevenue' => $totalRevenue,
            'totalTransactions' => $totalTransactions,
        ]);
    }

    /**
     * @param  array<string, mixed>  $filters
     */
    private function applyFilters(array $filters): Builder
    {
        $from = $filters['from'] ?? null;
        $to = $filters['to'] ?? null;
        $cashierId = $filters['cashier_id'] ?? null;

        return Sale::query()
            ->with(['cashier', 'details.product'])
            ->when($from, fn ($q) => $q->whereDate('tanggal_penjualan', '>=', Carbon::parse($from)))
            ->when($to, fn ($q) => $q->whereDate('tanggal_penjualan', '<=', Carbon::parse($to)))
            ->when($cashierId, fn ($q) => $q->where('user_id', $cashierId))
            ->orderByDesc('tanggal_penjualan');
    }
}
