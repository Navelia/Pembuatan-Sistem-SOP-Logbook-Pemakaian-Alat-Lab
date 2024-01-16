<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JenisAlatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table("jenis_alats")->insert([
            "nama" => "Jenis Alat 1",
            "deskripsi" => "Ini Deskripsi Jenis Alat 1",
            "gambar" => "jenis-1.jpg"
        ]);

        DB::table("jenis_alats")->insert([
            "nama" => "Jenis Alat 2",
            "deskripsi" => "Ini Deskripsi Jenis Alat 2",
            "gambar" => "jenis-2.jpg"
        ]);
    }
}
