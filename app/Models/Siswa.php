<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    use HasFactory;
    protected $table = 'siswa';
    protected $primaryKey = 'id_siswa';
    protected $fillable = ['nama_siswa', 'user_id', 'kelas_id','nis_siswa','alamat_siswa'];

    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'kelas_id', 'id_kelas');
    }
    public function nilai()
    {
        return $this->hasMany(Nilai::class,'siswa_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
