@extends('layouts.app')

@section('content')

<!-- Modal Tambah Unit -->
<div class="modal fade" id="modalTambahUnit" tabindex="-1" role="dialog" aria-labelledby="modalTambahUnitLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <form  method="POST" action="{{ route('unitkerja.store') }}">
      @csrf
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Form Tambah Bagian/Unit Kerja</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Tutup">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <label for="nama_bagian">Nama Bagian</label>
            <input type="text" name="nama_unit_kerja" class="form-control" required>
          </div>

          <div class="form-group">
            <label for="tipe_unit">Tipe/Level Unit Kerja</label>
            <select name="jenis_unit_kerja" class="form-control" required>
                <option value="Rektorat">Rektorat</option>
                <option value="Fakultas">Fakultas</option>
                <option value="Prodi">Program Studi</option>
                <option value="Biro/UPT">Biro/UPT</option>
            </select>
        </div>
        

          <div class="form-group">
            <label for="induk_unit">Unit Induk (Opsional)</label>
            <select name="parent_unit_kerja" class="form-control">
              <option value="">-- Tidak Ada --</option>

              @foreach ($unitkerjas as $item)
                <option value="{{ $item->id }}">{{ $item->nama_unit_kerja }}</option>
               @endforeach

            </select>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
          <button type="submit" class="btn btn-success">Simpan</button>
        </div>
      </div>
    </form>
  </div>
</div>

<h1 class="h3 mb-4 text-gray-800">{{ $title }}</h1>
<div class="container mt-4">
  <div class="d-flex justify-content-between align-items-center flex-wrap mb-3">
    <a href="#" class="btn btn-primary mb-3" data-toggle="modal" data-target="#modalTambahUnit">+ Tambah Unit Kerja</a>
  </div>

  <div class="table-responsive">
    <table class="table table-bordered table-hover">
      <thead class="thead-light">
        <tr>
          <th>No.</th>
          <th>Nama Bagian</th>
          <th>Jenis Unit</th>
          <th>Induk Unit</th>
          <th>Aksi</th>
        </tr>
      </thead>

      <tbody>
        @foreach ($unitkerjas as $index => $unit)
        <tr>
            <td>{{ $index + 1 }}</td>
            <td>{{ $unit->nama_unit_kerja }}</td>
            <td>{{ $unit->jenis_unit_kerja }}</td>
            <td>
                @php
                    $induk = $unitkerjas->firstWhere('id', $unit->parent_unit_kerja);
                @endphp
                {{ $induk ? $induk->nama_unit_kerja : '-' }}
            </td>

            <td>
                <a href="{{ route('unitkerja.edit', $unit->id) }}" class="btn btn-sm  mb-1">
                  <img src="{{ asset('img/edit.png') }}" alt="Edit" width="20" height="20">
                </a>
                <form action="{{ route('unitkerja.destroy', $unit->id) }}" method="POST" class="d-inline">
                    @csrf 
                    @method('DELETE')
                    <button type="submit" class="btn btn-sm mb-1" onclick="return confirm('Yakin hapus data ini?')">
                      <img src="{{ asset('img/delete.png') }}" alt="Hapus" width="20" height="20">
                    </button>
                </form>
            </td>

        </tr>
        @endforeach
    </tbody>
    
      
    </table>
  </div>
</div>
@endsection
