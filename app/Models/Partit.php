<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Partit extends Model
{
    use HasFactory;

    protected $fillable = [
        'local_id',
        'visitant_id',
        'estadi_id',
        'data',
        'jornada',
        'gols_local',
        'gols_visitant'
    ];

    // Relación con el equipo Local
    public function local()
    {
        return $this->belongsTo(Equip::class, 'local_id');
    }

    // Relación con el equipo Visitante
    public function visitant()
    {
        return $this->belongsTo(Equip::class, 'visitant_id');
    }

    // Relación con el Estadio
    public function estadi()
    {
        return $this->belongsTo(Estadi::class);
    }
}