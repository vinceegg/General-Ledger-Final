<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GeneralJournalController extends Controller
{
    public function index()
    {
        return view('journals.GJ');
    }
}