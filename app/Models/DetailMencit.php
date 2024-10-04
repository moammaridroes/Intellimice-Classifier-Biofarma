<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailMencit extends Model
{
    use HasFactory;

    protected $table = 'detail_mencit'; // Nama tabel di database

    protected $fillable = ['berat', 'gender', 'health_status']; // Kolom yang bisa diisi
}
