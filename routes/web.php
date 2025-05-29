<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function (){
    return redirect(route('dashboard'));
});
include 'admin/dashboard.php';
include 'admin/branch.php';
