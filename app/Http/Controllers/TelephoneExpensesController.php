<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TelephoneExpensesController extends Controller
{
    public function index()
    {
        return view('accountcode.TelephoneExpenses');
    }
}
