<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UjianSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $dataujian = [
            [
                'mapel_id' => 1,
                'kelas_id' => 1,
                'nama_ujian' => 'Ujian Adminstrasi Jaringan'
            ],
            [
                'mapel_id' => 2,
                'kelas_id' => 3,
                'nama_ujian' => 'Ujian Pemograman Dasar'
            ],
        ];

        DB::table('ujian')->insert($dataujian);
    }
}
