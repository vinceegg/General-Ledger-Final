<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CashReceiptJournalController extends Controller
{
    public function index()
    {
        return view('journals.CRJ');
    }
}