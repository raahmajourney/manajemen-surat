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
      <label for="tampilkan" class="mr-2 mb-2 mb-md-0">Tampilkan</label>
      <select id="tampilkan" class="form-control w-auto mr-3 mb-2 mb-md-0">
        <option selected>10</option>
        <option>25</option>
        <option>50</option>
      </select> 
      
      <form method="GET" action="{{ route('suratmasuk') }}" class="form-inline">
        <label for="search" class="mr-2">Cari:</label>
        <input type="text" name="search" id="search" value="{{ request('search') }}" class="form-control mr-2" placeholder="Cari surat...">
        <button type="submit" class="btn btn-primary">Cari</button>
      </form>
      

    </div>
  </div>

  @if($surats->isEmpty())
  <div class="alert alert-warning">Tidak ada data surat ditemukan.</div>
@endif


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
        <tr onclick="window.location='{{ route('suratmasuk.show', $surat->id) }}';" style="cursor: pointer;">
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
                <a href="{{ route('suratmasuk.edit', $surat->id) }}" class="btn btn-sm  mr-md-2 mb-2 mb-md-0" onclick="event.stopPropagation();">
                  <img src="{{ asset('img/edit.png') }}" alt="Edit" width="20" height="20">
                </a>
                
                <form action="{{ route('suratmasuk.destroy', $surat->id) }}" method="POST" class="form-delete" onclick="event.stopPropagation();">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="btn btn-sm">
                    <img src="{{ asset('img/delete.png') }}" alt="Hapus" width="20" height="20">
                  </button>
              </form>

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
                
              
            </div>
        </td>
        


        </tr>
        @endforeach
      </tbody>
      
    </table>
  </div>

 
  <div class="d-flex justify-content-between align-items-center mt-3">
    <div>
        Menampilkan {{ $surats->firstItem() }} sampai {{ $surats->lastItem() }} dari total {{ $surats->total() }} data
    </div>
    <div>
        {{ $surats->appends(request()->query())->links() }}
    </div>
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


  @if (session('success'))
  <script>
      Swal.fire({
          icon: 'success',
          title: 'Berhasil',
          text: '{{ session('success') }}',
          showConfirmButton: false,
          timer: 2000
      });
  </script>
  @endif

  @if (session('error'))
  <script>
      Swal.fire({
          icon: 'error',
          title: 'Gagal',
          text: '{{ session('error') }}',
          showConfirmButton: false,
          timer: 3000
      });
  </script>
  @endif




