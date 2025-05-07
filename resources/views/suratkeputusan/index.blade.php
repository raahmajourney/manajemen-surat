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
        <form method="POST" action="{{ route('suratkeputusan.store') }}" enctype="multipart/form-data">
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
                <option value="3" selected>Surat Keputusan</option>
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
            <label for="file_surat">Upload File Surat (Opsional)</label>
            <input type="file" class="form-control-file" id="file_surat" name="file_surat">
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
      <label for="tampilkan" class="mr-2 mb-2 mb-md-0">Tampilkan</label>
      <select id="tampilkan" class="form-control w-auto mr-3 mb-2 mb-md-0">
        <option selected>10</option>
        <option>25</option>
        <option>50</option>
      </select> 
      
      <label for="search" class="mr-2 mb-2 mb-md-0">Cari:</label>
      <input type="text" id="search" class="form-control w-auto">
    </div>
  </div>

  <div class="table-responsive">
    <table class="table table-bordered table-hover">
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
      <tbody>
        @foreach($surats as $no => $surat)
        <tr onclick="window.location='{{ route('suratkeputusan.show', $surat->id) }}';" style="cursor: pointer;">
          <td>{{ $no + 1 }}</td>
          <td>{{ $surat->nomor_surat }}</td>
          <td>{{ $surat->judul }}</td>
          <td>{{ $surat->jenisSurat->nama_jenis_surat ?? '-' }}</td>
          <td>{{ $surat->nama_pengirim }}</td>
          <td>{{ $surat->tanggal_surat }}</td>
          <td>
            <span class="badge badge-{{ $surat->status == 'aktif' ? 'success' : 'secondary' }}">
              {{ ucfirst($surat->status) }}
            </span>
          </td>
          <td>
            @if($surat->file_surat)
              <a href="{{ asset('storage/' . $surat->file_surat) }}" target="_blank" class="btn btn-sm btn-info" onclick="event.stopPropagation();">Lihat File</a>
            @else
              -
            @endif
          </td>

          <td>
            <div class="d-flex flex-column flex-md-row">
                <a href="{{ route('suratkeputusan.edit', $surat->id) }}" class="btn btn-sm mr-md-2 mb-2 mb-md-0" onclick="event.stopPropagation();">
                  <img src="{{ asset('img/edit.png') }}" alt="Edit" width="20" height="20">
                </a>
                
                <form action="{{ route('suratkeputusan.destroy', $surat->id) }}" method="POST"  onsubmit="return confirm('Apakah Anda yakin ingin menghapus surat ini?')" class="mb-2" onclick="event.stopPropagation();">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-sm" >
                      <img src="{{ asset('img/delete.png') }}" alt="Hapus" width="20" height="20">
                    </button>
                </form>
            </div>
        </td>
        


        </tr>
        @endforeach
      </tbody>
      
    </table>
  </div>

  <div class="d-flex flex-column flex-md-row justify-content-between align-items-center mt-3">
    <span class="mb-2 mb-md-0">Menampilkan 1 ke 1 dari 1 data</span>
    <nav>
      <ul class="pagination mb-0">
        <li class="page-item disabled"><a class="page-link" href="#">Sebelumnya</a></li>
        <li class="page-item active"><a class="page-link" href="#">1</a></li>
        <li class="page-item"><a class="page-link" href="#">Selanjutnya</a></li>
      </ul>
    </nav>
  </div>
</div>

@endsection

@if ($errors->any())
<script>
    $(document).ready(function () {
        $('#modalTambahSurat').modal('show');
    });
</script>
@endif

