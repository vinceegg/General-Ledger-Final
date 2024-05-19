<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SubscriptionExpensesController extends Controller
{
    public function index()
    {
        return view('accountcode.SubscriptionExpenses');
    }
}
