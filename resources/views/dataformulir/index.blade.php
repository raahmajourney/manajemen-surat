@extends('layouts.app')


@if(session('success'))
  <div class="alert alert-success alert-dismissible fade show" role="alert">
    {{ session('success') }}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
@endif

@section('content')
<h1 class="h3 mb-4 text-gray-800">{{ $title }}</h1>

<div class="container-fluid mt-4">
  <div class="d-flex justify-content-between align-items-center mb-3">
    <a href="{{ route('formulir') }}" class="btn btn-primary">+ Tambah Formulir</a>
  </div>

  <div class="table-responsive">
    <table class="table table-bordered table-hover">
      <thead class="thead-light">
        <tr>
          <th>No</th>
          <th>Nama Formulir</th>
          <th>Unit Kerja</th>
          <th>Tampilkan</th>
          <th>Visibilitas</th>
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
          <td>{{ $f->visibilitas }}</td>
          <td>
            @if($f->template_surat)
              <a href="{{ asset('storage/' . $f->template_surat) }}" target="_blank" class="btn btn-sm btn-info">Lihat Template</a>
            @else
              <span class="text-muted">Tidak Ada</span>
            @endif
          </td>
          <td>
            <div class="d-flex">
              <a href="{{ route('formulir.edit', $f->id) }}" class="btn btn-sm mr-2">
                <img src="{{ asset('img/edit.png') }}" alt="Edit" width="20">
              </a>

              <form action="{{ route('formulirsurat.destroy', $f->id) }}" method="POST" class="form-delete">
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
