@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h1 class="h3 mb-4 text-gray-800">Detail Surat</h1>

    <div class="card shadow p-4">
        <h5 class="mb-3">Informasi Surat</h5>
        <table class="table table-bordered">
            <tr>
                <th>Nomor Surat</th>
                <td>{{ $surat->nomor_surat }}</td>
            </tr>
            <tr>
                <th>Judul</th>
                <td>{{ $surat->judul }}</td>
            </tr>
            <tr>
                <th>Jenis Surat</th>
                <td>{{ $surat->jenisSurat->nama_jenis_surat ?? '-' }}</td>
            </tr>
            <tr>
                <th>Nama Pengirim</th>
                <td>{{ $surat->nama_pengirim }}</td>
            </tr>
            <tr>
                <th>Tanggal Surat</th>
                <td>{{ $surat->tanggal_surat }}</td>
            </tr>
            <tr>
                <th>Status</th>
                <td>
                    <span class="badge badge-{{ $surat->status == 'aktif' ? 'success' : 'secondary' }}">
                        {{ ucfirst($surat->status) }}
                    </span>
                </td>
            </tr>
            <tr>
                <th>Dibuat Oleh</th>
                <td>{{ $surat->pembuat->name ?? '-' }}</td>
            </tr>

            <tr>
                <th>Isi Surat</th>
                <td>{{ $surat->isi }}</td>
            </tr>
            <tr>
                <th>File Surat</th>
                <td>
                    @if($surat->file_surat)
                        <a href="{{ asset('storage/' . $surat->file_surat) }}" target="_blank" class="btn btn-sm btn-info">Lihat File</a>
                    @else
                        Tidak ada file
                    @endif
                </td>
            </tr>
        </table>

        <a href="{{ route('suratkeputusan') }}" class="btn btn-secondary mt-3">Kembali</a>
    </div>
</div>
@endsection
