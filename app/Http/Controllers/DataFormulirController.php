<?php

namespace App\Http\Controllers;

use App\Models\Formulir;
use App\Models\FormatSurat;
use App\Models\UnitKerja;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class DataFormulirController extends Controller
{
    public function index()
    {
        $title = 'Data Formulir Surat';
        $menuformulir = "active";
        $formulirs = Formulir::with('unitKerja')->get();
        $unitKerjas = UnitKerja::all();

        return view('dataformulir.index', compact('title', 'formulirs', 'unitKerjas'));
    }


    public function create()
{
    return view('formulirsurat.create', [
        'title' => 'Tambah Formulir Surat',
        'unitKerjas' => UnitKerja::all(),
        'menuformulir' => 'active',
        'collapseFormulir' => 'show',
        'dataformulir' => 'active', // Untuk submenu aktif
    ]);
}


    public function store(Request $request)
    {
        $request->validate([
            'nama_formulir' => 'required|string|max:255',
            'id_uker_pengelola' => 'required|exists:unit_kerjas,id',
            'tampilkan' => 'in:YA,TIDAK',
            'template_surat' => 'nullable|file|mimes:pdf'
        ]);

        $data = $request->only('nama_formulir', 'id_uker_pengelola', 'tampilkan');

        if ($request->hasFile('template_surat')) {
            $data['template_surat'] = $request->file('template_surat')->store('templatesurat', 'public');
        }

        Formulir::create($data);


         // Tambahkan logika untuk simpan format surat jika tersedia
        if ($request->has('format_surats')) {
            foreach ($request->format_surats as $format) {
                FormatSurat::create([
                    'id' => Str::uuid(),
                  //  'id_formulir' => $formulir->id,
                    'urutan' => $format['urutan'],
                    'text_masukan' => $format['text_masukan'],
                    'jenis_masukan' => $format['jenis_masukan'],
                    'keterangan' => $format['keterangan'] ?? null,
                ]);
            }
        }


        return redirect()->back()->with('success', 'Formulir surat berhasil ditambahkan.');
    }
}
