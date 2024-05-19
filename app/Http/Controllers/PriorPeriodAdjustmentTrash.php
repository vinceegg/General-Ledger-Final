<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PriorPeriodAdjustmentTrash extends Controller
{
    public function index()
    {
        return view('trashrecords.PriorPeriodAdjustmentArchived');
    }
}
