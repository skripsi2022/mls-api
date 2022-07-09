<?php

namespace App\Imports;

use App\Models\Soal;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ImportSoal implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */


    public function model(array $row)
    {
        return new Soal([
            'ujian_id' => $row['ujian_id'],
            'isi_soal' => $row['isi_soal'],
            'opsi_a' =>  $row['opsi_a'],
            'opsi_b' =>  $row['opsi_b'],
            'opsi_c' =>  $row['opsi_c'],
            'opsi_d' =>  $row['opsi_d'],
            'opsi_benar' =>  $row['opsi_benar'],
        ]);
    }
}
