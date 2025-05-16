<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LogSurat;
use App\Models\Surat;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Exception;

class LogSuratController extends Controller
{
    public function index()
    {
        $data = [
            'menuLogSurat' => 'active'
        ];

        $logs = LogSurat::with(['user', 'surat'])
            ->orderBy('created_at', 'desc')
            ->get();

        return view('logsurat.index', $data, compact('logs'));
    }

    public function storeSurat(Request $request)
    {
        $validated = $request->validate([
            'nomor_surat' => 'required|string|max:100',
            'judul' => 'required|string|max:255',
            'isi' => 'required|string',
        ]);

        try {
            $surat = Surat::create([
                'id' => Str::uuid(),
                'nomor_surat' => $validated['nomor_surat'],
                'judul' => $validated['judul'],
                'isi' => $validated['isi'],
                'id_jenis_surat' => 1,
                'nama_pengirim' => 'Dummy',
                'tanggal_surat' => now(),
                'status' => 'aktif',
                'dibuat_oleh' => Auth::id(),
                'diupdate_oleh' => Auth::id(),
            ]);

         
                

            return redirect()->back()->with('success', 'Surat dan log berhasil dibuat.');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Gagal menyimpan: ' . $e->getMessage());
        }
    }
}
