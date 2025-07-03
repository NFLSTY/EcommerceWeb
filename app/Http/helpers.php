<?php

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
        if ($imagePath) {
            // Construct the full path to the image file
            $fullPath = storage_path('app/public/' . $imagePath);
            
            // Check if the image file exists and delete it
            if (file_exists($fullPath)) {
                unlink($fullPath); // Deletes the file
                return true;
            }
        }
        return false;
    }
}