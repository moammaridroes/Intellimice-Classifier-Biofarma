<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UsersTableSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Mastah',
            'email' => 'master@gmail.com',
            'password' => bcrypt('password123'),
            'role' => 'master_data'
        ]);

        // User::create([
        //     'name' => 'Customer User',
        //     'email' => 'customer@example.com',
        //     'password' => bcrypt('password123'),
        //     'role' => 'customer'
        // ]);

        // User::create([
        //     'name' => 'Master Data User',
        //     'email' => 'masterdata@example.com',
        //     'password' => bcrypt('password123'),
        //     'role' => 'master_data'
        // ]);
    }
}
