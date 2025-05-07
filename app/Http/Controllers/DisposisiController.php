<?php

namespace App\Http\Controllers;

use App\Models\Disposisi;
use App\Models\Surat;
use Illuminate\Support\Str;
use App\Models\UnitKerja;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class DisposisiController extends Controller
{
    public function index(){
        $data = array(
            "title" => "Disposisi",
            "menudisposisi" => "active",

            'disposisis' => Disposisi::with(['surat', 'unitKerja'])->get(),
            'surats' => Surat::where('id_jenis_surat', 1)->get(),
            'unitKerjas' => UnitKerja::all(),
        );

        return view('disposisi.index', $data);
    }

    
    public function store(Request $request)
    {
        $request->validate([
            'id_surat' => 'required|uuid',
            'catatan_disposisi' => 'required|string',
            'id_unit_kerja' => 'required|integer',
            'file_disposisi' => 'nullable|file|mimes:pdf|max:2048',
        ]);
    
        // Simpan file ke storage/app/public/disposisi
        $file = $request->file('file_disposisi');
        $filePath = $file->store('disposisi', 'public');
    
        Disposisi::create([
            'id' => Str::uuid(),
            'id_surat' => $request->id_surat,
            'catatan_disposisi' => $request->catatan_disposisi,
            'id_unit_kerja' => $request->id_unit_kerja,
            'file_disposisi' => $filePath,
        ]);
    
        return redirect()->route('disposisi.index')->with('success', 'Disposisi berhasil ditambahkan.');
    }

    
    public function edit($id)
    {
        $disposisi = Disposisi::findOrFail($id);
        $surats = Surat::where('id_jenis_surat', 1)->get();
        $unitKerjas = UnitKerja::all();

        return view('disposisi.edit', compact('disposisi', 'surats', 'unitKerjas'));
    }
    

    public function update(Request $request, $id)
    {
        $disposisi = Disposisi::findOrFail($id);

        $request->validate([
            'catatan_disposisi' => 'required|string',
            'id_unit_kerja' => 'required|integer',
            'file_disposisi' => 'nullable|file|mimes:pdf|max:2048',
        ]);

        // Update file jika ada file baru
        if ($request->hasFile('file_disposisi')) {
            if ($disposisi->file_disposisi) {
                Storage::disk('public')->delete($disposisi->file_disposisi);
            }
            $filePath = $request->file('file_disposisi')->store('disposisi', 'public');
            $disposisi->file_disposisi = $filePath;
        }
        $disposisi->catatan_disposisi = $request->catatan_disposisi;
        $disposisi->id_unit_kerja = $request->id_unit_kerja;
        $disposisi->save();

        return redirect()->route('disposisi.index')->with('success', 'Disposisi berhasil diupdate.');
    }

    public function destroy($id)
    {
        $disposisi = Disposisi::findOrFail($id);

        // Hapus file jika ada
        if ($disposisi->file_disposisi) {
            Storage::disk('public')->delete($disposisi->file_disposisi);
        }

        $disposisi->delete();

        return redirect()->route('disposisi.index')->with('success', 'Disposisi berhasil dihapus.');
    }
}
