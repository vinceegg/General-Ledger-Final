<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OvertimeandNightPayTrash extends Controller
{
    public function index()
    {
        return view('trashrecords.OvertimeandNightPayArchive');
    }
}