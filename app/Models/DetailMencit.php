<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DetailMencit extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'detail_mencit'; // Nama tabel di database

    protected $fillable = ['berat', 'gender', 'health_status']; // Kolom yang bisa diisi

    public function orders()
    {
        return $this->hasMany(Order::class, 'detail_mencit_id');
    }
    
    public function customerOrders()
    {
        return $this->hasMany(CustomerOrder::class, 'detail_mencit_id');
    }
    

}
