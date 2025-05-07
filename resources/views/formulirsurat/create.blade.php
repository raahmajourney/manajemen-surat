@extends('layouts.app')

@section('content')
<h1 class="h3 mb-4 text-gray-800">{{ $title }}</h1>

<div class="card shadow mb-4">
  <div class="card-body">
    <form action="#" method="POST" enctype="multipart/form-data">
      @csrf
      <div class="form-group">
        <label for="nama_formulir">Nama Formulir</label>
        <input type="text" class="form-control" id="nama_formulir" name="nama_formulir" required>
      </div>

      <div class="form-group">
        <label for="id_uker_pengelola">Unit Kerja Pengelola</label>
        <select class="form-control" id="id_uker_pengelola" name="id_uker_pengelola" required>
          <option value="">-- Pilih Unit Kerja --</option>
          @foreach ($unitKerjas as $unit)
            <option value="{{ $unit->id }}">{{ $unit->nama_unit_kerja }}</option>
          @endforeach
        </select>
      </div>

      <div class="form-group">
        <label for="tampilkan">Tampilkan</label>
        <select class="form-control" id="tampilkan" name="tampilkan">
          <option value="YA">YA</option>
          <option value="TIDAK" selected>TIDAK</option>
        </select>
      </div>

      <div class="form-group">
        <label for="template_surat">Upload Template Surat (Opsional)</label>
        <input type="file" class="form-control-file" id="template_surat" name="template_surat">
      </div>

      <button type="submit" class="btn btn-success">Simpan</button>
      <a href="{{ route('formulirsurat') }}" class="btn btn-secondary">Kembali</a>
    </form>
  </div>
</div>
@endsection
