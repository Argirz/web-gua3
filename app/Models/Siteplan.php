<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Siteplan extends Model
{
    protected $fillable = ['title', 'image', 'description', 'active', 'sort_order'];

    protected function casts(): array
    {
        return [
            'active' => 'boolean',
        ];
    }
}