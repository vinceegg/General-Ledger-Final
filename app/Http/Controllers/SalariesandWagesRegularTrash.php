<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SalariesandWagesRegularTrash extends Controller
{
    public function index()
    {
        return view('trashrecords.SalariesandWagesRegularArchive');
    }
}
