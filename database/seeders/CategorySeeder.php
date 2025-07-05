<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void 
    {
        $categories = [
            [
                'name' => 'PC Components',
                'image_url' => 'images/categories/pc_components.jpg',
            ],
            [
                'name' => 'Peripherals',
                'image_url' => 'images/categories/peripherals.jpeg',
            ],
            [
                'name' => 'Accessories',
                'image_url' => 'images/categories/accessories.jpg',
            ],
            [
                'name' => 'Laptops and Desktops',
                'image_url' => 'images/categories/laptops_and_desktops.jpg',
            ],
        ];

        $now = now();
        foreach ($categories as &$category) {
            $category['created_at'] = $now;
            $category['updated_at'] = $now;
        }
        DB::table('categories')->insert($categories);
    }
}
