<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BankChargesController extends Controller
{
    public function index()
    {
        return view('accountcode.BankCharges');
    }
}
