<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RentIncomeController extends Controller
{
    public function index()
    {
        return view('accountcode.RentIncome');
    }
}
