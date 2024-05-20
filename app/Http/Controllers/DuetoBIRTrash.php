<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DuetoBIRTrash extends Controller
{
    public function index()
    {
        return view('trashrecords.DuetoBIRArchive');
    }
}
