<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ledgerSheetController extends Controller
{
    public function index()
    {
        return view('ledgersheet.ledgerSheetView');
    }
}
