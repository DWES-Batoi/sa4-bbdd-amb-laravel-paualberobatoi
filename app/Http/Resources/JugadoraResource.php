<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class JugadoraResource extends JsonResource
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
            'equip_id' => $this->equip_id,
            'posicio' => $this->posicio,
            'dorsal' => $this->dorsal,
            'edat' => $this->edat,
            // 'equip' => $this->whenLoaded('equip'), 
            'created_at' => $this->created_at->format('d/m/Y'),
            'updated_at' => $this->updated_at->format('d/m/Y'),
        ];
    }
}
