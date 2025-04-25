@extends('layouts.app')

@section('content')

<!-- Modal Tambah Data -->
<div class="modal fade" id="modalTambah" tabindex="-1" role="dialog" aria-labelledby="modalTambahLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modalTambahLabel">Form Tambah Data</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Tutup">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form>
            <div class="form-group">
              <label for="nama">Nama</label>
              <input type="text" class="form-control" id="nama" placeholder="Masukkan nama">
            </div>
            <div class="form-group">
              <label for="email">Email</label>
              <input type="email" class="form-control" id="email" placeholder="Masukkan email">
            </div>
            <div class="form-group">
              <label for="level">Level</label>
              <select class="form-control" id="level">
                <option value="">-- Pilih Level --</option>
                <option value="admin">Admin</option>
                <option value="user">User</option>
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
  


<h1 class="h3 mb-4 text-gray-800">{{ $title }}</h1>
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center flex-wrap mb-3">
        
        <a href="#" class="btn btn-primary mb-3" data-toggle="modal" data-target="#modalTambah">+ Tambah Data</a>

    </div>

    <div class="row mb-3">
        <div class="col-md-6 mb-2">
            <label for="tampilkan">Tampilkan</label>
            <select id="tampilkan" class="form-control w-auto d-inline-block ml-2">
                <option selected>10</option>
                <option>25</option>
                <option>50</option>
            </select> data
        </div>
        <div class="col-md-6 text-md-right">
            <label for="search" class="mr-2">Cari:</label>
            <input type="text" id="search" class="form-control d-inline-block w-50 w-sm-100">
        </div>
    </div>

    <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <thead class="thead-light">
                <tr>
                    <th>No.</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Level</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td>Rahma</td>
                    <td>rahma@gmail.com</td>
                    <td>admin</td>
                    <td>
                        <a href="#" class="btn btn-sm btn-primary mb-1">Edit</a>
                        <a href="#" class="btn btn-sm btn-danger mb-1">Hapus</a>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    <div class="d-flex justify-content-between flex-column flex-md-row align-items-center mt-3">
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


