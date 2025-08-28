<?php

// Fix email templates - replace dangerous null references with safe alternatives

$templates = [
    'resources/views/emails/admin/pending.blade.php',
    'resources/views/emails/admin/confirmed.blade.php', 
    'resources/views/emails/admin/completed.blade.php',
    'resources/views/emails/admin/cancelled.blade.php',
    'resources/views/emails/client/pending.blade.php',
    'resources/views/emails/client/confirmed.blade.php',
    'resources/views/emails/client/completed.blade.php',
    'resources/views/emails/client/cancelled.blade.php',
    'resources/views/emails/restaurant/pending.blade.php',
    'resources/views/emails/restaurant/confirmed.blade.php',
    'resources/views/emails/restaurant/completed.blade.php',
    'resources/views/emails/restaurant/cancelled.blade.php',
];

$replacements = [
    // Fix reservation name
    '{{ $reservation->name }}' => '{{ $reservation->client_name ?? "N/A" }}',
    
    // Fix place relationship
    '{{ $reservation->place->name }}' => '{{ $reservation->place->name ?? "N/A" }}',
    '{{ $reservation->place ? $reservation->place->name : "N/A" }}' => '{{ $reservation->place->name ?? "N/A" }}',
    
    // Fix table relationship  
    '{{ $reservation->table->name }}' => '{{ $reservation->table->name ?? "N/A" }}',
    '{{ $reservation->table ? $reservation->table->name : "N/A" }}' => '{{ $reservation->table->name ?? "N/A" }}',
    
    // Fix table->place relationship
    '{{ $reservation->table->place->name }}' => '{{ $reservation->table?->place?->name ?? "N/A" }}',
    
    // Fix restaurant relationship
    '{{ $reservation->restaurant->name }}' => '{{ $restaurantName }}',
    
    // Fix other potential null references
    '{{ $reservation->phone }}' => '{{ $reservation->phone ?? "N/A" }}',
    '{{ $reservation->email }}' => '{{ $reservation->email ?? "N/A" }}',
    '{{ $reservation->client_phone }}' => '{{ $reservation->client_phone ?? "N/A" }}',
    '{{ $reservation->client_email }}' => '{{ $reservation->client_email ?? "N/A" }}',
];

foreach ($templates as $template) {
    if (!file_exists($template)) {
        echo "⚠️  Template not found: $template\n";
        continue;
    }
    
    $content = file_get_contents($template);
    $originalContent = $content;
    
    foreach ($replacements as $find => $replace) {
        $content = str_replace($find, $replace, $content);
    }
    
    if ($content !== $originalContent) {
        file_put_contents($template, $content);
        echo "✅ Fixed: $template\n";
    } else {
        echo "✓ OK: $template\n";
    }
}

echo "\n🎉 All templates processed!\n";
