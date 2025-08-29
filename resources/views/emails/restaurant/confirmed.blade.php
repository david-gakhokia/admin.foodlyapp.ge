@extends('emails.layouts.restaurant')

@section('content')
<!-- Header -->
<div class="header status-confirmed">
    <div class="restaurant-badge">🏪 RESTAURANT PANEL</div>
    <div class="logo">🍽️ FOODLY</div>
    <div class="status-badge">✅ დადასტურებული</div>
</div>

<!-- Content -->
<div class="content">
    <h1 class="title georgian">🎉 თქვენ დაადასტურეთ რეზერვაცია!</h1>

    <div class="restaurant-alert">
        <p style="font-size: 16px; margin: 0;">
            ✨ <strong>შესანიშნავი! რეზერვაცია ოფიციალურად დადასტურდა!</strong><br>
            კლიენტს გაეგზავნა დადასტურების შეტყობინება და ელოდება თქვენს ვიზიტს.
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
            <span class="detail-label">✅ დადასტურების დრო:</span>
            <span class="detail-value">{{ $reservation->confirmed_at ?? now() }}</span>
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
                    💰 <strong>დადასტურებული შემოსავალი:</strong>
                </p>
                <p style="font-size: 24px; color: #78350f; margin: 5px 0 0 0; font-weight: 700;">
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

    <div style="background: linear-gradient(135deg, #ecfdf5 0%, #d1fae5 100%); border: 2px solid #10b981; border-radius: 12px; padding: 20px; margin: 25px 0;">
        <p style="font-size: 16px; font-weight: 600; color: #065f46; margin-bottom: 15px; text-align: center;">
            📋 <strong>მომზადების ჩეკლისტი:</strong>
        </p>
        <div style="color: #047857;">
            ✅ მაგიდა დაჯავშნილია მითითებულ დროზე<br>
            ✅ კლიენტს გაეგზავნა დადასტურების შეტყობინება<br>
            ✅ რეზერვაცია დაემატა რესტორნის კალენდარში<br>
            ✅ თანამშრომლებს ეცნობებათ ახალი რეზერვაციის შესახებ
        </div>
        
        <div style="margin-top: 20px; text-align: center;">
            <a href="{{ $restaurantPanelUrl ?? 'https://restaurant.foodly.space/calendar' }}" style="display: inline-block; background: linear-gradient(135deg, #10b981 0%, #059669 100%); color: white; padding: 12px 25px; border-radius: 25px; text-decoration: none; font-weight: 600; margin: 0 10px;">
                📅 კალენდარი
            </a>
            <a href="tel:{{ $reservation->phone ?? '+995322152024' }}" style="display: inline-block; background: linear-gradient(135deg, #ff6b35 0%, #f7931e 100%); color: white; padding: 12px 25px; border-radius: 25px; text-decoration: none; font-weight: 600; margin: 0 10px;">
                📞 კლიენტს დარეკვა
            </a>
        </div>
    </div>

    <div style="background: linear-gradient(135deg, #f0f9ff 0%, #dbeafe 100%); border: 2px solid #3b82f6; border-radius: 12px; padding: 20px; margin: 25px 0;">
        <p style="font-size: 16px; color: #1e40af; margin: 0; font-weight: 600; text-align: center;">
            🌟 <strong>კარგი განცდა = კარგი შეფასება!</strong><br>
            მნიშვნელოვანია კლიენტისთვის ისიუნი შექმნათ უმაღლესი ხარისხის სერვისი.<br>
            კლიენტის კმაყოფილება პირდაპირ აისახება თქვენი რესტორნის რეიტინგზე.
        </p>
    </div>

    <div style="background: linear-gradient(135deg, #ecfdf5 0%, #d1fae5 100%); border: 2px solid #10b981; border-radius: 12px; padding: 20px; margin: 25px 0;">
        <div style="display: flex; justify-content: space-between; align-items: center;">
            <div>
                <p style="font-size: 16px; color: #065f46; margin: 0; font-weight: 600;">
                    📊 <strong>დღევანდელი დადასტურებული:</strong>
                </p>
                <p style="font-size: 20px; color: #047857; margin: 5px 0 0 0; font-weight: 700;">
                    {{ $todayConfirmed ?? 'N/A' }} რეზერვაცია
                </p>
            </div>
            <div style="text-align: right;">
                <p style="font-size: 14px; color: #059669; margin: 0;">
                    📅 {{ date('Y-m-d') }}<br>
                    💰 {{ $todayRevenue ?? 'N/A' }} ₾
                </p>
            </div>
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
