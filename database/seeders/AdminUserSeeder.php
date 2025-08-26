<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Super_Admin',
            'email' => 'super_admin@dgapr.ma',
            'password' => bcrypt('superadmin123'),
            'role' => 'super_admin',
        ]);
    }
}
