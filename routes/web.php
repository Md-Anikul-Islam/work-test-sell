<?php

use App\Http\Controllers\admin\AdminDashboardController;
use App\Http\Controllers\admin\CategoryController;
use App\Http\Controllers\admin\InvoiceController;
use App\Http\Controllers\admin\ItemController;
use App\Http\Controllers\admin\OrderController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

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
    return view('auth.login');
});


Route::middleware('auth')->group(callback: function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
    Route::get('/unauthorized-action', [AdminDashboardController::class, 'unauthorized'])->name('unauthorized.action');

    //Category Section
    Route::get('/category-section', [CategoryController::class, 'index'])->name('category.section');
    Route::post('/category-store', [CategoryController::class, 'store'])->name('category.store');
    Route::put('/category-update/{id}', [CategoryController::class, 'update'])->name('category.update');
    Route::get('/category-delete/{id}', [CategoryController::class, 'destroy'])->name('category.destroy');

    //Item Section

    Route::get('/item-section', [ItemController::class, 'index'])->name('item.section');
    Route::post('/item-store', [ItemController::class, 'store'])->name('item.store');
    Route::put('/item-update/{id}', [ItemController::class, 'update'])->name('item.update');
    Route::get('/item-delete/{id}', [ItemController::class, 'destroy'])->name('item.destroy');

    //Order Section
    Route::get('/order-manage', [ItemController::class, 'allOrder'])->name('order.manage');
    Route::get('/invoice/{id}', [InvoiceController::class, 'show'])->name('invoice.show');

    //Order Section
    Route::get('/order-list', [OrderController::class, 'index'])->name('order.list');
    Route::post('/order-store', [OrderController::class, 'store'])->name('order.store');

    //Role and User Section
    Route::resource('roles', RoleController::class);
    Route::resource('users', UserController::class);

});

require __DIR__.'/auth.php';
