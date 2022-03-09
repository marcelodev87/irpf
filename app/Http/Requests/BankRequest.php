<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BankRequest extends FormRequest
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
            'name' => 'nullable|min:3|max:191',
            'agency' => 'nullable|min:3|max:12',
            'account' => 'nullable|min:3|max:12',
            'type' => 'nullable|min:3'
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
            'name.min' => 'O campo NOME DO BANCO deve possuir no mímino 3 letras!',

            'agency.min' => 'O campo AGÊNCIA deve possuir no mímino 3 caracteres!',
            'agency.max' => 'O campo AGÊNCIA deve possuir no máximo 12 caracteres!',

            'account.min' => 'O campo CONTA deve possuir no mímino 3 caracteres!',
            'account.max' => 'O campo CONTA deve possuir no mímino 12 caracteres!',

            'type.min' => 'O campo TIPO DA CONTA deve possuir no mímino 3 letras!',
        ];
    }
}
