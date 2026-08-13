<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Spesifikasi extends Model
{
    protected $table = 'spesifikasi';

    protected $fillable = ['category', 'name', 'value', 'sort_order'];
}