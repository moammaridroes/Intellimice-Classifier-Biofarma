<?php
// app/Models/DetailMencit.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DetailMencit extends Model
{
    // Optional: Specify the table name if it's not the plural form of the model name
    protected $table = 'detail_mencits';

    // Optional: Specify fillable fields if needed
    protected $fillable = ['kuantitas,berat,jenis_kelamin'];
}
