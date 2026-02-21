<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Dashboard\CashierController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Dashboard\ProductController;
use App\Http\Controllers\Dashboard\SaleController;
use App\Http\Controllers\Dashboard\SaleReportController;
use App\Http\Controllers\Dashboard\StockReportController;
use App\Http\Controllers\Landing\ProductController as LandingProductController;
use Illuminate\Support\Facades\Route;

Route::get('/health', fn () => response('OK', 200))->name('health');

Route::get('/', [LandingProductController::class, 'index'])->name('landing');
Route::get('/products/{product}', [LandingProductController::class, 'show'])->name('product.show');

Route::middleware('guest')->group(function (): void {
    Route::get('/login', [LoginController::class, 'create'])->name('login');
    Route::post('/login', [LoginController::class, 'store'])->name('login.attempt');
});

Route::post('/logout', [LoginController::class, 'destroy'])
    ->middleware('auth')
    ->name('logout');

Route::middleware('auth')
    ->prefix('dashboard')
    ->name('dashboard.')
    ->group(function (): void {
        Route::get('/', [DashboardController::class, 'index'])->name('index');

        Route::middleware('role:admin')->group(function (): void {
            Route::get('/cashiers', [CashierController::class, 'index'])->name('cashiers.index');
            Route::get('/cashiers/create', [CashierController::class, 'create'])->name('cashiers.create');
            Route::post('/cashiers', [CashierController::class, 'store'])->name('cashiers.store');
            Route::get('/cashiers/{cashier}/edit', [CashierController::class, 'edit'])->name('cashiers.edit');
            Route::put('/cashiers/{cashier}', [CashierController::class, 'update'])->name('cashiers.update');
            Route::delete('/cashiers/{cashier}', [CashierController::class, 'destroy'])->name('cashiers.destroy');
        });

        Route::middleware('role:kasir')->group(function (): void {
            Route::get('/sales', [SaleController::class, 'index'])->name('sales.index');
            Route::get('/sales/create', [SaleController::class, 'create'])->name('sales.create');
            Route::post('/sales', [SaleController::class, 'store'])->name('sales.store');
            Route::delete('/sales/{sale}', [SaleController::class, 'destroy'])->name('sales.destroy');

            Route::get('/products', [ProductController::class, 'index'])->name('products.index');
            Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');
            Route::post('/products', [ProductController::class, 'store'])->name('products.store');
            Route::get('/products/{product}/edit', [ProductController::class, 'edit'])->name('products.edit');
            Route::put('/products/{product}', [ProductController::class, 'update'])->name('products.update');
            Route::delete('/products/{product}', [ProductController::class, 'destroy'])->name('products.destroy');
        });

        Route::get('/reports/sales', [SaleReportController::class, 'index'])->name('reports.sales');
        Route::get('/reports/sales/print', [SaleReportController::class, 'print'])->name('reports.sales.print');
        Route::get('/reports/stock', [StockReportController::class, 'index'])->name('reports.stock');
        Route::get('/reports/stock/print', [StockReportController::class, 'print'])->name('reports.stock.print');
    });
