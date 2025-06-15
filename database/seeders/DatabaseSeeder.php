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

        // Default categories
        $categories = [
            'PC Components',
            'Peripherals',
            'Accessories',
            'Laptops and Desktops',
        ];

        foreach ($categories as $category) {
            DB::table('categories')->insert(['name' => $category]);
        }

        // Products dummy data (realistic)
        $this->call(ProductSeeder::class);
    }
}
