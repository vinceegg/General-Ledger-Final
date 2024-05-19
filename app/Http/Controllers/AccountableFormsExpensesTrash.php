<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AccountableFormsExpensesTrash extends Controller
{
    public function index()
    {
        return view('trashrecords.AccountableFormsExpensesArchived');
    }
}
