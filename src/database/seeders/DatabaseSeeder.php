<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Database\Seeders\ItemsTableSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::factory()->create([
            'id' => 1,
            'name' => 'testuser',
            'email' => 'test@example.com',
            'password' => bcrypt('password'),
        ]);

        $this->call([
            ItemsTableSeeder::class,
        ]);
    }
}