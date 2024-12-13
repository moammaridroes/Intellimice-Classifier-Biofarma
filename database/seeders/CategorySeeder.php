<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Category::insert([
            [
                'gender' => 'Male',
                'health_status' => 'Healthy',
                'min_weight' => 0,
                'max_weight' => 10,
                'category_name' => 'category1',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'gender' => 'Male',
                'health_status' => 'Healthy',
                'min_weight' => 10,
                'max_weight' => 20,
                'category_name' => 'category2',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'gender' => 'Female',
                'health_status' => 'Healthy',
                'min_weight' => 0,
                'max_weight' => 10,
                'category_name' => 'category1',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
