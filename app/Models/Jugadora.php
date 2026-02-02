<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jugadora extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom',
        'dorsal',
        'posicio',       
        'edat',
        'equip_id',
        'foto'
    ];

    public function equip()
    {
        return $this->belongsTo(Equip::class);
    }
}