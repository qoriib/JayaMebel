<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\SaleReportFilterRequest;
use App\Models\Sale;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Carbon;

class SaleReportController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'role:admin']);
    }

    public function index(SaleReportFilterRequest $request): View
    {
        $filters = $request->validated();
        $query = $this->applyFilters($filters);
        $totalRevenue = (clone $query)->sum('total_harga');
        $sales = $query->paginate(15)->withQueryString();

        return view('admin.reports.sales', [
            'sales' => $sales,
            'totalRevenue' => $totalRevenue,
            'filters' => $filters,
        ]);
    }

    public function print(SaleReportFilterRequest $request): View
    {
        $filters = $request->validated();
        $sales = $this->applyFilters($filters)->get();

        return view('admin.reports.sales-print', [
            'sales' => $sales,
            'filters' => $filters,
        ]);
    }

    /**
     * @param  array<string, mixed>  $filters
     */
    private function applyFilters(array $filters): Builder
    {
        $from = $filters['from'] ?? null;
        $to = $filters['to'] ?? null;

        return Sale::query()
            ->with(['cashier', 'details.product'])
            ->when($from, fn ($query) => $query->whereDate('tanggal_penjualan', '>=', Carbon::parse($from)))
            ->when($to, fn ($query) => $query->whereDate('tanggal_penjualan', '<=', Carbon::parse($to)))
            ->orderByDesc('tanggal_penjualan');
    }
}
