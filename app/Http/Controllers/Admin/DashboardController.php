<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    //
    public function base()
    {
        return redirect()->route('dashboard.index');
    }

    public function index()
    {
        return view('dashboard');
    }
}
