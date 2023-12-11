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
            "gambar" => "https://demo.binabakti.co.id/wp-content/uploads/2021/04/2.-XSP-104-ok.jpg"
        ]);

        DB::table("jenis_alats")->insert([
            "nama" => "Jenis Alat 2",
            "deskripsi" => "Ini Deskripsi Jenis Alat 2",
            "gambar" => "https://www.flinnsci.com/globalassets/flinn-scientific/all-product-images-rgb-jpegs/ms1130.jpg"
        ]);
    }
}
