@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h1 class="h3 mb-4 text-gray-800">Log Aktivitas Surat</h1>

    <div class="card shadow p-4">
        <!-- Tambahkan table-responsive -->
        <div class="table-responsive">
            <table class="table table-bordered table-striped table-hover">
                <thead class="thead-light">
                    <tr>
                        <th>#</th>
                        <th>Judul Surat</th>
                        <th>Aktivitas</th>
                        <th>User</th>
                        <th>Waktu</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($logs as $index => $log)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $log->surat->judul ?? '-' }}</td>
                            <td>{{ $log->aktivitas }}</td>
                            <td>{{ $log->user->name ?? 'User tidak ditemukan' }}</td>
                            <td>{{ $log->created_at->format('d-m-Y H:i') }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center">Tidak ada log aktivitas.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
