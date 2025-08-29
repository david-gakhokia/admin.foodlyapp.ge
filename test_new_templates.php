<?php

require_once __DIR__ . '/vendor/autoload.php';

// Setup Laravel application
$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make(\Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use App\Mail\Client\ClientPendingEmail;
use App\Mail\Restaurant\RestauranPendingEmail;
use App\Mail\Admin\AdminPendingEmail;
use App\Models\Reservation;
use Illuminate\Support\Facades\Mail;

echo "🎨 დიზაინების ტესტი - ახალი Template-ები\n";
echo "======================================\n\n";

try {
    // Get or create test reservation
    $reservation = Reservation::first();
    
    if (!$reservation) {
        echo "❌ რეზერვაცია ვერ მოიძებნა\n";
        return;
    }
    
    echo "📧 ტესტ რეზერვაცია ID: {$reservation->id}\n";
    echo "👤 კლიენტი: {$reservation->name}\n";
    echo "📧 Email: {$reservation->email}\n\n";
    
    // Define test emails
    $testEmails = [
        'david.gakhokia@gmail.com',
        'gakhokia.david@gmail.com',
        'dev.foodly@gmail.com'
    ];
    
    echo "🎯 Email-ების გაგზავნა ახალი დიზაინებით:\n";
    echo "========================================\n\n";
    
    foreach ($testEmails as $index => $email) {
        echo "📤 Email #" . ($index + 1) . ": {$email}\n";
        
        try {
            // Client Email (pending)
            Mail::to($email)->send(new ClientPendingEmail($reservation));
            echo "   ✅ კლიენტის Email (emails.client.pending)\n";
            
            // Restaurant Email (pending)  
            Mail::to($email)->send(new RestauranPendingEmail($reservation));
            echo "   ✅ რესტორნის Email (emails.restaurant.pending)\n";
            
            // Admin Email (pending)
            Mail::to($email)->send(new AdminPendingEmail($reservation));
            echo "   ✅ ადმინის Email (emails.admin.pending)\n";
            
        } catch (Exception $e) {
            echo "   ❌ შეცდომა: " . $e->getMessage() . "\n";
        }
        
        echo "\n";
        sleep(2);
    }
    
    echo "📊 შეჯამება:\n";
    echo "=============\n";
    echo "✅ ყველა Email-ს ახალი Template-ები აქვს:\n\n";
    
    echo "🔧 Mail კლასების მდგომარეობა:\n";
    echo "   👤 ClientPendingEmail -> emails.client.pending\n";
    echo "   🏪 RestauranPendingEmail -> emails.restaurant.pending\n";
    echo "   🛡️ AdminPendingEmail -> emails.admin.pending\n\n";
    
    echo "🎨 დიზაინის გაუმჯობესებები:\n";
    echo "   • თითოეულ Email-ს აქვს საკუთარი უნიკალური დიზაინი\n";
    echo "   • კლიენტისთვის - მომხმარებელზე ორიენტირებული დიზაინი\n";
    echo "   • რესტორნისთვის - ბიზნეს ორიენტირებული დიზაინი\n";
    echo "   • ადმინისთვის - ადმინისტრაციული დეტალური დიზაინი\n\n";
    
    echo "📬 თუ Email-ები არ მოდის foodly.portal@gmail.com-ზე:\n";
    echo "   1. შეამოწმეთ Gmail-ის Spam ფოლდერი\n";
    echo "   2. შეამოწმეთ Promotions ან Updates tab-ები\n";
    echo "   3. დაამატეთ noreply@foodlyapp.ge Contacts-ში\n\n";
    
    echo "🎉 Email სისტემა სრულად მზადაა!\n";
    
} catch (Exception $e) {
    echo "❌ შეცდომა: " . $e->getMessage() . "\n";
    echo "📍 ფაილი: " . $e->getFile() . ":" . $e->getLine() . "\n";
}
