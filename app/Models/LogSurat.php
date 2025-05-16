<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LogSurat extends Model
{
    protected $table = 'log_surats';

    protected $fillable = [
        'id_surat', 'id_user', 'aktivitas'
    ];

    public function surat()
    {
        return $this->belongsTo(Surat::class, 'id_surat');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
}
