<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Telas_Sistema as Funcoes;
use App\Grupo_Usuarios as Grupo;
use App\Http\Controllers\AuthController as AuthC;

class GruposUsersController extends Controller
{
    /* Validação dos dados recebidos */
    private function isValid ($request) {
        if (count($request->permissoes) != 0){
            $request->validate([
                'nomeGrupo' => 'bail|required|unique:grupo_usuarios|min:4|max:60',
            ],[
                'required' => 'O nome do grupo é obrigatório.',
                'unique' => 'Já existe um grupo chamado :input.',
                'min' => 'O nome do grupo deve ter no mínimo 4 caracteres.',
                'max' => 'O nome do grupo deve ter no máximo 60 caracteres.',
            ]);
        }
    }

    /* Verificando permissão antes de efetuar a ação*/
    /*public function authorize($operacao)
    {
        $id = auth()->user();
       // $comment = Comment::find($this->route('comment'));

        //return $comment && $this->user()->can('update', $comment);
        return $id;
    }*/

    /* Criando/Editando um grupo */
    private function storeUpdate(Grupo $grupo, Request $request) {
        $hasError = false;
        $grupo->nomeGrupo = $request->nomeGrupo;
        $grupo->save();

        // Removendo possíveis  duplicidade de funções
        $funcoes = array_unique($request->permissoes);

        // Informando as permssoes do grupo
        foreach ($funcoes as $idFuncao) {
            $funcao = Funcoes::find($idFuncao);
            if ($funcao != null)
                $grupo->funcoes()->attach($funcao->idTelas);
            else
                $hasError = true;
        }
        return $hasError;
    }
    public function store(Request $request) {
        $this->isValid($request);
        $grupo = new Grupo;
        $per = $request->permissoes;
        if(!$this->storeUpdate($grupo,$request))
            return response()->json(['message' => 'Grupo criado com sucesso']);
        else
            return response()->json(['message'=>'Ops! Ocorreu um erro. O grupo pode não ter sido criado corretamente'],'500');
    }

    public function index($order, $size, $filter = null) {
        $listaGrupo = Grupo::orderBy('nomeGrupo', $order)->where('nomeGrupo', 'like', '%'.$filter.'%')->paginate($size);
        return response()->json($listaGrupo);
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

    public function destroy($id) {
        $grupo = Grupo::find($id);
        if($grupo != null) {
            $grupo->funcoes()->detach();
            $grupo->delete();
            return response()->json(['message' => 'Grupo excluído  com sucesso']);
        }
        else
            return response()->json(['message'=>'Ops! O grupo a ser excluído  não foi encontrado'],'500');
    }

    public function update(Request $request) {
        $grupo = Grupo::find($request->idGrupo);
        if($grupo == null)
            return response()->json(['message'=>'Ops! O grupo a ser alterado  não foi encontrado'],'500');

        //Remove as relações para poder atualiza-las
        $grupo->funcoes()->detach();

        if(!$this->storeUpdate($grupo,$request))
            return response()->json(['message' => 'Grupo alterado com sucesso']);
        else
            return response()->json(['message'=>'Ops! Ocorreu um erro. O grupo pode não ter sido alterado corretamente'],'500');

    }
}
