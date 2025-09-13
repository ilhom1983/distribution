<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\OrdersController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

// Admin Routes
Route::prefix('admin')->name('admin.')->middleware(['auth', 'role:admin'])->group(function () {
    
    // Dashboard
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('dashboard');
    
    // Orders Management
    Route::prefix('orders')->name('orders.')->group(function () {
        Route::get('/', [OrdersController::class, 'index'])->name('index');
        Route::get('/{order}', [OrdersController::class, 'show'])->name('show');
        Route::patch('/{order}/status', [OrdersController::class, 'updateStatus'])->name('update-status');
        Route::patch('/{order}/payment-status', [OrdersController::class, 'updatePaymentStatus'])->name('update-payment-status');
    });
    
});

// Auth routes (assuming you have authentication)
require __DIR__.'/auth.php';