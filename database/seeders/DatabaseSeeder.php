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

        \App\Models\User::factory()->create([
            'user_level_id' => 1,
            'username' => 'admin',
            'password' => 'rnPgxzQ3qJeyNWKMtSD5La',
            'email' => 'admin@email.com',
            'name' => 'Admin',
            'created_by' => '1',
            'updated_by' => '1',
			'picture' => 'noimage.jpg'
        ]);

        \App\Models\UserLevel::factory()->create(['id' => 1, 'name' => 'Super Admin', 'created_by' => '1', 'updated_by' => '1']);
        \App\Models\UserLevel::factory()->create(['id' => 2, 'name' => 'User', 'created_by' => '1', 'updated_by' => '1']);

    }
}
