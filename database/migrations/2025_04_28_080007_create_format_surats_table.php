<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFormatSuratsTable extends Migration
{
    public function up()
    {
        Schema::create('format_surats', function (Blueprint $table) {
            $table->uuid('id')->primary(); // ID UUID sebagai primary key
            $table->integer('urutan');
            $table->string('teks_masukan');
            $table->enum('jenis_masukan', ['teks', 'number', 'radio', 'date']);
            $table->string('keterangan')->nullable();
            $table->unsignedBigInteger('id_formulir');

            $table->foreign('id_formulir')
                  ->references('id')
                  ->on('formulir_surats')
                  ->onDelete('cascade');

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('format_surats');
    }
}
