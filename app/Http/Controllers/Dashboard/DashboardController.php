<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    //
    function index(Request $request)
    {
        return view('admin.dashboard.dashboard');
    }
    //
}
