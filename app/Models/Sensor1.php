<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sensor1 extends Model
{
    use HasFactory;

    protected $table = 'data_kesehatan';
    protected $primaryKey = 'id';

    protected $fillable = [
        'kesehatan_status',
        'timestamp'
    ];

    public $timestamps = false; // Ubah menjadi true jika ingin Laravel mengelola `created_at` dan `updated_at`
}
