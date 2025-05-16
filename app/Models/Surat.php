<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Surat extends Model
{

    protected $table = 'surats';
    protected $keyType = 'string'; // UUID


    protected $fillable = [
        'id', 'nomor_surat', 'judul', 'isi', 'id_jenis_surat',
        'nama_pengirim', 'tanggal_surat', 'status',
        'file_surat', 'dibuat_oleh', 'diupdate_oleh'
    ];

    public $incrementing = false;


      // Relasi ke jenis surat
    public function jenisSurat()
    {
        return $this->belongsTo(JenisSurat::class, 'id_jenis_surat');
    }

     // ✅ Relasi ke disposisis
     public function disposisis()
     {
         return $this->hasMany(Disposisi::class, 'id_surat');
     }

       // 🔗 Relasi ke user yang membuat surat
    public function pembuat()
    {
        return $this->belongsTo(User::class, 'dibuat_oleh');
    }

    // 🔗 Relasi ke user yang mengupdate surat
    public function pengupdate()
    {
        return $this->belongsTo(User::class, 'diupdate_oleh');
    }



    // log surat
    public function logSurats()
    {
        return $this->hasMany(LogSurat::class, 'id_surat');
    }

}
