<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

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

        $users = $this->additionalTestUsers();
        foreach ($users as $u) {
            $role = Role::where('name', '!=', 'super_admin')->inRandomOrder()->first();
            User::factory()->create($u)->assignRole($role->name);
        }

    }

    private function additionalTestUsers(): array
    {
        return [
            ['first_name' => 'Logan', 'last_name' => 'Howlett', 'email' => 'wolverine@example.com'],
            ['first_name' => 'Scott', 'last_name' => 'Summers', 'email' => 'cyclops@example.com'],
            ['first_name' => 'Jean', 'last_name' => 'Grey', 'email' => 'phoenix@example.com'],
            ['first_name' => 'Ororo', 'last_name' => 'Munroe', 'email' => 'storm@example.com'],
            ['first_name' => 'Remy', 'last_name' => 'LeBeau', 'email' => 'gambit@example.com'],
            ['first_name' => 'Anna', 'last_name' => 'Marie', 'email' => 'rogue@example.com'],
            ['first_name' => 'Kurt', 'last_name' => 'Wagner', 'email' => 'nightcrawler@example.com'],
            ['first_name' => 'Piotr', 'last_name' => 'Rasputin', 'email' => 'colossus@example.com'],
            ['first_name' => 'Kitty', 'last_name' => 'Pryde', 'email' => 'shadowcat@example.com'],
            ['first_name' => 'Bobby', 'last_name' => 'Drake', 'email' => 'iceman@example.com'],
            ['first_name' => 'Hank', 'last_name' => 'McCoy', 'email' => 'beast@example.com'],
            ['first_name' => 'Warren', 'last_name' => 'Worthington', 'email' => 'angel@example.com'],
            ['first_name' => 'Charles', 'last_name' => 'Xavier', 'email' => 'professorx@example.com'],
            ['first_name' => 'Erik', 'last_name' => 'Lehnsherr', 'email' => 'magneto@example.com'],

            ['first_name' => 'Bruce', 'last_name' => 'Wayne', 'email' => 'batman@example.com'],
            ['first_name' => 'Jack', 'last_name' => 'Napier', 'email' => 'joker@example.com'],
            ['first_name' => 'Oswald', 'last_name' => 'Cobblepot', 'email' => 'penguin@example.com'],
            ['first_name' => 'Edward', 'last_name' => 'Nygma', 'email' => 'riddler@example.com'],
            ['first_name' => 'Selina', 'last_name' => 'Kyle', 'email' => 'catwoman@example.com'],
            ['first_name' => 'Harvey', 'last_name' => 'Dent', 'email' => 'twoface@example.com'],
            ['first_name' => 'Pamela', 'last_name' => 'Isley', 'email' => 'poisonivy@example.com'],
            ['first_name' => 'Victor', 'last_name' => 'Fries', 'email' => 'mrfreeze@example.com'],
            ['first_name' => 'Bane', 'last_name' => 'Dorrance', 'email' => 'bane@example.com'],
            ['first_name' => 'Jonathan', 'last_name' => 'Crane', 'email' => 'scarecrow@example.com'],
            ['first_name' => 'Harleen', 'last_name' => 'Quinzel', 'email' => 'harleyquinn@example.com'],

            ['first_name' => 'Clark', 'last_name' => 'Kent', 'email' => 'superman@example.com'],
            ['first_name' => 'Arthur', 'last_name' => 'Curry', 'email' => 'aquaman@example.com'],
            ['first_name' => 'Diana', 'last_name' => 'Prince', 'email' => 'wonderwoman@example.com'],
            ['first_name' => 'Barry', 'last_name' => 'Allen', 'email' => 'flash@example.com'],
            ['first_name' => 'Hal', 'last_name' => 'Jordan', 'email' => 'greenlantern@example.com'],
            ['first_name' => 'Oliver', 'last_name' => 'Queen', 'email' => 'greenarrow@example.com'],
            ['first_name' => 'Victor', 'last_name' => 'Stone', 'email' => 'cyborg@example.com'],
            ['first_name' => 'Kara', 'last_name' => 'Danvers', 'email' => 'supergirl@example.com'],
            ['first_name' => 'John', 'last_name' => 'Constantine', 'email' => 'constantine@example.com'],
            ['first_name' => 'Shayera', 'last_name' => 'Hol', 'email' => 'hawkgirl@example.com'],
        ];
    }
}
