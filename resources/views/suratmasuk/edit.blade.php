@extends('layouts.app')

@section('content')
<h1 class="h3 mb-4 text-gray-800">Edit Surat</h1>


<div class="container">
    <!-- Tombol Tambah Disposisi -->
<button type="button" class="btn btn-success mt-3 mb-3" data-toggle="modal" data-target="#modalTambahDisposisi">
  Tambahkan Disposisi
</button>
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>
    </div>
    @endif

    <form action="{{ route('suratmasuk.update', $surat->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="nomor_surat">Nomor Surat</label>
                <input type="text" class="form-control" id="nomor_surat" name="nomor_surat" value="{{ old('nomor_surat', $surat->nomor_surat) }}">
            </div>

            <div class="form-group col-md-6">
                <label for="judul">Judul Surat</label>
                <input type="text" class="form-control" id="judul" name="judul" value="{{ old('judul', $surat->judul) }}">
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
            
                  @error('id_jenis_surat')
                  <div class="text-danger">{{ $message }}</div>
                   @enderror
            </div>

            <div class="form-group col-md-6">
                <label for="nama_pengirim">Nama Pengirim</label>
                <input type="text" class="form-control" id="nama_pengirim" name="nama_pengirim" value="{{ old('nama_pengirim', $surat->nama_pengirim) }}">
            </div>
        </div>

        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="tanggal_surat">Tanggal Surat</label>
                <input type="date" class="form-control" id="tanggal_surat" name="tanggal_surat" value="{{ old('tanggal_surat', $surat->tanggal_surat) }}">
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
        
        <a href="{{ route('suratmasuk') }}" class="btn btn-secondary">Kembali</a>

    </form>
</div>


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

      <form action="{{ route('disposisi.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="modal-body">

          {{-- Hidden input agar id_surat langsung dibawa --}}
          <input type="hidden" name="id_surat" value="{{ $surat->id }}">

          <div class="form-group">
            <label for="catatan_disposisi">Catatan Disposisi</label>
            <textarea class="form-control" id="catatan_disposisi" name="catatan_disposisi" rows="3" placeholder="Masukkan catatan disposisi..."></textarea>
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
