<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TerminalLeaveBenefitsController extends Controller
{
    public function index()
    {
        return view('accountcode.TerminalLeaveBenefits');
    }
}
