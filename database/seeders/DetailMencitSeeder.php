<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DetailMencitSeeder extends Seeder
{
    public function run()
    {
        // Data dummy
        $data = [
            [
                'berat' => 25.5,
                'gender' => 'Male',
                'health_status' => 'Healthy',
                'created_at' => Carbon::now()->subDays(10),
                'updated_at' => Carbon::now()->subDays(10),
            ],
            [
                'berat' => 22.0,
                'gender' => 'Female',
                'health_status' => 'Sick',
                'created_at' => Carbon::now()->subDays(8),
                'updated_at' => Carbon::now()->subDays(8),
            ],
            [
                'berat' => 30.2,
                'gender' => 'Male',
                'health_status' => 'Healthy',
                'created_at' => Carbon::now()->subDays(5),
                'updated_at' => Carbon::now()->subDays(5),
            ],
            [
                'berat' => 27.8,
                'gender' => 'Female',
                'health_status' => 'Healthy',
                'created_at' => Carbon::now()->subDays(3),
                'updated_at' => Carbon::now()->subDays(3),
            ],
            [
                'berat' => 23.4,
                'gender' => 'Male',
                'health_status' => 'Sick',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ];

        // Insert data dummy ke tabel
        DB::table('detail_mencit')->insert($data);
    }
}
