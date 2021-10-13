<?php

use App\Http\Livewire\CreateOrder;
use App\Http\Livewire\OrdersIndex;
use App\Http\Livewire\VendorOrder;
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
    return redirect('orders');
});

Route::middleware(['auth:sanctum', 'verified'])->group(function() {
    Route::get('/orders', OrdersIndex::class)->name('orders');
    Route::get('/create-order', CreateOrder::class)->name('create-order');
    Route::get('/vendor-order', VendorOrder::class)->name('vendor-order');
});
