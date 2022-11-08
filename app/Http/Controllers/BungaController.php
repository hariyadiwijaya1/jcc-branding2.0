<?php

namespace App\Http\Controllers;

use App\Models\Bunga;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class BungaController extends Controller
{
    public function index()
    {
        if (request()->ajax()){
            $pinjaman = Bunga::latest()->get();
            return DataTables::of($pinjaman)
                ->addIndexColumn()
                ->editColumn('suku_bunga', function (Bunga $bunga) {
                    return $bunga->suku_bunga . "%";
                })
                ->addColumn('action', function ($row) {
                    $btn =
                        '<div class="btn-group">
                            <a class="badge bg-navy dropdown-toggle dropdown-icon" data-toggle="dropdown">
                            </a>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="javascript:void(0)" data-id="' . $row->id . '" class="btn btn-primary btn-sm" id="editData">Edit</a>
                            </div>
                        </div>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('bunga.index');
    }

    public function edit(Bunga $bunga)
    {
        return response()->json($bunga);
    }

    public function store()
    {
        request()->validate([
            'suku_bunga' => 'required'
        ]);

        Bunga::updateOrCreate(['id' => request('bunga_id')],
        [
            'suku_bunga'=> request('suku_bunga')
        ]);
    }
}
