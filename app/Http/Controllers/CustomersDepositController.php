<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CustomersDepositController extends Controller
{
    public function index()
    {
        return view('accountcode.CustomersDeposit');
    }
}
