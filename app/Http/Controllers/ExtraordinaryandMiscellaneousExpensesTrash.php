<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ExtraordinaryandMiscellaneousExpensesTrash extends Controller
{
    public function index()
    {
        return view('trashrecords.ExtraordinaryandMiscellaneousExpensesArchive');
    }
}
