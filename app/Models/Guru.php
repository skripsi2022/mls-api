<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Guru extends Model
{
    use HasFactory;
    protected $table = 'guru';
    protected $primaryKey = 'id_guru';
    protected $fillable = ['nama_guru', 'user_id','alamat_guru','notelp_guru','email_guru'];

    public function mapel(){
        return $this->hasMany(Mapel::class);
    }

}
