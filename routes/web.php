<?php

use App\Http\Controllers\CustomerController;
use Illuminate\Support\Facades\Route;

Route::controller(CustomerController::class)->group(function () {
    Route::get('/customer/create', 'create')
        ->name('customer.create');
    Route::post('/customer', 'store')
        ->name('customer.store');
});
