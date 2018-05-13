<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePermissoesGrupoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Permissoes_Grupo', function (Blueprint $table) {
            $table->integer('idGrupo')->unsigned();
            $table->integer('idTelas')->unsigned();
            $table->primary(['idGrupo', 'idTelas']);

            $table->foreign('idGrupo')->references('idGrupo')->on('Grupo_Usuarios')->onDelete('cascade');
            $table->foreign('idTelas')->references('idTelas')->on('Telas_Sistema')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('Permissoes_Grupo');
    }
}
