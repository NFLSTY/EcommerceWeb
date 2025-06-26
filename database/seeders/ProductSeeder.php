<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = [
            [
                'category_id' => 1,
                'name' => 'AMD Ryzen 7 5800X',
                'price' => 4650000,
                'image_url' => 'images/products/ryzen7_5800x.jpg',
                'description' => '8-core, 16-thread unlocked desktop processor for AM4 socket',
                'stock' => 10,
            ],
            [
                'category_id' => 1,
                'name' => 'Intel Core i7-12700K',
                'price' => 5950000,
                'image_url' => 'images/products/i7_12700k.jpg',
                'description' => '12-core (8P+4E) processor with integrated graphics',
                'stock' => 10,
            ],
            [
                'category_id' => 1,
                'name' => 'NVIDIA GeForce RTX 4070 Ti',
                'price' => 12899000,
                'image_url' => 'images/products/rtx_4070ti.jpg',
                'description' => '12GB GDDR6X GPU with DLSS 3 and Ray Tracing support',
                'stock' => 10,
            ],
            [
                'category_id' => 1,
                'name' => 'Corsair Vengeance LPX 16GB DDR4 3200MHz',
                'price' => 975000,
                'image_url' => 'images/products/corsair_ddr4_16gb.jpg',
                'description' => 'High-performance DDR4 RAM kit (2x8GB)',
                'stock' => 10,
            ],
            [
                'category_id' => 1,
                'name' => 'Samsung 980 PRO 1TB NVMe SSD',
                'price' => 2099000,
                'image_url' => 'images/products/samsung_980pro.jpg',
                'description' => 'PCIe Gen4 NVMe SSD with read speeds up to 7000MB/s',
                'stock' => 10,
            ],

            // Peripherals (category_id = 2)
            [
                'category_id' => 2,
                'name' => 'Logitech G Pro X Gaming Headset',
                'price' => 1599000,
                'image_url' => 'images/products/logitech_gpro_headset.jpg',
                'description' => 'Wired headset with Blue VO!CE mic technology',
                'stock' => 10,
            ],
            [
                'category_id' => 2,
                'name' => 'Razer DeathAdder V2 Gaming Mouse',
                'price' => 799000,
                'image_url' => 'images/products/razer_deathadder.jpg',
                'description' => 'Ergonomic mouse with 20K DPI optical sensor',
                'stock' => 10,
            ],
            [
                'category_id' => 2,
                'name' => 'Corsair K70 RGB Mechanical Keyboard',
                'price' => 1399000,
                'image_url' => 'images/products/corsair_k70.jpg',
                'description' => 'Mechanical keyboard with Cherry MX switches and RGB backlight',
                'stock' => 10,
            ],
            [
                'category_id' => 2,
                'name' => 'ASUS TUF Gaming 27” Monitor (VG27AQ)',
                'price' => 5299000,
                'image_url' => 'images/products/asus_vg27aq.jpg',
                'description' => '2K 165Hz IPS gaming monitor with G-Sync compatibility',
                'stock' => 10,
            ],
            [
                'category_id' => 2,
                'name' => 'Elgato Stream Deck MK.2',
                'price' => 2399000,
                'image_url' => 'images/products/elgato_streamdeck.jpg',
                'description' => '15 customizable LCD keys for streaming and productivity',
                'stock' => 10,
            ],

            // Accessories (category_id = 3)
            [
                'category_id' => 3,
                'name' => 'Logitech MX Palm Rest',
                'price' => 199000,
                'image_url' => 'images/products/logitech_palmrest.jpg',
                'description' => 'Soft memory foam palm rest for keyboards',
                'stock' => 10,
            ],
            [
                'category_id' => 3,
                'name' => 'Cooler Master MasterGel Pro V2',
                'price' => 99000,
                'image_url' => 'images/products/coolermaster_gel.jpg',
                'description' => 'Thermal paste for CPUs and GPUs with improved viscosity',
                'stock' => 10,
            ],
            [
                'category_id' => 3,
                'name' => 'NZXT Puck Cable Organizer',
                'price' => 249000,
                'image_url' => 'images/products/nzxt_puck.jpg',
                'description' => 'Magnetic headset and cable organizer for PC cases',
                'stock' => 10,
            ],
            [
                'category_id' => 3,
                'name' => 'HyperX Wrist Rest',
                'price' => 149000,
                'image_url' => 'images/products/hyperx_wristrest.jpg',
                'description' => 'Cooling gel-infused memory foam wrist rest',
                'stock' => 10,
            ],
            [
                'category_id' => 3,
                'name' => 'UGREEN USB 3.0 Hub 4-Port',
                'price' => 179000,
                'image_url' => 'images/products/ugreen_usb_hub.jpg',
                'description' => 'High-speed USB 3.0 hub with 4 ports and LED indicator',
                'stock' => 10,
            ],

            // Laptops and Desktops (category_id = 4)
            [
                'category_id' => 4,
                'name' => 'Dell XPS 15 (2023)',
                'price' => 30499000,
                'image_url' => 'images/products/dell_xps15.jpg',
                'description' => 'Intel i7, 16GB RAM, 1TB SSD, NVIDIA RTX 4050, 15.6” OLED display',
                'stock' => 10,
            ],
            [
                'category_id' => 4,
                'name' => 'Apple MacBook Air M2 (2023)',
                'price' => 18999000,
                'image_url' => 'images/products/macbook_air_m2.jpg',
                'description' => 'M2 chip, 8GB RAM, 256GB SSD, 13.6-inch Retina display',
                'stock' => 10,
            ],
            [
                'category_id' => 4,
                'name' => 'Lenovo Legion 5 Pro',
                'price' => 23990000,
                'image_url' => 'images/products/lenovo_legion5pro.jpg',
                'description' => 'Ryzen 7 6800H, 16GB RAM, RTX 3070, 1TB SSD, 165Hz display',
                'stock' => 10,
            ],
            [
                'category_id' => 4,
                'name' => 'HP Pavilion Desktop TG01-2003w',
                'price' => 11750000,
                'image_url' => 'images/products/hp_pavilion_tg01.jpg',
                'description' => 'Intel Core i5, 12GB RAM, 512GB SSD, GTX 1660 Super',
                'stock' => 10,
            ],
            [
                'category_id' => 4,
                'name' => 'MSI Stealth 16 Studio',
                'price' => 32999000,
                'image_url' => 'images/products/msi_stealth_16.jpg',
                'description' => 'Intel i9, 32GB RAM, RTX 4080, 1TB SSD, 240Hz QHD+ display',
                'stock' => 10,
            ],
        ];

        $now = now();
        foreach ($products as &$product) {
            $product['created_at'] = $now;
            $product['updated_at'] = $now;
        }
        DB::table('products')->insert($products);
    }
}
