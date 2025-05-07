<?php

namespace App\Http\Controllers;

use App\Models\FormulirSurat;
use App\Models\UnitKerja;
use Illuminate\Http\Request;

class FormulirSuratController extends Controller
{
    public function index()
    {
        $title = 'Formulir Surat';
        $menuformulir = "active";
        $formulirs = FormulirSurat::with('unitKerja')->get();
        $unitKerjas = UnitKerja::all();

        return view('formulirsurat.index', compact('title', 'formulirs', 'unitKerjas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_formulir' => 'required|string|max:255',
            'id_uker_pengelola' => 'required|exists:unit_kerjas,id',
            'tampilkan' => 'in:YA,TIDAK',
            'template_surat' => 'nullable|file|mimes:pdf,doc,docx'
        ]);

        $data = $request->only('nama_formulir', 'id_uker_pengelola', 'tampilkan');

        if ($request->hasFile('template_surat')) {
            $data['template_surat'] = $request->file('template_surat')->store('templatesurat', 'public');
        }

        FormulirSurat::create($data);

        return redirect()->back()->with('success', 'Formulir surat berhasil ditambahkan.');
    }
}
