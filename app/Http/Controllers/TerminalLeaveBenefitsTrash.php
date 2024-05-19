<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TerminalLeaveBenefitsTrash extends Controller
{
    public function index()
    {
        return view('trashrecords.TerminalLeaveBenefitsArchived');
    }
}