<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSpesifikasisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('spesifikasis', function (Blueprint $table) {
            $table->id();
            $table->string("nama_spesifikasi");
            $table->string("spesifikasi");
            $table->unsignedBigInteger('alat_id');
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
        Schema::dropIfExists('spesifikasis');
    }
}
