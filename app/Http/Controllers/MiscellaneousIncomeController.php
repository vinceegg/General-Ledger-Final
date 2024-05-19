<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MiscellaneousIncomeController extends Controller
{
    public function index()
    {
        return view('accountcode.MiscellaneousIncome');
    }
}
