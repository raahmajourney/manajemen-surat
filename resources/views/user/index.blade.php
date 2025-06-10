@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4>Daftar Pengguna</h4>
        <button class="btn btn-primary" data-toggle="modal" data-target="#tambahUserModal">
            Tambah Pengguna
        </button>
    </div>

    {{-- Tabel pengguna --}}
    <div class="table-responsive">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Unit Kerja</th>
                    <th>Role</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($users as $user)
                    <tr>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->unitKerja->nama_unit_kerja ?? '-' }}</td>
                        <td>{{ $user->roles->pluck('name')->implode(', ') }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center">Belum ada pengguna.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        {{-- Pagination --}}
        {{ $users->links() }}
    </div>
</div>

{{-- Modal Tambah Pengguna --}}
<div class="modal fade" id="tambahUserModal" tabindex="-1" role="dialog" aria-labelledby="tambahUserModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tambahUserModalLabel">Tambah Pengguna Baru</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Tutup">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('user.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label>Nama</label>
                        <input type="text" name="name" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" name="email" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" name="password" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label>Unit Kerja</label>
                        <select name="unit_kerja_id" class="form-control" required>
                            <option value="">-- Pilih Unit Kerja --</option>
                            @foreach($unitKerjas as $unit)
                                <option value="{{ $unit->id }}">{{ $unit->nama_unit_kerja }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Role</label>
                        <select name="role" class="form-control" required>
                            <option value="">-- Pilih Role --</option>
                            <option value="admin">Admin</option>
                            <option value="dosen">Dosen</option>
                            <option value="staf">Staf</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
