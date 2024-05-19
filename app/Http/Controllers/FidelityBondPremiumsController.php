<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FidelityBondPremiumsController extends Controller
{
    public function index()
    {
        return view('accountcode.FidelityBondPremiums');
    }
}
