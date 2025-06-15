@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4>Daftar Pengguna</h4>
        <button class="btn btn-primary" data-toggle="modal" data-target="#tambahUserModal">
            Tambah Pengguna
        </button>
    </div>

    {{-- Card untuk tabel pengguna --}}
    <div class="card shadow-sm">
       
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-bordered mb-0 table-hover">
                    <thead class="thead-light">
                        <tr>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Unit Kerja</th>
                            <th>Role</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($users as $user)
                        <tr>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->unitKerja->nama_unit_kerja ?? '-' }}</td>
                            <td>{{ $user->roles->pluck('name')->implode(', ') }}</td>
                            <td>
                                <select class="form-control status-dropdown" data-user-id="{{ $user->id }}">
                                    <option value="aktif" {{ $user->status === 'aktif' ? 'selected' : '' }}>Aktif</option>
                                    <option value="tidak aktif" {{ $user->status === 'tidak aktif' ? 'selected' : '' }}>Tidak Aktif</option>
                                </select>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center">Belum ada pengguna.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        @if ($users->hasPages())
        <div class="card-footer">
            {{ $users->links() }}
        </div>
        @endif
    </div>
</div>

{{-- Modal Tambah Pengguna --}}
<div class="modal fade" id="tambahUserModal" tabindex="-1" role="dialog" aria-labelledby="tambahUserModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <form action="{{ route('user.store') }}" method="POST" class="modal-content">
            @csrf
            <div class="modal-header">
                <h5 class="modal-title">Tambah Pengguna Baru</h5>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
            </div>
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
                    <div class="input-group">
                        <input type="password" name="password" id="passwordInput" class="form-control" required>
                        <div class="input-group-append">
                            <button class="btn btn-outline-secondary" type="button" id="togglePassword">
                                <i class="fa fa-eye"></i>
                            </button>
                        </div>
                    </div>
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
                <div class="form-group">
                    <label>Status</label>
                    <select name="status" class="form-control" required>
                        <option value="aktif">Aktif</option>
                        <option value="tidak aktif">Tidak Aktif</option>
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
@endsection

@push('scripts')
<script>
    document.querySelectorAll('.status-dropdown').forEach(function(select) {
        select.addEventListener('change', function() {
            const userId = this.getAttribute('data-user-id');
            const newStatus = this.value;

            fetch('{{ route('user.updateStatus') }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                },
                body: JSON.stringify({ user_id: userId, status: newStatus })
            })
            .then(response => response.json())
            .then(data => {
                if (!data.success) {
                    alert('Gagal mengubah status.');
                }
            })
            .catch(() => alert('Terjadi kesalahan.'));
        });
    });

    document.getElementById('togglePassword').addEventListener('click', function () {
        const input = document.getElementById('passwordInput');
        const icon = this.querySelector('i');
        input.type = input.type === 'password' ? 'text' : 'password';
        icon.classList.toggle('fa-eye');
        icon.classList.toggle('fa-eye-slash');
    });
</script>
@endpush
