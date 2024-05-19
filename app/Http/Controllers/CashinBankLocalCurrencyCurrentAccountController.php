<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CashinBankLocalCurrencyCurrentAccountController extends Controller
{
    public function index()
    {
        return view('accountcode.CashinBankLocalCurrencyCurrentAccount');
    }
}
