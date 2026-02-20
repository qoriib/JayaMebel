<?php

use App\Http\Controllers\Admin\CashierController as AdminCashierController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Http\Controllers\Admin\SaleReportController as AdminSaleReportController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Cashier\DashboardController as CashierDashboardController;
use App\Http\Controllers\Cashier\SaleController as CashierSaleController;
use App\Http\Controllers\Landing\ProductController as LandingProductController;
use Illuminate\Support\Facades\Route;

Route::get('/', [LandingProductController::class, 'index'])->name('landing');

Route::middleware('guest')->group(function (): void {
    Route::get('/login', [LoginController::class, 'create'])->name('login');
    Route::post('/login', [LoginController::class, 'store'])->name('login.attempt');
});

Route::post('/logout', [LoginController::class, 'destroy'])
    ->middleware('auth')
    ->name('logout');

Route::middleware(['auth', 'role:admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function (): void {
        Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

        Route::get('/cashiers', [AdminCashierController::class, 'index'])->name('cashiers.index');
        Route::get('/cashiers/create', [AdminCashierController::class, 'create'])->name('cashiers.create');
        Route::post('/cashiers', [AdminCashierController::class, 'store'])->name('cashiers.store');
        Route::get('/cashiers/{cashier}/edit', [AdminCashierController::class, 'edit'])->name('cashiers.edit');
        Route::put('/cashiers/{cashier}', [AdminCashierController::class, 'update'])->name('cashiers.update');
        Route::delete('/cashiers/{cashier}', [AdminCashierController::class, 'destroy'])->name('cashiers.destroy');

        Route::get('/products', [AdminProductController::class, 'index'])->name('products.index');
        Route::get('/products/create', [AdminProductController::class, 'create'])->name('products.create');
        Route::post('/products', [AdminProductController::class, 'store'])->name('products.store');
        Route::get('/products/{product}/edit', [AdminProductController::class, 'edit'])->name('products.edit');
        Route::put('/products/{product}', [AdminProductController::class, 'update'])->name('products.update');
        Route::delete('/products/{product}', [AdminProductController::class, 'destroy'])->name('products.destroy');

        Route::get('/reports/sales', [AdminSaleReportController::class, 'index'])->name('reports.sales');
        Route::get('/reports/sales/print', [AdminSaleReportController::class, 'print'])->name('reports.sales.print');
    });

Route::middleware(['auth', 'role:kasir'])
    ->prefix('kasir')
    ->name('cashier.')
    ->group(function (): void {
        Route::get('/dashboard', [CashierDashboardController::class, 'index'])->name('dashboard');
        Route::get('/sales', [CashierSaleController::class, 'index'])->name('sales.index');
        Route::get('/sales/create', [CashierSaleController::class, 'create'])->name('sales.create');
        Route::post('/sales', [CashierSaleController::class, 'store'])->name('sales.store');
        Route::delete('/sales/{sale}', [CashierSaleController::class, 'destroy'])->name('sales.destroy');
    });
