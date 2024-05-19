<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class InterestsReceivableTrash extends Controller
{
    public function index()
    {
        return view('trashrecords.InterestsReceivableArchived');
    }
}