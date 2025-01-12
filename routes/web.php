<?php

use App\Http\Controllers\ProductController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');
    Route::get('/products', [ProductController::class, 'index'])->name('list_products');
    Route::get('/products/create', [ProductController::class, 'create'])->name('create_product_form');
    Route::post('/products/{product}', [ProductController::class, 'store'])->name('create_product');
    Route::get('/products/{product}', [ProductController::class, 'show'])->name('get_product');
    Route::get('/products/{product}/update', [ProductController::class, 'create'])->name('update_product_form');
    Route::put('/products/{product}', [ProductController::class, 'update'])->name('update_product');
    Route::delete('/products/{product}', [ProductController::class, 'destroy'])->name('update_product');
});
