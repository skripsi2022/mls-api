<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MapelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $datamapel = [
            [
                'nama_mapel' => 'Administrasi Jaringan',
                'guru_id' => 1
            ],
            [
                'nama_mapel' => 'Pemograman Dasar',
                'guru_id' => 2
            ],
        ];
        DB::table('mapel')->insert($datamapel);
    }
}
