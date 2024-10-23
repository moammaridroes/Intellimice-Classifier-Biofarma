<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerOrder extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'customer_id',
        'fullname',
        'phone_number',
        'email',
        'item_name',
        'agency_name',
        'pick_up_date',
        'weight',
        'male_quantity',
        'female_quantity',
        'total_price',
        'notes',
        'status',
        'is_paid',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'is_paid' => 'boolean',
        'pick_up_date' => 'date',
    ];

    /**
     * Relasi ke model User (admin yang menyetujui).
     */
    public function approvedBy()
    {
        return $this->belongsTo(User::class, 'approved_by');
    }

    /**
     * Relasi ke model User (customer yang memesan).
     */
    public function customer()
    {
        return $this->belongsTo(User::class, 'customer_id');
    }
}
