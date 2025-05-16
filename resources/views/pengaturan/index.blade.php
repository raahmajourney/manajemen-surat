@extends('layouts.app') 

@section('content')
<div class="container">
    <h4 class="mb-4">Pengaturan Akun</h4>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form method="POST" action="{{ route('pengaturan.update') }}">
        @csrf

        <div class="form-group">
            <label>Nama</label>
            <input type="text" name="name" class="form-control" value="{{ old('name', Auth::user()->name) }}" required>
        </div>
        @error('name')
        <small class="text-danger">{{ $message }}</small>
        @enderror

        <div class="form-group">
            <label>Email</label>
            <input type="email" class="form-control" value="{{ Auth::user()->email }}" disabled>
        </div>

       <div class="form-group">
            <label>Password Baru (opsional)</label>
            <div class="input-group">
                <input type="password" name="password" id="password" class="form-control">
                <div class="input-group-append">
                    <button type="button" class="btn btn-outline-secondary toggle-password" data-target="#password">
                        <i class="fas fa-eye"></i>
                    </button>
                </div>
            </div>
            <small class="text-muted">Kosongkan jika tidak ingin mengubah password.</small>
            @error('password')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
            <div class="form-group">
            <label>Konfirmasi Password Baru</label>
            <div class="input-group">
                <input type="password" name="password_confirmation" id="password_confirmation" class="form-control">
                <div class="input-group-append">
                    <button type="button" class="btn btn-outline-secondary toggle-password" data-target="#password_confirmation">
                        <i class="fas fa-eye"></i>
                    </button>
                </div>
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
        <a href="{{ url()->previous() }}" class="btn btn-secondary">Kembali</a>
        


    </form>
</div>


<script>
    document.querySelectorAll('.toggle-password').forEach(button => {
        button.addEventListener('click', function () {
            const target = document.querySelector(this.dataset.target);
            const icon = this.querySelector('i');

            if (target.type === 'password') {
                target.type = 'text';
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            } else {
                target.type = 'password';
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            }
        });
    });
</script>

@endsection
