<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RequestSaidaProduto extends FormRequest
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

            'produto' => [
                'required',
            ],

            'quantidade' => [
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
        ];
    }
}
