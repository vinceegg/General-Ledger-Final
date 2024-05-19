<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AffiliationFeesController extends Controller
{
    public function index()
    {
        return view('accountcode.AffiliationFees');
    }
}
