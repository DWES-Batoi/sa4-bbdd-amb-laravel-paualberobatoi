<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PartitRequest extends FormRequest
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
            'equip_local_id' => ['required', 'exists:equips,id'],
            'equip_visitant_id' => ['required', 'exists:equips,id', 'different:equip_local_id'],
            'estadi_id' => ['required', 'exists:estadis,id'],
            'data_partit' => ['required', 'date'],
            'gols_local' => ['nullable', 'integer', 'min:0'],
            'gols_visitant' => ['nullable', 'integer', 'min:0'],
        ];
    }
}
