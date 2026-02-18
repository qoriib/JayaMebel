<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Sale;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class SaleReportController extends Controller
{
    public function index(Request $request): View
    {
        $query = $this->applyFilters($request);
        $totalRevenue = (clone $query)->sum('total_harga');
        $sales = $query->paginate(15)->withQueryString();

        return view('admin.reports.sales', [
            'sales' => $sales,
            'totalRevenue' => $totalRevenue,
            'filters' => $request->only(['from', 'to']),
        ]);
    }

    public function print(Request $request): View
    {
        $sales = $this->applyFilters($request)->get();

        return view('admin.reports.sales-print', [
            'sales' => $sales,
            'filters' => $request->only(['from', 'to']),
        ]);
    }

    private function applyFilters(Request $request): Builder
    {
        $from = $request->input('from');
        $to = $request->input('to');

        return Sale::query()
            ->with(['cashier', 'details.product'])
            ->when($from, fn ($query) => $query->whereDate('tanggal_penjualan', '>=', Carbon::parse($from)))
            ->when($to, fn ($query) => $query->whereDate('tanggal_penjualan', '<=', Carbon::parse($to)))
            ->orderByDesc('tanggal_penjualan');
    }
}
