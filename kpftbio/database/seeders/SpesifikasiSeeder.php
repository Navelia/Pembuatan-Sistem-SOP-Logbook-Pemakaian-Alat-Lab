<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SpesifikasiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table("spesifikasis")->insert([
            "nama" => "Spesifikasi 1.1",
            "spesifikasi" => "Ini Spesifikasi 1.1",
            "jenis_alat_id" => 1
        ]);

        DB::table("spesifikasis")->insert([
            "nama" => "Spesifikasi 1.2",
            "spesifikasi" => "Ini Spesifikasi 1.2",
            "jenis_alat_id" => 1
        ]);

        DB::table("spesifikasis")->insert([
            "nama" => "Spesifikasi 1.3",
            "spesifikasi" => "Ini Spesifikasi 1.3",
            "jenis_alat_id" => 1
        ]);

        DB::table("spesifikasis")->insert([
            "nama" => "Spesifikasi 2.1",
            "spesifikasi" => "Ini Spesifikasi 2.1",
            "jenis_alat_id" => 2
        ]);

        DB::table("spesifikasis")->insert([
            "nama" => "Spesifikasi 2.2",
            "spesifikasi" => "Ini Spesifikasi 2.2",
            "jenis_alat_id" => 2
        ]);

        DB::table("spesifikasis")->insert([
            "nama" => "Spesifikasi 2.2",
            "spesifikasi" => "Ini Spesifikasi 2.3",
            "jenis_alat_id" => 2
        ]);
    }
}
