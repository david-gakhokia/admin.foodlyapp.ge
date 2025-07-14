<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Kiosk;

class KioskSeeder extends Seeder
{

    public function run()
    {
        Kiosk::create([
            'identifier' => 'KIOSK_001',
            'secret'     => 'super-secret', 
            'name'       => 'Ali & Nino Kiosk',
            'location'   => 'Batumi Old Boulevard',
            'status'     => 'active',
            'ip_address' => '192.168.1.50',
        ]);
        Kiosk::create([
            'identifier' => 'KIOSK_002',
            'secret'     => 'another-secret',
            'name'       => 'Sabagiro Kiosk',
            'location'   => 'Batumi Sabagiro',
            'status'     => 'active',
            'ip_address' => '192.168.1.51',
        ]);
        Kiosk::create([
            'identifier' => 'KIOSK_003',
            'secret'     => 'third-secret',
            'name'       => 'Era Square Kiosk',
            'location'   => 'Batumi Era Square',
            'status'     => 'active',
            'ip_address' => '192.168.1.52',
        ]);
    }
}
