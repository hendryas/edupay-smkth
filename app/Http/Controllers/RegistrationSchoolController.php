<?php

namespace App\Http\Controllers;

use App\Models\RegistrationSchool;
use Illuminate\Http\Request;

class RegistrationSchoolController extends Controller
{
    public function index()
    {
        return view('registrationschool.index');
    }
}
