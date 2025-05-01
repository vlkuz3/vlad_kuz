<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = [
        'rental_id',
        'amount',
        'status',
        'payment_date',
    ];

    public function rental()
    {
        return $this->belongsTo(Rental::class);
    }

    public function scopeFilter($query, $filters)
    {
        return $query
            ->when($filters['rental_id'] ?? null, fn($q, $value) => $q->where('rental_id', $value))
            ->when($filters['amount'] ?? null, fn($q, $value) => $q->where('amount', $value))
            ->when($filters['status'] ?? null, fn($q, $value) => $q->where('status', 'like', "%$value%"))
            ->when($filters['payment_date'] ?? null, fn($q, $value) => $q->where('payment_date', $value));
    }
}
