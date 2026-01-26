<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PartitResource extends JsonResource
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
            'equip_local_id' => $this->equip_local_id,
            'equip_local_nom' => $this->local?->nom,
            'equip_visitant_id' => $this->equip_visitant_id,
            'equip_visitant_nom' => $this->visitant?->nom,
            'estadi_id' => $this->estadi_id,
            'estadi_nom' => $this->estadi?->nom,
            'data_partit' => $this->data_partit,
            'gols_local' => $this->gols_local,
            'gols_visitant' => $this->gols_visitant,
            'created_at' => $this->created_at->format('d/m/Y H:i'),
            'updated_at' => $this->updated_at->format('d/m/Y H:i'),
        ];
    }
}
