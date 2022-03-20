<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SoalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $datasoal = [
            [
                'ujian_id' => 1,
                'isi_soal' => 'Singkatan dari LAN adalah ?',
                'opsi_a' => 'Linear Area Network', 
                'opsi_b' => 'Local Area Network',
                'opsi_c' => 'Local Art National',
                'opsi_d' => 'Local Area Networking',
                'opsi_benar' =>'opsi_a', 
            ],
            [
                'ujian_id' => 1,
                'isi_soal' => 'Singkatan dari MAN adalah ?',
                'opsi_a' => 'Linear Area Network', 
                'opsi_b' => 'Metropolitan Area Network',
                'opsi_c' => 'Local Art National',
                'opsi_d' => 'Local Area Networking',
                'opsi_benar' =>'opsi_a', 
            ],
        ];

        DB::table('soal')->insert($datasoal);
    }
}
