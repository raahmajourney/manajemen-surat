<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Disposisi extends Model
{
    
    use HasFactory, HasUuids;
    protected $fillable = [
        'id_surat',
        'catatan_disposisi',
        'id_unit_kerja',
    ];


    public $incrementing = false;
    protected $keyType = 'string';

    public function surat()
    {
        return $this->belongsTo(Surat::class, 'id_surat');
    }

    public function unitKerja()
    {
        return $this->belongsTo(UnitKerja::class, 'id_unit_kerja');
    }
}
