<?php

namespace App\Http\Controllers;

use App\Models\Surat;
use App\Models\Disposisi;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{

  public function index()
{
    $unitKerjaId = Auth::user()->unit_kerja_id;

    $chartDates = [];
    $chartMasuk = [];
    $chartKeluar = [];

    // Ambil data 7 hari terakhir
    for ($i = 6; $i >= 0; $i--) {
        $date = Carbon::today()->subDays($i);
        $chartDates[] = $date->format('d M'); // Contoh: 15 Jun
        $chartMasuk[] = $this->getJumlahSuratHarian($unitKerjaId, 1, $date->toDateString());
        $chartKeluar[] = $this->getJumlahSuratHarian($unitKerjaId, 2, $date->toDateString());
    }

    return view('dashboard', [
        'title' => 'Dashboard',
        'menuDashboard' => 'active',

        'jumlahSuratMasuk' => $this->getJumlahSurat($unitKerjaId, 1),
        'jumlahSuratKeluar' => $this->getJumlahSurat($unitKerjaId, 2),
        'jumlahSuratKeputusan' => $this->getJumlahSurat($unitKerjaId, 3),
        'jumlahSuratDisposisi' => $this->getJumlahDisposisi($unitKerjaId),

        'chartDates' => $chartDates,
        'chartMasuk' => $chartMasuk,
        'chartKeluar' => $chartKeluar,
    ]);
}


private function getJumlahSurat($unitKerjaId, $jenisSurat)
{
    return Surat::where('id_jenis_surat', $jenisSurat)
        ->where('unit_kerja_id', $unitKerjaId)
        ->count();
}

private function getJumlahSuratHarian($unitKerjaId, $jenisSurat, $date)
{
    return Surat::whereDate('tanggal_surat', $date) // <--- pakai tanggal_surat
        ->where('id_jenis_surat', $jenisSurat)
        ->where('unit_kerja_id', $unitKerjaId)
        ->count();
}

private function getJumlahDisposisi($unitKerjaId)
{
    return Disposisi::where('id_unit_kerja', $unitKerjaId)->count();
}


}



