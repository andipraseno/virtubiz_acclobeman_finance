<?php

namespace App\Http\Controllers\actasys2;

use Illuminate\Routing\Controller as BaseController;

class DashboardController extends BaseController
{
    public function index()
    {
        return view('actasys2.dashboard');
    }
}
