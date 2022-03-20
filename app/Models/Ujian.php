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
}
