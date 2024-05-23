<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Produtos extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
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
                'min:3',
                'max:100'
            ],

            'fornecedor' => [
                'required',
                'min:3',
                'max:100'
            ],

            'peso' => [
                'required',
                'numeric',
                'min_digits:0'
            ],

            'quantidade' => [
                'required',
                'numeric',
                'min_digits:0'
            ]

        ];
    }
}
