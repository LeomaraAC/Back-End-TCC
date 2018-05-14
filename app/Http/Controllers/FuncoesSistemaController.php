<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Telas_Sistema as Funcoes;

class FuncoesSistemaController extends Controller
{
    public function index() {
        $listaGrupo = Funcoes::orderBy('nomeTela')->get();
        return $listaGrupo;
    }
}
