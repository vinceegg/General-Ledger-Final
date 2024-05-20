<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MembershipDuesandContributiontoOrgTrash extends Controller
{
    public function index()
    {
        return view('trashrecords.MembershipDuesandContributiontoOrgArchive');
    }
}
