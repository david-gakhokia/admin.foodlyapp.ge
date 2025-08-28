<!DOCTYPE html>
<html lang="ka">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>რეზერვაციის სტატუსი</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, sans-serif;
            line-height: 1.6;
            color: #333;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            padding: 20px;
        }
        
        .email-container {
            max-width: 600px;
            margin: 0 auto;
            background: #ffffff;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
        }
        
        .header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            padding: 30px 20px;
            text-align: center;
            color: white;
        }
        
        .logo {
            max-width: 180px;
            height: auto;
            margin-bottom: 20px;
            filter: brightness(0) invert(1);
        }
        
        .status-badge {
            display: inline-block;
            padding: 10px 20px;
            border-radius: 25px;
            font-weight: 600;
            font-size: 16px;
            margin-top: 15px;
        }
        
        .status-confirmed {
            background: #10b981;
            color: white;
        }
        
        .status-cancelled {
            background: #ef4444;
            color: white;
        }
        
        .status-pending {
            background: #f59e0b;
            color: white;
        }
        
        .status-completed {
            background: #8b5cf6;
            color: white;
        }
        
        .content {
            padding: 40px 30px;
        }
        
        .status-icon {
            font-size: 48px;
            text-align: center;
            margin-bottom: 20px;
        }
        
        .main-title {
            font-size: 28px;
            font-weight: 700;
            text-align: center;
            margin-bottom: 10px;
            color: #1f2937;
        }
        
        .subtitle {
            font-size: 16px;
            text-align: center;
            color: #6b7280;
            margin-bottom: 30px;
        }
        
        .restaurant-name {
            color: #667eea;
            font-weight: 600;
        }
        
        .details-card {
            background: #f8fafc;
            border-radius: 15px;
            padding: 25px;
            margin: 30px 0;
            border-left: 4px solid #667eea;
        }
        
        .details-title {
            font-size: 20px;
            font-weight: 600;
            color: #1f2937;
            margin-bottom: 20px;
            text-align: center;
        }
        
        .detail-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 12px 0;
            border-bottom: 1px solid #e5e7eb;
        }
        
        .detail-row:last-child {
            border-bottom: none;
        }
        
        .detail-label {
            font-weight: 500;
            color: #6b7280;
        }
        
        .detail-value {
            font-weight: 600;
            color: #1f2937;
            text-align: right;
        }
        
        .message-section {
            background: linear-gradient(135deg, #f0f9ff 0%, #e0e7ff 100%);
            border-radius: 15px;
            padding: 25px;
            margin: 20px 0;
            text-align: center;
        }
        
        .footer {
            background: #1f2937;
            color: white;
            padding: 30px 20px;
            text-align: center;
        }
        
        .footer-logo {
            font-size: 24px;
            font-weight: 700;
            color: #667eea;
            margin-bottom: 15px;
        }
        
        .contact-info {
            margin-bottom: 15px;
        }
        
        .contact-info a {
            color: #93c5fd;
            text-decoration: none;
        }
        
        .social-links {
            margin-top: 20px;
        }
        
        .social-links a {
            display: inline-block;
            margin: 0 10px;
            padding: 8px 15px;
            background: #667eea;
            color: white;
            text-decoration: none;
            border-radius: 8px;
            font-size: 14px;
        }
        
        @media only screen and (max-width: 600px) {
            body {
                padding: 10px;
            }
            
            .content {
                padding: 30px 20px;
            }
            
            .details-card {
                padding: 20px;
            }
            
            .detail-row {
                flex-direction: column;
                align-items: flex-start;
                gap: 5px;
            }
            
            .detail-value {
                text-align: left;
                font-size: 14px;
            }
            
            .main-title {
                font-size: 24px;
            }
        }
        
        .highlight {
            background: linear-gradient(120deg, #667eea 0%, #764ba2 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            font-weight: 700;
        }
    </style>
</head>
<body>
    <div class="email-container">
        <!-- Header -->
        <div class="header">
            <img src="https://imagedelivery.net/iju3uLOJWht1WeOaYRYgxA/16ba8fdf-3de4-47b9-516c-8a5b6b393d00/public" alt="Foodly Logo" class="logo">
            
            <div class="status-badge status-{{ $status }}">
                @switch($status)
                    @case('confirmed')
                        ✅ დადასტურებულია
                        @break
                    @case('cancelled')
                        ❌ გაუქმებულია
                        @break
                    @case('completed')
                        🎉 დასრულებულია
                        @break
                    @case('pending')
                        ⏳ განხილვაში
                        @break
                    @default
                        📋 სტატუსი შეიცვალა
                @endswitch
            </div>
        </div>
        
        <!-- Main Content -->
        <div class="content">
            <div class="status-icon">
                @switch($status)
                    @case('confirmed')
                        🎯
                        @break
                    @case('cancelled')
                        💔
                        @break
                    @case('completed')
                        🌟
                        @break
                    @case('pending')
                        🔄
                        @break
                    @default
                        📱
                @endswitch
            </div>
            
            <h1 class="main-title">
                @switch($status)
                    @case('confirmed')
                        რეზერვაცია დადასტურდა!
                        @break
                    @case('cancelled')
                        რეზერვაცია გაუქმდა
                        @break
                    @case('completed')
                        რეზერვაცია წარმატებით დასრულდა
                        @break
                    @case('pending')
                        რეზერვაცია განხილვაშია
                        @break
                    @default
                        რეზერვაციის სტატუსი შეიცვალა
                @endswitch
            </h1>
            
            <p class="subtitle">
                რესტორანში: <span class="restaurant-name">{{ $restaurantName ?? 'N/A' }}</span>
            </p>
            
            @if(isset($reservation))
            <div class="details-card">
                <h3 class="details-title">რეზერვაციის დეტალები</h3>
                
                <div class="detail-row">
                    <span class="detail-label">რეზერვაციის №:</span>
                    <span class="detail-value">#{{ $reservation->id ?? 'N/A' }}</span>
                </div>
                
                <div class="detail-row">
                    <span class="detail-label">სახელი:</span>
                    <span class="detail-value">{{ $reservation->client_name ?? 'N/A' }}</span>
                </div>
                
                <div class="detail-row">
                    <span class="detail-label">ელ. ფოსტა:</span>
                    <span class="detail-value">{{ $reservation->email ?? 'N/A' }}</span>
                </div>
                
                @if(isset($reservation->phone))
                <div class="detail-row">
                    <span class="detail-label">ტელეფონი:</span>
                    <span class="detail-value">{{ $reservation->phone }}</span>
                </div>
                @endif
                
                @if(isset($reservation->guest_count))
                <div class="detail-row">
                    <span class="detail-label">პერსონების რაოდენობა:</span>
                    <span class="detail-value">{{ $reservation->guest_count }} პირი</span>
                </div>
                @endif
                
                @if(isset($reservation->reservation_date))
                <div class="detail-row">
                    <span class="detail-label">თარიღი:</span>
                    <span class="detail-value">{{ $reservation->reservation_date }}</span>
                </div>
                @endif
                
                @if(isset($reservation->reservation_time))
                <div class="detail-row">
                    <span class="detail-label">დრო:</span>
                    <span class="detail-value">{{ $reservation->reservation_time }}</span>
                </div>
                @endif
            </div>
            @endif
            
            <div class="message-section">
                @switch($status)
                    @case('confirmed')
                        <p><strong>შესანიშნავი!</strong> თქვენი რეზერვაცია დადასტურდა. ველოდებით თქვენს ვიზიტს!</p>
                        @break
                    @case('cancelled')
                        <p>სამწუხაროდ, თქვენი რეზერვაცია გაუქმდა. დეტალური ინფორმაციისთვის გთხოვთ დაგვიკავშირდეთ.</p>
                        @break
                    @case('completed')
                        <p><strong>გმადლობთ!</strong> იმედოვნებთ, რომ კმაყოფილი დარჩით ჩვენს სერვისით. მოვლენაზე გისურვებთ!</p>
                        @break
                    @case('pending')
                        <p>თქვენი რეზერვაციის განაცხადი განხილვაშია. ტურამდე დაგიკავშირდებით პასუხით.</p>
                        @break
                    @default
                        <p>თქვენი რეზერვაციის სტატუსი განახლდა. დეტალური ინფორმაციისთვის შეგიძლიათ დაგვიკავშირდეთ.</p>
                @endswitch
            </div>
        </div>
        
        <!-- Footer -->
        <div class="footer">
            <div class="footer-logo">🍽️ FOODLY</div>
            
            <div class="contact-info">
                <p>📧 <a href="mailto:info@foodly.space">info@foodly.space</a></p>
                <p>📞 <a href="tel:+995322152024">(+995) 032 215 20 24</a></p>
                <p>🌐 <a href="https://foodly.space" target="_blank">www.foodly.space</a></p>
            </div>
            
            <p style="margin-top: 15px; font-size: 14px; color: #9ca3af;">
                გმადლობთ, რომ აირჩიეთ <span class="highlight">Foodly</span> - საუკეთესო გამოცდილებისთვის!
            </p>
        </div>
    </div>
</body>
</html>
