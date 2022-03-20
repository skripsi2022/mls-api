<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SiswaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $datasiswa = [
            [
                'nama_siswa' => 'Yahya Hudan',
                'user_id' => 4,
                'kelas_id' => 1,
                'nis_siswa' => '190451',
                'alamat_siswa' => 'Malang Kota'
            ],
        ];
        DB::table('siswa')->insert($datasiswa);
    }
}
