<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Personal;
use App\Models\Empresa;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;


class asesor extends Model
{
    //use HasFactory;
    use HasUuids;

    

    public function empresa(): BelongsTo
    {
        return $this->belongsTo(Empresa::class );
    }
    public function personal(): BelongsTo
    {
        return $this->belongsTo(Personal::class );
    }

    public function curso(): HasMany
    {
       
        return $this->hasMany(Curso::class);
    }
}
