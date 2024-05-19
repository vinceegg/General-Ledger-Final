<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SalariesandWagesRegularController extends Controller
{
    public function index()
    {
        return view('accountcode.SalariesandWagesRegular');
    }
}
