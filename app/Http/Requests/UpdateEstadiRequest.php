<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateEstadiRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nom' => ['required', 'string', 'max:255', Rule::unique('estadis')->ignore($this->route('estadi'))],
            'capacitat' => ['required', 'integer', 'min:1'],
        ];
    }
}
