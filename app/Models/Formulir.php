<?php

namespace App\Models;



use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Formulir extends Model
{
    
    use HasFactory;

    protected $table = 'formulir_surats';

    protected $fillable = [
        'nama_formulir',
        'id_uker_pengelola',
        'tampilkan',
        'template_surat',
        'visibilitas',
    ];

    public function unitKerja()
    {
        return $this->belongsTo(UnitKerja::class, 'id_uker_pengelola');
    }

    public function formatSurats()
    {
        return $this->hasMany(FormatSurat::class, 'id_formulir');
    }
}
