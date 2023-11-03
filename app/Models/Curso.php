<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\asesor;
use App\Models\curso_categoria;
use App\Models\Examene;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\participante;

class curso extends Model
{
    //use HasFactory;
    use HasUuids;

    protected $fillable = [
        'curso_categoria_id', // Otros campos permitidos para asignación masiva
        'asesor_id',
        'nombre_curso',
        'horas_duracion',
        'fecha_inicio',
        'fecha_fin', // Agrega todos los demás campos aquí
        'estatus', // Agrega el campo estatus a la lista
    ];

    public function asesor(): BelongsTo
    {
        return $this->belongsTo(Asesor::class);
    }
    public function curso_categoria(): BelongsTo
    {
        return $this->belongsTo(Curso_Categoria::class);
    }
    public function examene(): BelongsTo
    {
        return $this->belongsTo(Examene::class);
    }
    public function participante(): HasMany
    {
        return $this->hasMany(participante::class);
    }
}
