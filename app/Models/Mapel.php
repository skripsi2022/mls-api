<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mapel extends Model
{
    use HasFactory;
    protected $table = 'mapel';
    protected $primaryKey = 'id_mapel';
    protected $fillable = ['nama_mapel', 'guru_id'];

    public function guru(){
        return $this->belongsTo(Guru::class,'guru_id','id_guru');
    }
    public function ujian()
    {
        return $this->hasMany(Ujian::class);
    }
}
