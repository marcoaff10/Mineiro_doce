<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RequestUpdateFornecedores extends FormRequest
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
            
            'cnpj' => [
                'required',
                "unique:fornecedores,cnpj,{$this->id},id",
                'numeric'
            ],

            'fornecedor' => [
                'required',
                'min:3',
                'max:80',
            ],

            'telefone' => [
                'required',
                'numeric',
                'min_digits:11',
                'max_digits:11'
            ],
            
            'email' => [
                'required',
                'email',
            ],

            'cep' => [
                'required',
                'numeric',
                'min_digits:8',
                'max_digits:8'
            ],

            'cidade' => [
                'required',
                'min:3',
                'max:255',
            ],

            'endereco' => [
                'required',
                'min:3',
                'max:255'
            ],

            'bairro' => [
                'required',
                'min:3',
                'max:255'
            ],

            'num' => [
                'nullable',
                'numeric',
                'min_digits:1',
                'max_digits:100000'
            ]
        ];
    }

    public function messages()
    {
        return [
            
            'cnpj.required' => 'O campo CNPJ é obrigátorio.',
            'cnpj.unique' => 'Já existe um registro com esse CNPJ.',
            'cnpj.numeric' => 'O campo CNPJ deve conter apenas números.',
            
            'fornecedor.required' => 'O campo fornecedor é obrigátorio.',
            'fornecedor.min' => 'O campo fornecedor deve conter no mínimo :min caracteres.',
            'fornecedor.max' => 'O campo fornecedor deve conter no máximo :max caracteres.',

            'telefone.required' => 'O campo telefone é obrogátorio.',
            'telefone.numeric' => 'O campo telefone deve conter apenas números.',
            'telefone.min_digits' => 'O campo telefone deve conter no mínimo :min caracteres.', 
            'telefone.max_digits' => 'O campo telefone deve conter no máximo :max caracteres.', 

            'email.required' => 'O campo email é obrogátorio.',
            'email.email' => 'O campo email deve ser um email válido.',

            'cep.required' => 'O campo CEP é obrigátorio.',
            'cep.numeric' => 'O campo CEP deve conter apenas números.',
            'cep.min_digits' => 'O campo CEP deve conter no mínimo :min caracteres.',
            'cep.max_digits' => 'O campo CEP deve conter no máximo :max caracteres.',

            'cidade.required' => 'O campo cidade é obrigátorio.',
            'cidade.min' => 'O campo cidade deve conter no mínimo :min caracteres.',
            'cidade.max' => 'O campo cidade deve conter no máximo :max caracteres.',

            'endereco.required' => 'O campo endereco é obrigátorio.',
            'endereco.min' => 'O campo endereco deve conter no mínimo :min caracteres.',
            'endereco.max' => 'O campo endereco deve conter no máximo :max caracteres.',

            'bairro.required' => 'O campo bairro é obrigátorio.',
            'bairro.min' => 'O campo bairro deve conter no mínimo :min caracteres.',
            'bairro.max' => 'O campo bairro deve conter no máximo :max caracteres.',

            'num.numeric' => 'O campo N° deve conter apenas números.',
            'num.min_digits' => 'O campo N° deve conter no mínimo :min caracteres.',
            'num.max_digits' => 'O campo N° deve conter no máximo :max caracteres.',

        ];
    }
}
