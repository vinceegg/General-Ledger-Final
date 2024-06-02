<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LedgerSheetController extends Controller
{
    public function index()
    {
        return view('accountcodes.LedgerSheet');
    }
}
