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
        'is_paid'
    ];
    
}
