<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class InsuranceExpensesTrash extends Controller
{
    public function index()
    {
        return view('trashrecords.InsuranceExpensesArchived');
    }
}