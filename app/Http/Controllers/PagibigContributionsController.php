<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagibigContributionsController extends Controller
{
    public function index()
    {
        return view('accountcode.PagibigContributions');
    }
}
