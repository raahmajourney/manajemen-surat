@extends('layouts.app')

@section('content')
<div class="container mt-4">
  <h1 class="mb-4">{{ $title }}</h1>

  <form method="POST" action="{{ route('unitkerja.update', $unit->id) }}">
    @csrf
    @method('PUT')

    <div class="form-group">
      <label>Nama Unit Kerja</label>
      <input type="text" name="nama_unit_kerja" value="{{ $unit->nama_unit_kerja }}" class="form-control" required>
    </div>

    <div class="form-group">
      <label>Jenis Unit Kerja</label>
      <input type="text" name="jenis_unit_kerja" value="{{ $unit->jenis_unit_kerja }}" class="form-control" required>
    </div>

    <div class="form-group">
      <label>Parent Unit (Opsional)</label>
      <select name="parent_unit_kerja" class="form-control">
        <option value="">-- Tidak Ada --</option>
        @foreach ($unitkerjas as $item)
          <option value="{{ $item->id }}" {{ $unit->parent_unit_kerja == $item->id ? 'selected' : '' }}>
            {{ $item->nama_unit_kerja }}
          </option>
        @endforeach
      </select>
    </div>

    <button type="submit" class="btn btn-success">Simpan Perubahan</button>
    <a href="{{ route('unitkerja') }}" class="btn btn-secondary">Batal</a>
  </form>
</div>
@endsection
