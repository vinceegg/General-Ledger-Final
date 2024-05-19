<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TrainingExpensesTrash extends Controller
{
    public function index()
    {
        return view('trashrecords.TrainingExpensesArchived');
    }
}
