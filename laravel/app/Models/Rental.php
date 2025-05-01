<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rental extends Model
{
    protected $fillable = [
        'car_id',
        'customer_id',
        'start_date',
        'end_date',
        'total_price',
    ];

    public function car()
    {
        return $this->belongsTo(Car::class);
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    public function scopeFilter($query, $filters)
    {
        return $query
            ->when($filters['car_id'] ?? null, fn($q, $value) => $q->where('car_id', $value))
            ->when($filters['customer_id'] ?? null, fn($q, $value) => $q->where('customer_id', $value))
            ->when($filters['start_date'] ?? null, fn($q, $value) => $q->where('start_date', $value))
            ->when($filters['end_date'] ?? null, fn($q, $value) => $q->where('end_date', $value))
            ->when($filters['total_price'] ?? null, fn($q, $value) => $q->where('total_price', $value));
    }
}