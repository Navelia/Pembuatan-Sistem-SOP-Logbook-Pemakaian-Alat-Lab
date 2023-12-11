<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SopSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table("sops")->insert([
            "sop" => "SOP 1.1",
            "urutan" => 1,
            "jenis_alat_id" => 1
        ]);

        DB::table("sops")->insert([
            "sop" => "SOP 1.2",
            "urutan" => 2,
            "jenis_alat_id" => 1
        ]);

        DB::table("sops")->insert([
            "sop" => "SOP 1.3",
            "urutan" => 3,
            "jenis_alat_id" => 1
        ]);

        DB::table("sops")->insert([
            "sop" => "SOP 2.1",
            "urutan" => 1,
            "jenis_alat_id" => 2
        ]);

        DB::table("sops")->insert([
            "sop" => "SOP 2.2",
            "urutan" => 2,
            "jenis_alat_id" => 2
        ]);

        DB::table("sops")->insert([
            "sop" => "SOP 2.3",
            "urutan" => 3,
            "jenis_alat_id" => 2
        ]);
    }
}
