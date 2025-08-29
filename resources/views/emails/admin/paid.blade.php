@extends('emails.layouts.admin')

@section('content')
<!-- Header -->
<div class="header status-paid">
    <div class="admin-badge">👨‍💼 ADMIN PANEL</div>
    <div class="logo">🍽️ FOODLY</div>
    <div class="status-badge">💳 გადახდილი</div>
</div>

<!-- Content -->
<div class="content">
    <h1 class="title georgian">💰 გადახდა წარმატებით შესრულდა!</h1>

    <div class="admin-alert" style="background: linear-gradient(135deg, #ddd6fe 0%, #c4b5fd 100%); border-color: #8b5cf6; color: #5b21b6;">
        <p style="font-size: 16px; margin: 0;">
            🎉 <strong>შესანიშნავი! რეზერვაციისთვის გადახდა მოხდა!</strong><br>
            კლიენტს და რესტორანს ავტომატურად გაეგზავნა შეტყობინება.
        </p>
    </div>

    <div style="background: linear-gradient(135deg, #ecfdf5 0%, #d1fae5 100%); border: 2px solid #10b981; border-radius: 12px; padding: 25px; margin: 20px 0; text-align: center;">
        <p style="font-size: 24px; font-weight: 700; color: #065f46; margin: 0;">
            💰 გადახდილი თანხა: <span style="color: #047857;">{{ $paymentAmount ?? 'N/A' }} ₾</span>
        </p>
        <p style="font-size: 16px; color: #059669; margin-top: 10px;">
            📋 ტრანზაქციის ID: <code style="background: rgba(255,255,255,0.8); padding: 4px 8px; border-radius: 6px;">{{ $transactionId ?? 'N/A' }}</code>
        </p>
        <p style="font-size: 14px; color: #065f46; margin-top: 5px;">
            ⏰ გადახდის დრო: {{ $paymentTime ?? now() }}
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
            <span class="detail-label">💳 გადახდის მეთოდი:</span>
            <span class="detail-value">{{ $paymentMethod ?? 'ბანკის ბარათი (BOG)' }}</span>
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
            📋 <strong>ფინანსური ინფორმაცია:</strong>
        </p>
        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 15px; margin-bottom: 20px;">
            <div style="background: #f8fafc; padding: 15px; border-radius: 8px; border-left: 4px solid #10b981;">
                <p style="font-size: 14px; color: #4a5568; margin: 0;">💰 FOODLY-ის კომისია</p>
                <p style="font-size: 18px; color: #2d3748; margin: 5px 0 0 0; font-weight: 600;">{{ $platformFee ?? 'N/A' }} ₾</p>
            </div>
            <div style="background: #f8fafc; padding: 15px; border-radius: 8px; border-left: 4px solid #8b5cf6;">
                <p style="font-size: 14px; color: #4a5568; margin: 0;">🏪 რესტორნის ნაწილი</p>
                <p style="font-size: 18px; color: #2d3748; margin: 5px 0 0 0; font-weight: 600;">{{ $restaurantShare ?? 'N/A' }} ₾</p>
            </div>
        </div>
        
        <div style="text-align: center;">
            <a href="{{ $adminPanelUrl ?? 'https://admin.foodly.space/payments' }}" style="display: inline-block; background: linear-gradient(135deg, #8b5cf6 0%, #7c3aed 100%); color: white; padding: 15px 30px; border-radius: 25px; text-decoration: none; font-weight: 600; margin: 0 10px;">
                💳 გადახდები
            </a>
            <a href="{{ $adminPanelUrl ?? 'https://admin.foodly.space/analytics' }}" style="display: inline-block; background: linear-gradient(135deg, #10b981 0%, #059669 100%); color: white; padding: 15px 30px; border-radius: 25px; text-decoration: none; font-weight: 600; margin: 0 10px;">
                📊 ფინანსური ანალიტიკა
            </a>
        </div>
    </div>

    <div style="background: linear-gradient(135deg, #f0f9ff 0%, #dbeafe 100%); border: 2px solid #3b82f6; border-radius: 12px; padding: 20px; margin: 25px 0;">
        <p style="font-size: 16px; color: #1e40af; margin: 0; font-weight: 600; text-align: center;">
            📈 <strong>საკომისიო ინფორმაცია:</strong><br>
            FOODLY-ის პლატფორმა იღებს {{ $commissionRate ?? '5' }}% საკომისიოს<br>
            ფინანსური ანგარიშსწორება ხდება ყოველ კვირას
        </p>
    </div>

    <div style="background: linear-gradient(135deg, #ecfdf5 0%, #d1fae5 100%); border: 2px solid #10b981; border-radius: 12px; padding: 20px; margin: 25px 0;">
        <div style="display: flex; justify-content: space-between; align-items: center;">
            <div>
                <p style="font-size: 16px; color: #065f46; margin: 0; font-weight: 600;">
                    💵 <strong>დღევანდელი შემოსავალი:</strong>
                </p>
                <p style="font-size: 24px; color: #047857; margin: 5px 0 0 0; font-weight: 700;">
                    {{ $todayRevenue ?? 'N/A' }} ₾
                </p>
            </div>
            <div style="text-align: right;">
                <p style="font-size: 14px; color: #059669; margin: 0;">
                    📅 {{ date('Y-m-d') }}<br>
                    📊 გადახდილი რეზერვაციები: {{ $todayPaidReservations ?? 'N/A' }}
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
