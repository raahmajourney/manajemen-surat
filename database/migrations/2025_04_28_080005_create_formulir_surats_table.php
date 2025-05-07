<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFormulirSuratsTable extends Migration
{
    public function up()
    {
        Schema::create('formulir_surats', function (Blueprint $table) {
            $table->id();
            $table->string('nama_formulir');
            $table->unsignedBigInteger('id_uker_pengelola');
            $table->char('tampilkan', 5)->default('TIDAK'); // YA atau TIDAK
            $table->string('template_surat')->nullable();
            $table->char('visibilitas', 7)->default('Private');

            $table->timestamps();

            $table->foreign('id_uker_pengelola')->references('id')->on('unit_kerja')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('formulir_surats');
    }
}
