<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\departamento;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use App\Models\participante;
use App\Models\Calificacion;
use App\Models\curso;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class personal extends Model
{
    //use HasFactory;
    use HasUuids;
    public function departamento(): BelongsTo
    {
        return $this->belongsTo(Departamento::class );
    }
    public function participante(): HasMany
    {
        return $this->hasMany(participante::class);
    } 
    public function calificacion(): BelongsTo
    {
        return $this->belongsTo(Calificacion::class);
    } 

    public function cursos()
    {
        return $this->belongsToMany(Curso::class, 'participantes', 'personal_id', 'curso_id');
    }

}
