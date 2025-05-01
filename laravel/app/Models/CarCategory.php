<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CarCategory extends Model
{
    protected $fillable = [
        'name',
    ];

    public function scopeFilter($query, $filters)
    {
        return $query
            ->when($filters['name'] ?? null, fn($q, $value) => $q->where('name', 'like', "%$value%"));
    }
}
