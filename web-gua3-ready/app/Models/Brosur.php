<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Brosur extends Model
{
    protected $table = 'brosur';

    protected $fillable = ['kategori', 'title', 'file', 'cover', 'description', 'active', 'sort_order'];

    protected function casts(): array
    {
        return [
            'active' => 'boolean',
        ];
    }
}