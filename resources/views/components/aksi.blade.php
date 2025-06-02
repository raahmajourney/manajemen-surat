@php
    // Pastikan variabel $model dan $routePrefix dikirim dari controller
    $modelId = $model->id ?? null;
@endphp

<div class="btn-group" role="group" aria-label="Aksi Surat">
    <a href="{{ route($routePrefix . '.show', $modelId) }}" class="btn btn-sm btn-primary" title="Lihat Detail">
        <i class="fas fa-eye"></i> Detail
    </a>

    <a href="{{ $edit }}" class="btn btn-sm btn-warning" title="Edit Surat">
        <i class="fas fa-edit"></i> Edit
    </a>

    <form action="{{ $delete }}" method="POST" onsubmit="return confirm('Yakin hapus surat ini?')" style="display:inline;">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-sm btn-danger" title="Hapus Surat">
            <i class="fas fa-trash-alt"></i>
        </button>
    </form>
</div>
