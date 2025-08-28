#!/bin/bash

# Fix all Mailable classes to handle restaurant names properly

echo "🔧 Fixing all Mailable classes..."

# Get all unique Mailable files
find app/Mail -name "*.php" | sort | uniq | while read file; do
    echo "Processing: $file"
    
    # Check if file already has restaurantName property
    if ! grep -q "public \$restaurantName" "$file"; then
        # Add restaurant name logic after public $reservation
        sed -i '/public \$reservation;/a\
    public $restaurantName;' "$file"
        
        # Add restaurant name logic to constructor
        sed -i '/\$this->reservation = \$reservation;/a\
        \
        // Pre-compute restaurant name to avoid serialization issues\
        if (method_exists($reservation, '\''getRestaurantName'\'')) {\
            $this->restaurantName = $reservation->getRestaurantName();\
        } else {\
            $this->restaurantName = '\''N/A'\'';\
        }' "$file"
        
        # Add restaurantName to with() array in build method
        sed -i "s/'reservation' => \$this->reservation/'reservation' => \$this->reservation,\n                        'restaurantName' => \$this->restaurantName/g" "$file"
        
        echo "✅ Fixed: $file"
    else
        echo "⏭️  Already fixed: $file"
    fi
done

echo "🎉 All Mailable classes fixed!"
