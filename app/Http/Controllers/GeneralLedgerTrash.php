<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GeneralLedgerTrash extends Controller
{
    public function index()
    {
        return view('trashrecords.CashLocalTreasuryArchive');
    }
}
