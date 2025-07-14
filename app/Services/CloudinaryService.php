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
        $this->cloudinary = new Cloudinary(config('cloudinary'));
    }



    public function upload(UploadedFile $file, string $folder = 'foodly'): ?string
    {
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
        // Remove the version part of the URL (e.g., /v1234567890/)
        $urlWithoutVersion = preg_replace('/\/v\d+\//', '/', $url);

        // Get the path part of the URL
        $path = parse_url($urlWithoutVersion, PHP_URL_PATH);

        // Remove the initial / from the path
        $path = ltrim($path, '/');

        // Remove the cloud_name and resource_type part (e.g., cloud_name/resource_type/upload/)
        // This might need adjustment based on your Cloudinary setup and URL structure
        // Assuming standard 'upload' resource_type for images.
        // Example path: your_cloud_name/image/upload/folder/image_name.jpg
        // We need to get 'folder/image_name'

        $parts = explode('/', $path);
        // Typically, after cloud_name/image/upload/, the rest is the public_id including folders.
        // This assumes a URL structure like https://res.cloudinary.com/CLOUD_NAME/image/upload/VERSION/PUBLIC_ID.EXT
        // After removing version: https://res.cloudinary.com/CLOUD_NAME/image/upload/PUBLIC_ID.EXT
        // Path: /CLOUD_NAME/image/upload/PUBLIC_ID.EXT
        // Exploded parts (example): ['', 'CLOUD_NAME', 'image', 'upload', 'folder', 'image_name.jpg']
        // We want 'folder/image_name'

        // A more robust way is to find the $folderPrefix if provided
        if (!empty($folderPrefix)) {
            $prefixPosition = strpos($path, $folderPrefix);
            if ($prefixPosition !== false) {
                $publicIdWithExtension = substr($path, $prefixPosition);
            } else {
                // Fallback if prefix not found, this part is tricky and depends on URL structure
                // This basic extraction assumes public_id is the last part before extension, after /upload/
                $uploadMarker = '/upload/';
                $uploadPos = strpos($path, $uploadMarker);
                if ($uploadPos === false) return null;
                $publicIdWithExtension = substr($path, $uploadPos + strlen($uploadMarker));
            }
        } else {
            // Basic extraction if no folder prefix
            $uploadMarker = '/upload/';
            $uploadPos = strpos($path, $uploadMarker);
            if ($uploadPos === false) return null;
            $publicIdWithExtension = substr($path, $uploadPos + strlen($uploadMarker));
        }

        // Remove file extension
        $publicId = pathinfo($publicIdWithExtension, PATHINFO_FILENAME);
        // If the path still contains the cloud name (it shouldn't if parsed correctly from full URL path)
        // this logic needs to be robust based on your exact URL structure from Cloudinary.
        // A common structure for public_id is 'folder/subfolder/asset_name'

        // The most reliable way is if $uploaded['public_id'] from uploadImage response is stored.
        // If not, parsing can be error-prone.
        // Example for: "foodly/menu_categories/image_name"
        // URL: https://res.cloudinary.com/demo/image/upload/v123/foodly/menu_categories/image_name.jpg
        // path: /demo/image/upload/v123/foodly/menu_categories/image_name.jpg
        // $urlWithoutVersion: /demo/image/upload/foodly/menu_categories/image_name.jpg
        // $path (after ltrim): demo/image/upload/foodly/menu_categories/image_name.jpg
        //
        // A simpler regex approach if public_id is always after the $folderPrefix (or /upload/ if no prefix)
        // and contains the folder structure.

        $pattern = '';
        if (!empty($folderPrefix)) {
            // Ensure folderPrefix doesn't have trailing slash for this pattern
            $folderPrefix = rtrim($folderPrefix, '/');
            // Pattern to capture everything after the folder prefix up to the file extension
            $pattern = '/' . preg_quote($folderPrefix, '/') . '\/(.+?)(\.\w+)?$/';
        } else {
            // Pattern to capture everything after /upload/ up to the file extension
            // This is less specific and might grab parts of cloud_name if URL structure is non-standard
            $pattern = '/\/upload\/(.+?)(\.\w+)?$/';
        }

        // Let's use a more direct approach based on knowing the secure_url structure
        // secure_url: https://res.cloudinary.com/<cloud_name>/image/upload/<version>/<public_id>.<format>
        // We need to extract <public_id> which includes folders.
        // The $folderPrefix helps identify the start of the public_id if it's part of it.

        // Example: $url = "https://res.cloudinary.com/mycloud/image/upload/v12345/foodly/menu_categories/img1.jpg"
        // We want "foodly/menu_categories/img1"
        $parts = explode('/', $url);
        $fileNameWithExtension = end($parts); // img1.jpg
        $publicIdParts = [];
        // Iterate backwards from the filename part until we hit the version or 'upload'
        for ($i = count($parts) - 2; $i >= 0; $i--) {
            if (preg_match('/^v\d+$/', $parts[$i]) || $parts[$i] === 'upload') {
                break;
            }
            array_unshift($publicIdParts, $parts[$i]);
        }
        if (empty($publicIdParts)) return null; // Could not determine structure

        $publicIdWithoutFilename = implode('/', $publicIdParts);
        $filenameWithoutExtension = pathinfo($fileNameWithExtension, PATHINFO_FILENAME);

        return $publicIdWithoutFilename ? $publicIdWithoutFilename . '/' . $filenameWithoutExtension : $filenameWithoutExtension;
    }


    public function deleteImage(string $publicId)
    {
        try {
            return $this->cloudinary->uploadApi()->destroy($publicId);
        } catch (\Exception $e) {
            // Log error or handle it
            report($e); // Laravel's helper to log exceptions
            return null;
        }
    }

    /**
     * Uploads an image to Cloudinary and returns full response array.
     *
     * @param UploadedFile $file The file to upload.
     * @param string $folder The folder in Cloudinary.
     * @return array The response from Cloudinary as an array.
     */
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

        // Convert ApiResponse to array
        return $response->getArrayCopy();
    }

    /**
     * Check if URL is from Cloudinary
     */
    public function isCloudinaryUrl(string $url): bool
    {
        return str_contains($url, 'cloudinary.com');
    }

    /**
     * Delete image from appropriate storage (Cloudinary or local)
     */
    public function deleteImageFromUrl(string $imageUrl, string $folder = ''): bool
    {
        try {
            if ($this->isCloudinaryUrl($imageUrl)) {
                // Extract public_id and delete from Cloudinary
                $publicId = $this->extractPublicIdFromUrl($imageUrl, $folder);
                if ($publicId) {
                    $this->deleteImage($publicId);
                    return true;
                }
            } else if (!filter_var($imageUrl, FILTER_VALIDATE_URL)) {
                // Delete from local storage (legacy support)
                $oldImagePath = public_path('storage/' . $imageUrl);
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath);
                    return true;
                }
            }
            // External URLs - we don't delete these
            return false;
        } catch (\Exception $e) {
            Log::warning('Failed to delete image: ' . $e->getMessage(), [
                'image_url' => $imageUrl
            ]);
            return false;
        }
    }

    /**
     * Upload file from local path to Cloudinary
     */
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

        // Convert response to array if it's not already
        $responseArray = $response instanceof \ArrayAccess ? $response : $response->getArrayCopy();
        
        return $responseArray['secure_url'] ?? null;
    }
}
