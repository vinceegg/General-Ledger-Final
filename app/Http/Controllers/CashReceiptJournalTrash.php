<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CashReceiptJournalTrash extends Controller
{
    public function index()
    {
        return view('trashrecords.CashReceiptJournalArchived');
    }
}
