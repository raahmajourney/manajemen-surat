<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDisposisisTable extends Migration
{
    public function up()
    {
        Schema::create('disposisis', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('id_surat');
            $table->string('catatan_disposisi');
            $table->unsignedBigInteger('id_unit_kerja');
            $table->timestamps();

            $table->foreign('id_surat')->references('id')->on('surats')->onDelete('cascade');
            $table->foreign('id_unit_kerja')->references('id')->on('unit_kerjas')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('disposisis');
    }
}
