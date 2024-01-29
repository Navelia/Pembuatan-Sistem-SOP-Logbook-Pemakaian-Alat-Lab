<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LabSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table("labs")->insert([
            "nama" => "Lab 1"
        ]);

        DB::table("labs")->insert([
            "nama" => "Lab 2"
        ]);

        DB::table("labs")->insert([
            "nama" => "Lab 3"
        ]);

        DB::table("labs")->insert([
            "nama" => "Lab 4"
        ]);

        DB::table("labs")->insert([
            "nama" => "Lab 5"
        ]);

        DB::table("labs")->insert([
            "nama" => "Lab 6"
        ]);
    }
}
