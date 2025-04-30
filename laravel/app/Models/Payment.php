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
}
