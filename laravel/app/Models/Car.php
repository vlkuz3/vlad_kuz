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

}
