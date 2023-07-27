<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        \App\Models\User::factory(100)->create();

        // \App\Models\User::factory()->create([
        //     'username' => 'johndoe',
        //     'first_name' => 'John',
        //     'last_name' => 'Doe',
        //     'email' => 'johndoe@email.com',
        // ]);
    }
}
