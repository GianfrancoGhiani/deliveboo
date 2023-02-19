<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\RestaurantController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\StatsController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth', 'verified'])->name('admin.')->prefix('admin')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])
        ->name('dashboard');
    Route::resource('products', ProductController::class)->parameters(['products' => 'product:slug']);
    Route::resource('restaurants', RestaurantController::class)->parameters(['restaurants' => 'restaurant:slug']);
    Route::resource('orders', OrderController::class)->parameters(['orders' => 'order:id']);
    Route::get('stats', [StatsController::class, 'index'])->name('stats');
});


// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });

require __DIR__ . '/auth.php';

Route::fallback(function () {
    return redirect()->route('admin.dashboard');
});