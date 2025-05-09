<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class FormatSurat extends Model
{
    public $incrementing = false;
    protected $keyType = 'uuid';
    protected $fillable = ['id', 'urutan', 'text_masukan', 'jenis_masukan', 'keterangan', 'id_formulir'];

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            $model->id = Str::uuid();
        });
    }

    public function formulirSurat()
    {
        return $this->belongsTo(FormulirSurat::class, 'id_formulir');
    }
}
