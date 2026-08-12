<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    protected $fillable = ['block', 'type', 'land_area', 'building_area', 'price', 'status'];

    protected function casts(): array
    {
        return [
            'land_area' => 'decimal:2',
            'building_area' => 'decimal:2',
            'price' => 'decimal:0',
        ];
    }
}