<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pricelist extends Model
{
    protected $fillable = ['title', 'land_area', 'building_area', 'price', 'discount', 'active', 'sort_order'];

    protected function casts(): array
    {
        return [
            'land_area' => 'decimal:2',
            'building_area' => 'decimal:2',
            'price' => 'decimal:0',
            'discount' => 'decimal:0',
            'active' => 'boolean',
        ];
    }
}