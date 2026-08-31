<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class TipeRumah extends Model
{
    protected $table = 'tipe_rumah';

    protected $fillable = [
        'name',
        'slug',
        'image',
        'description',
        'brochure_pdf',
        'pricelist_pdf',
        'land_area',
        'building_area',
        'bedrooms',
        'bathrooms',
        'price',
        'discount',
        'active',
        'sort_order',
    ];

    protected function casts(): array
    {
        return [
            'land_area' => 'decimal:2',
            'building_area' => 'decimal:2',
            'bedrooms' => 'integer',
            'bathrooms' => 'integer',
            'price' => 'decimal:0',
            'discount' => 'decimal:0',
            'active' => 'boolean',
        ];
    }

    public function units(): HasMany
    {
        return $this->hasMany(UnitRumah::class, 'unit_type_id');
    }

    public function fotoRumah(): HasMany
    {
        return $this->hasMany(FotoRumah::class);
    }

    public function prospek(): HasMany
    {
        return $this->hasMany(Prospek::class);
    }
}