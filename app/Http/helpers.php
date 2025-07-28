<?php

use Illuminate\Support\Facades\Storage;

if (!function_exists('generateRandomString')) {
    function generateRandomString($length = 10) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[random_int(0, $charactersLength - 1)];
        }
        return $randomString;
    }
}

if (!function_exists('deleteImage')) {
    function deleteImage($imagePath) {
        if (empty($imagePath)) {
            return false;
        }
        
        // Normalize the path separators for cross-platform compatibility
        $imagePath = str_replace('\\', '/', $imagePath);
        
        // Construct the full path to the image file
        $fullPath = storage_path('app/public/' . $imagePath);
        
        // Normalize the full path for the current operating system
        $fullPath = str_replace(['/', '\\'], DIRECTORY_SEPARATOR, $fullPath);
        
        // Check if the image file exists and delete it
        if (file_exists($fullPath)) {
            if (unlink($fullPath)) {
                return true;
            }
        }
        
        return false;
    }
}

if (!function_exists('deleteImageUsingStorage')) {
    /**
     * Delete an image using Laravel's Storage facade (recommended method)
     * @param string $imagePath - The relative path to the image (e.g., 'images/products/image.jpg')
     * @return bool - True if successful, false otherwise
     */
    function deleteImageUsingStorage($imagePath) {
        // Import the Storage class at the top of your file or use the full namespace
        
        if (empty($imagePath)) {
            return false;
        }
        
        // Normalize the path separators for cross-platform compatibility
        $imagePath = str_replace('\\', '/', $imagePath);
        
        try {
            // Use Laravel's Storage facade for better file handling
            if (Storage::disk('public')->exists($imagePath)) {
                return Storage::disk('public')->delete($imagePath);
            } else {
                return false;
            }
        } catch (\Exception $e) {
            // Fallback to direct file system operations on error
            return deleteImage($imagePath);
        }
    }
}