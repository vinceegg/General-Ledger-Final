<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MembershipDuesandContributiontoOrgController extends Controller
{
    public function index()
    {
        return view('accountcode.MembershipDuesandContributiontoOrg');
    }
}
