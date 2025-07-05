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
            'password' => 'password',
            'name' => 'User',
            'email' => 'user@example.com',
        ]);

        Admin::factory()->create([
            'username' => 'admin',
            'password' => 'password',
        ]);

        User::factory(10)->create();

        Admin::factory(5)->create();
        
        // Copy sample asset to storage
        $this->call(SampleAssetSeeder::class);
        // Categories dummy data (realistic)
        $this->call(CategorySeeder::class);
        // Products dummy data (realistic)
        $this->call(ProductSeeder::class);
    }
}
