<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Pinjaman;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        return view('dashboard', [
            'title' => 'Dashboard',
            'anggota' => User::count(),
            'pinjaman' => Pinjaman::get(),
        ]);
    }
}
