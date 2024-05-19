<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DrugsandMedicinesExpensesController extends Controller
{
    public function index()
    {
        return view('accountcode.DrugsandMedicinesExpenses');
    }
}
