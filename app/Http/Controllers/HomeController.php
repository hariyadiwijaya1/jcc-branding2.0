<?php

namespace App\Http\Controllers;

use App\Models\{Angsuran, Bunga, User, Pinjaman};

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('role:Superadmin');
    }

    public function index()
    {
        return view('home');
    }

    public function profile($id)
    {
        $user = User::find($id);
        if ($user && auth()->user()->id == $user->id) {
            return view('profile', [
                'user' => $user,
                'pinjaman' => Pinjaman::with('angsuran', 'user')->where('user_id', $id)->get(),
                'angsuran' => Angsuran::with('pinjaman')
                    ->whereHas('pinjaman', function ($q) use ($user) {
                        $q->where('user_id', $user->id);
                        $q->where('status', 1);
                    })
                    ->get(),
            ]);
        } else {
            abort(404);
        }
    }

    public function createLoan()
    {
        return view('create-loan', [
            'suku_bunga' => Bunga::first()->suku_bunga
        ]);
    }
}
