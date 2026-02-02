<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreJugadoraRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nom' => 'required|min:3',
            'equip_id' => 'required|exists:equips,id',
            'edat' => 'required|integer|min:0|max:120',
            'posicio' => 'required|string',     
            'dorsal' => 'required|integer|between:1,99',
            'foto' => 'nullable|image|max:2048' 
        ];
    }
}