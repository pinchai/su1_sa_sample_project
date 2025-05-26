<?php

use App\Http\Controllers\Dashboard\BranchController;
use Illuminate\Support\Facades\Route;
//CRUD
Route::get('/admin/branch', [BranchController::class, 'index'])
    ->name('branch');

Route::get('/admin/branch/get', [BranchController::class, 'get'])
    ->name('get_branch');

Route::post('/admin/branch/create', [BranchController::class, 'create'])
    ->name('create_branch');

Route::post('/admin/branch/delete', [BranchController::class, 'delete'])
    ->name('delete_branch');

Route::post('/admin/branch/update', [BranchController::class, 'update'])
    ->name('update_branch');
