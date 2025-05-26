<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function (){
    return view('admin.master');
});
include 'admin/dashboard.php';
include 'admin/branch.php';
