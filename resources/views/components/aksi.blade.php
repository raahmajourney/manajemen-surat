<div class="btn-group" role="group" aria-label="Aksi Surat">
    <a href="{{ route('suratmasuk.show', $row->id) }}" class="btn btn-sm btn-primary" title="Lihat Detail">
        <i class="fas fa-eye"></i> Detail
    </a>
    
    <a href="{{ $edit }}" class="btn btn-sm btn-warning" title="Edit Surat">
        <i class="fas fa-edit"></i> Edit
    </a>
    
    <form action="{{ $delete }}" method="POST" onsubmit="return confirm('Yakin hapus surat ini?')" style="display:inline;">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-sm btn-danger" title="Hapus Surat">
            <i class="fas fa-trash-alt"></i> Hapus
        </button>
    </form>
</div>
