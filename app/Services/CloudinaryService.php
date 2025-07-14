<?php

namespace App\Services;

use Cloudinary\Cloudinary;
use Illuminate\Http\UploadedFile;
use Cloudinary\Api\ApiResponse;
use Illuminate\Support\Facades\Log;

class CloudinaryService
{
    protected Cloudinary $cloudinary;

    public function __construct()
    {
        $config = config('cloudinary');
        if (!empty($config['cloud']['cloud_name'])) {
            $this->cloudinary = new Cloudinary($config);
        }
    }

    public function upload(UploadedFile $file, string $folder = 'foodly'): ?string
    {
        if (!isset($this->cloudinary)) {
            Log::warning('CloudinaryService: Cloudinary not configured');
            return null;
        }
        
        try {
            Log::info('CloudinaryService: Starting file upload', [
                'original_name' => $file->getClientOriginalName(),
                'size' => $file->getSize(),
                'mime_type' => $file->getMimeType(),
                'folder' => $folder
            ]);

            $originalName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
            $uniqueName = $originalName . '_' . time();

            $response = $this->cloudinary->uploadApi()->upload($file->getRealPath(), [
                'folder'          => $folder,
                'public_id'       => $uniqueName,
                'overwrite'       => true,
                'resource_type'   => 'image',
                'use_filename'    => true,
                'unique_filename' => false,
            ]);

            // Convert response to array if it's not already
            $responseArray = $response instanceof \ArrayAccess ? $response : $response->getArrayCopy();
            
            $secureUrl = $responseArray['secure_url'] ?? null;
            
            Log::info('CloudinaryService: Upload successful', [
                'secure_url' => $secureUrl,
                'public_id' => $responseArray['public_id'] ?? null
            ]);
            
            return $secureUrl;
        } catch (\Exception $e) {
            Log::error('CloudinaryService: Upload failed', [
                'error' => $e->getMessage(),
                'file' => $file->getClientOriginalName(),
                'folder' => $folder,
                'trace' => $e->getTraceAsString()
            ]);
            
            throw $e; // Re-throw to maintain existing error handling
        }
    }


    public function extractPublicIdFromUrl(string $url, string $folderPrefix = ''): ?string
    {
        $urlWithoutVersion = preg_replace('/\/v\d+\//', '/', $url);
        $parts = explode('/', $url);
        $fileNameWithExtension = end($parts);
        $publicIdParts = [];
        
        for ($i = count($parts) - 2; $i >= 0; $i--) {
            if (preg_match('/^v\d+$/', $parts[$i]) || $parts[$i] === 'upload') {
                break;
            }
            array_unshift($publicIdParts, $parts[$i]);
        }
        
        if (empty($publicIdParts)) return null;

        $publicIdWithoutFilename = implode('/', $publicIdParts);
        $filenameWithoutExtension = pathinfo($fileNameWithExtension, PATHINFO_FILENAME);

        return $publicIdWithoutFilename ? $publicIdWithoutFilename . '/' . $filenameWithoutExtension : $filenameWithoutExtension;
    }


    public function deleteImage(string $publicId)
    {
        try {
            return $this->cloudinary->uploadApi()->destroy($publicId);
        } catch (\Exception $e) {
            report($e);
            return null;
        }
    }

    public function uploadImage(UploadedFile $file, string $folder = 'foodly/menu_categories'): array
    {
        $originalName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
        $uniqueName = $originalName . '_' . time();

        $response = $this->cloudinary->uploadApi()->upload($file->getRealPath(), [
            'folder'          => $folder,
            'public_id'       => $uniqueName,
            'overwrite'       => true,
            'resource_type'   => 'image',
            'use_filename'    => true,
            'unique_filename' => false,
        ]);

        return $response->getArrayCopy();
    }

    public function isCloudinaryUrl(string $url): bool
    {
        return str_contains($url, 'cloudinary.com');
    }

    public function deleteImageFromUrl(string $imageUrl, string $folder = ''): bool
    {
        try {
            if ($this->isCloudinaryUrl($imageUrl)) {
                $publicId = $this->extractPublicIdFromUrl($imageUrl, $folder);
                if ($publicId) {
                    $this->deleteImage($publicId);
                    return true;
                }
            } else if (!filter_var($imageUrl, FILTER_VALIDATE_URL)) {
                $oldImagePath = public_path('storage/' . $imageUrl);
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath);
                    return true;
                }
            }
            return false;
        } catch (\Exception $e) {
            Log::warning('Failed to delete image: ' . $e->getMessage(), [
                'image_url' => $imageUrl
            ]);
            return false;
        }
    }

    public function uploadFromPath(string $filePath, string $folder = 'foodly'): ?string
    {
        $filename = pathinfo($filePath, PATHINFO_FILENAME);
        $uniqueName = $filename . '_' . time();

        $response = $this->cloudinary->uploadApi()->upload($filePath, [
            'folder'          => $folder,
            'public_id'       => $uniqueName,
            'overwrite'       => true,
            'resource_type'   => 'image',
            'use_filename'    => true,
            'unique_filename' => false,
        ]);

        $responseArray = $response instanceof \ArrayAccess ? $response : $response->getArrayCopy();
        
        return $responseArray['secure_url'] ?? null;
    }
}
