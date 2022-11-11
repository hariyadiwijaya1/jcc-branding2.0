<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Pinjaman;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('role:Superadmin');
    }

    public function index()
    {
        return view('dashboard', [
            'title' => 'Dashboard',
            'anggota' => User::with('pinjaman')->count(),
            'pinjaman' => Pinjaman::with('angsuran', 'user')->get(),
        ]);
    }
}
