<?php

namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Http\Request;
use App\Models\UnitKerja;
use Illuminate\Support\Facades\Storage;
use App\Models\FormulirSurat;

class FormulirSuratController extends Controller
{
    public function index(){


    

        return view('formulir.index', [
            'title' => 'Template Formulir',
            'menuformulir' => 'active',
            'collapseFormulir' => 'show',
            'templateformulir' => 'active', // Buat ini juga agar submenu aktif
            'unitKerjas' => UnitKerja::all()
        ]);


    }

    //menyimpan data
    public function store(Request $request)
{
    $request->validate([
        'nama_formulir' => 'required|string|max:255',
        'id_uker_pengelola' => 'required|exists:unit_kerja,id',
        'tampilkan' => 'required|in:YA,TIDAK',
        'visibilitas' => 'required|in:Private,Public',
        'template_surat' => 'nullable|file|mimes:pdf'
    ]);

    $data = $request->only(['nama_formulir', 'id_uker_pengelola', 'tampilkan', 'visibilitas']);

    if ($request->hasFile('template_surat')) {
        $data['template_surat'] = $request->file('template_surat')->store('templatesurat', 'public');
    }

    FormulirSurat::create($data);

    return redirect()->route('dataformulir.index')->with('success', 'Formulir berhasil disimpan.');
}
}
