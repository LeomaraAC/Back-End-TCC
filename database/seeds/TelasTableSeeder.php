<?php

use Illuminate\Database\Seeder;

class TelasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = array(
            array('nomeTela'=>'Incluir Grupo', 'siglaTela'=> 'inGru'),
            array('nomeTela'=>'Editar Grupo', 'siglaTela'=> 'edGru'),
            array('nomeTela'=>'Apagar Grupo', 'siglaTela'=> 'exGru')
        );
        DB::table('telas_sistema')->insert($data);
    }
}
