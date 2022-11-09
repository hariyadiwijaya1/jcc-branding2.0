<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DataTables\UserDataTable;

class AnggotaController extends Controller
{
    public function index(UserDataTable $datatable)
    {
        return $datatable->render('anggota.index');
    }

    // public function export()
    // {
    //     return Excel::download(new PinjamanExport, 'pinjaman.xlsx');
    // }
}
