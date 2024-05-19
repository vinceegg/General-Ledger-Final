<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagibigContributionsTrash extends Controller
{
    public function index()
    {
        return view('trashrecords.PagibigContributionsArchived');
    }
}
