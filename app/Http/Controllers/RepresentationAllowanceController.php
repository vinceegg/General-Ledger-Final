<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RepresentationAllowanceController extends Controller
{
    public function index()
    {
        return view('accountcode.RepresentationAllowance');
    }
}
