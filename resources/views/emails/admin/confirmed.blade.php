@extends('emails.layouts.admin')

@section('content')
<!-- Header -->
<div class="header status-confirmed">
    <div class="admin-badge">👨‍💼 ADMIN PANEL</div>
    <div class="logo">🍽️ FOODLY</div>
    <div class="status-badge">✅ დადასტურებული</div>
</div>

<!-- Content -->
<div class="content">
    <h1 class="title georgian">✅ რეზერვაცია წარმატებით დადასტურდა!</h1>

    <div class="admin-alert" style="background: linear-gradient(135deg, #d1fae5 0%, #a7f3d0 100%); border-color: #10b981; color: #065f46;">
        <p style="font-size: 16px; margin: 0;">
            🎉 <strong>შესანიშნავი! რეზერვაცია ოფიციალურად დადასტურდა!</strong><br>
            კლიენტს და რესტორანს ავტომატურად გაეგზავნა შეტყობინება.
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
            <span class="detail-label">✅ დადასტურების დრო:</span>
            <span class="detail-value">{{ $reservation->confirmed_at ?? now() }}</span>
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
            📋 <strong>შემდგომი ნაბიჯები:</strong>
        </p>
        <p style="color: #075985; margin-bottom: 20px;">
            ✅ კლიენტს გაეგზავნა დადასტურების შეტყობინება<br>
            ✅ რესტორანს გაეგზავნა შეტყობინება<br>
            ✅ რეზერვაცია დაემატა კალენდარში<br>
            📊 სტატისტიკა ავტომატურად განახლდა
        </p>
        
        <div style="text-align: center;">
            <a href="{{ $adminPanelUrl ?? 'https://admin.foodly.space/reservations' }}" style="display: inline-block; background: linear-gradient(135deg, #10b981 0%, #059669 100%); color: white; padding: 15px 30px; border-radius: 25px; text-decoration: none; font-weight: 600; margin: 0 10px;">
                📊 კალენდარი
            </a>
            <a href="{{ $adminPanelUrl ?? 'https://admin.foodly.space/analytics' }}" style="display: inline-block; background: linear-gradient(135deg, #4f46e5 0%, #7c3aed 100%); color: white; padding: 15px 30px; border-radius: 25px; text-decoration: none; font-weight: 600; margin: 0 10px;">
                📈 ანალიტიკა
            </a>
        </div>
    </div>

    <div style="background: linear-gradient(135deg, #ecfdf5 0%, #d1fae5 100%); border: 2px solid #10b981; border-radius: 12px; padding: 20px; margin: 25px 0;">
        <div style="display: flex; justify-content: space-between; align-items: center;">
            <div>
                <p style="font-size: 16px; color: #065f46; margin: 0; font-weight: 600;">
                    💰 <strong>მოსალოდნელი შემოსავალი:</strong>
                </p>
                <p style="font-size: 20px; color: #047857; margin: 5px 0 0 0; font-weight: 700;">
                    {{ $expectedRevenue ?? 'N/A' }} ₾
                </p>
            </div>
            <div style="text-align: right;">
                <p style="font-size: 14px; color: #059669; margin: 0;">
                    📅 {{ $reservation->reservation_date ?? 'N/A' }}<br>
                    👥 {{ $reservation->guests_count ?? 'N/A' }} სტუმარი
                </p>
            </div>
        </div>
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
