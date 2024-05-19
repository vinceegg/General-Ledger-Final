<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RepresentationExpensesController extends Controller
{
    public function index()
    {
        return view('accountcode.RepresentationExpenses');
    }
}
