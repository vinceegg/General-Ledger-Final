<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LS2PettyCashTrash extends Controller
{
    public function index()
    {
        return view('trashrecords.LS2PettyCashArchived');
    }
}
