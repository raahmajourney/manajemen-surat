<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSuratsTable extends Migration
{
    public function up()
    {
        Schema::create('surats', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('nomor_surat');
            $table->string('judul');
            $table->text('isi');
            $table->foreignId('id_jenis_surat')->constrained('jenis_surats');
            $table->string('nama_pengirim');
            $table->date('tanggal_surat');
            $table->string('status');

           // $table->foreignId('dibuat_oleh')->constrained('users');
           // $table->foreignId('diupdate_oleh')->nullable()->constrained('users');

           $table->foreignId('dibuat_oleh')->nullable()->constrained('users');
           $table->foreignId('diupdate_oleh')->nullable()->constrained('users');


            $table->string('file_surat')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('surats');
    }
}
