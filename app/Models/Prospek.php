<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Prospek extends Model
{
    protected $table = 'prospek';

    protected $fillable = ['tipe_rumah_id', 'nama_lengkap', 'nomor_wa', 'sumber', 'status'];

    public function tipeRumah(): BelongsTo
    {
        return $this->belongsTo(TipeRumah::class);
    }
}