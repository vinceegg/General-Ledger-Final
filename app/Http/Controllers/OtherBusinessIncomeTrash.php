<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OtherBusinessIncomeTrash extends Controller
{
    public function index()
    {
        return view('trashrecords.OtherBusinessIncomeArchive');
    }
}
