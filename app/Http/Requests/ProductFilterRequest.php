<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductFilterRequest extends FormRequest
{
    public function rules()
    {
        return [
            'search'   => ['nullable', 'string', 'max:255'],
            'category' => ['nullable', 'string', 'max:255'],
        ];
    }

    public function authorize()
    {
        return true; // Allow all users, or add your own authorization logic
    }
}
