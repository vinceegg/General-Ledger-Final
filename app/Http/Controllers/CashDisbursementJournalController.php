<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CashDisbursementJournalController extends Controller
{
    public function index()
    {
        return view('journals.CDJ');
    }
}