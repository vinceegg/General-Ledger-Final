<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CashGiftTrash extends Controller
{
    public function index()
    {
        return view('trashrecords.CashGiftArchived');
    }
}
