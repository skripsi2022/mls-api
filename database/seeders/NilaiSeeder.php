<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class NilaiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $datanilai = [
            [
                'siswa_id' => 1,
                'mapel_id' => 1,
                'nilai' => 90
            ],
        ];
        DB::table('nilai')->insert($datanilai);
    }
}
