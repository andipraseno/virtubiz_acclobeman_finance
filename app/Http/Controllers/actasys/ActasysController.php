<?php

namespace App\Http\Controllers\actasys;

use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Session;

class ActasysController extends BaseController
{
    public function index()
    {
        Session::flush();
        Session::regenerate();

        return redirect('/login');
    }
}
