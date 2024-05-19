<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RepresentationExpensesTrash extends Controller
{
    public function index()
    {
        return view('trashrecords.RepresentationExpensesArchived');
    }
}
