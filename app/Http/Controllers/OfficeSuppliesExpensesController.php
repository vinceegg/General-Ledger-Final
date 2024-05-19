<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OfficeSuppliesExpensesController extends Controller
{
    public function index()
    {
        return view('accountcode.OfficeSuppliesExpenses');
    }
}
