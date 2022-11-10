<?php

namespace App\Http\Controllers;

use App\Models\User;
use Yajra\DataTables\Facades\DataTables;

class AnggotaController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:pinjaman-module', ['only' => ['index','show', 'create', 'edit', 'store', 'update', 'destroy']]);
    }

    public function index()
    {
        // $user = User::with('pinjaman')->get();
        // return response()->json($user);
        if (request()->ajax()) {
            $anggota = User::with('pinjaman')->latest()->get();
            return DataTables::of($anggota)
                ->addIndexColumn()
                ->addColumn('pinjaman', function (User $user) {
                    return $user->pinjaman->count();
                })
                ->addColumn('button', function ($row) {
                    $btn = '
                        <a class="btn btn-sm btn-success" href="javascript:void(0)" data-id="' . $row['id'] . '" data-toggle="modal" data-target="#showModal">Button</a>
                    ';
                    return $btn;
                })
                ->addColumn('action', function ($row) {
                    $btn =
                    '<div class="dropdown d-inline-block">
                        <a aria-haspopup="true" aria-expanded="false" data-toggle="dropdown" class="mb-2 mr-2 dropdown-toggle btn-primary btn-sm text-white"></a>
                        <div tabindex="-1" role="menu" aria-hidden="true" class="dropdown-menu">
                            <a href="javascript:void(0)" id="showDetails" data-id="' . $row['id'] . '" tabindex="0" class="dropdown-item">Detail</a>
                        </div>
                    </div>';
                    return $btn;
                })
                ->rawColumns(['action', 'button'])
                ->make(true);
        }

        return view('anggota.index');
    }

    // public function export()
    // {
    //     return Excel::download(new PinjamanExport, 'pinjaman.xlsx');
    // }
}
