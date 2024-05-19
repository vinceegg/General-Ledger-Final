<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OfficeSuppliesExpensesTrash extends Controller
{
    public function index()
    {
        return view('trashrecords.OfficeSuppliesExpensesArchived');
    }
}
