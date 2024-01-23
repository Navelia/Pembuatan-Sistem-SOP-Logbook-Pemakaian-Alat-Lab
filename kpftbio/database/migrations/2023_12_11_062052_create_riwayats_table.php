<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('riwayats', function (Blueprint $table) {
            $table->integer('id', true);
            $table->string('nama', 255)->nullable();
            $table->string('nrp', 255)->nullable();
            $table->date('tanggal')->nullable();
            $table->float('jam_mulai')->nullable();
            $table->float('jam_selesai')->nullable();
            $table->integer('alat_id')->index('fk_riwayat_alat1_idx');
            $table->timestamps();
            $table->softDeletes();
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
};
