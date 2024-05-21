<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CheckDisbursementJournalTrash extends Controller
{
    public function index()
    {
        return view('trashrecords.CheckDisbursementJournalArchived');
    }
}
