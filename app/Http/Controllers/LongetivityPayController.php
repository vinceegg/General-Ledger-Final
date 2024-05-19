<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LongetivityPayController extends Controller
{
    public function index()
    {
        return view('accountcode.LongetivityPay');
    }
}
