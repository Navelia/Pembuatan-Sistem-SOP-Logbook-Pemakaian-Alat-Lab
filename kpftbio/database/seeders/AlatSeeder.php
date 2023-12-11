<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AlatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table("alats")->insert([
            "nomor" => 1,
            "jenis_alat_id" => 1
        ]);

        DB::table("alats")->insert([
            "nomor" => 2,
            "jenis_alat_id" => 1
        ]);

        DB::table("alats")->insert([
            "nomor" => 3,
            "jenis_alat_id" => 1
        ]);

        DB::table("alats")->insert([
            "nomor" => 1,
            "jenis_alat_id" => 2
        ]);

        DB::table("alats")->insert([
            "nomor" => 2,
            "jenis_alat_id" => 2
        ]);

        DB::table("alats")->insert([
            "nomor" => 3,
            "jenis_alat_id" => 2
        ]);
    }
}
