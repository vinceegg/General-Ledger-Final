<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class YearEndBonusTrash extends Controller
{
    public function index()
    {
        return view('trashrecords.YearEndBonusArchive');
    }
}