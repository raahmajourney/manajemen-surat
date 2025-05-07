@extends('layouts.app')

@section('content')
<h1 class="h3 mb-4 text-gray-800">Edit Disposisi</h1>
<div class="container">
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>
    </div>
    @endif

    <form action="{{ route('disposisi.update', $disposisi->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="id_surat">Pilih Surat</label>
            <select class="form-control" id="id_surat" name="id_surat" disabled>
                @foreach ($surats as $surat)
                    <option value="{{ $surat->id }}" {{ $surat->id == $disposisi->id_surat ? 'selected' : '' }}>
                        {{ $surat->nomor_surat }} - {{ $surat->judul }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="catatan_disposisi">Catatan Disposisi</label>
            <textarea class="form-control" id="catatan_disposisi" name="catatan_disposisi" rows="3">{{ old('catatan_disposisi', $disposisi->catatan_disposisi) }}</textarea>
        </div>

        <div class="form-group">
            <label for="id_unit_kerja">Unit Kerja Tujuan</label>
            <select class="form-control" id="id_unit_kerja" name="id_unit_kerja">
                @foreach ($unitKerjas as $unit)
                    <option value="{{ $unit->id }}" {{ $unit->id == $disposisi->id_unit_kerja ? 'selected' : '' }}>
                        {{ $unit->nama_unit_kerja }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="file_disposisi">Upload File Baru</label><br>
            @if ($disposisi->file_disposisi)
                <a href="{{ asset('storage/' . $disposisi->file_disposisi) }}" target="_blank" class="btn btn-sm btn-info">Lihat File Saat Ini</a><br><br>
            @endif
            <input type="file" class="form-control-file" id="file_disposisi" name="file_disposisi">
        </div>

        <button type="submit" class="btn btn-primary">Update Disposisi</button>
        <a href="{{ route('disposisi.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection
