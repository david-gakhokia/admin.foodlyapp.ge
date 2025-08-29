@extends('emails.layouts.admin')

@section('content')
<!-- Header -->
<div class="header status-pending">
    <div class="admin-badge">👨‍💼 ADMIN PANEL</div>
    <div class="logo">🍽️ FOODLY</div>
    <div class="status-badge">📋 ახალი რეზერვაცია</div>
</div>

<!-- Content -->
<div class="content">
    <h1 class="title georgian">🚨 ახალი რეზერვაციის მოთხოვნა!</h1>

    <div class="admin-alert">
        <p style="font-size: 16px; margin: 0;">
            ⚡ <strong>საჭიროებს დაუყოვნებლივ განხილვას!</strong><br>
            კლიენტი ელოდება დადასტურებას 30 წუთის განმავლობაში.
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
            <span class="detail-value"><strong>{{ $reservation->guests_count ?? 'N/A' }} პერსონა</strong></span>
        </div>
        
        <div class="detail-row">
            <span class="detail-label">📅 თარიღი:</span>
            <span class="detail-value"><strong>{{ $reservation->reservation_date ?? 'N/A' }}</strong></span>
        </div>
        
        <div class="detail-row">
            <span class="detail-label">🕐 დრო:</span>
            <span class="detail-value"><strong>{{ $reservation->time_from ?? 'N/A' }} - {{ $reservation->time_to ?? 'N/A' }}</strong></span>
        </div>
        
        <div class="detail-row">
            <span class="detail-label">🏪 რესტორანი:</span>
            <span class="detail-value georgian">{{ $restaurantName ?? 'N/A' }}</span>
        </div>
        
        <div class="detail-row">
            <span class="detail-label">⏰ მოთხოვნის დრო:</span>
            <span class="detail-value">{{ $reservation->created_at ?? 'N/A' }}</span>
        </div>
        
        @if($reservation->notes ?? false)
        <div class="detail-row">
            <span class="detail-label">📝 კლიენტის შენიშვნა:</span>
            <span class="detail-value georgian">{{ $reservation->notes }}</span>
        </div>
        @endif
    </div>

    <div class="admin-actions">
        <p style="font-size: 16px; font-weight: 600; color: #0c4a6e; margin-bottom: 15px;">
            ⚡ <strong>საჭირო ქმედებები:</strong>
        </p>
        <p style="color: #075985; margin-bottom: 20px;">
            1. შეამოწმეთ ხელმისაწვდომობა მოცემულ დროს<br>
            2. დაადასტურეთ ან უარყავით რეზერვაცია ადმინ პანელში<br>
            3. კლიენტს ავტომატურად გაეგზავნება შეტყობინება<br>
            4. რესტორანსაც მიეცემა შეტყობინება გადაწყვეტილების შესახებ
        </p>
        
        <div style="text-align: center;">
            <a href="{{ $adminPanelUrl ?? 'https://admin.foodly.space/reservations' }}" style="display: inline-block; background: linear-gradient(135deg, #4f46e5 0%, #7c3aed 100%); color: white; padding: 15px 30px; border-radius: 25px; text-decoration: none; font-weight: 600; margin: 0 10px;">
                🎛️ ადმინ პანელი
            </a>
            <a href="tel:{{ $reservation->phone ?? '+995322152024' }}" style="display: inline-block; background: linear-gradient(135deg, #ff6b35 0%, #f7931e 100%); color: white; padding: 15px 30px; border-radius: 25px; text-decoration: none; font-weight: 600; margin: 0 10px;">
                📞 კლიენტს დარეკვა
            </a>
        </div>
    </div>

    <div style="background: linear-gradient(135deg, #fef3c7 0%, #fde047 100%); border: 2px solid #facc15; border-radius: 12px; padding: 20px; margin: 25px 0;">
        <p style="font-size: 14px; color: #92400e; margin: 0; text-align: center;">
            ⏰ <strong>დრო მნიშვნელოვანია!</strong> კლიენტები ელოდებიან სწრაფ პასუხს.<br>
            სტატისტიკურად, 30 წუთში პასუხი იზრდება კმაყოფილების მაჩვენებელს 85%-მდე.
        </p>
    </div>
</div>

<!-- Footer -->
<div class="footer">
    <div class="footer-logo">🍽️ FOODLY ADMIN</div>
    <div class="footer-text georgian">
        ადმინისტრაციული პანელი<br>
        <strong>რეზერვაციების მართვის სისტემა</strong>
    </div>
    <div class="contact-info">
        📧 <a href="mailto:admin@foodlyapp.ge">admin@foodlyapp.ge</a><br>
        📞 <a href="tel:+995322152024">(+995) 032 215 20 24</a><br>
        🌐 <a href="https://admin.foodly.space" target="_blank">admin.foodly.space</a>
    </div>
</div>
@endsection
