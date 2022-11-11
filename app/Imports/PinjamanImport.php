<?php

namespace App\Imports;

use Carbon\Carbon;
use App\Models\{Angsuran, Pinjaman};
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class PinjamanImport implements ToCollection
{
    /**
    * @param Collection $collection
    */
    public function collection(Collection $collection)
    {
        foreach ($collection as $row)
        {
            // $user = User::where('name', $row[4])->first();
            $total_pinjaman = $row[1];
            $tenor = $row[5];
            $pinjaman = Pinjaman::create([
                'user_id' => $row[0],
                'total_pinjaman' => $total_pinjaman,
                'saldo_pinjaman' => $row[2],
                'tanggal_pinjam' => $row[3],
                'status' => $row[4],
                'tenor' => $tenor,
                'tunggakan' => $row[6],
                'angsuran_bunga' => $row[7],
                'angsuran_pokok' => $row[8],
                'suku_bunga' => $row[9],
                'total_angsuran' => $row[10],
                'keterangan' => $row[11],
            ]);

            for ($i = 0; $i < $tenor; $i++) {
                Angsuran::create([
                    'pinjaman_id' => $pinjaman->id,
                    'pokok' => $pinjaman->angsuran_pokok,
                    'bunga' => $pinjaman->angsuran_bunga,
                    'total' => $pinjaman->total_angsuran,
                    'jatuh_tempo' => Carbon::parse($pinjaman->tanggal_pinjam)->addMonth($i+1)->format('Y-m-d'),
                    'angsuran_keberapa' => $i+1,
                    'status' => $pinjaman->tanggal_pinjam == null ? '0' : '1',
                ]);
            }
        }
    }
}
