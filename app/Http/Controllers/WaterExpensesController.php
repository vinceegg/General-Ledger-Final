<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WaterExpensesController extends Controller
{
    public function index()
    {
        return view('accountcode.WaterExpenses');
    }
}
