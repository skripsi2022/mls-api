<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jawaban extends Model
{
    use HasFactory;

    protected $table = 'jawaban';
    protected $primaryKey = 'id_jawaban';
    protected $fillable = ['soal_id','user_id', 'isi_jawaban', 'ket_jawaban'];

    public function soal()
    {
        return $this->belongsTo(Soal::class, 'soal_id', 'id_soal');
    }

}