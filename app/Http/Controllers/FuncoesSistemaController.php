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
    public function filter(Request $request) {
        $listaGrupo = Funcoes::orderBy('nomeTela')->where('nomeTela', 'like', '%'.$request->filtro.'%')->get();
        return $listaGrupo;
    }
}
