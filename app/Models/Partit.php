<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Partit extends Model
{
    use HasFactory;

    protected $fillable = ['local_id', 'visitant_id', 'estadi_id', 'data', 'jornada', 'gols_local', 'gols_visitant'];

    // Relación: Equipo Local
    public function local()
    {
        return $this->belongsTo(Equip::class, 'local_id');
    }

    // Relación: Equipo Visitante
    public function visitant()
    {
        return $this->belongsTo(Equip::class, 'visitant_id');
    }

    // Relación: Estadi
    public function estadi()
    {
        return $this->belongsTo(Estadi::class);
    }
}