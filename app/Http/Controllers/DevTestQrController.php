<?php

namespace App\Http\Controllers;

use App\Models\Table;
use App\Services\ReservationQrService;

class DevTestQrController extends Controller
{
    public function generateTableUrl($tableId)
    {
        $table = Table::findOrFail($tableId);
        $qrService = new ReservationQrService();
        $url = $qrService->generateTableQrUrl($table);

        return response()->json(['url' => $url]);
    }
}
