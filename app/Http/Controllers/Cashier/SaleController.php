<?php

namespace App\Http\Controllers\Cashier;

use App\Http\Controllers\Controller;
use App\Http\Requests\Cashier\StoreSaleRequest;
use App\Models\Product;
use App\Models\Sale;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class SaleController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'role:kasir']);
    }

    public function index(Request $request): View
    {
        $sales = $request->user()
            ->sales()
            ->with('details.product')
            ->latest('tanggal_penjualan')
            ->paginate(15);

        $totalTransactions = $request->user()->sales()->count();
        $todayRevenue = $request->user()->sales()
            ->whereDate('tanggal_penjualan', today())
            ->sum('total_harga');

        return view('cashier.sales.index', compact('sales', 'totalTransactions', 'todayRevenue'));
    }

    public function create(): View
    {
        $products = Product::query()
            ->where('stok_status', 'tersedia')
            ->orderBy('nama_produk')
            ->get();

        return view('cashier.sales.create', compact('products'));
    }

    public function store(StoreSaleRequest $request): RedirectResponse
    {
        $cashier = $request->user();
        $data = $request->validated();
        $items = collect($data['items']);

        DB::transaction(function () use ($cashier, $items, $data): void {
            $sale = $cashier->sales()->create([
                'total_harga' => 0,
                'tanggal_penjualan' => Carbon::parse($data['tanggal_penjualan']),
            ]);

            $grandTotal = 0;

            foreach ($items as $item) {
                $product = Product::query()->lockForUpdate()->find($item['product_id']);

                if ($product === null) {
                    throw ValidationException::withMessages([
                        'items' => ['Produk tidak ditemukan.'],
                    ]);
                }

                if ($product->stok < $item['jumlah']) {
                    throw ValidationException::withMessages([
                        'items' => [sprintf('Stok %s tidak mencukupi.', $product->nama_produk)],
                    ]);
                }

                $subtotal = $product->harga * $item['jumlah'];
                $grandTotal += $subtotal;

                $sale->details()->create([
                    'product_id' => $product->id,
                    'jumlah' => $item['jumlah'],
                    'subtotal' => $subtotal,
                ]);

                $newStock = $product->stok - $item['jumlah'];
                $product->update([
                    'stok' => $newStock,
                    'stok_status' => $newStock > 0 ? 'tersedia' : 'tidak',
                ]);
            }

            $sale->update(['total_harga' => $grandTotal]);
        });

        return redirect()
            ->route('cashier.sales.index')
            ->with('success', 'Transaksi penjualan berhasil dicatat.');
    }

    public function destroy(Request $request, Sale $sale): RedirectResponse
    {
        if ($sale->user_id !== $request->user()->id) {
            abort(403);
        }

        DB::transaction(function () use ($sale): void {
            foreach ($sale->details as $detail) {
                if ($detail->product) {
                    $restoredStock = $detail->product->stok + $detail->jumlah;
                    $detail->product->update([
                        'stok' => $restoredStock,
                        'stok_status' => 'tersedia',
                    ]);
                }
            }
            $sale->delete();
        });

        return redirect()
            ->route('cashier.sales.index')
            ->with('success', 'Transaksi berhasil dihapus dan stok dipulihkan.');
    }
}
