@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="h3 mb-2 text-gray-800">Edit Surat</h1>

     <a href="{{ route('suratmasuk') }}" class="btn btn-secondary mb-4">Kembali</a>
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>
    </div>
    @endif

    <!-- Card Form Edit Surat -->
    <div class="card shadow mb-4">
        <div class="card-header">
            <h6 class="m-0 font-weight-bold text-primary">Form Edit Surat</h6>
        </div>
        <div class="card-body">
            <form action="{{ route('suratmasuk.update', $surat->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="nomor_surat">Nomor Surat</label>
                        <input type="text" class="form-control" id="nomor_surat" name="nomor_surat"
                            value="{{ old('nomor_surat', $surat->nomor_surat) }}">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="judul">Judul Surat</label>
                        <input type="text" class="form-control" id="judul" name="judul"
                            value="{{ old('judul', $surat->judul) }}">
                    </div>
                </div>

                <div class="form-group">
                    <label for="isi">Isi Surat</label>
                    <textarea class="form-control" id="isi" name="isi" rows="4">{{ old('isi', $surat->isi) }}</textarea>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="id_jenis_surat">Jenis Surat</label>
                        <select class="form-control" id="id_jenis_surat" name="id_jenis_surat" readonly>
                            <option value="1" selected>Surat Masuk</option>
                        </select>
                        @error('id_jenis_surat')<div class="text-danger">{{ $message }}</div>@enderror
                    </div>
                    <div class="form-group col-md-6">
                        <label for="nama_pengirim">Nama Pengirim</label>
                        <input type="text" class="form-control" id="nama_pengirim" name="nama_pengirim"
                            value="{{ old('nama_pengirim', $surat->nama_pengirim) }}">
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="tanggal_surat">Tanggal Surat</label>
                        <input type="date" class="form-control" id="tanggal_surat" name="tanggal_surat"
                            value="{{ old('tanggal_surat', $surat->tanggal_surat) }}">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="status">Status</label>
                        <select class="form-control" id="status" name="status">
                            <option value="aktif" {{ old('status', $surat->status) == 'aktif' ? 'selected' : '' }}>Aktif</option>
                            <option value="arsip" {{ old('status', $surat->status) == 'arsip' ? 'selected' : '' }}>Arsip</option>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label for="file_surat">Upload File Baru (opsional)</label><br>
                    @if ($surat->file_surat)
                        <a href="{{ asset('storage/' . $surat->file_surat) }}" target="_blank">Lihat File Saat Ini</a><br><br>
                    @endif
                    <input type="file" class="form-control-file" id="file_surat" name="file_surat">
                </div>

                <button type="submit" class="btn btn-primary">Update Surat</button>
               
            </form>
        </div>
    </div>

     <!-- Tombol Tambah Disposisi -->
    <button type="button" class="btn btn-success mb-3" data-toggle="modal" data-target="#modalTambahDisposisi">
        Tambah Disposisi
    </button>
    <!-- Tabel Disposisi -->
    @if($surat->disposisis->count())
    <div class="card shadow">
        <div class="card-header">
            <h6 class="m-0 font-weight-bold text-info">Daftar Disposisi</h6>
        </div>
        <div class="card-body">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Catatan</th>
                        <th>Unit Kerja</th>
                        <th>File</th>
                        <th>Tanggal</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($surat->disposisis as $index => $disposisi)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $disposisi->catatan_disposisi }}</td>
                        <td>{{ $disposisi->unitKerja->nama_unit_kerja ?? '-' }}</td>
                        <td>
                            @if ($disposisi->file_disposisi)
                            <a href="{{ asset('storage/' . $disposisi->file_disposisi) }}" target="_blank">Lihat File</a>
                            @else
                            Tidak Ada File
                            @endif
                        </td>
                        <td>{{ $disposisi->created_at->format('d/m/Y') }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    @endif

</div>

<!-- Modal Tambah Disposisi -->
<div class="modal fade" id="modalTambahDisposisi" tabindex="-1" role="dialog" aria-labelledby="modalTambahDisposisiLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Form Tambah Disposisi</h5>
        <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
      </div>
      <form action="{{ route('disposisi.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="modal-body">
          <input type="hidden" name="id_surat" value="{{ $surat->id }}">

          <div class="form-group">
            <label for="catatan_disposisi">Catatan Disposisi</label>
            <textarea class="form-control" id="catatan_disposisi" name="catatan_disposisi" rows="3"></textarea>
          </div>

          <div class="form-group">
            <label for="id_unit_kerja">Unit Kerja Tujuan</label>
            <select class="form-control" id="id_unit_kerja" name="id_unit_kerja">
              <option value="">-- Pilih Unit Kerja --</option>
              @foreach ($unitKerjas as $unit)  
                <option value="{{ $unit->id }}">{{ $unit->nama_unit_kerja }}</option>
              @endforeach
            </select>
          </div>

          <div class="form-group">
            <label for="file_disposisi">Upload File Bukti Disposisi</label>
            <input type="file" class="form-control-file" id="file_disposisi" name="file_disposisi">
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
          <button type="submit" class="btn btn-success">Simpan</button>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection
