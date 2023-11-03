<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\Personal;
use App\Models\Curso;
use App\Models\TiposAsistencia;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class participante extends Model
{
    use HasFactory;
    use HasUuids;

    protected $fillable = [
        'curso_id',
        'personal_id',
    ];

    public function personal(): BelongsTo
    {
        return $this->belongsTo(Personal::class);
    }
    public function curso(): HasMany
    {
        return $this->hasMany(Curso::class);
    }
    public function tipos_asistencia(): BelongsTo
    {
        return $this->belongsTo(TiposAsistencia::class, 'tipo_asistencia_id');
    }

    
}
