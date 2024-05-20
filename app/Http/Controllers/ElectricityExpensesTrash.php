<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ElectricityExpensesTrash extends Controller
{
    public function index()
    {
        return view('trashrecords.ElectricityExpensesArchive');
    }
}
