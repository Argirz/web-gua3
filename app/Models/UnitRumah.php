<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class UnitRumah extends Model
{
    protected $table = 'unit_rumah';

    protected $fillable = ['block', 'unit_type_id', 'status'];

    protected $appends = ['tipe'];

    public function tipeRumah(): BelongsTo
    {
        return $this->belongsTo(TipeRumah::class, 'unit_type_id');
    }

    public function serahTerima(): HasMany
    {
        return $this->hasMany(SerahTerima::class, 'unit_rumah_id');
    }

    public function getTipeAttribute(): ?string
    {
        return $this->tipeRumah?->name;
    }
}