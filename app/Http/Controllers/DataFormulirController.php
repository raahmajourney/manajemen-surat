<?php

namespace App\Http\Controllers;

use App\Models\FormulirSurat;
use Illuminate\Support\Facades\Storage;
use App\Models\FormatSurat;
use App\Models\UnitKerja;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class DataFormulirController extends Controller
{
    public function index()
    {
        return view('dataformulir.index', [
            'title' => 'Data Formulir Surat',
            'Dataformulir' => 'active',
            'collapseFormulir' => 'show',
            'formulirs' => FormulirSurat::with('unitKerja')->get(),
        ]);
    }


        public function destroy($id)
    {
        $formulir = FormulirSurat::findOrFail($id);

        // Hapus file template jika ada
        if ($formulir->template_surat && Storage::disk('public')->exists($formulir->template_surat)) {
            Storage::disk('public')->delete($formulir->template_surat);
        }

        $formulir->delete();

        return redirect()->route('formulirsurat')->with('success', 'Formulir berhasil dihapus.');
    }

    public function edit($id)
    {
        $formulir = FormulirSurat::findOrFail($id);
        $unitKerjas = UnitKerja::all();

        return view('dataformulir.edit', [
            'title' => 'Edit Formulir',
            'formulir' => $formulir,
            'unitKerjas' => $unitKerjas,
        ]);
    }


    public function update(Request $request, $id)
    {
        $formulir = FormulirSurat::findOrFail($id);
    
        $request->validate([
            'nama_formulir' => 'required|string|max:255',
            'id_uker_pengelola' => 'required|exists:unit_kerja,id',
            'tampilkan' => 'required|in:YA,TIDAK',
            'visibilitas' => 'required|in:Private,Public',
            'template_surat' => 'nullable|file|mimes:pdf'
        ]);
    
        $formulir->nama_formulir = $request->nama_formulir;
        $formulir->id_uker_pengelola = $request->id_uker_pengelola;
        $formulir->tampilkan = $request->tampilkan;
        $formulir->visibilitas = $request->visibilitas;
    
        if ($request->hasFile('template_surat')) {
            if ($formulir->template_surat && Storage::disk('public')->exists($formulir->template_surat)) {
                Storage::disk('public')->delete($formulir->template_surat);
            }
            $formulir->template_surat = $request->file('template_surat')->store('templatesurat', 'public');
        }
    
        $formulir->save();
    
        return redirect()->route('formulirsurat')->with('success', 'Formulir berhasil diperbarui.');
    }
    
}
