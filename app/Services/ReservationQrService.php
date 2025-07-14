<?php

namespace App\Services;

use Illuminate\Support\Facades\Crypt;
use Endroid\QrCode\QrCode;
use Endroid\QrCode\Writer\PngWriter;

class ReservationQrService
{
    // რესტორნის QR
    public function generateRestaurantQr($restaurant)
    {
        $url = url("/reservations/restaurant/{$restaurant->slug}");
        return $this->generateQrImage($url);
    }

    // სივრცის QR (!!! slug-ის გამოყენებით)
    public function generatePlaceQr($place)
    {
        $url = url("/reservations/place/{$place->slug}");
        return $this->generateQrImage($url);
    }

    // მაგიდის QR (დაშიფრული ტოკენით)
    public function generateTableQr($table)
    {
        $payload = [
            'table_id' => $table->id,
            'place_id' => $table->place_id,
            'restaurant_id' => $table->restaurant_id,
        ];

        $token = Crypt::encrypt(json_encode($payload));
        $url = url("/reservations/table/{$table->id}?token={$token}");

        return $this->generateQrImage($url);
    }

    // გამოსახულების გენერაცია
    private function generateQrImage($url)
    {
        $qr = new QrCode($url);
        $qr->setSize(300);

        $writer = new PngWriter();
        $result = $writer->write($qr);

        return $result->getString();
    }



    public function generateTableQrUrl($table)
    {
        $payload = [
            'table_id' => $table->id,
            'place_id' => $table->place_id,
            'restaurant_id' => $table->restaurant_id,
        ];

        $token = Crypt::encrypt(json_encode($payload));
        $url = url("/reservations/table/{$table->id}?token={$token}");

        return $url;
    }


    // დამატებითი დამხმარე ფუნქცია - სრული URL-ის გენერაცია მაგიდის QR ტესტისთვის
    public function getTableQrUrl($table)
    {
        $payload = [
            'table_id' => $table->id,
            'place_id' => $table->place_id,
            'restaurant_id' => $table->restaurant_id,
        ];

        $token = Crypt::encrypt(json_encode($payload));
        $url = url("/reservations/table/{$table->id}?token={$token}");

        return $url;
    }
}
