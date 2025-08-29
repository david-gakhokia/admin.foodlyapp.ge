@extends('emails.layouts.restaurant')

@section('content')
<!-- Header -->
<div class="header status-paid">
    <div class="restaurant-badge">🏪 RESTAURANT PANEL</div>
    <div class="logo">🍽️ FOODLY</div>
    <div class="status-badge">💳 გადახდილი</div>
</div>

<!-- Content -->
<div class="content">
    <h1 class="title georgian">💰 კლიენტმა გადაიხადა!</h1>

    <div class="restaurant-alert">
        <p style="font-size: 16px; margin: 0;">
            🎉 <strong>შესანიშნავი! რეზერვაცია სრულად გადახდილია!</strong><br>
            ეს არის VIP რეზერვაცია - უზრუნველყავით უმაღლესი ხარისხის სერვისი.
        </p>
    </div>

    <div style="background: linear-gradient(135deg, #ecfdf5 0%, #d1fae5 100%); border: 2px solid #10b981; border-radius: 12px; padding: 25px; margin: 20px 0; text-align: center;">
        <p style="font-size: 24px; font-weight: 700; color: #065f46; margin: 0;">
            💰 გადახდილი თანხა: <span style="color: #047857;">{{ $paymentAmount ?? 'N/A' }} ₾</span>
        </p>
        <p style="font-size: 16px; color: #059669; margin-top: 10px;">
            🏪 თქვენი ნაწილი: <span style="font-weight: 600;">{{ $restaurantShare ?? 'N/A' }} ₾</span> ({{ $sharePercentage ?? '95' }}%)
        </p>
        <p style="font-size: 14px; color: #065f46; margin-top: 5px;">
            📋 ტრანზაქციის ID: <code style="background: rgba(255,255,255,0.8); padding: 4px 8px; border-radius: 6px;">{{ $transactionId ?? 'N/A' }}</code>
        </p>
    </div>

    <div class="reservation-card">
        <div class="detail-row">
            <span class="detail-label">🆔 რეზერვაციის ID:</span>
            <span class="detail-value">{{ $reservation->id ?? 'N/A' }}</span>
        </div>
        
        <div class="detail-row">
            <span class="detail-label">👤 კლიენტის სახელი:</span>
            <span class="detail-value georgian">{{ $reservation->name ?? 'N/A' }}</span>
        </div>
        
        <div class="detail-row">
            <span class="detail-label">📧 ელ-ფოსტა:</span>
            <span class="detail-value">{{ $reservation->email ?? 'N/A' }}</span>
        </div>
        
        <div class="detail-row">
            <span class="detail-label">📞 ტელეფონი:</span>
            <span class="detail-value">{{ $reservation->phone ?? 'N/A' }}</span>
        </div>
        
        <div class="detail-row">
            <span class="detail-label">👥 სტუმრები:</span>
            <span class="detail-value"><strong style="color: #047857;">{{ $reservation->guests_count ?? 'N/A' }} პერსონა</strong></span>
        </div>
        
        <div class="detail-row">
            <span class="detail-label">📅 თარიღი:</span>
            <span class="detail-value"><strong style="color: #047857;">{{ $reservation->reservation_date ?? 'N/A' }}</strong></span>
        </div>
        
        <div class="detail-row">
            <span class="detail-label">🕐 დრო:</span>
            <span class="detail-value"><strong style="color: #047857;">{{ $reservation->time_from ?? 'N/A' }} - {{ $reservation->time_to ?? 'N/A' }}</strong></span>
        </div>
        
        <div class="detail-row">
            <span class="detail-label">💳 გადახდის დრო:</span>
            <span class="detail-value">{{ $paymentTime ?? now() }}</span>
        </div>
        
        @if($reservation->notes ?? false)
        <div class="detail-row">
            <span class="detail-label">📝 კლიენტის შენიშვნა:</span>
            <span class="detail-value georgian" style="font-style: italic; color: #059669;">{{ $reservation->notes }}</span>
        </div>
        @endif
    </div>

    <div style="background: linear-gradient(135deg, #fef3c7 0%, #fde047 100%); border: 2px solid #eab308; border-radius: 12px; padding: 20px; margin: 25px 0;">
        <p style="font-size: 18px; font-weight: 600; color: #92400e; margin-bottom: 15px; text-align: center;">
            💎 <strong>VIP რეზერვაცია - განსაკუთრებული ყურადღება!</strong>
        </p>
        <div style="color: #78350f; text-align: center;">
            ✨ კლიენტმა წინასწარ გადაიხადა - ისაუბნუი მაღალ მოლოდინზე<br>
            🎯 უზრუნველყავით უმაღლესი ხარისხის სერვისი<br>
            ⭐ შეფასება ამ რეზერვაციისთვის განსაკუთრებით მნიშვნელოვანია<br>
            🤝 ეს არის კლიენტის ნდობის ნიშანი თქვენ მიმართ
        </div>
        
        <div style="margin-top: 20px; text-align: center;">
            <a href="{{ $restaurantPanelUrl ?? 'https://restaurant.foodly.space/vip-reservations' }}" style="display: inline-block; background: linear-gradient(135deg, #eab308 0%, #ca8a04 100%); color: white; padding: 15px 25px; border-radius: 25px; text-decoration: none; font-weight: 600; margin: 0 10px;">
                💎 VIP რეზერვაციები
            </a>
            <a href="tel:{{ $reservation->phone ?? '+995322152024' }}" style="display: inline-block; background: linear-gradient(135deg, #ff6b35 0%, #f7931e 100%); color: white; padding: 15px 25px; border-radius: 25px; text-decoration: none; font-weight: 600; margin: 0 10px;">
                📞 კლიენტს დარეკვა
            </a>
        </div>
    </div>

    <div style="background: linear-gradient(135deg, #f0f9ff 0%, #dbeafe 100%); border: 2px solid #3b82f6; border-radius: 12px; padding: 20px; margin: 25px 0;">
        <p style="font-size: 16px; color: #1e40af; margin: 0; font-weight: 600; text-align: center;">
            💡 <strong>ფინანსური ინფორმაცია:</strong><br>
            FOODLY-ის პლატფორმის კომისია: {{ $platformFee ?? 'N/A' }} ₾ ({{ $commissionRate ?? '5' }}%)<br>
            ფინანსური ანგარიშსწორება ყოველ კვირას ხდება თქვენს ბანკის ანგარიშზე.
        </p>
    </div>

    <div class="revenue-info">
        <div style="display: flex; justify-content: space-between; align-items: center;">
            <div>
                <p style="font-size: 16px; color: #92400e; margin: 0; font-weight: 600;">
                    💰 <strong>დღევანდელი შემოსავალი:</strong>
                </p>
                <p style="font-size: 24px; color: #78350f; margin: 5px 0 0 0; font-weight: 700;">
                    {{ $todayRevenue ?? 'N/A' }} ₾
                </p>
            </div>
            <div style="text-align: right;">
                <p style="font-size: 14px; color: #a16207; margin: 0;">
                    💳 გადახდილი: {{ $todayPaidReservations ?? 'N/A' }}<br>
                    📊 სულ რეზერვაციები: {{ $todayTotalReservations ?? 'N/A' }}
                </p>
            </div>
        </div>
    </div>

    <div style="background: linear-gradient(135deg, #ecfdf5 0%, #d1fae5 100%); border: 2px solid #10b981; border-radius: 12px; padding: 20px; margin: 25px 0;">
        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
            <div style="text-align: center;">
                <p style="font-size: 16px; color: #065f46; margin: 0; font-weight: 600;">
                    📈 <strong>კვირის შემოსავალი</strong>
                </p>
                <p style="font-size: 22px; color: #047857; margin: 5px 0 0 0; font-weight: 700;">
                    {{ $weeklyRevenue ?? 'N/A' }} ₾
                </p>
            </div>
            <div style="text-align: center;">
                <p style="font-size: 16px; color: #065f46; margin: 0; font-weight: 600;">
                    🏆 <strong>წარმატების მაჩვენებელი</strong>
                </p>
                <p style="font-size: 22px; color: #047857; margin: 5px 0 0 0; font-weight: 700;">
                    {{ $successRate ?? '95' }}%
                </p>
            </div>
        </div>
    </div>

    <div style="text-align: center; margin-top: 30px;">
        <p style="font-size: 18px; font-weight: 600; color: #047857;">
            🌟 გმადლობთ FOODLY-ის პარტნიორობისთვის!
        </p>
        <p style="color: #059669; margin-top: 10px;">
            ერთად ვქმნით საუკეთესო კულინარიულ გამოცდილებას ქართველი კლიენტებისთვის.
        </p>
        
        <div style="margin-top: 20px;">
            <a href="{{ $restaurantPanelUrl ?? 'https://restaurant.foodly.space/analytics' }}" style="display: inline-block; background: linear-gradient(135deg, #059669 0%, #047857 100%); color: white; padding: 12px 25px; border-radius: 25px; text-decoration: none; font-weight: 600; margin: 0 10px;">
                📊 სრული ანალიტიკა
            </a>
            <a href="{{ $restaurantPanelUrl ?? 'https://restaurant.foodly.space/calendar' }}" style="display: inline-block; background: linear-gradient(135deg, #ff6b35 0%, #f7931e 100%); color: white; padding: 12px 25px; border-radius: 25px; text-decoration: none; font-weight: 600; margin: 0 10px;">
                📅 კალენდარი
            </a>
        </div>
    </div>
</div>

<!-- Footer -->
<div class="footer">
    <div class="footer-logo">🍽️ FOODLY RESTAURANT</div>
    <div class="footer-text georgian">
        რესტორნების პარტნიორული პლატფორმა<br>
        <strong>თქვენი ბიზნესის წარმატების გარანტი</strong>
    </div>
    <div class="contact-info">
        📧 <a href="mailto:restaurant@foodlyapp.ge">restaurant@foodlyapp.ge</a><br>
        📞 <a href="tel:+995322152024">(+995) 032 215 20 24</a><br>
        🌐 <a href="https://restaurant.foodly.space" target="_blank">restaurant.foodly.space</a>
    </div>
</div>
@endsection
