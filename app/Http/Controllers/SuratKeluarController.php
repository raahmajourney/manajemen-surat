<?php

namespace App\Http\Controllers;

use App\Models\Surat;
use App\Models\JenisSurat;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class SuratKeluarController extends Controller
{
    public function index() {
        $data = array(
            "title" => "Surat Keluar",
            "menuSuratKeluar" => "active",
            "collapseSurat" => "show",
            "suratkeluar" => "active",

            "surats" => Surat::with('jenisSurat')
            ->where('id_jenis_surat', 2) // hanya Surat Keluar
            ->orderBy('created_at', 'desc')
            ->get(),



            'jenisSurats' => JenisSurat::all(),
        );
            return view('suratkeluar.index', $data);
    }


    public function show($id)
{
    $surat = Surat::with('jenisSurat')->findOrFail($id);

    return view('suratkeluar.tampil', [
        'title' => 'Detail Surat',
        'surat' => $surat
    ]);
}

    
    
    public function store(Request $request)
{
    $validated = $request->validate([
        'nomor_surat' => 'required|string|unique:surats,nomor_surat',
        'judul' => 'required|string',
        'isi' => 'required|string',
        'id_jenis_surat' => 'required|integer',
        'nama_pengirim' => 'required|string',
        'tanggal_surat' => 'required|date',
        'status' => 'required|in:aktif,arsip',
        'file_surat' => 'nullable|file|mimes:pdf|max:2048', // hanya PDF
    ]);

    $filePath = null;
    if ($request->hasFile('file_surat')) {
        $filePath = $request->file('file_surat')->store('surat', 'public');
    }

    Surat::create([
        'id' => Str::uuid(),
        'nomor_surat' => $validated['nomor_surat'],
        'judul' => $validated['judul'],
        'isi' => $validated['isi'],
        'id_jenis_surat' => $validated['id_jenis_surat'],
        'nama_pengirim' => $validated['nama_pengirim'],
        'tanggal_surat' => $validated['tanggal_surat'],
        'status' => $validated['status'],
        'file_surat' => $filePath,

        //'dibuat_oleh' => Auth::id(),
        //'diupdate_oleh' => Auth::id(),

            // SEMENTARA tidak pakai Auth
        'dibuat_oleh' => 1, // ganti dengan ID user default (atau buat dummy user dengan ID 1)
        'diupdate_oleh' => null,
    ]);

    return redirect()->route('suratkeluar')->with('success', 'Surat berhasil ditambahkan.');
}


    //untuk mengedit 
    public function edit($id)
    {
        $surat = Surat::findOrFail($id);
        $jenisSurats = JenisSurat::all();

        return view('suratkeluar.edit', compact('surat', 'jenisSurats'));
    }


        public function update(Request $request, $id)
    {
        $surat = Surat::findOrFail($id);

        $validated = $request->validate([
            'nomor_surat' => 'required|string|unique:surats,nomor_surat,' . $id,
            'judul' => 'required|string',
            'isi' => 'required|string',
            'id_jenis_surat' => 'required|integer',
            'nama_pengirim' => 'required|string',
            'tanggal_surat' => 'required|date',
            'status' => 'required|in:aktif,arsip',
            'file_surat' => 'nullable|file|mimes:pdf,doc,docx,jpg,png|max:2048',
        ]);

        $filePath = $surat->file_surat;
        if ($request->hasFile('file_surat')) {
            $filePath = $request->file('file_surat')->store('surat', 'public');
        }

        $surat->update([
            'nomor_surat' => $validated['nomor_surat'],
            'judul' => $validated['judul'],
            'isi' => $validated['isi'],
            'id_jenis_surat' => $validated['id_jenis_surat'],
            'nama_pengirim' => $validated['nama_pengirim'],
            'tanggal_surat' => $validated['tanggal_surat'],
            'status' => $validated['status'],
            'file_surat' => $filePath,
        ]);

        return redirect()->route('suratkeluar')->with('success', 'Surat berhasil diperbarui.');
    }


    // delete 
    public function destroy($id)
    {
        $surat = Surat::findOrFail($id);
        
        // Jika ada file surat, hapus file-nya
        if ($surat->file_surat) {
            Storage::delete('public/' . $surat->file_surat);
        }

        $surat->delete();

        return redirect()->route('suratkeluar')->with('success', 'Surat berhasil dihapus.');
    }
}
