<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SchoolFeesController extends Controller
{
    public function index()
    {
        return view('accountcode.SchoolFees');
    }
}
