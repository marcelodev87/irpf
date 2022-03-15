<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
            'document' => 'min:11|max:14|unique:users',
            'document_voter' => 'nullable|min:8|max:12',
            'date_of_birth' => 'required|date_format:d/m/Y',
            'civil_status' => 'nullable|min:3|max:12',

            // Income
            'occupation' => 'nullable|min:3|max:50',

            // Address
            'zipcode' => 'nullable|min:8|max:9',
            'street' => 'nullable|min:5',
            'number' => 'nullable|min:1',
            'complement' => 'nullable|min:1',
            'neighborhood' => 'nullable|min:3',
            'city' => 'nullable|min:3',
            'state' => 'nullable|max:2',

            // Contact
            'telephone' => 'nullable|min:10|max:15',
            'cell' => 'nullable|min:10|max:15',

            // Access
            'email' => (!empty($this->request->all()['id']) ? 'email|unique:users,email,' . $this->request->all()['id'] : 'email|unique:users,email'),
            //'password' => (empty($this->request->all()['id']) ? 'required' : ''),
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
            'name.min' => 'O campo NOME deve possuir no mímino 3 letras!',
            'name.required' => 'O campo NOME é obrigatório!',

            'document.unique' => 'O campo CPF é obrigatório!',
            'document.min' => 'Insira um CPF válido!',

            'email.required' => 'O campo EMAIL é obrigatório!',
            'email.unique' => 'Este EMAIL igual a esse! Tente entrar com outro email.',
            'email.email' => 'Insira um EMAIL válido.',

            'date_of_birth.required' => 'O campo DATA DE NASCIMENTO é obrigatório!',

            'document_voter.min' => 'O campo TÍTULO DE ELEITOR deve possuir no mímino 8 números!',
            'document_voter.max' => 'O campo TÍTULO DE ELEITOR deve possuir no máximo 12 números!',

            'civil_status.min' => 'O campo ESTADO CIVIL deve possuir no mímino 3 letras!',
            'civil_status.max' => 'O campo ESTADO CIVIL deve possuir no máximo 12 letras!',

            'occupation.min' => 'O campo PROFISSÃO deve possuir no mímino 3 letras!',
            'occupation.min' => 'O campo PROFISSÃO deve possuir no máximo 50 letras!',

            'zipcode.min' => 'O campo CEP deve possuir no mímino 8 números!',
            'zipcode.max' => 'O campo CEP deve possuir no máximo 9 números!',

            'street.min' => 'O campo RUA deve possuir no mímino 3 letras!',
            'number.min' => 'O campo NÚMERO deve possuir no mímino 1 número!',
            'complement.min' => 'O campo COMPLEMENTO deve possuir no mímino 1 número!',
            'neighborhood.min' => 'O campo BAIRRO deve possuir no mímino 3 letras!',
            'city.min' => 'O campo CIDADE deve possuir no mímino 3 letras!',
            'state.max' => 'O campo ESTADO deve possuir apenas 2 letras!',

            'telephone.min' => 'O campo TELEFONE deve possuir no mímino 10 números!',
            'telephone.max' => 'O campo TELEFONE deve possuir no máximo 13 números!',

            'cell.min' => 'O campo CELULAR deve possuir no mímino 10 números!',
            'cell.max' => 'O campo CELULAR deve possuir no máximo 13 números!',



        ];
    }
}
