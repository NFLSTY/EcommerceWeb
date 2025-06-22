<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class SampleAssetSeeder extends Seeder
{
    public function run(): void
    {
        $this->copyImages('banners');
        $this->copyImages('categories');
        $this->copyImages('products');
    }

    private function copyImages(string $folder)
    {
        $sourcePath = database_path("seeders/sample_images/{$folder}");
        $targetPath = "images/{$folder}";

        // Ensure the destination folder exists
        Storage::disk('public')->makeDirectory($targetPath);

        foreach (scandir($sourcePath) as $file) {
            if (in_array($file, ['.', '..']) || !preg_match('/\.(jpg|jpeg|png)$/i', $file)) {
                continue;
            }

            $sourceFile = $sourcePath . '/' . $file;
            $targetFile = $targetPath . '/' . $file;

            if (!Storage::disk('public')->exists($targetFile)) {
                Storage::disk('public')->put($targetFile, file_get_contents($sourceFile));
                $this->command->info("Copied $folder image: $file");
            } else {
                $this->command->line("Skipped (already exists): $folder/$file");
            }
        }
    }
}
