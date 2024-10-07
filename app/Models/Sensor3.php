<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sensor3 extends Model
{
    use HasFactory;

    // Define the table if it's different from the pluralized name of the model
    protected $table = 'data_load_cell';
    protected $primarykey = 'id';

    // Fillable fields to allow mass assignment
    protected $fillable = [
        'berat',
        'timestamp'
    ];
    // public $timestamps = true;  // Make sure this is true if you want Laravel to auto-manage `created_at` and `updated_at`
}


