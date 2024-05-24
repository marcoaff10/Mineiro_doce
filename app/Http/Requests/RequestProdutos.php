<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RequestProdutos extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'produto' => [
                'required',
                'string',
                'min:3',
                'max:100'
            ],

            'categoria' => [
                'required'
            ],

            'peso' => [
                'required',
                'numeric',
                'min_digits:0'
            ]
        ];
    }

    public function messages()
    {
        return [

            'produto.required' => 'O campo produto é obrigátorio.',
            'produto.string' => 'Produto inálido.',
            'produto.min' => 'O campo produto deve conter no mínimo :min caracteres.',
            'produto.max' => 'O campo produto deve conter no máximo :max caracteres.',

            'categoria.required' => 'O campo categoria é obrigátorio.',

            'peso.required' => 'O campo peso é obrigátorio.',
            'peso.numeric' => 'O campo peso deve ser um valor numérico.',
            'peso.min_digits' => 'O peso não pode ser menor do que 0.'

        ];
    }
}
