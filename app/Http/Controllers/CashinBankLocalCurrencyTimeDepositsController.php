<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CashinBankLocalCurrencyTimeDepositsController extends Controller
{
    public function index()
    {
        return view('accountcode.CashinBankLocalCurrencyTimeDeposits');
    }
}
