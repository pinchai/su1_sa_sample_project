<?php

use App\Http\Controllers\Dashboard\DashboardController;
use Illuminate\Support\Facades\Route;
//CRUD
Route::get('/admin/dashboard', [DashboardController::class, 'index'])
    ->name('dashboard');
