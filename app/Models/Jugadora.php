<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jugadora extends Model
{
    use HasFactory;

    protected $fillable = ['equip_id', 'nom', 'data_naixement', 'dorsal', 'foto'];

    // Relación: Una jugadora pertenece a un Equipo (N:1)
    public function equip()
    {
        return $this->belongsTo(Equip::class);
    }
}