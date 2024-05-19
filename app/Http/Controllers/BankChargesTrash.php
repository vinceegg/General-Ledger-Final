<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BankChargesTrash extends Controller
{
    public function index()
    {
        return view('trashrecords.BankChargesArchived');
    }
}
