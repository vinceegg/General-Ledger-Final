<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CashGiftController extends Controller
{
    public function index()
    {
        return view('accountcode.CashGift');
    }
}
