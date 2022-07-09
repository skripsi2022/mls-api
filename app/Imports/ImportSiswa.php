<?php

namespace App\Imports;

use App\Models\Siswa;
use App\Models\User;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ImportSiswa implements ToModel , WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */

    private $users;

    public function __construct()
    {
        $this->users = User::select('id','name','email')->get();
    }

    public function model(array $row)
    {
        $user = $this->users->where('name',$row['name'])->first();
        return new Siswa([
            'user_id'     => $user->id ?? NULL,
            'kelas_id'      =>$row['kelas_id'],
            'nama_siswa'    => $row['name'],
            'nis_siswa'    => $row['nis_siswa'],
            'alamat_siswa'    => $row['alamat_siswa']
        ]);
    }
}
