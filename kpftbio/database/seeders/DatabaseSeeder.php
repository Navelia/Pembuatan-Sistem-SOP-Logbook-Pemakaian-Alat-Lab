<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(JenisAlatSeeder::class);
        $this->call(AlatSeeder::class);
        $this->call(SpesifikasiSeeder::class);
        $this->call(SopSeeder::class);
        $this->call(RiwayatSeeder::class);
    }
}
