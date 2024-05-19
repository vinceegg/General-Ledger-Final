<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FinesandPenaltiesServiceIncomeTrash extends Controller
{
    public function index()
    {
        return view('trashrecords.FinesandPenaltiesServiceIncomeArchived');
    }
}
