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
            line-height: 1.6;
            color: #333;
            background-color: #f8f9fa;
        }
        
        .container {
            max-width: 600px;
            margin: 0 auto;
            background: white;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
        }
        
        .header {
            background: linear-gradient(135deg, #ff6b35 0%, #f7931e 100%);
            color: white;
            padding: 40px 30px;
            text-align: center;
        }
        
        .logo {
            font-size: 28px;
            font-weight: 800;
            margin-bottom: 10px;
            letter-spacing: 1px;
        }
        
        .status-pending {
            background: linear-gradient(135deg, #fed7aa 0%, #f7931e 100%);
        }
        
        .status-confirmed {
            background: linear-gradient(135deg, #86efac 0%, #22c55e 100%);
        }
        
        .status-completed {
            background: linear-gradient(135deg, #fdba74 0%, #ff6b35 100%);
        }
        
        .status-cancelled {
            background: linear-gradient(135deg, #fca5a5 0%, #ef4444 100%);
        }
        
        .status-badge {
            display: inline-block;
            background: rgba(255, 255, 255, 0.2);
            padding: 8px 16px;
            border-radius: 20px;
            font-size: 14px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        
        .content {
            padding: 30px;
        }
        
        .title {
            font-size: 24px;
            font-weight: 700;
            color: #2d3748;
            margin-bottom: 20px;
            text-align: center;
        }
        
        .reservation-card {
            background: #f7fafc;
            border-radius: 8px;
            padding: 20px;
            margin: 20px 0;
            border-left: 4px solid #ff6b35;
        }
        
        .detail-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 8px 0;
            border-bottom: 1px solid #e2e8f0;
        }
        
        .detail-row:last-child {
            border-bottom: none;
        }
        
        .detail-label {
            font-weight: 600;
            color: #4a5568;
            min-width: 120px;
        }
        
        .detail-value {
            color: #2d3748;
            font-weight: 500;
        }
        
        .message {
            background: #edf2f7;
            padding: 20px;
            border-radius: 8px;
            margin: 20px 0;
            text-align: center;
            color: #4a5568;
        }
        
        .footer {
            background: #2d3748;
            color: white;
            padding: 30px;
            text-align: center;
        }
        
        .footer-logo {
            font-size: 20px;
            font-weight: 700;
            margin-bottom: 10px;
            color: #ff6b35;
        }
        
        .footer-text {
            font-size: 14px;
            color: #a0aec0;
            line-height: 1.5;
        }
        
        .contact-info {
            margin-top: 15px;
            font-size: 14px;
        }
        
        .contact-info a {
            color: #ff6b35;
            text-decoration: none;
        }
        
        @media only screen and (max-width: 600px) {
            .container {
                margin: 0;
                border-radius: 0;
            }
            
            .header, .content, .footer {
                padding: 20px;
            }
            
            .detail-row {
                flex-direction: column;
                align-items: flex-start;
                gap: 5px;
            }
            
            .detail-label {
                min-width: auto;
            }
        }
        
        /* Georgian font support */
        .georgian {
            font-family: 'BPG Nino Mtavruli', 'Sylfaen', 'DejaVu Sans', sans-serif;
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Header -->
        <div class="header status-{{ $reservation->status ?? 'pending' }}">
            <div class="logo">🍽️ FOODLY</div>
            <div class="status-badge">
                @switch($reservation->status ?? 'pending')
                    @case('pending')
                        📋 მიმდინარე
                        @break
                    @case('confirmed')
                        ✅ დადასტურებული
                        @break
                    @case('completed')
                        🎉 დასრულებული
                        @break
                    @case('cancelled')
                        ❌ გაუქმებული
                        @break
                    @default
                        📋 მიმდინარე
                @endswitch
            </div>
        </div>

        <!-- Content -->
        <div class="content">
            <h1 class="title georgian">
                @switch($reservation->status ?? 'pending')
                    @case('pending')
                        ახალი რეზერვაციის შეტყობინება
                        @break
                    @case('confirmed')
                        რეზერვაცია დადასტურდა
                        @break
                    @case('completed')
                        რეზერვაცია წარმატებით დასრულდა
                        @break
                    @case('cancelled')
                        რეზერვაცია გაუქმდა
                        @break
                    @default
                        რეზერვაციის შეტყობინება
                @endswitch
            </h1>

            <div class="reservation-card">
                <div class="detail-row">
                    <span class="detail-label">👤 :</span>
                    <span class="detail-value georgian">{{ $reservation->name ?? 'N/A' }}</span>
                </div>
                
                <div class="detail-row">
                    <span class="detail-label">📧 :</span>
                    <span class="detail-value">{{ $reservation->email ?? 'N/A' }}</span>
                </div>
                
                <div class="detail-row">
                    <span class="detail-label">📞 :</span>
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
                @switch($reservation->status ?? 'pending')
                    @case('pending')
                        <p class="georgian">📋 ეს რეზერვაცია ელოდება დადასტურებას. ადმინისტრაციამ უნდა გადახედოს და მოახდინოს სტატუსის განახლება.</p>
                        @break
                    @case('confirmed')
                        <p class="georgian">🎉 გილოცავთ! თქვენი რეზერვაცია დადასტურდა. ელოდებით თქვენს ვიზიტს!</p>
                        @break
                    @case('completed')
                        <p class="georgian">✨ მადლობთ FOODLY-ის არჩევისთვის! იმედოვნებთ, რომ მოგეწონათ ჩვენი სერვისი!</p>
                        @break
                    @case('cancelled')
                        <p class="georgian">😔 ვწუხვართ, რეზერვაცია გაუქმდა. კითხვების შემთხვევაში დაგვიკავშირდით.</p>
                        @break
                    @default
                        <p class="georgian">მადლობთ FOODLY-ის არჩევისთვის!</p>
                @endswitch
            </div>
        </div>

        <!-- Footer -->
        <div class="footer">
            <div class="footer-logo">🍽️ FOODLY</div>
            <div class="footer-text georgian">
                რესტორნების რეზერვაციების პლატფორმა
            </div>
            <div class="contact-info">
                📧 <a href="mailto:support@foodlyapp.ge">support@foodlyapp.ge</a><br>
                🌐 <a href="https://foodlyapp.ge">foodlyapp.ge</a>
            </div>
        </div>
    </div>
</body>
</html>
