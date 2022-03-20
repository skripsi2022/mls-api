<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $dataAdmin = [
            'nama_admin' => 'Yahya Hudan',
            'user_id' => '1',
        ];

        DB::table('admin')->insert($dataAdmin);
    }
}
