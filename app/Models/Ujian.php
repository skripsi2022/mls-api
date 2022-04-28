<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ujian extends Model
{
    use HasFactory;
    protected $table = 'ujian';
    protected $primaryKey = 'id_ujian';
    protected $fillable = ['mapel_id', 'kelas_id', 'nama_ujian'];

    public function mapel()
    {
        return $this->belongsTo(Mapel::class, 'mapel_id', 'id_mapel');
    }
    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'kelas_id', 'id_kelas');
    }
    public function soal()
    {
        return $this->hasMany(Soal::class);
    }
}
