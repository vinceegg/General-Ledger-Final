<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GuarantySecurityDepositsPayableTrash extends Controller
{
    public function index()
    {
        return view('trashrecords.GuarantySecurityDepositsPayableArchive');
    }
}
