<?php
use App\Livewire\CreateProduct;
use Illuminate\Support\Facades\Route;
use App\Livewire\ProductIndex;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/products/create', CreateProduct::class);

Route::get('/products', ProductIndex::class);