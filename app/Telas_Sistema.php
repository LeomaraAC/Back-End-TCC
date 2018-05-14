<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Telas_Sistema extends Model
{
    use SoftDeletes;
    protected $table = 'Telas_Sistema';
    protected $primaryKey = 'idTelas';
    protected $dates = ['deleted_at'];
    protected $hidden = ['deleted_at'];


    public function grupos()
    {
        return $this->belongsToMany(Grupo_Usuarios::class,'permissoes_grupo','idTelas','idGrupo');
    }
}
