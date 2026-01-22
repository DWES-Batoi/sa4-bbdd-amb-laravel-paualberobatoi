<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class JugadoraRequest extends FormRequest
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
            'nom' => ['required', 'string', 'max:255'],
            'equip_id' => ['required', 'exists:equips,id'],
            'posicio' => ['nullable', 'string', 'max:100'],
            'dorsal' => ['nullable', 'integer', 'min:0', 'max:99'],
            'edat' => ['nullable', 'integer', 'min:0', 'max:120'],
        ];
    }
}
