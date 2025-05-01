<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $fillable = [
        'name',
        'email',
        'phone',
    ];

    public function scopeFilter($query, $filters)
    {
        return $query
            ->when($filters['name'] ?? null, fn($q, $value) => $q->where('name', 'like', "%$value%"))
            ->when($filters['email'] ?? null, fn($q, $value) => $q->where('email', 'like', "%$value%"))
            ->when($filters['phone'] ?? null, fn($q, $value) => $q->where('phone', 'like', "%$value%"));
    }
}
