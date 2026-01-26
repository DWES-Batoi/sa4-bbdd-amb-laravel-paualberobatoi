<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EquipResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'nom' => $this->nom,
            'estadi_id' => $this->estadi_id,
            'estadi_nom' => $this->estadi?->nom,
            'titols' => $this->titols,
            // 'escut_url' => $this->escut ? asset('storage/' . $this->escut) : null, // Opcional: URL completa
            'created_at' => $this->created_at->format('d/m/Y'),
            'updated_at' => $this->updated_at->format('d/m/Y'),
        ];
    }
}
