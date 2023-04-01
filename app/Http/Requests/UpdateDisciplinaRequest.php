<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateDisciplinaRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        $id = $this->id ?? '';
        return [
            'cadeira'=>"required|unique:disciplinas,cadeira,{$id},id",
            'curso_id'=>'required'
        ];
    }

    public function messages()
    {
        return [
            'cadeira.required'=>'O campo de disciplina precisa estar preenchido',
            'cadeira.unique'=>'Esta disciplina já está cadastrada',
            'curso_id.required'=>'Precisas associar os cursos com a disciplina digitada'
        ];
    }
}
