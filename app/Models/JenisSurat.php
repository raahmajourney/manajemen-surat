<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JenisSurat extends Model
{
    protected $table = 'jenis_surats';
    protected $fillable = ['nama_jenis_surat'];

    public function surat()
    {
        return $this->hasMany(Surat::class, 'id_jenis_surat');
    }
}
