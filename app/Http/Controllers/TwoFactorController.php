<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TwoFactorController extends Controller
{
    
    public function index()
    {
        return view('auth.verify');
    }

    
    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $user = auth()->user();
        $otpCode = $request->code1 . $request->code2 . $request->code3 . $request->code4;
        if ($otpCode == $user->code)
        {
            $user->restCode();
            return redirect()->route('dashboard');
        }
        return redirect()->back()->withErrors(['code'=>'Invalid code']);
    }

    
    public function show(string $id)
    {
        //
    }

    
    public function edit(string $id)
    {
        //
    }

    
    public function update(Request $request, string $id)
    {
        //
    }

    public function destroy(string $id)
    {
        //
    }
}
