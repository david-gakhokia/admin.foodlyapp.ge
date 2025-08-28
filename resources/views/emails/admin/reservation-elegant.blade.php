<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>რეზერვაციის სტატუსი | Foodly</title>
    <style type="text/css">
        /* Reset */
        body, table, td, a { -webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%; }
        table, td { mso-table-lspace: 0pt; mso-table-rspace: 0pt; }
        img { -ms-interpolation-mode: bicubic; border: 0; outline: none; text-decoration: none; }
        
        /* Base */
        body {
            height: 100% !important;
            margin: 0 !important;
            padding: 0 !important;
            width: 100% !important;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f8fafc;
        }
        
        table { border-collapse: collapse !important; }
        a { color: #4f46e5; text-decoration: none; }
        
        /* Main container */
        .wrapper {
            width: 100%;
            background-color: #f8fafc;
            padding: 40px 0;
        }
        
        .container {
            max-width: 600px;
            margin: 0 auto;
            background: #ffffff;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.08);
        }
        
        /* Header */
        .header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            padding: 50px 30px;
            text-align: center;
            position: relative;
        }
        
        .header::before {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            height: 20px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            clip-path: polygon(0 0, 100% 0, 100% 60%, 50% 100%, 0 60%);
        }
        
        .logo {
            max-width: 140px;
            height: auto;
            margin-bottom: 25px;
            filter: brightness(0) invert(1);
        }
        
        .status-indicator {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: rgba(255, 255, 255, 0.2);
            backdrop-filter: blur(10px);
            border-radius: 50px;
            padding: 12px 24px;
            font-weight: 600;
            font-size: 16px;
            color: white;
            border: 1px solid rgba(255, 255, 255, 0.3);
        }
        
        /* Content */
        .content {
            padding: 60px 40px 40px;
            text-align: center;
        }
        
        .status-emoji {
            font-size: 80px;
            line-height: 1;
            margin-bottom: 25px;
            opacity: 0.9;
        }
        
        .title {
            font-size: 32px;
            font-weight: 800;
            color: #1e293b;
            margin: 0 0 15px 0;
            line-height: 1.2;
            letter-spacing: -0.02em;
        }
        
        .subtitle {
            font-size: 18px;
            color: #64748b;
            margin: 0 0 40px 0;
            line-height: 1.5;
        }
        
        .restaurant-highlight {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            font-weight: 700;
        }
        
        /* Details section */
        .details-section {
            background: #f8fafc;
            border-radius: 20px;
            padding: 35px;
            margin: 40px 0;
            position: relative;
            border: 1px solid #e2e8f0;
        }
        
        .details-title {
            font-size: 22px;
            font-weight: 700;
            color: #334155;
            margin: 0 0 25px 0;
            text-align: center;
            position: relative;
        }
        
        .details-title::after {
            content: '';
            position: absolute;
            bottom: -10px;
            left: 50%;
            transform: translateX(-50%);
            width: 50px;
            height: 3px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border-radius: 2px;
        }
        
        .details-grid {
            width: 100%;
        }
        
        .detail-item {
            padding: 15px 0;
            border-bottom: 1px solid #e2e8f0;
        }
        
        .detail-item:last-child {
            border-bottom: none;
        }
        
        .detail-label {
            font-weight: 600;
            color: #64748b;
            font-size: 14px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            width: 45%;
        }
        
        .detail-value {
            font-weight: 600;
            color: #1e293b;
            font-size: 16px;
            text-align: right;
        }
        
        /* Message section */
        .message-section {
            background: linear-gradient(135deg, #f1f5f9 0%, #e0f2fe 100%);
            border-radius: 16px;
            padding: 30px;
            margin: 30px 0;
            border-left: 4px solid #667eea;
            position: relative;
        }
        
        .message-icon {
            position: absolute;
            top: -10px;
            right: 20px;
            background: #667eea;
            color: white;
            width: 35px;
            height: 35px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 18px;
        }
        
        .message-text {
            font-size: 16px;
            line-height: 1.7;
            color: #334155;
            margin: 0;
            text-align: left;
        }
        
        /* Footer */
        .footer {
            background: #1e293b;
            padding: 40px 30px;
            text-align: center;
            color: #94a3b8;
        }
        
        .footer-logo {
            font-size: 28px;
            font-weight: 800;
            margin-bottom: 20px;
        }
        
        .foodly-text {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        
        .contact-grid {
            margin: 25px 0;
            line-height: 1.8;
        }
        
        .contact-item {
            display: inline-block;
            margin: 5px 15px;
        }
        
        .contact-item a {
            color: #cbd5e1;
            font-weight: 500;
            transition: color 0.2s;
        }
        
        .contact-item a:hover {
            color: #667eea;
        }
        
        .footer-message {
            font-size: 14px;
            margin-top: 25px;
            padding-top: 20px;
            border-top: 1px solid #334155;
            line-height: 1.6;
        }
        
        /* Status colors */
        .status-confirmed .status-indicator {
            background: rgba(16, 185, 129, 0.9);
        }
        
        .status-cancelled .status-indicator {
            background: rgba(239, 68, 68, 0.9);
        }
        
        .status-completed .status-indicator {
            background: rgba(139, 92, 246, 0.9);
        }
        
        .status-pending .status-indicator {
            background: rgba(245, 158, 11, 0.9);
        }
        
        /* Responsive design */
        @media only screen and (max-width: 600px) {
            .wrapper { padding: 20px 0 !important; }
            .content { padding: 40px 25px 30px !important; }
            .details-section { padding: 25px !important; }
            .title { font-size: 26px !important; }
            .status-emoji { font-size: 60px !important; }
            .detail-label { width: 50% !important; }
            .contact-item { display: block !important; margin: 8px 0 !important; }
        }
        
        /* Print styles */
        @media print {
            .wrapper { background: white !important; }
            .container { box-shadow: none !important; }
            .header { background: #667eea !important; }
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%">
            <tr>
                <td align="center">
                    <div class="container">
                        
                        <!-- Header -->
                        <div class="header status-{{ $status ?? 'default' }}">
                            <img src="https://imagedelivery.net/iju3uLOJWht1WeOaYRYgxA/16ba8fdf-3de4-47b9-516c-8a5b6b393d00/public" alt="Foodly" class="logo">
                            
                            <div class="status-indicator">
                                <span>
                                    @switch($status ?? 'default')
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
                                            📋 განახლებულია
                                    @endswitch
                                </span>
                            </div>
                        </div>
                        
                        <!-- Content -->
                        <div class="content">
                            <div class="status-emoji">
                                @switch($status ?? 'default')
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
                            
                            <h1 class="title">
                                @switch($status ?? 'default')
                                    @case('confirmed')
                                        რეზერვაცია დადასტურდა!
                                        @break
                                    @case('cancelled')
                                        რეზერვაცია გაუქმებულია
                                        @break
                                    @case('completed')
                                        რეზერვაცია დასრულებულია
                                        @break
                                    @case('pending')
                                        რეზერვაცია განხილვაშია
                                        @break
                                    @default
                                        სტატუსი განახლდა
                                @endswitch
                            </h1>
                            
                            <p class="subtitle">
                                რესტორანში: <span class="restaurant-highlight">{{ $restaurantName ?? 'N/A' }}</span>
                            </p>
                            
                            @if(isset($reservation))
                            <div class="details-section">
                                <h3 class="details-title">რეზერვაციის დეტალები</h3>
                                
                                <table class="details-grid" role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%">
                                    <tr class="detail-item">
                                        <td class="detail-label">№</td>
                                        <td class="detail-value">#{{ $reservation->id ?? 'N/A' }}</td>
                                    </tr>
                                    
                                    @if(isset($reservation->client_name))
                                    <tr class="detail-item">
                                        <td class="detail-label">სახელი</td>
                                        <td class="detail-value">{{ $reservation->client_name }}</td>
                                    </tr>
                                    @endif
                                    
                                    @if(isset($reservation->email))
                                    <tr class="detail-item">
                                        <td class="detail-label">ელ. ფოსტა</td>
                                        <td class="detail-value">{{ $reservation->email }}</td>
                                    </tr>
                                    @endif
                                    
                                    @if(isset($reservation->phone))
                                    <tr class="detail-item">
                                        <td class="detail-label">ტელეფონი</td>
                                        <td class="detail-value">{{ $reservation->phone }}</td>
                                    </tr>
                                    @endif
                                    
                                    @if(isset($reservation->guest_count))
                                    <tr class="detail-item">
                                        <td class="detail-label">პერსონები</td>
                                        <td class="detail-value">{{ $reservation->guest_count }} ადამიანი</td>
                                    </tr>
                                    @endif
                                    
                                    @if(isset($reservation->reservation_date))
                                    <tr class="detail-item">
                                        <td class="detail-label">თარიღი</td>
                                        <td class="detail-value">{{ $reservation->reservation_date }}</td>
                                    </tr>
                                    @endif
                                    
                                    @if(isset($reservation->reservation_time))
                                    <tr class="detail-item">
                                        <td class="detail-label">დრო</td>
                                        <td class="detail-value">{{ $reservation->reservation_time }}</td>
                                    </tr>
                                    @endif
                                </table>
                            </div>
                            @endif
                            
                            <div class="message-section">
                                <div class="message-icon">ℹ️</div>
                                <p class="message-text">
                                    @switch($status ?? 'default')
                                        @case('confirmed')
                                            <strong>შესანიშნავი!</strong> თქვენი რეზერვაცია წარმატებით დადასტურდა. ველოდებით თქვენს ვიზიტს დანიშნულ დროს. გთხოვთ, მოსვლამდე 30 წუთით ადრე დაგვიკავშირდეთ.
                                            @break
                                        @case('cancelled')
                                            სამწუხაროდ, თქვენი რეზერვაცია გაუქმდა. ეს შეიძლება მოხდა სხვადასხვა მიზეზით. დამატებითი ინფორმაციისთვის გთხოვთ დაგვიკავშირდეთ.
                                            @break
                                        @case('completed')
                                            <strong>გმადლობთ!</strong> იმედოვნებთ, რომ ტკბილად გაატარეთ დრო ჩვენთან. თქვენი გამოხმაურება ჩვენთვის მნიშვნელოვანია. გელოდებით ხელახლა!
                                            @break
                                        @case('pending')
                                            თქვენი რეზერვაციის განაცხადი მიღებულია და ამჟამად განიხილება. უახლოეს მომავალში დაგიკავშირდებით დასტურის თაობაზე.
                                            @break
                                        @default
                                            თქვენი რეზერვაციის სტატუსი განახლდა. დეტალური ინფორმაციისთვის შეგიძლიათ დაგვიკავშირდეთ.
                                    @endswitch
                                </p>
                            </div>
                        </div>
                        
                        <!-- Footer -->
                        <div class="footer">
                            <div class="footer-logo">
                                🍽️ <span class="foodly-text">FOODLY</span>
                            </div>
                            
                            <div class="contact-grid">
                                <div class="contact-item">
                                    📧 <a href="mailto:info@foodly.space">info@foodly.space</a>
                                </div>
                                <div class="contact-item">
                                    📞 <a href="tel:+995322152024">(+995) 032 215 20 24</a>
                                </div>
                                <div class="contact-item">
                                    🌐 <a href="https://foodly.space" target="_blank">foodly.space</a>
                                </div>
                            </div>
                            
                            <div class="footer-message">
                                გმადლობთ, რომ აირჩიეთ <strong style="color: #667eea;">Foodly</strong><br>
                                <em>საუკეთესო კულინარიული გამოცდილებისთვის ყოველთვის თქვენს სევისზე!</em>
                            </div>
                        </div>
                        
                    </div>
                </td>
            </tr>
        </table>
    </div>
</body>
</html>
