# Fix all Mailable classes to handle restaurant names properly

Write-Host "🔧 Fixing all Mailable classes..." -ForegroundColor Cyan

# Get all unique Mailable files
$mailableFiles = Get-ChildItem -Path "app\Mail" -Filter "*.php" -Recurse | Sort-Object FullName | Get-Unique -AsString

foreach ($file in $mailableFiles) {
    Write-Host "Processing: $($file.FullName)" -ForegroundColor Yellow
    
    $content = Get-Content $file.FullName -Raw
    
    # Check if file already has restaurantName property
    if ($content -notmatch "public \`$restaurantName") {
        Write-Host "  Adding restaurantName property..." -ForegroundColor Green
        
        # Add restaurant name property after reservation property
        $content = $content -replace "(public \`$reservation;)", "`$1`n    public `$restaurantName;"
        
        # Add restaurant name logic to constructor after reservation assignment
        $constructorAddition = @"

        // Pre-compute restaurant name to avoid serialization issues
        if (method_exists(`$reservation, 'getRestaurantName')) {
            `$this->restaurantName = `$reservation->getRestaurantName();
        } else {
            `$this->restaurantName = 'N/A';
        }
"@
        $content = $content -replace "(\`$this->reservation = \`$reservation;)", "`$1$constructorAddition"
        
        # Add restaurantName to with() array in build method
        $content = $content -replace "('reservation' => \`$this->reservation)", "'reservation' => `$this->reservation,`n                        'restaurantName' => `$this->restaurantName"
        
        # Write back to file
        Set-Content -Path $file.FullName -Value $content -Encoding UTF8
        
        Write-Host "  ✅ Fixed: $($file.Name)" -ForegroundColor Green
    } else {
        Write-Host "  ⏭️ Already fixed: $($file.Name)" -ForegroundColor Gray
    }
}

Write-Host "🎉 All Mailable classes fixed!" -ForegroundColor Green
