<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RequestCategorias extends FormRequest
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
            'categoria' => [
                'required',
                'min:3',
                'max:255'
            ]
        ];
    }

    public function messages()
    {
        return [

            'categoria.required' => 'O campo categoria é obrigátorio.',
            'categoria.min' => 'O campo categoria deve conter no mínimo :min caracteres.',
            'categoria.max' => 'O campo categoria deve conter no mínimo :max caracteres.',
        ];
    }
}
