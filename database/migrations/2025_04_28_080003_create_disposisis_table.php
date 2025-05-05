<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDisposisisTable extends Migration
{
    public function up()
    {
        Schema::create('disposisis', function (Blueprint $table) {
            $table->uuid('id')->primary(); // ID Disposisi (PK)
            $table->uuid('id_surat'); // FK ke tabel 'surats'
            $table->string('catatan_disposisi'); // Catatan Disposisi
            $table->unsignedBigInteger('id_unit_kerja'); // FK ke tabel 'unit_kerjas'
            $table->string('file_surat')->nullable();
            $table->timestamps();

            // Relasi ke tabel 'surats'
            $table->foreign('id_surat')->references('id')->on('surats')->onDelete('cascade');
            // Relasi ke tabel 'unit_kerja'
            $table->foreign('id_unit_kerja')->references('id')->on('unit_kerja')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('disposisis');
    }
}
