<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UnitKerja;

class UnitkerjaController extends Controller
{
    public function unitkerja()
    {
        $unitkerjas = UnitKerja::all();

        $data = array(
            "title" => "Unit Kerja",
            'unitkerjas' => $unitkerjas,
            "menuunitkerja" => "active",

        );

        return view('unitkerja.unitkerja', $data);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_unit_kerja' => 'required',
            'jenis_unit_kerja' => 'required',
        ]);

        UnitKerja::create($request->all());

        return redirect()->route('unitkerja')->with('success', 'Unit Kerja berhasil ditambahkan.');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_unit_kerja' => 'required',
            'jenis_unit_kerja' => 'required',
        ]);

        $unit = UnitKerja::findOrFail($id);
        $unit->update($request->all());

        return redirect()->route('unitkerja')->with('success', 'Unit Kerja berhasil diupdate.');
    }


    public function edit($id)
{
    $unit = UnitKerja::findOrFail($id);
    $unitkerjas = UnitKerja::all(); // Untuk dropdown parent

    return view('unitkerja.edit', [
        'title' => 'Edit Unit Kerja',
        "menuDashboard" => "active",
        'unit' => $unit,
        'unitkerjas' => $unitkerjas
    ]);
}
    

    
    public function destroy($id)
    {
        $unit = UnitKerja::findOrFail($id);

        if ($unit->surats()->exists() || $unit->disposisis()->exists()) {
            return redirect()->route('unitkerja')
                ->with('error', 'Unit Kerja ini tidak dapat dihapus karena telah memiliki Disposisi.');
        }

        $unit->delete();

        return redirect()->route('unitkerja')->with('success', 'Unit Kerja berhasil dihapus.');
    }
}