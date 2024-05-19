<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SchoolFeesTrash extends Controller
{
    public function index()
    {
        return view('trashrecords.SchoolFeesArchived');
    }
}
