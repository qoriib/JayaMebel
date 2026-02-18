<?php

use App\Http\Controllers\Admin\CashierController as AdminCashierController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Http\Controllers\Admin\SaleReportController as AdminSaleReportController;
use App\Http\Controllers\Cashier\DashboardController as CashierDashboardController;
use App\Http\Controllers\Cashier\SaleController as CashierSaleController;
use App\Http\Controllers\Landing\ProductController as LandingProductController;
use Illuminate\Support\Facades\Route;

Route::get('/', [LandingProductController::class, 'index'])->name('landing');

Route::middleware(['auth', 'role:admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function (): void {
        Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

        Route::get('/cashiers', [AdminCashierController::class, 'index'])->name('cashiers.index');
        Route::post('/cashiers', [AdminCashierController::class, 'store'])->name('cashiers.store');
        Route::put('/cashiers/{cashier}', [AdminCashierController::class, 'update'])->name('cashiers.update');
        Route::delete('/cashiers/{cashier}', [AdminCashierController::class, 'destroy'])->name('cashiers.destroy');

        Route::get('/products', [AdminProductController::class, 'index'])->name('products.index');
        Route::patch('/products/{product}/status', [AdminProductController::class, 'updateStatus'])->name('products.update-status');

        Route::get('/reports/sales', [AdminSaleReportController::class, 'index'])->name('reports.sales');
        Route::get('/reports/sales/print', [AdminSaleReportController::class, 'print'])->name('reports.sales.print');
    });

Route::middleware(['auth', 'role:kasir'])
    ->prefix('kasir')
    ->name('cashier.')
    ->group(function (): void {
        Route::get('/dashboard', [CashierDashboardController::class, 'index'])->name('dashboard');
        Route::get('/sales', [CashierSaleController::class, 'index'])->name('sales.index');
        Route::post('/sales', [CashierSaleController::class, 'store'])->name('sales.store');
    });
