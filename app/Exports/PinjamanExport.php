<?php

namespace App\Exports;

use App\Models\Pinjaman;
use Maatwebsite\Excel\Concerns\FromCollection;

class PinjamanExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Pinjaman::get(['user_id', 'total_pinjaman', 'saldo_pinjaman', 'tanggal_pinjam', 'status', 'tenor', 'tunggakan', 'angsuran_bunga', 'angsuran_pokok', 'suku_bunga', 'total_angsuran', 'keterangan']);
    }
}
