<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

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
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

Route::controller(\App\Http\Controllers\ProductController::class)->group(function (){
    Route::get('', 'index')->name('home');
    Route::get('/products/{slug}', 'show')->name('products.show')->where('slug', '[A-Za-z0-9-]+');


    Route::prefix('admin')->name('products.')->group(function (){
        Route::get('/products/create', 'create')->name('create');
        Route::post('/products', 'store')->name('store');
        Route::get('/products/{id}/edit', 'edit')->name('edit')->where('id', '[0-9-]+');
        Route::put('/products/{id}', 'update')->name('update')->where('id', '[0-9-]+');
        Route::delete('/products/{id}', 'delete')->name('delete')->where('id', '[0-9-]+');
    });

    Route::controller(\App\Http\Controllers\CartController::class)->prefix('cart')->name('cart.')->group(function (){
        Route::get('', 'index')->name('index');
        Route::get('/{id}/add', 'add')->name('add')->where('id', '[0-9-]+');
        Route::get('/{id}/remove', 'remove')->name('remove')->where('id', '[0-9-]+');
    });

    Route::get('/categories/{slug}/products', [\App\Http\Controllers\CategoryController::class, 'show'])
        ->name('categories.show')->where('slug', '[A-Za-z0-9-]+');

    Route::get('/brands/{slug}/products', [\App\Http\Controllers\BrandController::class, 'show'])
        ->name('brands.show')->where('slug', '[A-Za-z0-9-]+');

});