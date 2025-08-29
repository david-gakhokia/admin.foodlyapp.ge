@extends('emails.layouts.client')

@section('content')
<!-- Header -->
<div class="header status-pending">
    <div class="logo">🍽️ FOODLY</div>
    <div class="status-badge">📋 ელოდება დადასტურებას</div>
</div>

<!-- Content -->
<div class="content">
    <h1 class="title georgian">თქვენი რეზერვაცია მიღებულია!</h1>

    <div class="client-highlight">
        <p class="georgian" style="font-size: 16px; text-align: center; margin: 0;">
            🎯 <strong>თქვენი რეზერვაცია წარმატებით გაიგზავნა!</strong><br>
            ელოდებით რესტორნის დადასტურებას მომდევნო 30 წუთში.
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

    <div class="message">
        <p class="georgian" style="font-size: 16px; font-weight: 600;">
            ⏳ <strong>რა ხდება შემდეგ?</strong>
        </p>
        <p class="georgian" style="margin-top: 10px;">
            რესტორნის ადმინისტრაცია გადახედავს თქვენს მოთხოვნას და 30 წუთის განმავლობაში 
            მიიღებთ დადასტურების ან უარყოფის შეტყობინებას.
        </p>
        <p style="margin-top: 15px; font-size: 14px; color: #6b7280;">
            📧 შეტყობინება გამოიგზავნება ელ-ფოსტაზე<br>
            📱 SMS შეტყობინება ტელეფონზე
        </p>
    </div>
</div>

<!-- Footer -->
<div class="footer">
    <div class="footer-logo">🍽️ FOODLY</div>
    <div class="footer-text georgian">
        რესტორნების რეზერვაციების პლატფორმა<br>
        <strong>გმადლობთ ჩვენი სერვისის არჩევისთვის!</strong>
    </div>
    <div class="contact-info">
        📧 <a href="mailto:support@foodlyapp.ge">support@foodlyapp.ge</a><br>
        📞 <a href="tel:+995322152024">(+995) 032 215 20 24</a><br>
        🌐 <a href="https://foodly.space" target="_blank">foodly.space</a>
    </div>
</div>
@endsection
