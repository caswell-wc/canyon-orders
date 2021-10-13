<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

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
            'name' => 'Derek Caswell',
            'email' => 'derek.caswell@gmail.com',
            'password' => bcrypt('password')
        ]);

        $this->call(OrderSeeder::class);
    }
}
