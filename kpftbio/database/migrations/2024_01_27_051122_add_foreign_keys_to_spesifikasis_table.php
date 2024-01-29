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
        Schema::table('spesifikasis', function (Blueprint $table) {
            $table->foreign(['jenis_alat_id'], 'fk_spesifikasi_jenis_alat')->references(['id'])->on('jenis_alats')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('spesifikasis', function (Blueprint $table) {
            $table->dropForeign('fk_spesifikasi_jenis_alat');
        });
    }
};
