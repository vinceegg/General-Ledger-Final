<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OtherPayablesController extends Controller
{
    public function index()
    {
        return view('accountcode.OtherPayables');
    }
}
