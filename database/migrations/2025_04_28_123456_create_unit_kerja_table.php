<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUnitKerjaTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('unit_kerja', function (Blueprint $table) {
            $table->increments('id'); // Primary Key, int, auto increment
            $table->string('nama_unit_kerja');
            $table->string('jenis_unit_kerja');
            $table->integer('parent_unit_kerja')->nullable(); // int, bisa null (FK ke unit_kerja.id)

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('unit_kerja');
    }
}
