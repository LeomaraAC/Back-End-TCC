<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Telas_Sistema extends Model
{
    protected $table = 'Telas_Sistema';
    protected $primaryKey = 'idTelas';


    public function grupos()
    {
        return $this->belongsToMany(Grupo_Usuarios::class,'permissoes_grupo','idTelas','idGrupo');
    }
}
