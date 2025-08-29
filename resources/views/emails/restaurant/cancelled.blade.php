@extends('emails.layouts.restaurant')

@section('content')
<!-- Header -->
<div class="header status-cancelled">
    <div class="restaurant-badge">🏪 RESTAURANT PANEL</div>
    <div class="logo">🍽️ FOODLY</div>
    <div class="status-badge">❌ გაუქმებული</div>
</div>

<!-- Content -->
<div class="content">
    <h1 class="title georgian">❌ თქვენ გააუქმეთ რეზერვაცია</h1>

    <div class="restaurant-alert" style="background: linear-gradient(135deg, #fee2e2 0%, #fecaca 100%); border-color: #ef4444; color: #991b1b;">
        <p style="font-size: 16px; margin: 0;">
            📝 <strong>რეზერვაცია ოფიციალურად გაუქმდა</strong><br>
            კლიენტს გაეგზავნა გაუქმების შეტყობინება და ადგილი გათავისუფლდა.
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
            <span class="detail-value"><strong style="color: #dc2626;">{{ $reservation->guests_count ?? 'N/A' }} პერსონა</strong></span>
        </div>
        
        <div class="detail-row">
            <span class="detail-label">📅 თარიღი:</span>
            <span class="detail-value"><strong style="color: #dc2626;">{{ $reservation->reservation_date ?? 'N/A' }}</strong></span>
        </div>
        
        <div class="detail-row">
            <span class="detail-label">🕐 დრო:</span>
            <span class="detail-value"><strong style="color: #dc2626;">{{ $reservation->time_from ?? 'N/A' }} - {{ $reservation->time_to ?? 'N/A' }}</strong></span>
        </div>
        
        <div class="detail-row">
            <span class="detail-label">❌ გაუქმების დრო:</span>
            <span class="detail-value">{{ $reservation->cancelled_at ?? now() }}</span>
        </div>
        
        @if($cancellationReason ?? false)
        <div class="detail-row">
            <span class="detail-label">📝 გაუქმების მიზეზი:</span>
            <span class="detail-value georgian" style="font-style: italic; color: #dc2626;">{{ $cancellationReason }}</span>
        </div>
        @endif
        
        @if($reservation->notes ?? false)
        <div class="detail-row">
            <span class="detail-label">📝 კლიენტის შენიშვნა:</span>
            <span class="detail-value georgian" style="font-style: italic; color: #6b7280;">{{ $reservation->notes }}</span>
        </div>
        @endif
    </div>

    <div class="revenue-info" style="background: linear-gradient(135deg, #fee2e2 0%, #fecaca 100%); border-color: #ef4444;">
        <div style="display: flex; justify-content: space-between; align-items: center;">
            <div>
                <p style="font-size: 16px; color: #991b1b; margin: 0; font-weight: 600;">
                    💸 <strong>დაკარგული შემოსავალი:</strong>
                </p>
                <p style="font-size: 22px; color: #7f1d1d; margin: 5px 0 0 0; font-weight: 700;">
                    {{ $lostRevenue ?? 'N/A' }} ₾
                </p>
            </div>
            <div style="text-align: right;">
                <p style="font-size: 14px; color: #b91c1c; margin: 0;">
                    👥 {{ $reservation->guests_count ?? 'N/A' }} სტუმარი<br>
                    ⏱️ {{ $estimatedDuration ?? '2' }} საათი
                </p>
            </div>
        </div>
    </div>

    <div style="background: linear-gradient(135deg, #fef3c7 0%, #fde047 100%); border: 2px solid #facc15; border-radius: 12px; padding: 20px; margin: 25px 0;">
        <p style="font-size: 16px; font-weight: 600; color: #92400e; margin-bottom: 15px; text-align: center;">
            🤔 <strong>გაუქმების ანალიზი:</strong>
        </p>
        <div style="color: #78350f; text-align: center;">
            მაღალი გაუქმების მაჩვენებელი შეიძლება ნიშნავდეს:<br>
            • ხელმისაწვდომობის პრობლემებს<br>
            • კომუნიკაციის გაუმჯობესების საჭიროებას<br>
            • ოპერაციული პროცესების ოპტიმიზაციის საჭიროებას
        </div>
        
        <div style="margin-top: 20px; text-align: center;">
            <a href="{{ $restaurantPanelUrl ?? 'https://restaurant.foodly.space/calendar' }}" style="display: inline-block; background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%); color: white; padding: 12px 25px; border-radius: 25px; text-decoration: none; font-weight: 600; margin: 0 10px;">
                📅 კალენდარი
            </a>
            <a href="{{ $restaurantPanelUrl ?? 'https://restaurant.foodly.space/analytics' }}" style="display: inline-block; background: linear-gradient(135deg, #059669 0%, #047857 100%); color: white; padding: 12px 25px; border-radius: 25px; text-decoration: none; font-weight: 600; margin: 0 10px;">
                📊 ანალიტიკა
            </a>
        </div>
    </div>

    <div style="background: linear-gradient(135deg, #f0f9ff 0%, #dbeafe 100%); border: 2px solid #3b82f6; border-radius: 12px; padding: 20px; margin: 25px 0;">
        <p style="font-size: 16px; color: #1e40af; margin: 0; font-weight: 600; text-align: center;">
            💡 <strong>რჩევა:</strong> რეზერვაციის ღირსეული მიზეზით გაუქმება უკეთესია ვიდრე უხარისხო სერვისი.<br>
            კლიენტი კვლავ შეიძლება მოინახულოს თქვენი რესტორანი მომავალში, თუ გაუქმება იყო გამართლებული.
        </p>
    </div>

    <div style="background: linear-gradient(135deg, #fee2e2 0%, #fecaca 100%); border: 2px solid #ef4444; border-radius: 12px; padding: 20px; margin: 25px 0;">
        <div style="display: flex; justify-content: space-between; align-items: center;">
            <div>
                <p style="font-size: 16px; color: #991b1b; margin: 0; font-weight: 600;">
                    📊 <strong>დღევანდელი გაუქმებული:</strong>
                </p>
                <p style="font-size: 20px; color: #7f1d1d; margin: 5px 0 0 0; font-weight: 700;">
                    {{ $todayCancelled ?? 'N/A' }} რეზერვაცია
                </p>
            </div>
            <div style="text-align: right;">
                <p style="font-size: 14px; color: #b91c1c; margin: 0;">
                    📅 {{ date('Y-m-d') }}<br>
                    💸 {{ $todayLostRevenue ?? 'N/A' }} ₾
                </p>
            </div>
        </div>
    </div>

    <div style="text-align: center; margin-top: 30px;">
        <p style="font-size: 18px; font-weight: 600; color: #047857;">
            🌟 ახალი შესაძლებლობები ელოდება! შეავსეთ გათავისუფლებული ადგილი.
        </p>
        <div style="margin-top: 15px;">
            <a href="{{ $restaurantPanelUrl ?? 'https://restaurant.foodly.space/availability' }}" style="display: inline-block; background: linear-gradient(135deg, #ff6b35 0%, #f7931e 100%); color: white; padding: 12px 25px; border-radius: 25px; text-decoration: none; font-weight: 600;">
                📊 ხელმისაწვდომობის განახლება
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
