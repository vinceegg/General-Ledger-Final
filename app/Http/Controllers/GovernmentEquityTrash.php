<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GovernmentEquityTrash extends Controller
{
    public function index()
    {
        return view('trashrecords.GovernmentEquityArchived');
    }
}
