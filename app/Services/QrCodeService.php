<?php

namespace App\Services;

use Illuminate\Support\Facades\Crypt;
use Endroid\QrCode\QrCode;
use Endroid\QrCode\Writer\PngWriter;
use Endroid\QrCode\Encoding\Encoding;
use Endroid\QrCode\ErrorCorrectionLevel\ErrorCorrectionLevelMedium;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;

class QrCodeService
{
    protected CloudinaryService $cloudinaryService;

    public function __construct(CloudinaryService $cloudinaryService)
    {
        $this->cloudinaryService = $cloudinaryService;
    }

    public function generateTableToken($table)
    {
        $payload = [
            'table_id' => $table->id,
            'place_id' => $table->place_id,
            'restaurant_id' => $table->restaurant_id,
        ];

        return Crypt::encrypt(json_encode($payload));
    }

    public function decryptToken($token)
    {
        $decrypted = Crypt::decrypt($token);
        return json_decode($decrypted, true);
    }

    /**
     * Generate QR code for a place and upload to Cloudinary
     *
     * @param int $placeId
     * @param string $placeName
     * @param string $restaurantSlug
     * @param string $placeSlug
     * @return array ['qr_code_url' => string, 'qr_code_link' => string]
     */
    public function generateForPlace(int $placeId, string $placeName, string $restaurantSlug, string $placeSlug): array
    {
        // Generate the URL that the QR code will point to
        $baseUrl = config('app.frontend_url', config('app.url'));
        $qrLink = "{$baseUrl}/booking-form/{$restaurantSlug}/place/{$placeSlug}";


        // Create QR code
        $qrCode = new QrCode($qrLink);

        // Create writer
        $writer = new PngWriter();
        $result = $writer->write($qrCode);

        // Generate a unique filename
        $filename = 'place_' . $placeId . '_' . Str::random(8) . '.png';

        // Save temporarily
        $tempPath = storage_path('app/temp/' . $filename);

        // Ensure temp directory exists
        if (!file_exists(dirname($tempPath))) {
            mkdir(dirname($tempPath), 0755, true);
        }

        file_put_contents($tempPath, $result->getString());

        try {
            // Upload to Cloudinary using direct API call
            $response = $this->cloudinaryService->uploadFromPath($tempPath, 'foodly/qr-codes/places');

            // Clean up temp file
            unlink($tempPath);

            return [
                'qr_code_image' => $response,
                'qr_code_link' => $qrLink
            ];
        } catch (\Exception $e) {
            // Clean up temp file on error
            if (file_exists($tempPath)) {
                unlink($tempPath);
            }

            throw $e;
        }
    }

    /**
     * Delete QR code from Cloudinary
     *
     * @param string $qrCodeUrl
     * @return bool
     */
    public function deleteQRCode(string $qrCodeUrl): bool
    {
        try {
            return $this->cloudinaryService->deleteImageFromUrl($qrCodeUrl, 'foodly/qr-codes/places');
        } catch (\Exception $e) {
            Log::error('Failed to delete QR code: ' . $e->getMessage());
            return false;
        }
    }

    /**
     * Regenerate QR code for a place
     *
     * @param int $placeId
     * @param string $placeName
     * @param string $restaurantSlug
     * @param string $placeSlug
     * @param string|null $oldQrCodeUrl
     * @return array
     */
    public function regenerateForPlace(int $placeId, string $placeName, string $restaurantSlug, string $placeSlug, ?string $oldQrCodeUrl = null): array
    {
        // Delete old QR code if exists
        if ($oldQrCodeUrl) {
            $this->deleteQRCode($oldQrCodeUrl);
        }

        // Generate new QR code
        return $this->generateForPlace($placeId, $placeName, $restaurantSlug, $placeSlug);
    }

