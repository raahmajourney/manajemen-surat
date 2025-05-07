<?php

namespace App\Models;

use App\Models\Surat;
use App\Models\Disposisi;
use Illuminate\Database\Eloquent\Model;

class UnitKerja extends Model
{
    protected $table = 'unit_kerja';

    protected $fillable = [
        'nama_unit_kerja',
        'jenis_unit_kerja',
        'parent_unit_kerja'
    ];

    public function surats()
    {
        return $this->hasMany(Surat::class, 'dibuat_oleh'); // atau sesuaikan nama kolom relasi
    }

    public function disposisis()
    {
        return $this->hasMany(Disposisi::class, 'id_unit_kerja'); // sesuaikan nama kolom relasi
    }

    public function unitKerja()
{
    return $this->belongsTo(UnitKerja::class, 'id_uker_pengelola');
}

}
