<!DOCTYPE html>
<html lang="ka">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FOODLY - რეზერვაციის შეტყობინება</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
            line-height: 1.5;
            color: #1a202c;
            background-color: #f7fafc;
            padding: 20px;
        }
        
        .container {
            max-width: 600px;
            margin: 0 auto;
            background: white;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
            border: 1px solid #e2e8f0;
        }
        
        .header {
            background: linear-gradient(135deg, #1a365d 0%, #2d3748 50%, #2c5282 100%);
            color: white;
            padding: 40px 30px;
            text-align: center;
            position: relative;
            border-bottom: 3px solid #48bb78;
        }
        
        .header::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="dots" x="0" y="0" width="20" height="20" patternUnits="userSpaceOnUse"><circle cx="10" cy="10" r="1" fill="%23ffffff" opacity="0.1"/></pattern></defs><rect width="100" height="100" fill="url(%23dots)"/></svg>');
        }
        
        .logo {
            font-size: 32px;
            font-weight: 800;
            margin-bottom: 12px;
            letter-spacing: 1px;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.3);
            position: relative;
            z-index: 2;
        }
        
        .subtitle {
            font-size: 16px;
            opacity: 0.95;
            font-weight: 500;
            letter-spacing: 0.5px;
            position: relative;
            z-index: 2;
        }
        
        .status-badge {
            display: inline-block;
            margin-top: 20px;
            padding: 12px 24px;
            border-radius: 8px;
            font-size: 14px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.2);
            position: relative;
            z-index: 2;
        }
        
        .status-pending {
            background: linear-gradient(135deg, #fed7d7 0%, #fc8181 100%);
            color: #742a2a;
            border: 2px solid #e53e3e;
        }
        
        .status-confirmed {
            background: linear-gradient(135deg, #c6f6d5 0%, #68d391 100%);
            color: #1a365d;
            border: 2px solid #38a169;
        }
        
        .status-completed {
            background: linear-gradient(135deg, #bee3f8 0%, #63b3ed 100%);
            color: #1a365d;
            border: 2px solid #3182ce;
        }
        
        .status-cancelled {
            background: linear-gradient(135deg, #fbb6ce 0%, #f687b3 100%);
            color: #702459;
            border: 2px solid #b83280;
        }
        
        .content {
            padding: 30px;
        }
        
        .title {
            font-size: 20px;
            font-weight: 600;
            color: #2d3748;
            margin-bottom: 20px;
            text-align: center;
            border-bottom: 2px solid #e2e8f0;
            padding-bottom: 15px;
        }
        
        .reservation-card {
            background: linear-gradient(145deg, #ffffff 0%, #f8f9fa 100%);
            border: 2px solid #e9ecef;
            border-radius: 12px;
            padding: 30px;
            margin: 25px 0;
            box-shadow: 0 8px 25px rgba(0,0,0,0.08);
            position: relative;
        }
        
        .reservation-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 4px;
            height: 100%;
            border-radius: 2px 0 0 2px;
        }
        
        .card-header {
            font-size: 18px;
            font-weight: 700;
            color: #2d3748;
            margin-bottom: 20px;
            padding-bottom: 12px;
            border-bottom: 2px solid #e9ecef;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        
        .detail-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 15px;
            margin-bottom: 15px;
        }
        
        .detail-item {
            display: flex;
            flex-direction: column;
            gap: 4px;
        }
        
        .detail-label {
            font-size: 12px;
            font-weight: 600;
            color: #6c757d;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        
        .detail-value {
            font-size: 14px;
            color: #212529;
            font-weight: 500;
        }
        
        .full-width {
            grid-column: 1 / -1;
        }
        
        .action-required {
            background: linear-gradient(135deg, #4299e1 0%, #3182ce 50%, #2b6cb0 100%);
            color: white;
            padding: 25px;
            border-radius: 12px;
            margin: 25px 0;
            text-align: center;
            box-shadow: 0 8px 25px rgba(66, 153, 225, 0.3);
            border: 2px solid #2b6cb0;
        }
        
        .action-title {
            font-size: 18px;
            font-weight: 700;
            margin-bottom: 10px;
            text-shadow: 1px 1px 2px rgba(0,0,0,0.2);
        }
        
        .action-text {
            font-size: 15px;
            opacity: 0.95;
            line-height: 1.5;
        }
        
        .priority-high {
            border-left: 4px solid #e53e3e;
        }
        
        .priority-medium {
            border-left: 4px solid #dd6b20;
        }
        
        .priority-low {
            border-left: 4px solid #38a169;
        }
        
        .footer {
            background: #2d3748;
            color: white;
            padding: 25px;
            text-align: center;
        }
        
        .footer-logo {
            font-size: 18px;
            font-weight: 600;
            margin-bottom: 8px;
            color: #48bb78;
        }
        
        .footer-text {
            font-size: 13px;
            color: #a0aec0;
            line-height: 1.4;
        }
        
        .contact-info {
            margin-top: 15px;
            font-size: 12px;
            border-top: 1px solid #4a5568;
            padding-top: 15px;
        }
        
        .contact-info a {
            color: #48bb78;
            text-decoration: none;
        }
        
        @media only screen and (max-width: 600px) {
            body { padding: 10px; }
            .detail-grid { grid-template-columns: 1fr; }
            .content { padding: 20px; }
        }
        
        .georgian {
            font-family: 'BPG Nino Mtavruli', 'Sylfaen', 'DejaVu Sans', sans-serif;
        }
        
        .timestamp {
            font-size: 11px;
            color: #6c757d;
            text-align: right;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Header -->
        <div class="header">
            <div class="logo">🍽️ FOODLY</div>
            <div class="subtitle georgian">რესტორნების მენეჯმენტ სისტემა</div>
            <div class="status-badge status-{{ $reservation->status ?? 'pending' }}">
                @switch($reservation->status ?? 'pending')
                    @case('pending')
                        მიმდინარე რეზერვაცია
                        @break
                    @case('confirmed')
                        დადასტურებული
                        @break
                    @case('completed')
                        დასრულებული
                        @break
                    @case('cancelled')
                        გაუქმებული
                        @break
                    @default
                        სტატუსი განუსაზღვრელი
                @endswitch
            </div>
        </div>

        <!-- Content -->
        <div class="content">
            <h1 class="title georgian">
                @switch($reservation->status ?? 'pending')
                    @case('pending')
                        ახალი რეზერვაციის მოთხოვნა
                        @break
                    @case('confirmed')
                        რეზერვაცია დადასტურებულია
                        @break
                    @case('completed')
                        რეზერვაცია წარმატებით დასრულდა
                        @break
                    @case('cancelled')
                        რეზერვაციის გაუქმება
                        @break
                    @default
                        რეზერვაციის შეტყობინება
                @endswitch
            </h1>

            <div class="reservation-card @if(($reservation->status ?? 'pending') === 'pending') priority-high @elseif(($reservation->status ?? 'pending') === 'confirmed') priority-medium @else priority-low @endif">
                <div class="card-header">📋 რეზერვაციის დეტალები</div>
                
                <div class="detail-grid">
                    <div class="detail-item">
                        <span class="detail-label">კლიენტი</span>
                        <span class="detail-value georgian">{{ $reservation->name ?? 'N/A' }}</span>
                    </div>
                    
                    <div class="detail-item">
                        <span class="detail-label">ელ-ფოსტა</span>
                        <span class="detail-value">{{ $reservation->email ?? 'N/A' }}</span>
                    </div>
                    
                    <div class="detail-item">
                        <span class="detail-label">ტელეფონი</span>
                        <span class="detail-value">{{ $reservation->phone ?? 'N/A' }}</span>
                    </div>
                    
                    <div class="detail-item">
                        <span class="detail-label">სტუმრების რაოდენობა</span>
                        <span class="detail-value">{{ $reservation->guests_count ?? 'N/A' }} პერსონა</span>
                    </div>
                    
                    <div class="detail-item">
                        <span class="detail-label">რეზერვაციის თარიღი</span>
                        <span class="detail-value">{{ $reservation->reservation_date ?? 'N/A' }}</span>
                    </div>
                    
                    <div class="detail-item">
                        <span class="detail-label">დრო</span>
                        <span class="detail-value">{{ $reservation->time_from ?? 'N/A' }} - {{ $reservation->time_to ?? 'N/A' }}</span>
                    </div>
                    
                    <div class="detail-item full-width">
                        <span class="detail-label">რესტორანი</span>
                        <span class="detail-value georgian">{{ $restaurantName ?? 'N/A' }}</span>
                    </div>
                    
                    @if($reservation->notes ?? false)
                    <div class="detail-item full-width">
                        <span class="detail-label">კლიენტის შენიშვნა</span>
                        <span class="detail-value georgian">{{ $reservation->notes }}</span>
                    </div>
                    @endif
                </div>
                
                <div class="timestamp">
                    📅 შექმნის დრო: {{ now()->format('Y-m-d H:i:s') }}
                </div>
            </div>

            @switch($reservation->status ?? 'pending')
                @case('pending')
                    <div class="action-required">
                        <div class="action-title">⚡ საჭიროა მოქმედება</div>
                        <div class="action-text georgian">
                            ახალი რეზერვაციის მოთხოვნა მიღებულია. 
                            გთხოვთ შეამოწმოთ ხელმისაწვდომობა და დაადასტუროთ ან უარყოთ რეზერვაცია 
                            სისტემის ადმინისტრაციული პანელიდან.
                        </div>
                    </div>
                    @break
                @case('confirmed')
                    <div class="action-required">
                        <div class="action-title">✅ რეზერვაცია დადასტურდა</div>
                        <div class="action-text georgian">
                            რეზერვაცია წარმატებით დადასტურდა. 
                            მოემზადეთ კლიენტის მისაღებად მითითებულ დროს.
                        </div>
                    </div>
                    @break
                @case('completed')
                    <div class="action-required">
                        <div class="action-title">🎉 რეზერვაცია დასრულდა</div>
                        <div class="action-text georgian">
                            რეზერვაცია წარმატებით დასრულდა. 
                            მადლობთ კარგი სერვისისთვის!
                        </div>
                    </div>
                    @break
                @case('cancelled')
                    <div class="action-required">
                        <div class="action-title">❌ რეზერვაცია გაუქმდა</div>
                        <div class="action-text georgian">
                            რეზერვაცია გაუქმებულია. 
                            მაგიდა კვლავ ხელმისაწვდომია ახალი ბუკინგისთვის.
                        </div>
                    </div>
                    @break
            @endswitch
        </div>

        <!-- Footer -->
        <div class="footer">
            <div class="footer-logo">🍽️ FOODLY</div>
            <div class="footer-text georgian">
                რესტორნების პროფესიონალური მენეჯმენტ სისტემა
            </div>
            <div class="contact-info">
                📧 <a href="mailto:admin@foodlyapp.ge">admin@foodlyapp.ge</a> |
                🌐 <a href="https://foodlyapp.ge">foodlyapp.ge</a> |
                📞 ტექნიკური მხარდაჭერა
            </div>
        </div>
    </div>
</body>
</html>
