<?php

use App\Http\Controllers\CustomerController;
use Illuminate\Support\Facades\Route;
//CRUD
Route::get('/customers', [CustomerController::class, 'get']);
Route::get('/customers/{id}', [CustomerController::class, 'getById']);
Route::post('/customers/create', [CustomerController::class, 'create']);
Route::post('/customers/update', [CustomerController::class, 'update']);
Route::post('/customers/delete', [CustomerController::class, 'delete']);

