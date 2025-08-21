<?php
use App\Livewire\CreateProduct;
use Illuminate\Support\Facades\Route;
use App\Livewire\ProductIndex;
use App\Http\Controllers\ProductController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/products/create', CreateProduct::class);

Route::get('/products', ProductIndex::class);

Route::get('/products/{id}', [ProductController::class, 'show'])->name('products.show');

