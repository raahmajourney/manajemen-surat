<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Surat extends Model
{

    protected $table = 'surats';
    protected $keyType = 'string'; // UUID


    protected $fillable = [
        'id', 'nomor_surat', 'judul', 'isi', 'id_jenis_surat',
        'nama_pengirim', 'tanggal_surat', 'status',
        'file_surat', 'dibuat_oleh', 'diupdate_oleh', 'unit_kerja_id'
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

     protected static function booted()
    {
        static::created(function ($surat) {
            if (Auth::check()) {
                LogSurat::create([
                    'id_surat' => $surat->id,
                    'id_user' => Auth::id(),
                    'aktivitas' => 'Membuat surat',
                ]);
            }
        });

        static::updated(function ($surat) {
            if (Auth::check()) {
                LogSurat::create([
                    'id_surat' => $surat->id,
                    'id_user' => Auth::id(),
                    'aktivitas' => 'Mengedit surat',
                ]);
            }
        });

        
    static::deleting(function ($surat) {
        if (Auth::check()) {
            LogSurat::create([
                'id_surat' => $surat->id,
                'id_user' => Auth::id(),
                'aktivitas' => 'Menghapus surat',
            ]);
        }
    });
    }

    public function unitKerja()
    {
        return $this->belongsTo(UnitKerja::class, 'unit_kerja_id');
    }
    

    public function unitKerjaPenerima()
    {
        return $this->belongsTo(UnitKerja::class, 'unit_kerja_id');
    }

    public function unitKerjaPengirim()
    {
        return $this->belongsTo(UnitKerja::class, 'id_unit_kerja_pengirim');
    }


}
