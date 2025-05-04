<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJenisSuratsTable extends Migration
{
    public function up()
    {
        Schema::create('jenis_surats', function (Blueprint $table) {
            $table->id(); // PK int
            $table->string('nama_jenis_surat');
            $table->timestamps();
        });

     
    }

    public function down()
    {
        Schema::dropIfExists('jenis_surats');
    }
}
