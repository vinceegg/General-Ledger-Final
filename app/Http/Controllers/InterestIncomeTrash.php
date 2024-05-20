<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class InterestIncomeTrash extends Controller
{
    public function index()
    {
        return view('trashrecords.InterestIncomeArchive');
    }
}
