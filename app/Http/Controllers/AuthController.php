<?php

namespace App\Http\Controllers;

use App\Models\User;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function index()
    {
        $data['title'] = 'Login';
        return view('auth.login', $data);
    }

    public function login(Request $request)
    {
        // cek form validation
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required'
        ]);

        // cek apakah email dan password benar
        if (auth()->attempt(request(['email', 'password']))) {
            return redirect('dashboard.index');
        } else {
            return redirect()->back()->with('error', 'Email atau Password salah');
        }
    }

    // VERSI KE 2
    // public function login(Request $request)
    // {
    //     $data = [
    //         'email' => $request->input('email'),
    //         'password' => $request->input('password'),
    //     ];

    //     if (auth()->attempt($data)) {
    //         // if (Auth::Attempt($data)) {
    //         return redirect('dashboard.index');
    //     } else {
    //         // Session::flash('error', 'Email atau Password Salah');
    //         // atau
    //         // return redirect('login')->with('error', 'Email atau Password salah');
    //         // atau
    //         return redirect()->back()->with('error', 'Email atau Password salah');
    //     }
    // }
}
