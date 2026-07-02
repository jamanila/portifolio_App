<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateServiceRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title' => ['sometimes', 'required', 'string', 'max:255'],
            'slug' => ['nullable', 'string', 'max:255', Rule::unique('services', 'slug')->ignore($this->route('service'))],
            'icon' => ['nullable', 'string', 'max:255'],
            'description' => ['sometimes', 'required', 'string'],
            'benefits' => ['nullable', 'array'],
            'sort_order' => ['integer', 'min:0'],
        ];
    }
}
