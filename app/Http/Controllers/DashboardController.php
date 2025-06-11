<?php

namespace App\Http\Controllers;

use App\Models\Surat;
use App\Models\Disposisi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
{
    $unitKerjaId = Auth::user()->unit_kerja_id; // Ambil unit kerja user

    $data = [
        "title" => "Dashboard",
        "menuDashboard" => "active",

        // Hitung jumlah surat per jenis, khusus milik unit kerja user
        "jumlahSuratMasuk" => Surat::where('id_jenis_surat', 1)
            ->where('unit_kerja_id', $unitKerjaId)->count(),

        "jumlahSuratKeluar" => Surat::where('id_jenis_surat', 2)
            ->where('unit_kerja_id', $unitKerjaId)->count(),

        "jumlahSuratKeputusan" => Surat::where('id_jenis_surat', 3)
            ->where('unit_kerja_id', $unitKerjaId)->count(),

        // Disposisi juga bisa difilter jika berelasi dengan surat dan unit kerja
        "jumlahSuratDisposisi" => Disposisi::whereHas('surat', function($q) use ($unitKerjaId) {
            $q->where('unit_kerja_id', $unitKerjaId);
        })->count(),
    ];

    return view('dashboard', $data);
}

}



