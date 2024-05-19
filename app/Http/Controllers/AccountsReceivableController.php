<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AccountsReceivableController extends Controller
{
    public function index()
    {
        return view('accountcode.AccountReceivable');
    }
}
