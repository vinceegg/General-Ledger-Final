<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GrantsDonationsinKindController extends Controller
{
    public function index()
    {
        return view('accountcode.GrantsDonationsinKind');
    }
}
