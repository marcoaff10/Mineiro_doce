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
                'max:255'
            ],

            'categoria' => [
                'required'
            ],

            'peso' => [
                'required',
                'numeric',
                'min:0'
            ],
            
            'minimo' => [
                'required',
                'numeric',
                'min:0'
            ],

            'maximo' => [
                'required',
                'numeric',
                'min:0'
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
            'peso.min' => 'O peso não pode ser menor do que :min.',

            'minimo.required' => 'O campo minimo é obrigátorio.',
            'minimo.numeric' => 'O campo minimo deve ser um valor numérico.',
            'minimo.min' => 'O minimo não pode ser menor do que :min.',

            'maximo.required' => 'O campo maximo é obrigátorio.',
            'maximo.numeric' => 'O campo maximo deve ser um valor numérico.',
            'maximo.min' => 'O maximo não pode ser menor do que :min.'

        ];
    }
}
