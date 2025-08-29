@extends('emails.layouts.client')

@section('content')
<!-- Header -->
<div class="header status-confirmed">
    <div class="logo">🍽️ FOODLY</div>
    <div class="status-badge">✅ დადასტურებული</div>
</div>

<!-- Content -->
<div class="content">
    <h1 class="title georgian">🎉 გილოცავთ! რეზერვაცია დადასტურდა!</h1>

    <div class="client-highlight">
        <p class="georgian" style="font-size: 18px; text-align: center; margin: 0; color: #065f46;">
            ✨ <strong>შესანიშნავი! თქვენი რეზერვაცია ოფიციალურად დადასტურდა!</strong><br>
            ელოდებით თქვენს ვიზიტს დანიშნულ დროს.
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

    <div class="message" style="background: linear-gradient(135deg, #d1fae5 0%, #a7f3d0 100%); border: 2px solid #10b981;">
        <p class="georgian" style="font-size: 16px; font-weight: 600; color: #065f46;">
            🎯 <strong>მნიშვნელოვანი ინფორმაცია:</strong>
        </p>
        <p class="georgian" style="margin-top: 10px; color: #065f46;">
            • მოგვმართეთ 15 წუთით ადრე<br>
            • მიიღეთ საბუთისმცველი დოკუმენტი<br>
            • შეცვლის ან გაუქმების შემთხვევაში დაგვიკავშირდით 2 საათით ადრე<br>
            • COVID-19 პროტოკოლების დაცვა სავალდებულოა
        </p>
        <div style="margin-top: 20px; padding: 15px; background: rgba(255, 255, 255, 0.8); border-radius: 8px;">
            <p style="font-weight: 600; color: #047857; margin: 0;">
                📞 გადაუდებელი კონტაქტი: <a href="tel:{{ $restaurantPhone ?? '+995322152024' }}" style="color: #059669;">{{ $restaurantPhone ?? '(+995) 032 215 20 24' }}</a>
            </p>
        </div>
    </div>
</div>

<!-- Footer -->
<div class="footer">
    <div class="footer-logo">🍽️ FOODLY</div>
    <div class="footer-text georgian">
        რესტორნების რეზერვაციების პლატფორმა<br>
        <strong>მადლობთ ჩვენი სერვისის არჩევისთვის!</strong>
    </div>
    <div class="contact-info">
        📧 <a href="mailto:support@foodlyapp.ge">support@foodlyapp.ge</a><br>
        📞 <a href="tel:+995322152024">(+995) 032 215 20 24</a><br>
        🌐 <a href="https://foodly.space" target="_blank">foodly.space</a>
    </div>
</div>
@endsection
