<?php

namespace App\Repositories\Disciplinas;

use App\Models\Disciplina;
use Illuminate\Support\Facades\Auth;

class disciplinasRepository
{

    protected $ententy;
    protected $userID;

    public function __construct(Disciplina $disciplina)
    {
        $this->ententy = $disciplina;
        $this->userID=Auth()->user()->id;
    }

    public function getDisciplinas()
    {
        $disciplinas = $this->ententy::orderBy('cadeira', 'asc')->where('user_id', $this->userID)->get();
            if (asset($disciplinas)) {
                return response()->json($disciplinas);
            } else {
                return response()->json([
                    'status' => 'Erro',
                    'message' => 'Não foi possível carregar as disciplinas'
                ], 401);
            }
    }

    public function create($data)
    {

        $saveDisciplina = $this->ententy::create([            
            'user_id' => $this->userID,
            'cadeira' => $data['cadeira']
        ]);

        $saveDisciplina->cursos()->sync([
            'user_id'=>$this->userID, 
            'curso_id'=>$data->curso_id
        ]);
        
        if (asset($saveDisciplina)) {
            return response()->json([
                'status' => 'Sucesso',
                'Disciplina' => $saveDisciplina,
            ], 200);
        } else {
            return response()->json([
                'status' => 'Erro',
                'message' => 'Nao foi possível cadastrar esta disciplina. deve-se a um problema interno.!'
            ], 401);
        }
    }

    public function getDisciplina($id)
    {
        //dd($id);
        $getDisciplina = $this->ententy::find($id);
        if (asset($getDisciplina)) {
            return response()->json([
                'getDisciplina' => $getDisciplina
            ], 200);
        } else {
            return response()->json([
                'message' => 'Disciplina não encontrada..!'
            ], 401);
        }
    }

    public function updateDisciplina($data, $id)
    {
        $updateDisciplina = $this->ententy::find($id);
        
        $updateDisciplina->cadeira = $data['cadeira'];
        $updateDisciplina->save();

        if (asset($updateDisciplina)) {
            return response()->json(['message' => 'A disciplina foi actualizada com sucesso'], 200);
        } else {
            return response()->json(['Erro' => 'Não foi possível actualizar esta disciplina'], 401);
        }
    }

    public function apagar($id)
    {
        $deleteDisciplina = $this->ententy::find($id);
        $deleteDisciplina->delete();

        if (asset($deleteDisciplina)) {
            return response()->json(['message' => 'Esta disciplina foi apagada com sucesso'], 200);
        } else {
            return response()->json(['erro' => 'Não foi possível apagar esta disciplina'], 401);
        }
    }

    public function detalhes($id){
        $detalhes = $this->ententy::find($id);
        if(asset($detalhes)){
            return response()->json($detalhes);
        }else{
            return response()->json(['erro'=>'Não foi possível carregar os detalhes']);
        }
    }
}
