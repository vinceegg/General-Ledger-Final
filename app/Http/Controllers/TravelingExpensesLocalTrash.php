<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TravelingExpensesLocalTrash extends Controller
{
    public function index()
    {
        return view('trashrecords.TravelingExpensesLocalArchived');
    }
}
