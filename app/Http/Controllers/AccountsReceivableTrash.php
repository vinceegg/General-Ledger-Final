<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AccountsReceivableTrash extends Controller
{
    public function index()
    {
        return view('trashrecords.AccountsReceivableArchive');
    }
}
