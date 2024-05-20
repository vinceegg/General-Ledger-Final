<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LongetivityPayTrash extends Controller
{
    public function index()
    {
        return view('trashrecords.LongetivityPayArchive');
    }
}
