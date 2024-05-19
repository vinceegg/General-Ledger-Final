<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RentExpensesController extends Controller
{
    public function index()
    {
        return view('accountcode.RentExpenses');
    }
}
