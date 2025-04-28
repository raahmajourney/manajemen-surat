@extends('layouts.app')

@section('content')
<section class="content card" style="padding: 10px 10px 10px 10px">
    <div class="box">
        <form>
            <h3><i class="nav-icon fas fa-envelope my-1 btn-sm-1"></i> Tambah Data Surat Keluar</h3>
            <hr>
            <div class="row">
                <div class="col-6">
                    <label for="nomorsurat">Nomor Surat</label>
                    <input name="no_surat" type="text" class="form-control" id="nomorsurat"
                        placeholder="Nomor Surat" required>

                    <label for="tujuansurat">Tujuan Surat</label>
                    <input name="tujuan_surat" type="text" class="form-control bg-light"
                        id="tujuansurat" placeholder="Tujuan Surat" required>

                    <label for="isisurat">Isi Ringkas</label>
                    <textarea name="isi" class="form-control bg-light" id="isisurat" rows="3"
                        placeholder="Isi Ringkas Surat Keluar" required></textarea>

                    <label for="kode">Kode Klasifikasi</label>
                    <select name="kode" class="custom-select my-1 mr-sm-2 bg-light" id="inlineFormCustomSelectPref"
                        required>
                        <option value="">-- Pilih Klasifikasi Surat --</option>
                        <!-- Dummy options -->
                        <option value="001">Umum (001)</option>
                        <option value="002">Kepegawaian (002)</option>
                        <option value="003">Keuangan (003)</option>
                    </select>
                </div>
                <div class="col-6">
                    <label for="tglsurat">Tanggal Surat</label>
                    <input name="tgl_surat" type="date" class="form-control bg-light"
                        id="tglsurat" required>

                    <label for="tglcatat">Tanggal Catat</label>
                    <input name="tgl_catat" type="date" class="form-control bg-light"
                        id="tglcatat" required>

                    <label for="keterangan">Keterangan</label>
                    <input name="keterangan" type="text" class="form-control bg-light"
                        id="keterangan" placeholder="Keterangan" required>

                    <div class="custom-file mt-2">
                        <label for="validatedCustomFile">File</label>
                        <input name="filekeluar" type="file" class="form-control-file" id="validatedCustomFile"
                            required>
                        <small class="text-danger">
                            Pastikan file anda ( jpg, jpeg, png, doc, docx, pdf ) !!!
                        </small>
                    </div>
                </div>
            </div>
            <hr>
            <button type="submit" class="btn btn-success btn-sm"><i class="fas fa-save"></i> SIMPAN</button>
            <a class="btn btn-danger btn-sm" href="#" role="button"><i class="fas fa-undo"></i> BATAL</a>
        </form>
    </div>
</section>
@endsection
