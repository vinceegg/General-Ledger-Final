<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OtherDeferredCreditsController extends Controller
{
    public function index()
    {
        return view('accountcode.OtherDeferredCredits');
    }
}
