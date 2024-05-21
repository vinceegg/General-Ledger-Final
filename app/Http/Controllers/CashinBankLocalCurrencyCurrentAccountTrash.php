<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CashinBankLocalCurrencyCurrentAccountTrash extends Controller
{
    public function index()
    {
        return view('trashrecords.CashinBankLocalCurrencyCurrentAccountArchived');
    }
}
