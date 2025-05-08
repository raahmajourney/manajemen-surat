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
        <label for="visibilitas">Visibilitas</label>
        <select class="form-control" id="visibilitas" name="visibilitas" required>
          <option value="Private" selected>Private</option>
          <option value="Public">Public</option>
        </select>
      </div>
      

      <div class="form-group">
        <label for="template_surat">Upload Template Surat (Opsional)</label>
        <input type="file" class="form-control-file" id="template_surat" name="template_surat">
      </div>

      <button type="submit" class="btn btn-success">Simpan</button>
      <a href="{{ route('formulirsurat') }}" class="btn btn-secondary">Kembali</a>



      <hr>
<h5 class="mt-4">Format Surat</h5>

<div id="format-container">
  <!-- Format Item Pertama -->
  <div class="format-item border p-3 mb-3 rounded">
    <div class="form-row">
      <div class="form-group col-md-2">
        <label>Urutan</label>
        <input type="number" name="format_surats[0][urutan]" class="form-control" required>
      </div>
      <div class="form-group col-md-3">
        <label>Teks Masukan</label>
        <input type="text" name="format_surats[0][text_masukan]" class="form-control" required>
      </div>
      <div class="form-group col-md-3">
        <label>Jenis Masukan</label>
        <select name="format_surats[0][jenis_masukan]" class="form-control" required>
          <option value="text">Text</option>
          <option value="date">Date</option>
          <option value="area">Textarea</option>
        </select>
      </div>
      <div class="form-group col-md-3">
        <label>Keterangan</label>
        <input type="text" name="format_surats[0][keterangan]" class="form-control">
      </div>
      <div class="form-group col-md-1 d-flex align-items-end">
        <button type="button" class="btn btn-danger btn-sm remove-format" style="display:none;">X</button>
      </div>
    </div>
  </div>
</div>

<!-- Tombol Tambah Format -->
<button type="button" class="btn btn-secondary btn-sm" id="add-format">+ Tambah Format</button>

    </form>
  </div>
</div>


<script>
  let formatIndex = 1;

  document.getElementById('add-format').addEventListener('click', function () {
    const container = document.getElementById('format-container');
    const item = document.querySelector('.format-item').cloneNode(true);

    // Update input names
    item.querySelectorAll('input, select').forEach((input) => {
      if (input.name) {
        input.name = input.name.replace(/\[\d+\]/, `[${formatIndex}]`);
        input.value = '';
      }
    });

    // Tampilkan tombol hapus
    item.querySelector('.remove-format').style.display = 'inline-block';
    item.querySelector('.remove-format').addEventListener('click', function () {
      item.remove();
    });

    container.appendChild(item);
    formatIndex++;
  });

  // Tombol hapus pertama hanya muncul pada salinan
</script>

@endsection
