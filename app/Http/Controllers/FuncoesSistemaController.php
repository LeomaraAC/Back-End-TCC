<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Telas_Sistema as Funcoes;

class FuncoesSistemaController extends Controller
{
    public function index($order, $size, $filter = null) {
        $listaGrupo = Funcoes::orderBy('nomeTela', $order)->where('nomeTela', 'like', '%'.$filter.'%')->paginate($size);
        return response()->json($listaGrupo);
    }
}
