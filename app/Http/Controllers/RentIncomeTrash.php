<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RentIncomeTrash extends Controller
{
    public function index()
    {
        return view('trashrecords.RentIncomeArchived');
    }
}
