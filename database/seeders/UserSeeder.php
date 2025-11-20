<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker; // Import the Faker Factory

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create(); // Create a Faker instance

        for ($i = 0; $i < 300; $i++) { // Loop to create multiple records
            DB::table('users')->insert([
                'user_level_id' => 2,
                'username' => $faker->name(), // Generates a random name
                'name' => $faker->name(), // Generates a random name
                'email' => $faker->unique()->safeEmail(), // Generates a unique, safe email
                'password' => bcrypt('password'), // Example password
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
