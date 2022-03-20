<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KelasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $datakelas = [
            [
                'nama_kelas' => 'TKJ1',
                'jurusan_id' => 1,
                
            ],
            [
                'nama_kelas' => 'TKJ2',
                'jurusan_id' => 1,

            ],
            [
                'nama_kelas' => 'RPL1',
                'jurusan_id' => 2,

            ],
            [
                'nama_kelas' => 'RPL2',
                'jurusan_id' => 2,

            ],
            
        ];
        DB::table('kelas')->insert($datakelas);
    }
}
