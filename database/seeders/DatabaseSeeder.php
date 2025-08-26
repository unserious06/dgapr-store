<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        Role::create(['name' => 'user']);
        Role::create(['name' => 'admin']);
        Role::create(['name' => 'super_admin']);

            User::factory()->create([
                'name' => 'Normal_User',
                'email' => 'user@example.com',
         ])->assignRole('user');

        User::factory()->create([
            'name' => 'Admin_User',
            'email' => 'admin@example.com',
        ])->assignRole('admin');

        User::factory()->create([
            'name' => 'Super_Admin_User',
            'email' => 'superadmin@example.com',
        ])->assignRole('super_admin');
    }
}
