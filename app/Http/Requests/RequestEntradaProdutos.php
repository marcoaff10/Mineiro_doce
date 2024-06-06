<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RequestEntradaProdutos extends FormRequest
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
            'motivo' => [
                'required',
            ],

            'fornecedor' => [
                'nullable'
            ],

            'produto' => [
                'required',
            ],

            'quantidade' => [
                'required',
                'numeric',
            ],

            'valor_unidade' => [
                'required',
                'numeric',
            ],

            'frete' => [
                'required',
                'numeric',
            ],

        ];
    }

    public function messages()
    {
        return [

            'motivo.required' => 'O campo motivo é obrigátorio.',
            'produto.required' => 'O campo produto é obrigátorio.',

            'quantidade.required' => 'O campo quantidade é obrigátorio',
            'quantidade.numeric' => 'O campo quantidade deve ser do tipo numérico.',

            'valor_unidade.required' => 'O campo valor unidade é obrigátorio',
            'valor_unidade.numeric' => 'O campo valor unidade deve ser do tipo numérico.',

            'frete.required' => 'O campo frete é obrigátorio',
            'frete.numeric' => 'O campo frete deve ser do tipo numérico.',
        ];
    }
}
