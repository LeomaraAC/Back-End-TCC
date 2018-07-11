<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(TelasTableSeeder::class);
        $this->call(UserTableSeeder::class);
        $this->call(GrupoTableSeeder::class);
    }
}
