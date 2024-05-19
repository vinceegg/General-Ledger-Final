<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class InterestsReceivableController extends Controller
{
    public function index()
    {
        return view('accountcode.InterestsReceivable');
    }
}
