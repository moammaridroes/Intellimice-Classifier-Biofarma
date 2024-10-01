<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'fullname',
        'phone_number',
        'email',
        'item_name',
        'agency_name',
        'operator_name',
        'weight',
        'male_quantity',
        'female_quantity',
        'total_price',
        'is_paid',
    ];

    // Setter untuk total_price
    public function setTotalPriceAttribute()
    {
        $malePrice = 4000;
        $femalePrice = 5000;
        $this->attributes['total_price'] = ($this->male_quantity * $malePrice) + ($this->female_quantity * $femalePrice);
    }
}
