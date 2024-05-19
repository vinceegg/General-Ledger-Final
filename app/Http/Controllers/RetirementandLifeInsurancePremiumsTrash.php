<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RetirementandLifeInsurancePremiumsTrash extends Controller
{
    public function index()
    {
        return view('trashrecords.RetirementandLifeInsurancePremiumsArchived');
    }
}
