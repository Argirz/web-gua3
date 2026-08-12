<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Brochure extends Model
{
    protected $fillable = ['title', 'file', 'cover', 'description', 'active', 'sort_order'];

    protected function casts(): array
    {
        return [
            'active' => 'boolean',
        ];
    }
}