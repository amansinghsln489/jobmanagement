<?php
namespace Database\Seeders;

use App\Models\Job;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Create Users
        $admin = User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@demo.test',
            'is_admin' => true, // Add an 'is_admin' column/flag to users table
        ]);

        $standardUser = User::factory()->create([
            'name' => 'Standard User',
            'email' => 'user@demo.test',
            'is_admin' => false,
        ]);

        // 2. Create 30+ Jobs
        Job::factory(25)->create(['user_id' => $admin->id]);
        Job::factory(10)->create(['user_id' => $standardUser->id]);

        // Note: You would also need a migration to add 'is_admin' to the 'users' table.
    }
}