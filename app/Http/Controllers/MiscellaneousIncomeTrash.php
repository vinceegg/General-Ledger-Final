<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MiscellaneousIncomeTrash extends Controller
{
    public function index()
    {
        return view('trashrecords.MiscellaneousIncomeArchive');
    }
}

