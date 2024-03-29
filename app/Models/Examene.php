<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Examene extends Model
{
    //use HasFactory;
    use HasUuids;
    public function curso(): BelongsTo
    {
        return $this->belongsTo(Curso::class);
    }

    public function calificacion(): HasMany
    {
        return $this->hasMany(Calificacion::class);
    }
}
