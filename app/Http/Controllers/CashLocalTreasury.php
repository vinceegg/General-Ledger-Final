<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CashLocalTreasury extends Controller
{
    public function index()
    {
        return view('accountcode.CashLocalTreasury');
    }
}
