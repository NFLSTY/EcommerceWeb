<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Admin;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->create([
            'username' => 'user',
            'password' => 'password123',
            'name' => 'User',
            'email' => 'user@example.com',
            'role' => 'user'
        ]);

        User::factory()->create([
            'username' => 'admin',
            'password' => 'password123',
            'name' => 'admin',
            'email' => 'admin@example.com',
            'role' => 'admin'
        ]);

        User::factory(10)->create();
        
        // Copy sample asset to storage
        $this->call(SampleAssetSeeder::class);
        // Categories dummy data (realistic)
        $this->call(CategorySeeder::class);
        // Products dummy data (realistic)
        $this->call(ProductSeeder::class);
    }
}
