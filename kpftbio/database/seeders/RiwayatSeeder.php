<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RiwayatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table("riwayats")->insert([
            "nama" => "Ryan 1",
            "nrp" => "123",
            "tanggal" => "2023-12-08",
            "jam_mulai" => 11,
            "jam_selesai" => 12,
            "alat_id" => 1
        ]);

        DB::table("riwayats")->insert([
            "nama" => "Ryan 2",
            "nrp" => "234",
            "tanggal" => "2023-12-08",
            "jam_mulai" => 12,
            "jam_selesai" => 13,
            "alat_id" => 1
        ]);

        DB::table("riwayats")->insert([
            "nama" => "Ryan 3",
            "nrp" => "345",
            "tanggal" => "2023-12-08",
            "jam_mulai" => 13,
            "jam_selesai" => 14,
            "alat_id" => 2
        ]);

        DB::table("riwayats")->insert([
            "nama" => "Ryan 4",
            "nrp" => "456",
            "tanggal" => "2023-12-08",
            "jam_mulai" => 14,
            "jam_selesai" => 15,
            "alat_id" => 2
        ]);
    }
}
