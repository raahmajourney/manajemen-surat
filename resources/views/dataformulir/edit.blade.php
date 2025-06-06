@extends('layouts.app')

@section('content')
<h1 class="h3 mb-4 text-gray-800">{{ $title }}</h1>

<div class="card shadow mb-4">
  <div class="card-body">
    <form action="{{ route('formulir.update', $formulir->id) }}" method="POST" enctype="multipart/form-data">
      @csrf
      @method('PUT')

      <div class="form-group">
        <label for="nama_formulir">Nama Formulir</label>
        <input type="text" class="form-control" id="nama_formulir" name="nama_formulir" value="{{ old('nama_formulir', $formulir->nama_formulir) }}" required>
      </div>

      <div class="form-group">
        <label for="id_uker_pengelola">Unit Kerja Pengelola</label>
        <select class="form-control" id="id_uker_pengelola" name="id_uker_pengelola" required>
          <option value="">-- Pilih Unit Kerja --</option>
          @foreach ($unitKerjas as $unit)
            <option value="{{ $unit->id }}" {{ $unit->id == $formulir->id_uker_pengelola ? 'selected' : '' }}>
              {{ $unit->nama_unit_kerja }}
            </option>
          @endforeach
        </select>
      </div>

      <div class="form-group">
        <label for="tampilkan">Tampilkan</label>
        <select class="form-control" id="tampilkan" name="tampilkan" required>
          <option value="YA" {{ $formulir->tampilkan == 'YA' ? 'selected' : '' }}>YA</option>
          <option value="TIDAK" {{ $formulir->tampilkan == 'TIDAK' ? 'selected' : '' }}>TIDAK</option>
        </select>
      </div>

      <div class="form-group">
        <label for="visibilitas">Visibilitas</label>
        <select class="form-control" id="visibilitas" name="visibilitas" required>
          <option value="Private" {{ $formulir->visibilitas == 'Private' ? 'selected' : '' }}>Private</option>
          <option value="Public" {{ $formulir->visibilitas == 'Public' ? 'selected' : '' }}>Public</option>
        </select>
      </div>

      <div class="form-group">
        <label for="template_surat">Template Surat (PDF)</label>
        @if($formulir->template_surat)
          <div class="mb-2">
            <a href="{{ asset('storage/' . $formulir->template_surat) }}" target="_blank" class="btn btn-sm btn-info">Lihat Template Lama</a>
          </div>
        @endif
        <input type="file" class="form-control-file" id="template_surat" name="template_surat">
      </div>

      <button type="submit" class="btn btn-primary">Update</button>
      <a href="{{ route('formulirsurat') }}" class="btn btn-secondary">Kembali</a>
    </form>
  </div>
</div>
@endsection
