<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PersonnelEconomicReliefAllowanceTrash extends Controller
{
    public function index()
    {
        return view('trashrecords.PersonnelEconomicReliefAllowanceArchived');
    }
}