<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    use HasFactory;
    protected $table = 'kelas';
    protected $primaryKey = 'id_kelas';
    protected $fillable = ['nama_kelas', 'jurusan_id'];

    public function jurusan()
    {
        return $this->belongsTo(Jurusan::class, 'jurusan_id', 'id_jurusan');
    }
    public function ujian(){
        return $this->hasMany(Ujian::class);
    }
    public function siswa(){
        return $this->hasMany(Siswa::class);
    }
}
