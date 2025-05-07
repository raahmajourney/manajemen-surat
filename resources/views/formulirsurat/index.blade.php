@extends('layouts.app')

@section('content')
<h1 class="h3 mb-4 text-gray-800">{{ $title }}</h1>

<!-- Modal Tambah Formulir -->
<div class="modal fade" id="modalTambahFormulir" tabindex="-1" role="dialog" aria-labelledby="modalTambahFormulirLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalTambahFormulirLabel">Form Tambah Formulir Surat</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Tutup">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
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

          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
            <button type="submit" class="btn btn-success">Simpan</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- Konten Utama -->
<div class="container-fluid mt-4">
  <div class="d-flex justify-content-between align-items-center mb-3">
    <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#modalTambahFormulir">+ Tambah Formulir</a>
  </div>

  <div class="table-responsive">
    <table class="table table-bordered table-hover">
      <thead class="thead-light">
        <tr>
          <th>No</th>
          <th>Nama Formulir</th>
          <th>Unit Kerja</th>
          <th>Tampilkan</th>
          <th>Template</th>
          <th>Aksi</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($formulirs as $index => $f)
        <tr>
          <td>{{ $index + 1 }}</td>
          <td>{{ $f->nama_formulir }}</td>
          <td>{{ $f->unitKerja->nama_unit_kerja ?? '-' }}</td>
          <td>{{ $f->tampilkan }}</td>
          <td>
            @if($f->template_surat)
              <a href="{{ asset('storage/' . $f->template_surat) }}" target="_blank" class="btn btn-sm btn-info">Lihat Template</a>
            @else
              Tidak Ada
            @endif
          </td>
          <td>
            <div class="d-flex">
              <a href="{{ route('formulir-surat.edit', $f->id) }}" class="btn btn-sm mr-2">
                <img src="{{ asset('img/edit.png') }}" alt="Edit" width="20">
              </a>
              <form action="{{ route('formulir-surat.destroy', $f->id) }}" method="POST" class="form-delete">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-sm">
                  <img src="{{ asset('img/delete.png') }}" alt="Hapus" width="20">
                </button>
              </form>
            </div>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.form-delete').forEach(form => {
        form.addEventListener('submit', function (e) {
            e.preventDefault();
            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "Data akan dihapus secara permanen!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        });
    });
});
</script>

@endsection
