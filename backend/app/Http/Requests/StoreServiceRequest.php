<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreServiceRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'max:255'],
            'slug' => ['nullable', 'string', 'max:255', 'unique:services,slug'],
            'icon' => ['nullable', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'benefits' => ['nullable', 'array'],
            'sort_order' => ['integer', 'min:0'],
        ];
    }
}
