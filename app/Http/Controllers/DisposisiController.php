<?php

namespace App\Http\Controllers;

use App\Models\Disposisi;
use App\Models\Surat;
use Illuminate\Support\Str;
use App\Models\UnitKerja;
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
        ]);
    
        Disposisi::create([
            'id' => Str::uuid(),
            'id_surat' => $request->id_surat,
            'catatan_disposisi' => $request->catatan_disposisi,
            'id_unit_kerja' => $request->id_unit_kerja,
        ]);
    
        return redirect()->route('disposisi.index')->with('success', 'Disposisi berhasil ditambahkan.');
    }
}
