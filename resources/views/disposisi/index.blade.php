@extends('layouts.app')

@section('content')
<!-- Page Heading -->
<h1 class="h3 mb-4 text-gray-800">{{ $title }}</h1>

<!-- Modal Tambah Disposisi -->
<div class="modal fade" id="modalTambahDisposisi" tabindex="-1" role="dialog" aria-labelledby="modalTambahDisposisiLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalTambahDisposisiLabel">Form Tambah Disposisi</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Tutup">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form>
          <div class="form-group">
            <label for="id_surat">Pilih Surat</label>
            <select class="form-control" id="id_surat">
              <option value="">-- Pilih Surat --</option>
              <option value="1">001/SRT/IV/2025 - Undangan Rapat</option>
              <option value="2">002/SRT/IV/2025 - Permohonan Data</option>
              <!-- Data surat lainnya -->
            </select>
          </div>

          <div class="form-group">
            <label for="catatan_disposisi">Catatan Disposisi</label>
            <textarea class="form-control" id="catatan_disposisi" rows="3" placeholder="Masukkan catatan disposisi..."></textarea>
          </div>

          <div class="form-group">
            <label for="id_unit_kerja">Unit Kerja Tujuan</label>
            <select class="form-control" id="id_unit_kerja">
              <option value="">-- Pilih Unit Kerja --</option>
              <option value="1">Bagian Administrasi</option>
              <option value="2">Bagian Keuangan</option>
              <option value="3">Bagian Akademik</option>
              <!-- Data unit kerja lainnya -->
            </select>
          </div>
        </form>
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
        <button type="submit" class="btn btn-success">Simpan</button>
      </div>
    </div>
  </div>
</div>

<!-- Konten Utama -->
<div class="container-fluid mt-4">
  <div class="d-flex flex-column flex-md-row justify-content-between align-items-center mb-3">
    <a href="#" class="btn btn-primary mb-3" data-toggle="modal" data-target="#modalTambahDisposisi">+ Tambah Disposisi</a>

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
          <th>Judul Surat</th>
          <th>Catatan Disposisi</th>
          <th>Unit Kerja Tujuan</th>
          <th>Aksi</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>1</td>
          <td>001/SRT/IV/2025</td>
          <td>Undangan Rapat</td>
          <td>Segera ditindaklanjuti</td>
          <td>Bagian Administrasi</td>
          <td>
            <div class="d-flex flex-column flex-md-row">
              <a href="#" class="btn btn-sm btn-primary mr-md-2 mb-2 mb-md-0">Edit</a>
              <a href="#" class="btn btn-sm btn-danger">Hapus</a>
            </div>
          </td>
        </tr>
        <!-- Data disposisi lainnya -->
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
