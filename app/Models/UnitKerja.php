<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UnitKerja extends Model
{
    protected $table = 'unit_kerja';

    protected $fillable = [
        'nama_unit_kerja',
        'jenis_unit_kerja',
        'parent_unit_kerja'
    ];
}
