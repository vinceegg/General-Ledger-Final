<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AccountsPayableTrash extends Controller
{
    public function index()
    {
        return view('trashrecords.AccountsPayableArchived');
    }
}
