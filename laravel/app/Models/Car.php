<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    protected $fillable = [
        'brand',
        'model',
        'color',
        'year',
        'category_id',
        'price_per_day',
        'is_available',
    ];

    public function category()
    {
        return $this->belongsTo(CarCategory::class);
    }

    public function rentals()
    {
        return $this->hasMany(Rental::class);
    }

    public function scopeFilter($query, $filters)
    {
        return $query
            ->when($filters['brand'] ?? null, fn($q, $value) => $q->where('brand', 'like', "%$value%"))
            ->when($filters['model'] ?? null, fn($q, $value) => $q->where('model', 'like', "%$value%"))
            ->when($filters['color'] ?? null, fn($q, $value) => $q->where('color', 'like', "%$value%"))
            ->when($filters['year'] ?? null, fn($q, $value) => $q->where('year', $value))
            ->when($filters['category_id'] ?? null, fn($q, $value) => $q->where('category_id', $value))
            ->when($filters['price_per_day'] ?? null, fn($q, $value) => $q->where('price_per_day', '=', $value))
            ->when($filters['is_available'] !== '' && $filters['is_available'] !== null, function ($q) use ($filters) {
                return $q->where('is_available', $filters['is_available']);
            });
    }
}