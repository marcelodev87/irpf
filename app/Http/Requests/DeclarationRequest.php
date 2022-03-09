<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DeclarationRequest extends FormRequest
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
            'year' => 'required|min:4|max:4'
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
            'year.required' => 'O campo ANO DA DECLARAÇÃO é obrigatório!',

            'year.min' => 'O campo ANO DA DECLARAÇÃO deve possuir no mímino 4 números!',
            'year.max' => 'O campo ANO DA DECLARAÇÃO deve possuir no máximo 4 números!'
        ];
    }
}
