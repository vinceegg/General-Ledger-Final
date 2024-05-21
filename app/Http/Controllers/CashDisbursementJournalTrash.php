<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CashDisbursementJournalTrash extends Controller
{
    public function index()
    {
        return view('trashrecords.CashDisbursementJournalArchived');
    }
}
