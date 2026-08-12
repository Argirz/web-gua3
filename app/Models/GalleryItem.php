<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GalleryItem extends Model
{
    protected $fillable = ['title', 'description', 'image', 'active', 'sort_order'];

    protected function casts(): array
    {
        return [
            'active' => 'boolean',
        ];
    }
}