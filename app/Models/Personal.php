<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\departamento;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use App\Models\participante;

class personal extends Model
{
    //use HasFactory;
    use HasUuids;
    public function departamento(): BelongsTo
    {
        return $this->belongsTo(Departamento::class );
    }
    public function participante(): BelongsTo
    {
        return $this->belongsTo(participante::class);
    } 

}
