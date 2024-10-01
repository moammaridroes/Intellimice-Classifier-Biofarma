<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DetailMencit extends Model
{
    use HasFactory; // Menambahkan trait HasFactory

    protected $table = 'detail_mencit'; // Nama tabel

    protected $fillable = ['berat', 'gender', 'health_status']; // Atribut yang dapat diisi
}
