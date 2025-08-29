@extends('emails.layouts.client')

@section('content')
<!-- Header -->
<div class="header status-cancelled">
    <div class="logo">🍽️ FOODLY</div>
    <div class="status-badge">❌ გაუქმებული</div>
</div>

<!-- Content -->
<div class="content">
    <h1 class="title georgian">😔 რეზერვაცია გაუქმდა</h1>

    <div class="client-highlight" style="background: linear-gradient(135deg, #fee2e2 0%, #fca5a5 100%); border-color: #ef4444;">
        <p class="georgian" style="font-size: 16px; text-align: center; margin: 0; color: #991b1b;">
            💔 <strong>ვწუხვართ, თქვენი რეზერვაცია გაუქმდა</strong><br>
            რესტორანს ვერ მოხერხდა თქვენი მოთხოვნის შესრულება.
        </p>
    </div>

    <div class="reservation-card">
        <div class="detail-row">
            <span class="detail-label">👤 სახელი:</span>
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
            <span class="detail-value">{{ $reservation->guests_count ?? 'N/A' }} პერსონა</span>
        </div>
        
        <div class="detail-row">
            <span class="detail-label">📅 თარიღი:</span>
            <span class="detail-value">{{ $reservation->reservation_date ?? 'N/A' }}</span>
        </div>
        
        <div class="detail-row">
            <span class="detail-label">🕐 დრო:</span>
            <span class="detail-value">{{ $reservation->time_from ?? 'N/A' }} - {{ $reservation->time_to ?? 'N/A' }}</span>
        </div>
        
        <div class="detail-row">
            <span class="detail-label">🏪 რესტორანი:</span>
            <span class="detail-value georgian">{{ $restaurantName ?? 'N/A' }}</span>
        </div>
        
        @if($reservation->notes ?? false)
        <div class="detail-row">
            <span class="detail-label">📝 შენიშვნა:</span>
            <span class="detail-value georgian">{{ $reservation->notes }}</span>
        </div>
        @endif
    </div>

    <div class="message" style="background: linear-gradient(135deg, #fee2e2 0%, #fecaca 100%); border: 2px solid #ef4444;">
        <p class="georgian" style="font-size: 16px; font-weight: 600; color: #991b1b;">
            🤔 <strong>რატომ შეიძლება გაუქმდეს რეზერვაცია?</strong>
        </p>
        <p class="georgian" style="margin-top: 10px; color: #7f1d1d;">
            • რესტორანი დაკავებულია მოცემულ დროს<br>
            • არ არის საკმარისი ადგილი მოცემული რაოდენობის სტუმრებისთვის<br>
            • ტექნიკური პრობლემები რესტორანში<br>
            • სპეციალური მოვლენები ან დახურვა
        </p>
        
        <div style="margin-top: 20px; padding: 15px; background: rgba(255, 255, 255, 0.8); border-radius: 8px;">
            <p class="georgian" style="font-weight: 600; color: #7f1d1d; margin: 0;">
                💡 <strong>შემოთავაზება:</strong> სცადეთ სხვა დრო ან თარიღი<br>
                📞 ან დაგვიკავშირდით პირდაპირ: <a href="tel:+995322152024" style="color: #ef4444;">(+995) 032 215 20 24</a>
            </p>
        </div>
    </div>

    <div style="text-align: center; margin-top: 30px;">
        <p class="georgian" style="font-size: 18px; font-weight: 600; color: #2d3748;">
            🌟 <span style="color: #ff6b35;">FOODLY</span>-ზე ათასობით სხვა შესანიშნავი რესტორანია!
        </p>
        <div style="margin-top: 15px;">
            <a href="https://foodly.space" style="display: inline-block; background: linear-gradient(135deg, #ff6b35 0%, #f7931e 100%); color: white; padding: 12px 25px; border-radius: 25px; text-decoration: none; font-weight: 600;">
                🔍 მოძებნეთ სხვა რესტორანი
            </a>
        </div>
    </div>
</div>

<!-- Footer -->
<div class="footer">
    <div class="footer-logo">🍽️ FOODLY</div>
    <div class="footer-text georgian">
        რესტორნების რეზერვაციების პლატფორმა<br>
        <strong>ჩვენ ყოველთვის აქ ვართ, რომ დაგეხმაროთ!</strong>
    </div>
    <div class="contact-info">
        📧 <a href="mailto:support@foodlyapp.ge">support@foodlyapp.ge</a><br>
        📞 <a href="tel:+995322152024">(+995) 032 215 20 24</a><br>
        🌐 <a href="https://foodly.space" target="_blank">foodly.space</a>
    </div>
</div>
@endsection
