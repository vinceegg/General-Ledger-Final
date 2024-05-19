<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RentExpensesTrash extends Controller
{
    public function index()
    {
        return view('trashrecords.RentExpensesArchived');
    }
}
