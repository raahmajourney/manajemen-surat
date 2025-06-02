@extends('layouts.app')

@section('content')
<h1 class="h3 mb-4 text-gray-800">{{ $title }}</h1>

<div class="card">
    <div class="card-body">
        <h5 class="card-title">Detail Disposisi</h5>
        <p><strong>Nomor Surat:</strong> {{ $disposisi->surat->nomor_surat ?? '-' }}</p>
        <p><strong>Judul Surat:</strong> {{ $disposisi->surat->judul ?? '-' }}</p>
        <p><strong>Catatan Disposisi:</strong> {{ $disposisi->catatan_disposisi }}</p>
        <p><strong>Unit Kerja Tujuan:</strong> {{ $disposisi->unitKerja->nama_unit_kerja ?? '-' }}</p>
        <p><strong>File Disposisi:</strong> 
            @if($disposisi->file_disposisi)
                <a href="{{ asset('storage/' . $disposisi->file_disposisi) }}" target="_blank">Lihat File</a>
            @else
                Tidak ada file
            @endif
        </p>
    </div>
</div>
@endsection
