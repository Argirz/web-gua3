<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SerahTerima extends Model
{
    protected $table = 'serah_terima';

    protected $fillable = ['unit_rumah_id', 'customer', 'image', 'caption', 'handover_date', 'active', 'sort_order'];

    protected $appends = ['unit'];

    protected function casts(): array
    {
        return [
            'handover_date' => 'date',
            'active' => 'boolean',
        ];
    }

    public function unitRumah(): BelongsTo
    {
        return $this->belongsTo(UnitRumah::class, 'unit_rumah_id');
    }

    public function getUnitAttribute(): ?string
    {
        return $this->unitRumah?->block;
    }
}