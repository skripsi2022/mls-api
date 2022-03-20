<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JurusanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $datajurusan = [
            [
                'nama_jurusan' => 'Teknik Komputer dan Jaringan',
            ],
            [
                'nama_jurusan' => 'Rekayasa Perangkat Lunak',
            ]
        ];

        DB::table('jurusans')->insert($datajurusan);
    }
}
