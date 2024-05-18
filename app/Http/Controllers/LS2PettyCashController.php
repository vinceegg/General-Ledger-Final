<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LS2PettyCashController extends Controller
{
    public function index()
    {
        return view('accountcode.LS2PettyCash');
    }
}
