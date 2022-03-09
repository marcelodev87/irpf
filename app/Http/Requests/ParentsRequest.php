<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ParentsRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|min:3|max:191',
            //'document' => (!empty($this->request->all()['id']) ? 'min:11|max:14|unique:users,document,' . $this->request->all()['id'] : 'min:11|max:14|unique:users,document'),
            'document' => 'nullable|min:11|max:14',
            'date_of_birth' => 'nullable|date_format:d/m/Y'
        ];

    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'name.required' => 'O campo NOME é obrigatório!',
            'name.min' => 'O campo NOME deve possuir no mímino 3 letras!',

            'document.min' => 'O campo CPF deve possuir no mímino 11 números!',
            'document.max' => 'O campo CPF deve possuir no máximo 14 números!',

            'date_of_birth.date_format' => 'No campo DATA DE NASCIMENTO: insira um formato válido! Ex: 20/10/1995',
        ];
    }
}
