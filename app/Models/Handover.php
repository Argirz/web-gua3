<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Handover extends Model
{
    protected $fillable = ['unit', 'customer', 'image', 'caption', 'handover_date', 'active', 'sort_order'];

    protected function casts(): array
    {
        return [
            'handover_date' => 'date',
            'active' => 'boolean',
        ];
    }
}