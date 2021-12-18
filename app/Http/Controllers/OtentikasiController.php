<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OtentikasiController extends Controller
{
    public function login(Request $request)
    {
        // $ss = 7691;
        // $menit = floor(($ss%3600)/60);
        // $h = (floor($ss/3600));
        // $d = floor($ss%60); 
        // dd($d. ' detik '.$menit. ' menit '. $h. ' Jam');
        return view('login');
    }

    public function store(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return response()->json(true);
        }
        return response()->json("email atau password tidak cocok");
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/login');
    }
    
    public function index()
    {
        //
    }

    public function create()
    {
        //
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