    /**
     * Generate QR code for a table and upload to Cloudinary
     *
     * @param int $tableId
     * @param string $tableName
     * @param string $restaurantSlug
     * @param string|null $placeSlug
     * @param string $tableSlug
     * @return array ['qr_code_image' => string, 'qr_code_link' => string]
     */
    public function generateForTable(int $tableId, string $tableName, string $restaurantSlug, ?string $placeSlug, string $tableSlug): array
    {
        // Generate the URL that the QR code will point to
        $baseUrl = config('app.frontend_url', config('app.url'));
        
        // Generate appropriate URL based on whether table belongs to a place or directly to restaurant
        $qrLink = $placeSlug
            ? "{$baseUrl}/booking-form/{$restaurantSlug}/{$placeSlug}/table/{$tableSlug}"
            : "{$baseUrl}/booking-form/restaurant/{$restaurantSlug}/table/{$tableSlug}";

        // ? "{$baseUrl}/restaurants/{$restaurantSlug}/{$placeSlug}/tables/{$tableSlug}/reservation"
        // : "{$baseUrl}/restaurants/{$restaurantSlug}/tables/{$tableSlug}/reservation";


        // Create QR code
        $qrCode = new QrCode($qrLink);

        // Create writer
        $writer = new PngWriter();
        $result = $writer->write($qrCode);

        // Generate a unique filename
        $filename = 'table_' . $tableId . '_' . Str::random(8) . '.png';

        // Save temporarily
        $tempPath = storage_path('app/temp/' . $filename);

        // Ensure temp directory exists
        if (!file_exists(dirname($tempPath))) {
            mkdir(dirname($tempPath), 0755, true);
        }

        file_put_contents($tempPath, $result->getString());

        try {
            // Upload to Cloudinary using direct API call
            $response = $this->cloudinaryService->uploadFromPath($tempPath, 'foodly/qr-codes/tables');

            // Clean up temp file
            unlink($tempPath);

            return [
                'qr_code_image' => $response,
                'qr_code_link' => $qrLink
            ];
        } catch (\Exception $e) {
            // Clean up temp file on error
            if (file_exists($tempPath)) {
                unlink($tempPath);
            }

            throw $e;
        }
    }

    /**
     * Regenerate QR code for a table
     *
     * @param int $tableId
     * @param string $tableName
     * @param string $restaurantSlug
     * @param string|null $placeSlug
     * @param string $tableSlug
     * @param string|null $oldQrCodeUrl
     * @return array
     */
    public function regenerateForTable(int $tableId, string $tableName, string $restaurantSlug, ?string $placeSlug, string $tableSlug, ?string $oldQrCodeUrl = null): array
    {
        // Delete old QR code if exists
        if ($oldQrCodeUrl) {
            $this->deleteQRCode($oldQrCodeUrl);
        }

        // Generate new QR code
        return $this->generateForTable($tableId, $tableName, $restaurantSlug, $placeSlug, $tableSlug);
    }

    /**
     * Generate QR code for a restaurant and upload to Cloudinary
     *
     * @param int $restaurantId
     * @param string $restaurantName
     * @param string $restaurantSlug
     * @return array ['qr_code_image' => string, 'qr_code_link' => string]
     */
    public function generateForRestaurant(int $restaurantId, string $restaurantName, string $restaurantSlug): array
    {
        // Generate the URL that the QR code will point to (restaurant main page)
        $baseUrl = config('app.frontend_url', config('app.url'));
        
        $qrLink = "{$baseUrl}/booking-form/restaurant/{$restaurantSlug}";



        // Create QR code
        $qrCode = new QrCode($qrLink);

        // Create writer
        $writer = new PngWriter();
        $result = $writer->write($qrCode);

        // Generate a unique filename
        $filename = 'restaurant_' . $restaurantId . '_' . Str::random(8) . '.png';

        // Save temporarily
        $tempPath = storage_path('app/temp/' . $filename);

        // Ensure temp directory exists
        if (!file_exists(dirname($tempPath))) {
            mkdir(dirname($tempPath), 0755, true);
        }

        file_put_contents($tempPath, $result->getString());

        try {
            // Upload to Cloudinary using direct API call
            $response = $this->cloudinaryService->uploadFromPath($tempPath, 'foodly/qr-codes/restaurants');

            // Clean up temp file
            unlink($tempPath);

            return [
                'qr_code_image' => $response,
                'qr_code_link' => $qrLink
            ];

        } catch (\Exception $e) {
            Log::error('Failed to generate QR code for restaurant: ' . $e->getMessage());
            throw $e;
        }
    }

    /**
     * Regenerate QR code for a restaurant
     *
     * @param int $restaurantId
     * @param string $restaurantName
     * @param string $restaurantSlug
     * @param string|null $oldQrCodeUrl
     * @return array ['qr_code_image' => string, 'qr_code_link' => string]
     */
    public function regenerateForRestaurant(int $restaurantId, string $restaurantName, string $restaurantSlug, ?string $oldQrCodeUrl = null): array
    {
        // Delete old QR code if exists
        if ($oldQrCodeUrl) {
            $this->deleteQRCode($oldQrCodeUrl);
        }

        // Generate new QR code
        return $this->generateForRestaurant($restaurantId, $restaurantName, $restaurantSlug);
    }
}
