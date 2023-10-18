<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Compartment extends Model
{
    use HasFactory;
    use HasUuids;

    /**
     * Get the subcompartments in a compartment.
     *
     * This can for example be boxes in that area which further divide it
     */
    public function sub_compartments(): HasMany
    {
        return $this->hasMany(Compartment::class);
    }



    public function cabinet(): BelongsTo
    {
        return $this->belongsTo(Cabinet::class);
    }
}
