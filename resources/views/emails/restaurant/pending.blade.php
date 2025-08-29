@extends('emails.layouts.restaurant')

@section('content')
<!-- Header -->
<div class="header status-pending">
    <div class="restaurant-badge">🏪 RESTAURANT PANEL</div>
    <div class="logo">🍽️ FOODLY</div>
    <div class="status-badge">📋 ახალი რეზერვაცია</div>
</div>

<!-- Content -->
<div class="content">
    <h1 class="title georgian">🚨 ახალი რეზერვაციის მოთხოვნა!</h1>

    <div class="restaurant-alert">
        <p style="font-size: 16px; margin: 0;">
            ⚡ <strong>კლიენტი ელოდება თქვენს პასუხს!</strong><br>
            გთხოვთ, 30 წუთში გაცნოთ გადაწყვეტილება - დაადასტურეთ ან უარყავით.
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
            <span class="detail-label">⏰ მოთხოვნის დრო:</span>
            <span class="detail-value">{{ $reservation->created_at ?? 'N/A' }}</span>
        </div>
        
        @if($reservation->notes ?? false)
        <div class="detail-row">
            <span class="detail-label">📝 კლიენტის შენიშვნა:</span>
            <span class="detail-value georgian" style="font-style: italic; color: #059669;">{{ $reservation->notes }}</span>
        </div>
        @endif
    </div>

    <div class="revenue-info">
        <div style="display: flex; justify-content: space-between; align-items: center;">
            <div>
                <p style="font-size: 16px; color: #92400e; margin: 0; font-weight: 600;">
                    💰 <strong>მოსალოდნელი შემოსავალი:</strong>
                </p>
                <p style="font-size: 22px; color: #78350f; margin: 5px 0 0 0; font-weight: 700;">
                    {{ $expectedRevenue ?? 'N/A' }} ₾
                </p>
            </div>
            <div style="text-align: right;">
                <p style="font-size: 14px; color: #a16207; margin: 0;">
                    👥 {{ $reservation->guests_count ?? 'N/A' }} სტუმარი<br>
                    ⏱️ {{ $estimatedDuration ?? '2' }} საათი
                </p>
            </div>
        </div>
    </div>

    <div style="background: linear-gradient(135deg, #ecfdf5 0%, #d1fae5 100%); border: 2px solid #10b981; border-radius: 12px; padding: 20px; margin: 25px 0; text-align: center;">
        <p style="font-size: 16px; font-weight: 600; color: #065f46; margin-bottom: 20px;">
            🎯 <strong>მოქმედება საჭიროა:</strong>
        </p>
        
        <div style="display: flex; justify-content: center; gap: 15px; flex-wrap: wrap;">
            <a href="{{ $confirmUrl ?? 'https://restaurant.foodly.space/confirm/' . ($reservation->id ?? '1') }}" style="display: inline-block; background: linear-gradient(135deg, #10b981 0%, #059669 100%); color: white; padding: 15px 25px; border-radius: 25px; text-decoration: none; font-weight: 600;">
                ✅ დადასტურება
            </a>
            <a href="{{ $rejectUrl ?? 'https://restaurant.foodly.space/reject/' . ($reservation->id ?? '1') }}" style="display: inline-block; background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%); color: white; padding: 15px 25px; border-radius: 25px; text-decoration: none; font-weight: 600;">
                ❌ უარყოფა
            </a>
            <a href="tel:{{ $reservation->phone ?? '+995322152024' }}" style="display: inline-block; background: linear-gradient(135deg, #ff6b35 0%, #f7931e 100%); color: white; padding: 15px 25px; border-radius: 25px; text-decoration: none; font-weight: 600;">
                📞 კლიენტს დარეკვა
            </a>
        </div>
    </div>

    <div style="background: linear-gradient(135deg, #fef3c7 0%, #fde047 100%); border: 2px solid #facc15; border-radius: 12px; padding: 20px; margin: 25px 0;">
        <p style="font-size: 16px; color: #92400e; margin: 0; font-weight: 600; text-align: center;">
            ⏰ <strong>დროის მენეჯმენტი:</strong>
        </p>
        <p style="color: #78350f; margin-top: 10px; text-align: center;">
            • პასუხი 15 წუთში - 95% კმაყოფილება<br>
            • პასუხი 30 წუთში - 85% კმაყოფილება<br>
            • 30+ წუთი - რეპუტაციის დაქვეითება
        </p>
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
