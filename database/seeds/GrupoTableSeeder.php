<?php

use Illuminate\Database\Seeder;

class GrupoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        factory(App\Grupo_Usuarios::class,10)->create()->each(function($a) {
            $a->funcoes()->attach(App\Telas_Sistema::all()->random(3));
        });
    }
}
