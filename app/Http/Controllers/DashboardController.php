<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class DashboardController extends Controller
{
    public function index()
    {
        // $name = Session::get('role');
        // var_dump($name);
        // die;

        return view('dashboard');
    }
}
