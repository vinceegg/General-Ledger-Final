<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FuelOilandLubricantsExpensesTrash extends Controller
{
    public function index()
    {
        return view('trashrecords.FuelOilandLubricantsExpensesArchived');
    }
}
