<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ElectricityExpensesController extends Controller
{
    public function index()
    {
        return view('accountcode.ElectricityExpenses');
    }
}
