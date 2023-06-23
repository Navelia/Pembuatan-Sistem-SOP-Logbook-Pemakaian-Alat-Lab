<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRiwayatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('riwayats', function (Blueprint $table) {
            $table->id();
            $table->string("nama_peminjam");
            $table->string("nrp");
            $table->date("tanggal");
            $table->integer("jam_mulai");
            $table->integer("jam_selesai");
            $table->unsignedBigInteger("alat_id");
            $table->timestamps();

            $table->foreign("alat_id")->references("id")->on("alats");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('riwayats');
    }
}
