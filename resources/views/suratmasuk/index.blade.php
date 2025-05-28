@extends('layouts.app')

@section('content')
   <!-- Page Heading -->
   <h1 class="h3 mb-4 text-gray-800">{{ $title }}</h1>


   @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<!-- form Tambah Surat -->
<div class="modal fade" id="modalTambahSurat" tabindex="-1" role="dialog" aria-labelledby="modalTambahSuratLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalTambahSuratLabel">Form Tambah Surat</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Tutup">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="POST" action="{{ route('suratmasuk.store') }}" enctype="multipart/form-data">
          @csrf
          <div class="form-row">
            <div class="form-group col-md-6">
              <label for="nomor_surat">Nomor Surat</label>
              <input type="text" class="form-control" id="nomor_surat" name="nomor_surat" placeholder="Masukkan nomor surat">
            </div>
            
            <div class="form-group col-md-6">
              <label for="judul">Judul Surat</label>
              <input type="text" class="form-control" id="judul" name="judul" placeholder="Masukkan judul surat">
            </div>
          </div>
        
          <div class="form-group">
            <label for="isi">Isi Surat</label>
            <textarea class="form-control" id="isi" name="isi" rows="4" placeholder="Masukkan isi surat"></textarea>
          </div>
        
          <div class="form-row">

            <div class="form-group col-md-6">
              <label for="id_jenis_surat">Jenis Surat</label>
             
              <select class="form-control" id="id_jenis_surat" name="id_jenis_surat" readonly>
                <option value="1" selected>Surat Masuk</option>
            </select>
            
                  @error('id_jenis_surat')
                  <div class="text-danger">{{ $message }}</div>
                   @enderror
            </div>

            <div class="form-group col-md-6">
              <label for="nama_pengirim">Nama Pengirim</label>
              <input type="text" class="form-control" id="nama_pengirim" name="nama_pengirim" placeholder="Masukkan nama pengirim">
            </div>
          </div>
        
          <div class="form-row">
            <div class="form-group col-md-6">
              <label for="tanggal_surat">Tanggal Surat</label>
              <input type="date" class="form-control" id="tanggal_surat" name="tanggal_surat">
            </div>
            <div class="form-group col-md-6">
              <label for="status">Status</label>
              <select class="form-control" id="status" name="status">
                <option value="aktif">Aktif</option>
                <option value="arsip">Arsip</option>
              </select>
            </div>
          </div>
        
          <div class="form-group">
            <label for="file_surat">Upload File Surat (PDF)</label>
            <input type="file" class="form-control-file" id="file_surat" name="file_surat" accept="application/pdf">
            @error('file_surat')
                <div class="text-danger">{{ $message }}</div>
            @enderror
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
  <div class="d-flex flex-column flex-md-row justify-content-between align-items-center mb-3">
    <a href="#" class="btn btn-primary mb-3" data-toggle="modal" data-target="#modalTambahSurat">+ Tambah Surat</a>
    
    <div class="d-flex flex-column flex-md-row align-items-center">
    </div>
  </div>
  <div class="table-responsive">
   <table class="table table-bordered table-hover" id="datatable">
    <thead class="thead-light">
        <tr>
            <th>No</th>
            <th>Nomor Surat</th>
            <th>Judul</th>
            <th>Jenis Surat</th>
            <th>Nama Pengirim</th>
            <th>Tanggal Surat</th>
            <th>Status</th>
            <th>File</th>
            <th>Aksi</th>
        </tr>
    </thead>
</table>

  </div>
</div>
@endsection


@push('scripts')
<script>
$(document).ready(function() {
    $('#datatable').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('suratmasuk.data') }}",
        columns: [
            { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
            { data: 'nomor_surat', name: 'nomor_surat' },
            { data: 'judul', name: 'judul' },
            { data: 'jenis_surat', name: 'jenisSurat.nama_jenis_surat' },
            { data: 'nama_pengirim', name: 'nama_pengirim' },
            { data: 'tanggal_surat', name: 'tanggal_surat' },
            { data: 'status', name: 'status' },
            { data: 'file', name: 'file', orderable: false, searchable: false },
            { data: 'aksi', name: 'aksi', orderable: false, searchable: false }
        ]
    });
});
</script>

@if (session('success'))
<script>
    $(document).ready(function () {
        Swal.fire({
            icon: 'success',
            title: 'Berhasil',
            text: '{{ session('success') }}',
            showConfirmButton: false,
            timer: 2000
        });
    });
</script>
@endif

@if (session('error'))
<script>
    $(document).ready(function () {
        Swal.fire({
            icon: 'error',
            title: 'Gagal',
            text: '{{ session('error') }}',
            showConfirmButton: false,
            timer: 3000
        });
    });
</script>
@endif

@endpush




