<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PrintingandPublicationExpensesController extends Controller
{
    public function index()
    {
        return view('accountcode.PrintingandPublicationExpenses');
    }
}
