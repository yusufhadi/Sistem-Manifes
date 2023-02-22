<?php

namespace App\Http\Controllers;

use App\Models\Penumpang;
use App\Models\Kendaraan;
use App\Models\Jadwal;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {
        return view('dashboard.login');
    }

    public function store(Request $request)
    {
        $user = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required']
        ]);

        if (Auth::attempt($user)) {
            return view('dashboard.dashboard', [
                'penumpang' => Penumpang::count(),
                'kendaraan' => Kendaraan::count(),
                'jadwal' => Jadwal::count(),
                'account' => User::count()
            ]);
        } else {
            return back()->withErrors([
                'email' => 'Email Anda Salah'
            ]);
        }
    }

    public function keluar()
    {
        Auth::logout();

        return redirect()->route('login');
    }
}
