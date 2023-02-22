<?php

namespace App\Http\Controllers;

use App\Models\Jadwal;
use App\Models\Kendaraan;
use App\Models\Penumpang;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        return view('dashboard.dashboard', [
            'penumpang' => Penumpang::count(),
            'kendaraan' => Kendaraan::count(),
            'jadwal' => Jadwal::count(),
            'account' => User::count()
        ]);
    }
}
