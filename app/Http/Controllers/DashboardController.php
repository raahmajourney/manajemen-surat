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

    $today = Carbon::today()->format('Y-m-d');

    return view('dashboard', [
        'title' => 'Dashboard',
        'menuDashboard' => 'active',

        'jumlahSuratMasuk' => $this->getJumlahSurat($unitKerjaId, 1),
        'jumlahSuratKeluar' => $this->getJumlahSurat($unitKerjaId, 2),
        'jumlahSuratKeputusan' => $this->getJumlahSurat($unitKerjaId, 3),
        'jumlahSuratDisposisi' => $this->getJumlahDisposisi($unitKerjaId),

        // Chart Hari Ini
        'chartDates' => [Carbon::parse($today)->format('d M')],
        'chartMasuk' => [$this->getJumlahSuratHarian($unitKerjaId, 1, $today)],
        'chartKeluar' => [$this->getJumlahSuratHarian($unitKerjaId, 2, $today)],
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
    return Surat::whereDate('created_at', $date)
        ->where('id_jenis_surat', $jenisSurat)
        ->where('unit_kerja_id', $unitKerjaId)
        ->count();
}

private function getJumlahDisposisi($unitKerjaId)
{
    return Disposisi::where('id_unit_kerja', $unitKerjaId)->count();
}


}



