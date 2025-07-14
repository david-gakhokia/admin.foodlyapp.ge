<?php

namespace App\Enums;

enum ReservationStatus: string
{
    case Pending = 'pending';       // ჯერ მხოლოდ მოთხოვნა გაგზავნილია
    case Confirmed = 'confirmed';   // რესტორანმა დაადასტურა
    case Cancelled = 'cancelled';   // რესტორანმა უარყო
    case Paid = 'paid';             // მომხმარებელმა გადაიხადა (BOG Capture Success)
}
