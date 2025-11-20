<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Actividad extends Model
{
    use HasFactory;

    
    protected $table = 'actividades';

    protected $fillable = [
        'nota_id',
        'descripcion', 
        'estado',
        'fecha_inicio',
        'fecha_fin'
    ];

    protected $casts = [
        'fecha_inicio' => 'datetime',
        'fecha_fin' => 'datetime',
    ];

    // Relación: Actividad pertenece a una Nota
    public function nota()
    {
        return $this->belongsTo(Nota::class);
    }
}