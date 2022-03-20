<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GuruSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $dataguru = [
            [
                'nama_guru' => 'Yuri Ariyanto',
                'user_id' => 2,
                'alamat_guru' => 'Malang',
                'notelp_guru' => '081259224380',
            ],
            [
                'nama_guru' => 'Sofyan Arief',
                'user_id' => 3,
                'alamat_guru' => 'Malang',
                'notelp_guru' => '081259224380',
            ],
        ];

        DB::table('guru')->insert($dataguru);
    }
}
