<?php

namespace App\Http\Helpers;

use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;

class Helper
{
    public static function generateFolderCloudinary($folder)
    {
        return 'hotelbookings/' . $folder . '/';
    }

    public static function uploadToCloudinary($file, $namePath = 'default')
    {
        $path = 'hotelbookings/' . $namePath;
        $fileName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
        $publicId = date('Ymd-His') . "_" . $fileName;

        $uploadUrl = Cloudinary::upload(
            $file->getRealPath(),
            ["public_id" => $publicId, "folder" => $path]
        )->getSecurePath();

        return $uploadUrl;
    }

    public static function uploadMultipleFilesToCloudinary(array $files, $namePath = 'photos')
    {
        $uploadedUrls = [];

        foreach ($files as $file) {
            $uploadedUrl = self::uploadToCloudinary($file, $namePath);
            $uploadedUrls[] = $uploadedUrl;
        }

        return $uploadedUrls;
    }

    public static function updateCloudinaryFile($file, $currentPhotoUrl, $namePath = 'default')
    {
        // Hapus file lama dari Cloudinary jika ada
        if ($currentPhotoUrl) {
            $parseUrl = pathinfo($currentPhotoUrl, PATHINFO_FILENAME);
            $publicId = self::generateFolderCloudinary($namePath) . $parseUrl;
            Cloudinary::destroy($publicId);
        }

        // Upload file baru dan dapatkan URL secure
        if ($file) {
            return self::uploadToCloudinary($file, $namePath);
        }

        return null; // Jika tidak ada file baru
    }
}
