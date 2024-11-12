<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    
    use HasFactory;
    protected $casts = [
        'deleted_mice_ids' => 'array',
    ];
    

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

    public function setWeightAttribute($value)
    {
        switch ($value) {
            case 'less_than_8':
                $this->attributes['weight'] = '<8g'; // Menyimpan '<8g'
                break;
            case 'between_8_and_14':
                $this->attributes['weight'] = '8-14g'; // Menyimpan '8-14g'
                break;
            case 'between_14_and_18':
                $this->attributes['weight'] = '14-18g'; // Menyimpan '14-18g'
                break;
            case 'greater_equal_18':
                $this->attributes['weight'] = '>18g'; // Menyimpan '>18g'
                break;
        }
    }

    // Accessor untuk mengembalikan value asli dari database ke dalam form (optional)
    public function getWeightAttribute($value)
    {
        switch ($value) {
            case '<8g':
                return 'less_than_8';
            case '8-14g':
                return 'between_8_and_14';
            case '14-18g':
                return 'between_14_and_18';
            case '>18g':
                return 'greater_equal_18';
            default:
                return $value;
        }
    }

    // Setter untuk total_price
    public function setTotalPriceAttribute()
    {
        $malePrice = 4000;
        $femalePrice = 5000;
        $this->attributes['total_price'] = ($this->male_quantity * $malePrice) + ($this->female_quantity * $femalePrice);
    }
}
