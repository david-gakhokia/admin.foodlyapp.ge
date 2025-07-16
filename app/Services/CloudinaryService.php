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
        
        // Check maximum file size limit (10MB = 10485760 bytes)
        $maxSizeBytes = 10485760; // 10MB hard limit
        $fileSizeBytes = $file->getSize();
        
        if ($fileSizeBytes > $maxSizeBytes) {
            $fileSizeMB = round($fileSizeBytes / 1048576, 2);
            Log::warning('CloudinaryService: File size exceeds hard limit', [
                'file_size_mb' => $fileSizeMB,
                'max_size_mb' => 10,
                'file_name' => $file->getClientOriginalName()
            ]);
            throw new \Exception("ფაილის ზომა ({$fileSizeMB}MB) ძალიან დიდია. მაქსიმალური ზომა: 10MB");
        }
        
        // Log if file is large and will be compressed
        if ($fileSizeBytes > 1048576) { // If larger than 1MB
            $fileSizeMB = round($fileSizeBytes / 1048576, 2);
            Log::info('CloudinaryService: Large file detected, will be compressed', [
                'file_size_mb' => $fileSizeMB,
                'file_name' => $file->getClientOriginalName()
            ]);
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

            // Upload with aggressive optimization and compression
            $response = $this->cloudinary->uploadApi()->upload($file->getRealPath(), [
                'folder'          => $folder,
                'public_id'       => $uniqueName,
                'overwrite'       => true,
                'resource_type'   => 'image',
                'use_filename'    => true,
                'unique_filename' => false,
                // Aggressive transformations for optimization
                'quality'         => 'auto:eco',   // More aggressive compression
                'fetch_format'    => 'auto',       // Automatic format selection (WebP, AVIF, etc.)
                'width'           => 1920,         // Max width 1920px
                'height'          => 1080,         // Max height 1080px
                'crop'            => 'limit',      // Only resize if larger than specified dimensions
                'flags'           => 'progressive.lossy', // Progressive JPEG with lossy compression
                'dpr'             => 'auto',       // Device pixel ratio optimization
            ]);

            // Convert response to array if it's not already
            $responseArray = $response instanceof \ArrayAccess ? $response : $response->getArrayCopy();
            
            $secureUrl = $responseArray['secure_url'] ?? null;
            
            Log::info('CloudinaryService: Upload successful', [
                'secure_url' => $secureUrl,
                'public_id' => $responseArray['public_id'] ?? null,
                'original_size_bytes' => $fileSizeBytes,
                'original_size_mb' => round($fileSizeBytes / 1048576, 2),
                'compressed' => $fileSizeBytes > 1048576,
                'optimized' => true
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
        // Check maximum file size limit (10MB = 10485760 bytes)
        $maxSizeBytes = 10485760; // 10MB hard limit
        $fileSizeBytes = $file->getSize();
        
        if ($fileSizeBytes > $maxSizeBytes) {
            $fileSizeMB = round($fileSizeBytes / 1048576, 2);
            throw new \Exception("ფაილის ზომა ({$fileSizeMB}MB) ძალიან დიდია. მაქსიმალური ზომა: 10MB");
        }

        $originalName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
        $uniqueName = $originalName . '_' . time();

        $response = $this->cloudinary->uploadApi()->upload($file->getRealPath(), [
            'folder'          => $folder,
            'public_id'       => $uniqueName,
            'overwrite'       => true,
            'resource_type'   => 'image',
            'use_filename'    => true,
            'unique_filename' => false,
            // Aggressive transformations for optimization
            'quality'         => 'auto:eco',
            'fetch_format'    => 'auto',
            'width'           => 1920,
            'height'          => 1080,
            'crop'            => 'limit',
            'flags'           => 'progressive.lossy',
            'dpr'             => 'auto',
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
        // Check if file exists
        if (!file_exists($filePath)) {
            throw new \Exception("ფაილი ვერ მოიძებნა: {$filePath}");
        }

        // Check maximum file size limit (10MB = 10485760 bytes)
        $maxSizeBytes = 10485760; // 10MB hard limit
        $fileSizeBytes = filesize($filePath);
        
        if ($fileSizeBytes > $maxSizeBytes) {
            $fileSizeMB = round($fileSizeBytes / 1048576, 2);
            throw new \Exception("ფაილის ზომა ({$fileSizeMB}MB) ძალიან დიდია. მაქსიმალური ზომა: 10MB");
        }

        $filename = pathinfo($filePath, PATHINFO_FILENAME);
        $uniqueName = $filename . '_' . time();

        $response = $this->cloudinary->uploadApi()->upload($filePath, [
            'folder'          => $folder,
            'public_id'       => $uniqueName,
            'overwrite'       => true,
            'resource_type'   => 'image',
            'use_filename'    => true,
            'unique_filename' => false,
            // Aggressive transformations for optimization
            'quality'         => 'auto:eco',
            'fetch_format'    => 'auto',
            'width'           => 1920,
            'height'          => 1080,
            'crop'            => 'limit',
            'flags'           => 'progressive.lossy',
            'dpr'             => 'auto',
        ]);

        $responseArray = $response instanceof \ArrayAccess ? $response : $response->getArrayCopy();
        
        return $responseArray['secure_url'] ?? null;
    }
}
