<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CustomersDepositTrash extends Controller
{
    public function index()
    {
        return view('trashrecords.CustomersDepositArchived');
    }
}
