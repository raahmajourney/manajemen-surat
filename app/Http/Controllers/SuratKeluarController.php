<?php

namespace App\Http\Controllers;

use App\Models\Surat;
use App\Models\JenisSurat;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class SuratKeluarController extends Controller
{
    public function index(Request $request) {
        $search = $request->query('search');

        $query = Surat::with('jenisSurat')
            ->where('id_jenis_surat', 2)
            ->orderBy('created_at', 'desc');

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('nomor_surat', 'like', "%{$search}%")
                ->orWhere('judul', 'like', "%{$search}%")
                ->orWhere('nama_pengirim', 'like', "%{$search}%")
                ->orWhere('isi', 'like', "%{$search}%");
            });
        }

        $data = array(
            "title" => "Surat Keluar",
            "menuSuratKeluar" => "active",
            "collapseSurat" => "show",
            "suratkeluar" => "active",

            "surats" => $query->get(),
            'jenisSurats' => JenisSurat::all(),
        );

        return view('suratkeluar.index', $data);
    }


    //-datatable--///
    public function getData(Request $request)
{
    $data = Surat::with('jenisSurat')
        ->where('id_jenis_surat', 2)
        ->orderBy('created_at', 'desc');

    return DataTables::of($data)
        ->addIndexColumn()
        ->addColumn('jenis_surat', fn ($row) => $row->jenisSurat->nama_jenis_surat ?? '-')
        ->addColumn('status', function ($row) {
    $color = match($row->status) {
        'aktif' => 'success',
        'arsip' => 'secondary',
        default => 'dark',
    };

    return '<span class="badge badge-' . $color . '">' . ucfirst($row->status) . '</span>';
})
        ->addColumn('file', function ($row) {
            return $row->file_surat
                ? '<a href="'.asset("storage/{$row->file_surat}").'" target="_blank" class="btn btn-sm btn-info">Lihat File</a>'
                : '-';
        })
        ->addColumn('aksi', function ($row) {
            $edit = route('suratkeluar.edit', $row->id);
            $delete = route('suratkeluar.destroy', $row->id);
             $routePrefix = 'suratkeluar';

            return view('components.aksi', [
            'edit' => $edit,
            'delete' => $delete,
            'model' => $row,
            'routePrefix' => $routePrefix
    ])->render();
        })
        ->rawColumns(['file', 'status', 'aksi'])
        ->make(true);
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
        'dibuat_oleh' => Auth::id(),
        'diupdate_oleh' => Auth::id(),

        
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
            'file_surat' => 'nullable|file|mimes:pdf|max:2048',
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
            'diupdate_oleh' => Auth::id(),
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
