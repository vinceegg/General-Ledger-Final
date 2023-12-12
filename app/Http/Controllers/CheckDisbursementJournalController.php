<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CheckDisbursementJournalController extends Controller
{
    public function index()
    {
        return view('journals.CKDJ');
    }
}