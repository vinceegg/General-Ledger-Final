<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EmployeesCompensationInsurancePremiumsTrash extends Controller
{
    public function index()
    {
        return view('trashrecords.EmployeesCompensationInsurancePremiumsArchived');
    }
}
