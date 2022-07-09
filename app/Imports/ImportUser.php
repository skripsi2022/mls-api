<?php

namespace App\Imports;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ImportUser implements ToModel , WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new User([
            'role'     => $row['role'],
            'name'    => $row['name'],
            'email'    => $row['nis_siswa']."@student.id",
            'password'    => Hash::make($row['nis_siswa'])
        ]);
    }
}
