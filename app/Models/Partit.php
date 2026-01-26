<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Partit extends Model
{
    use HasFactory;

    protected $fillable = [
        'equip_local_id', 
        'equip_visitant_id', 
        'estadi_id', 
        'data_partit', 
        'gols_local', 
        'gols_visitant'
    ];

    // Relación con el equipo local
    public function local()
    {
        return $this->belongsTo(Equip::class, 'equip_local_id');
    }

    // Relación con el equipo visitante
    public function visitant()
    {
        return $this->belongsTo(Equip::class, 'equip_visitant_id');
    }

    public function estadi()
    {
        return $this->belongsTo(Estadi::class);
    }
}