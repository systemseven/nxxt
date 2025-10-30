<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::truncate();

        User::factory()->create([
            'first_name' => 'Justin',
            'last_name' => 'Test',
            'email' => 'systemsevendesigns@gmail.com',
        ])->assignRole('super_admin');
    }
}
