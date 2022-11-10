<?php

namespace Database\Seeders;

use Carbon\Carbon;
use App\Models\{Bunga, Angsuran, Pinjaman};
use Illuminate\Database\Seeder;

class PinjamanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tgl_pinjam = ['2022-09-10', '2022-11-10', '2022-06-10', null];
        $nenor = [1, 3, 6, 12];
        $array = [1000000, 900000, 2000000, 3000000];
        for ($ikhsan = 0; $ikhsan < 1000; $ikhsan++) {
            $finalTgl = $tgl_pinjam[array_rand($tgl_pinjam)];
            $totalPinjaman = $array[array_rand($array)];
            $tenor = $nenor[array_rand($nenor)];
            $suku_bunga = Bunga::find(1)->suku_bunga;
            $pinjaman = Pinjaman::create([
                'user_id' => rand(3,32),
                'total_pinjaman' => $totalPinjaman,
                'saldo_pinjaman' => 0,
                'tanggal_pinjam' => $finalTgl,
                'tenor' => $tenor,
                'angsuran_pokok' => $totalPinjaman / $tenor,
                'angsuran_bunga' => $totalPinjaman * $suku_bunga / 100,
                'total_angsuran' => $totalPinjaman / $tenor + $totalPinjaman * $suku_bunga / 100,
                'keterangan' => '-',
                'status' => $finalTgl == null ? null : '1',
                'suku_bunga' => $suku_bunga,
            ]);

            for ($i = 0; $i < $tenor; $i++) {
                Angsuran::create([
                    'pinjaman_id' => $pinjaman->id,
                    'pokok' => $pinjaman->angsuran_pokok,
                    'bunga' => $pinjaman->angsuran_bunga,
                    'total' => $pinjaman->total_angsuran,
                    'jatuh_tempo' => $pinjaman->tanggal_pinjam == null ? null : Carbon::parse($pinjaman->tanggal_pinjam)->addMonth($i+1)->format('Y-m-d'),
                    'angsuran_keberapa' => $i+1,
                    'status' => $pinjaman->tanggal_pinjam == null ? '0' : '1',
                ]);
            }
        }
    }
}
