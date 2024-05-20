<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MedicalDentalandLaboratorySuppliesExpensesTrash extends Controller
{
    public function index()
    {
        return view('trashrecords.MedicalDentalandLaboratorySuppliesExpensesArchive');
    }
}
