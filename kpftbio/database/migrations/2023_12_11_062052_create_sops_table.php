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
        Schema::create('sops', function (Blueprint $table) {
            $table->integer('id', true);
            $table->text('sop')->nullable();
            $table->integer('urutan')->nullable();
            $table->integer('jenis_alat_id')->index('fk_sop_jenis_alat1_idx');
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
        Schema::dropIfExists('sops');
    }
};
