<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSaranTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('saran', function (Blueprint $table) {
            $table->id();
            $table->string('topik_saran');
            $table->text('saran');
            $table->string('nama_pengirim')->nullable();
            $table->string('telepon')->nullable();
            $table->string('file_bukti')->nullable();
            $table->foreignId('divisi_id')->constrained('divisi');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('saran');
    }
}
