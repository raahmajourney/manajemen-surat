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
        <form action="{{ route('disposisi.store') }}" method="POST" enctype="multipart/form-data">
          @csrf
          <div class="form-group">
            <label for="id_surat">Pilih Surat</label>
            <select class="form-control" id="id_surat" name="id_surat">
              <option value="">-- Pilih Surat --</option>
              @foreach ($surats as $surat)
                  <option value="{{ $surat->id }}">{{ $surat->nomor_surat }} - {{ $surat->judul }}</option>
              @endforeach
          </select>          
          </div>

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

<!-- Konten Utama -->
<div class="container-fluid mt-4">
  <div class="d-flex flex-column flex-md-row justify-content-between align-items-center mb-3">

    <div class="d-flex flex-column flex-md-row align-items-center"> 
    </div>
  </div>

  <div class="table-responsive">
    <table class="table table-bordered table-hover" id="datatable">
      <thead class="thead-light">
        <tr>
          <th>No</th>
          <th>Nomor Surat</th>
          <th>Judul Surat</th>
          <th>Catatan Disposisi</th>
          <th>Unit Kerja Tujuan</th>
          <th>File</th>
          <th>Aksi</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($disposisis as $index => $d)
        <tr>
            <td>{{ $index + 1 }}</td>
            <td>{{ $d->surat->nomor_surat }}</td>
            <td>{{ $d->surat->judul }}</td>
            <td>{{ $d->catatan_disposisi }}</td>
            <td>{{ $d->unitKerja?->nama_unit_kerja }}</td>

            <td>
              @if($d->file_disposisi)
              <a href="{{ asset('storage/' . $d->file_disposisi) }}" target="_blank" class="btn btn-sm btn-info">Lihat File</a>
            @else
              -
            @endif
            </td>
           
            <td>
              <div class="d-flex flex-column flex-md-row">
                  <a href="{{ route('disposisi.edit', $d->id) }}" class="btn btn-sm  mr-md-2 mb-2 mb-md-0">
                    <img src="{{ asset('img/edit.png') }}" alt="Edit" width="20" height="20">
                  </a>
                  
                  <form action="{{ route('disposisi.destroy', $d->id) }}" method="POST" class="form-delete">
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
        
        <!-- Data disposisi lainnya -->
      </tbody>
    </table>
  </div>

  <div class="d-flex flex-column flex-md-row justify-content-between align-items-center mt-3">
  </div>
</div>

@endsection

@push('scripts')
<script>
$(document).ready(function() {
    $('#datatable').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('disposisi.data') }}",
        columns: [
            { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
            { data: 'nomor_surat', name: 'surat.nomor_surat' },
            { data: 'judul', name: 'surat.judul' },
            { data: 'catatan_disposisi', name: 'catatan_disposisi' },
            { data: 'unit_kerja', name: 'unitKerja.nama_unit_kerja' },
            { data: 'file', name: 'file', orderable: false, searchable: false },
            { data: 'aksi', name: 'aksi', orderable: false, searchable: false },
        ]
    });
});
</script>

@endpush