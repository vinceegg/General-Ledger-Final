<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PhilHealthContributionsController extends Controller
{
    public function index()
    {
        return view('accountcode.PhilHealthContributions');
    }
}
