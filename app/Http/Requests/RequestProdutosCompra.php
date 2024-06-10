<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RequestProdutosCompra extends FormRequest
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
            ],
            
            'quantidade' => [
                'required',
                'min:1'
            ],

            'preco_compra' => [
                'required',
                'min:0'
            ],
        ];
    }


    public function messages()
    {
        return [
            'produto.required' => 'O campo produto é obrigatório.',

            'quantidade.required' => 'O campo quantidade é obrigatório.',
            'quantidade.min' => 'Quantidade inválida. Mínima de :min',

            'preco_compra.required' => 'O campo preco compra é obrigatório.',
            'preco_compra.min' => 'O preço da compra está inválido. Preço mínimo de :min',
        ];
    }
}
