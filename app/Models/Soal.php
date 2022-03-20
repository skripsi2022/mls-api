<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Soal extends Model
{
    use HasFactory;
    protected $table = 'soal';
    protected $primaryKey = 'id_soal';
    protected $fillable = ['ujian_id', 'isi_soal','opsi_a', 'opsi_b', 'opsi_c', 'opsi_d', 'opsi_benar'];
}
