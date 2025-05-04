<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLogSuratsTable extends Migration
{
    public function up()
    {
        Schema::create('log_surats', function (Blueprint $table) {
            $table->id();
            $table->uuid('id_surat');
            $table->foreignId('id_user')->constrained('users');
            $table->string('aktivitas');
            $table->timestamps();

            $table->foreign('id_surat')->references('id')->on('surats')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('log_surats');
    }
}
