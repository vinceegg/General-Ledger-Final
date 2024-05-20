<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WaterExpensesTrash extends Controller
{
    public function index()
    {
        return view('trashrecords.WaterExpensesArchive');
    }
}