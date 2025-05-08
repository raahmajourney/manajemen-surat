<?php

namespace App\Http\Controllers;

use App\Models\Surat;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(){
        $data = array(
            "title" => "Dashboard",
            "menuDashboard" => "active",

              // Ambil jumlah surat berdasarkan jenis
        "jumlahSuratMasuk" => Surat::where('id_jenis_surat', 1)->count(),
        "jumlahSuratKeluar" => Surat::where('id_jenis_surat', 2)->count(),
        "jumlahSuratKeputusan" => Surat::where('id_jenis_surat', 3)->count(),
        "jumlahSuratDisposisi" => Surat::where('id_jenis_surat', 4)->count(),
            
        );

        return view('dashboard', $data);
    }
}



