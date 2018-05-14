<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Telas_Sistema as Funcoes;
use App\Grupo_Usuarios as Grupo;

class GruposUsersController extends Controller
{
    public function store(Request $request) {
        $hasError = false;
        //Gravando o novo grupo
        $grupo = new Grupo;
        $grupo->nomeGrupo = $request->nomeGrupo;
        $grupo->save();
        // Informando as permssoes do grupo
        foreach ($request->funcoes as $idFuncao) {
            $funcao = Funcoes::find($idFuncao);
            if ($funcao != null)
                $grupo->funcoes()->attach($funcao->idTelas);
            else
                $hasError = true;
        }
        if(!$hasError)
            return response()->json(['message' => 'Grupo criado com sucesso']);
        else
            return response()->json(['message'=>'Ops! Ocorreu um erro. O grupo pode não ter sido criado corretamente'],'500');
    }
    public function index() {
        $listaGrupo = Grupo::all();
        return $listaGrupo;
    }
    public function show($id) {
        $grupo = Grupo::find($id);
        $permissoes = array();
        $cont = 0;
        foreach ($grupo->funcoes as $funcao) {
            $permissoes[$cont]["idTelas"] = $funcao->idTelas;
            $permissoes[$cont]["nomeTela"] = $funcao->nomeTela;
            $permissoes[$cont]["modulo"] = $funcao->modulo;
            $cont++;

        }
        return response()->json([
            'idGrupo' => $grupo->idGrupo,
            'grupo' => $grupo->nomeGrupo,
            'funcoesPermissoes' => $permissoes
        ]);
    }
}
