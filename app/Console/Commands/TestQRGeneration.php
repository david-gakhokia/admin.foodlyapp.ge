<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\QrCodeService;
use App\Models\Place;

class TestQRGeneration extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'test:qr-generation {place_id?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Test QR code generation for places';

    protected QrCodeService $qrCodeService;

    public function __construct(QrCodeService $qrCodeService)
    {
        parent::__construct();
        $this->qrCodeService = $qrCodeService;
    }

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $placeId = $this->argument('place_id');
        
        if ($placeId) {
            $place = Place::with(['restaurant', 'translations'])->find($placeId);
            
            if (!$place) {
                $this->error("Place with ID {$placeId} not found!");
                return 1;
            }
            
            $placeName = $place->translations->first()->name ?? 'Unknown';
            $this->info("Generating QR code for place: {$placeName}");
            
            try {
                $restaurant = $place->restaurant;
                $placeName = $place->translations->first()->name ?? 'Place';
                
                $qrData = $this->qrCodeService->generateForPlace(
                    $place->id,
                    $placeName,
                    $restaurant->slug,
                    $place->slug
                );

                // Update place with QR code data
                $place->update([
                    'qr_code_url' => $qrData['qr_code_url'],
                    'qr_code_link' => $qrData['qr_code_link']
                ]);

                $this->info("QR Code generated successfully!");
                $this->line("QR Code URL: " . $qrData['qr_code_url']);
                $this->line("QR Code Link: " . $qrData['qr_code_link']);
                
            } catch (\Exception $e) {
                $this->error("Failed to generate QR code: " . $e->getMessage());
                return 1;
            }
        } else {
            // Test with dummy data
            $this->info("Testing QR code generation with dummy data...");
            
            try {
                $qrData = $this->qrCodeService->generateForPlace(
                    999,
                    'Test Place',
                    'test-restaurant',
                    'test-place'
                );

                $this->info("QR Code generated successfully!");
                $this->line("QR Code URL: " . $qrData['qr_code_url']);
                $this->line("QR Code Link: " . $qrData['qr_code_link']);
                
            } catch (\Exception $e) {
                $this->error("Failed to generate QR code: " . $e->getMessage());
                return 1;
            }
        }
        
        return 0;
    }
}
