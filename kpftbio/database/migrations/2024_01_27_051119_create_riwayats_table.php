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
            $table->string('nama')->nullable();
            $table->string('nrp')->nullable();
            $table->date('tanggal')->nullable();
            $table->double('jam_mulai', 8, 2)->nullable();
            $table->double('jam_selesai', 8, 2)->nullable();
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
