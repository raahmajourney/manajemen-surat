<?php

namespace App\Http\Controllers;

use App\Models\Disposisi;
use App\Models\Surat;
use App\Models\UnitKerja;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Yajra\DataTables\Facades\DataTables;

class DisposisiController extends Controller
{
    public function index()
    {
        $unitKerjaId = Auth::user()->unit_kerja_id;

        return view('disposisi.index', [
            'title' => 'Disposisi',
            'menudisposisi' => 'active',
            'disposisis' => Disposisi::with(['surat', 'unitKerja'])
                ->where('id_unit_kerja', $unitKerjaId)
                ->get(),
            'surats' => Surat::where('id_jenis_surat', 1)->get(),
            'unitKerjas' => UnitKerja::all(),
        ]);
    }

    public function getData(Request $request)
    {
        $unitKerjaId = Auth::user()->unit_kerja_id;

        $query = Disposisi::with(['surat', 'unitKerja'])
            ->where('id_unit_kerja', $unitKerjaId)
            ->latest();

        return DataTables::of($query)
            ->addIndexColumn()
            ->addColumn('nomor_surat', fn($d) => $d->surat->nomor_surat ?? '-')
            ->addColumn('judul', fn($d) => $d->surat->judul ?? '-')
            ->addColumn('unit_kerja', fn($d) => $d->unitKerja->nama_unit_kerja ?? '-')
            ->addColumn('file', fn($d) => $d->file_disposisi
                ? '<a href="'.asset('storage/'.$d->file_disposisi).'" target="_blank" class="btn btn-sm btn-info">Lihat File</a>'
                : '-')
            ->addColumn('aksi', function($d) {
                return view('components.aksi', [
                    'edit' => route('disposisi.edit', $d->id),
                    'delete' => route('disposisi.destroy', $d->id),
                    'model' => $d,
                    'routePrefix' => 'disposisi'
                ])->render();
            })
            ->rawColumns(['file', 'aksi'])
            ->make(true);
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_surat' => 'required|uuid',
            'catatan_disposisi' => 'required|string',
            'id_unit_kerja' => 'required|integer',
            'file_disposisi' => 'nullable|file|mimes:pdf|max:2048',
        ]);

        $filePath = null;
        if ($request->hasFile('file_disposisi')) {
            $filePath = $request->file('file_disposisi')->store('disposisi', 'public');
        }

        Disposisi::create([
            'id' => Str::uuid(),
            'id_surat' => $request->id_surat,
            'catatan_disposisi' => $request->catatan_disposisi,
            'id_unit_kerja' => $request->id_unit_kerja, // Bisa tetap input manual
            'file_disposisi' => $filePath,
        ]);

        return redirect()->route('disposisi.index')->with('success', 'Disposisi berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $disposisi = $this->authorizeDisposisi($id);

        return view('disposisi.edit', [
            'disposisi' => $disposisi,
            'surats' => Surat::where('id_jenis_surat', 1)->get(),
            'unitKerjas' => UnitKerja::all(),
        ]);
    }

    public function update(Request $request, $id)
    {
        $disposisi = $this->authorizeDisposisi($id);

        $request->validate([
            'catatan_disposisi' => 'required|string',
            'id_unit_kerja' => 'required|integer',
            'file_disposisi' => 'nullable|file|mimes:pdf|max:2048',
        ]);

        if ($request->hasFile('file_disposisi')) {
            if ($disposisi->file_disposisi) {
                Storage::disk('public')->delete($disposisi->file_disposisi);
            }
            $disposisi->file_disposisi = $request->file('file_disposisi')->store('disposisi', 'public');
        }

        $disposisi->update([
            'catatan_disposisi' => $request->catatan_disposisi,
            'id_unit_kerja' => $request->id_unit_kerja,
        ]);

        return redirect()->route('disposisi.index')->with('success', 'Disposisi berhasil diupdate.');
    }

    public function destroy($id)
    {
        $disposisi = $this->authorizeDisposisi($id);

        if ($disposisi->file_disposisi) {
            Storage::disk('public')->delete($disposisi->file_disposisi);
        }

        $disposisi->delete();

        return redirect()->route('disposisi.index')->with('success', 'Disposisi berhasil dihapus.');
    }

    public function show($id)
    {
        $disposisi = $this->authorizeDisposisi($id);

        return view('disposisi.tampil', [
            'title' => 'Detail Disposisi',
            'disposisi' => $disposisi,
        ]);
    }

    /**
     * Cek apakah disposisi milik unit kerja user login
     */
    private function authorizeDisposisi($id)
    {
        $disposisi = Disposisi::with(['surat', 'unitKerja'])->findOrFail($id);

        if ($disposisi->id_unit_kerja !== Auth::user()->unit_kerja_id) {
            abort(403, 'Anda tidak memiliki akses ke data ini.');
        }

        return $disposisi;
    }
}
