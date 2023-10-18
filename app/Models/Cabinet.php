<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Cabinet extends Model
{
    use HasFactory;
    use HasUuids;

    public function Room(): BelongsTo
    {
        return $this->belongsTo(Room::class);
    }
}
