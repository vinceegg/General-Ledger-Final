<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TransportationAllowanceTrash extends Controller
{
    public function index()
    {
        return view('trashrecords.TransportationAllowanceArchived');
    }
}