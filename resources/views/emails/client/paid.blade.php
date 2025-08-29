@extends('emails.layouts.client')

@section('content')
<!-- Header -->
<div class="header status-paid">
    <div class="logo">🍽️ FOODLY</div>
    <div class="status-badge">💳 გადახდილი</div>
</div>

<!-- Content -->
<div class="content">
    <h1 class="title georgian">🎉 გადახდა წარმატებით შესრულდა!</h1>

    <div class="client-highlight" style="background: linear-gradient(135deg, #fef3c7 0%, #fbbf24 100%); border-color: #f59e0b;">
        <p class="georgian" style="font-size: 18px; text-align: center; margin: 0; color: #92400e;">
            ✨ <strong>შესანიშნავი! გადახდა მოხდა და რეზერვაცია სრულად დადასტურდა!</strong><br>
            თქვენი ადგილი დაზუსტებულია და ელოდებით თქვენს ვიზიტს.
        </p>
    </div>

    <div style="background: linear-gradient(135deg, #ecfdf5 0%, #d1fae5 100%); border: 2px solid #10b981; border-radius: 12px; padding: 20px; margin: 20px 0; text-align: center;">
        <p style="font-size: 20px; font-weight: 700; color: #065f46; margin: 0;">
            💰 გადახდილი თანხა: <span style="color: #047857;">{{ $paymentAmount ?? 'N/A' }} ₾</span>
        </p>
        <p style="font-size: 14px; color: #059669; margin-top: 5px;">
            📋 ტრანზაქციის ID: <code style="background: rgba(255,255,255,0.8); padding: 2px 6px; border-radius: 4px;">{{ $transactionId ?? 'N/A' }}</code>
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

    <div class="message" style="background: linear-gradient(135deg, #fef3c7 0%, #fde047 100%); border: 2px solid #eab308;">
        <p class="georgian" style="font-size: 16px; font-weight: 600; color: #92400e;">
            🎯 <strong>მნიშვნელოვანი ინფორმაცია ვიზიტისთვის:</strong>
        </p>
        <p class="georgian" style="margin-top: 10px; color: #78350f;">
            ✅ <strong>რეზერვაცია სრულად გადახდილია</strong><br>
            • მოგვმართეთ 15 წუთით ადრე<br>
            • მიიღეთ ეს ელ-ფოსტა (მოქმედებს როგორც ვაუჩერი)<br>
            • შეცვლის ან გაუქმების შემთხვევაში დაგვიკავშირდით 4 საათით ადრე<br>
            • გაუქმების შემთხვევაში თანხის დაბრუნება მოხდება 2-3 სამუშაო დღეში
        </p>
        
        <div style="margin-top: 20px; padding: 15px; background: rgba(255, 255, 255, 0.9); border-radius: 8px;">
            <p style="font-weight: 600; color: #78350f; margin: 0;">
                📞 რესტორნის პირდაპირი ხაზი: <a href="tel:{{ $restaurantPhone ?? '+995322152024' }}" style="color: #f59e0b;">{{ $restaurantPhone ?? '(+995) 032 215 20 24' }}</a><br>
                📧 მხარდაჭერა: <a href="mailto:support@foodlyapp.ge" style="color: #f59e0b;">support@foodlyapp.ge</a>
            </p>
        </div>
    </div>

    <div style="text-align: center; margin-top: 30px; padding: 20px; background: linear-gradient(135deg, #f0f9ff 0%, #dbeafe 100%); border-radius: 12px;">
        <p class="georgian" style="font-size: 18px; font-weight: 600; color: #1e40af;">
            🌟 გმადლობთ <span style="color: #ff6b35;">FOODLY</span>-ის არჩევისთვის!
        </p>
        <p class="georgian" style="margin-top: 10px; color: #3730a3;">
            იმედოვნებთ, რომ მოგეწონებათ ჩვენი სერვისი და კარგად გაატარებთ დროს!
        </p>
        
        <div style="margin-top: 20px;">
            <a href="https://foodly.space/rate-experience" style="display: inline-block; background: linear-gradient(135deg, #ff6b35 0%, #f7931e 100%); color: white; padding: 12px 25px; border-radius: 25px; text-decoration: none; font-weight: 600; margin: 0 10px;">
                ⭐ შეაფასეთ გამოცდილება
            </a>
            <a href="https://foodly.space" style="display: inline-block; background: linear-gradient(135deg, #3b82f6 0%, #1d4ed8 100%); color: white; padding: 12px 25px; border-radius: 25px; text-decoration: none; font-weight: 600; margin: 0 10px;">
                🔍 მეტი რესტორანი
            </a>
        </div>
    </div>
</div>

<!-- Footer -->
<div class="footer">
    <div class="footer-logo">🍽️ FOODLY</div>
    <div class="footer-text georgian">
        რესტორნების რეზერვაციების პლატფორმა<br>
        <strong>მადლობთ ჩვენზე ნდობისთვის!</strong>
    </div>
    <div class="contact-info">
        📧 <a href="mailto:support@foodlyapp.ge">support@foodlyapp.ge</a><br>
        📞 <a href="tel:+995322152024">(+995) 032 215 20 24</a><br>
        🌐 <a href="https://foodly.space" target="_blank">foodly.space</a>
    </div>
</div>
@endsection
