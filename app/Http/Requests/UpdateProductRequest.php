<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
         return [
            'idModal' => 'required|exists:products,id',
            'product' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'file_input' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ];
    }
}
