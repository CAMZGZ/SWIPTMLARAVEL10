<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Empresa;
use App\Models\personal;
use App\Models\participante;
class departamento extends Model
{
    //use HasFactory;
    use HasUuids;

    public function empresa(): BelongsTo
    {
        return $this->belongsTo(Empresa::class, 'empresa_id', 'id'  );
    }

    public function participantes()
    {
        return $this->hasManyThrough(Participante::class, Personal::class);
    }


}
