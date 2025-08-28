<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>რეზერვაციის სტატუსი - Foodly</title>
    <style type="text/css">
        /* Reset styles */
        body, table, td, a { -webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%; }
        table, td { mso-table-lspace: 0pt; mso-table-rspace: 0pt; }
        img { -ms-interpolation-mode: bicubic; border: 0; height: auto; line-height: 100%; outline: none; text-decoration: none; }
        
        /* Base styles */
        body {
            height: 100% !important;
            margin: 0 !important;
            padding: 0 !important;
            width: 100% !important;
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif;
        }
        
        table {
            border-collapse: collapse !important;
        }
        
        a {
            color: #667eea;
            text-decoration: none;
        }
        
        /* Container */
        .email-container {
            max-width: 600px;
            margin: 0 auto;
        }
        
        /* Header styles */
        .header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            padding: 40px 20px;
            text-align: center;
        }
        
        .logo {
            max-width: 160px;
            height: auto;
            margin-bottom: 20px;
        }
        
        .status-badge {
            background: rgba(255, 255, 255, 0.2);
            border-radius: 20px;
            padding: 10px 20px;
            color: white;
            font-weight: 600;
            font-size: 16px;
            display: inline-block;
        }
        
        /* Content styles */
        .content {
            background: #ffffff;
            padding: 40px 30px;
            text-align: center;
        }
        
        .status-emoji {
            font-size: 64px;
            line-height: 1;
            margin-bottom: 20px;
        }
        
        .main-title {
            font-size: 28px;
            font-weight: 700;
            color: #1a202c;
            margin: 0 0 10px 0;
            line-height: 1.2;
        }
        
        .subtitle {
            font-size: 16px;
            color: #718096;
            margin: 0 0 30px 0;
            line-height: 1.4;
        }
        
        .restaurant-name {
            color: #667eea;
            font-weight: 600;
        }
        
        /* Details card */
        .details-container {
            background: #f7fafc;
            border-radius: 12px;
            padding: 30px;
            margin: 30px 0;
            text-align: left;
        }
        
        .details-title {
            font-size: 20px;
            font-weight: 600;
            color: #2d3748;
            margin: 0 0 20px 0;
            text-align: center;
        }
        
        .detail-table {
            width: 100%;
        }
        
        .detail-row td {
            padding: 12px 0;
            border-bottom: 1px solid #e2e8f0;
        }
        
        .detail-row:last-child td {
            border-bottom: none;
        }
        
        .detail-label {
            font-weight: 500;
            color: #718096;
            width: 40%;
        }
        
        .detail-value {
            font-weight: 600;
            color: #2d3748;
            text-align: right;
        }
        
        /* Message section */
        .message-box {
            background: linear-gradient(135deg, #edf2f7 0%, #e6fffa 100%);
            border-radius: 12px;
            padding: 25px;
            margin: 30px 0;
            border-left: 4px solid #667eea;
        }
        
        .message-text {
            font-size: 16px;
            line-height: 1.6;
            color: #2d3748;
            margin: 0;
        }
        
        /* Footer */
        .footer {
            background: #2d3748;
            color: #ffffff;
            padding: 30px 20px;
            text-align: center;
        }
        
        .footer-brand {
            font-size: 24px;
            font-weight: 700;
            color: #667eea;
            margin-bottom: 15px;
        }
        
        .footer-contact {
            margin-bottom: 15px;
            line-height: 1.6;
        }
        
        .footer-contact a {
            color: #a0aec0;
        }
        
        .footer-note {
            font-size: 14px;
            color: #a0aec0;
            margin-top: 15px;
            line-height: 1.4;
        }
        
        /* Status specific colors */
        .status-confirmed .status-badge {
            background: rgba(16, 185, 129, 0.9);
        }
        
        .status-cancelled .status-badge {
            background: rgba(239, 68, 68, 0.9);
        }
        
        .status-completed .status-badge {
            background: rgba(139, 92, 246, 0.9);
        }
        
        .status-pending .status-badge {
            background: rgba(245, 158, 11, 0.9);
        }
        
        /* Responsive */
        @media screen and (max-width: 600px) {
            .content {
                padding: 30px 20px !important;
            }
            
            .details-container {
                padding: 20px !important;
            }
            
            .detail-label {
                width: 50% !important;
            }
            
            .main-title {
                font-size: 24px !important;
            }
            
            .status-emoji {
                font-size: 48px !important;
            }
        }
        
        /* Dark mode support */
        @media (prefers-color-scheme: dark) {
            .content {
                background: #1a202c !important;
                color: #ffffff !important;
            }
            
            .main-title {
                color: #ffffff !important;
            }
            
            .details-container {
                background: #2d3748 !important;
            }
            
            .detail-value {
                color: #ffffff !important;
            }
            
            .message-box {
                background: #2d3748 !important;
            }
            
            .message-text {
                color: #ffffff !important;
            }
        }
    </style>
</head>
<body style="margin: 0; padding: 0; background-color: #f7fafc;">
    <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%">
        <tr>
            <td align="center" style="padding: 20px 0;">
                <table class="email-container" role="presentation" cellspacing="0" cellpadding="0" border="0" width="600" style="max-width: 600px;">
                    
                    <!-- Header -->
                    <tr>
                        <td class="header status-{{ $status ?? 'default' }}" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); padding: 40px 20px; text-align: center;">
                            <img src="https://imagedelivery.net/iju3uLOJWht1WeOaYRYgxA/16ba8fdf-3de4-47b9-516c-8a5b6b393d00/public" alt="Foodly" class="logo" style="max-width: 160px; height: auto; margin-bottom: 20px; display: block; margin-left: auto; margin-right: auto;">
                            
                            <div class="status-badge">
                                @switch($status ?? 'default')
                                    @case('confirmed')
                                        ✅ რეზერვაცია დადასტურდა
                                        @break
                                    @case('cancelled')
                                        ❌ რეზერვაცია გაუქმდა
                                        @break
                                    @case('completed')
                                        🎉 რეზერვაცია დასრულდა
                                        @break
                                    @case('pending')
                                        ⏳ რეზერვაცია განხილვაში
                                        @break
                                    @default
                                        📋 სტატუსი შეიცვალა
                                @endswitch
                            </div>
                        </td>
                    </tr>
                    
                    <!-- Content -->
                    <tr>
                        <td class="content" style="background: #ffffff; padding: 40px 30px; text-align: center;">
                            
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
                            
                            <h1 class="main-title">
                                @switch($status ?? 'default')
                                    @case('confirmed')
                                        შესანიშნავი! რეზერვაცია დადასტურდა
                                        @break
                                    @case('cancelled')
                                        რეზერვაცია გაუქმებულია
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
                            <div class="details-container">
                                <h3 class="details-title">რეზერვაციის დეტალები</h3>
                                
                                <table class="detail-table" role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%">
                                    <tr class="detail-row">
                                        <td class="detail-label">რეზერვაციის №:</td>
                                        <td class="detail-value">#{{ $reservation->id ?? 'N/A' }}</td>
                                    </tr>
                                    
                                    @if(isset($reservation->client_name))
                                    <tr class="detail-row">
                                        <td class="detail-label">სახელი:</td>
                                        <td class="detail-value">{{ $reservation->client_name }}</td>
                                    </tr>
                                    @endif
                                    
                                    @if(isset($reservation->email))
                                    <tr class="detail-row">
                                        <td class="detail-label">ელ. ფოსტა:</td>
                                        <td class="detail-value">{{ $reservation->email }}</td>
                                    </tr>
                                    @endif
                                    
                                    @if(isset($reservation->phone))
                                    <tr class="detail-row">
                                        <td class="detail-label">ტელეფონი:</td>
                                        <td class="detail-value">{{ $reservation->phone }}</td>
                                    </tr>
                                    @endif
                                    
                                    @if(isset($reservation->guest_count))
                                    <tr class="detail-row">
                                        <td class="detail-label">პერსონების რაოდენობა:</td>
                                        <td class="detail-value">{{ $reservation->guest_count }} პირი</td>
                                    </tr>
                                    @endif
                                    
                                    @if(isset($reservation->reservation_date))
                                    <tr class="detail-row">
                                        <td class="detail-label">თარიღი:</td>
                                        <td class="detail-value">{{ $reservation->reservation_date }}</td>
                                    </tr>
                                    @endif
                                    
                                    @if(isset($reservation->reservation_time))
                                    <tr class="detail-row">
                                        <td class="detail-label">დრო:</td>
                                        <td class="detail-value">{{ $reservation->reservation_time }}</td>
                                    </tr>
                                    @endif
                                </table>
                            </div>
                            @endif
                            
                            <div class="message-box">
                                <p class="message-text">
                                    @switch($status ?? 'default')
                                        @case('confirmed')
                                            <strong>შესანიშნავი!</strong> თქვენი რეზერვაცია წარმატებით დადასტურდა. ველოდებით თქვენს ვიზიტს დანიშნულ დროს. 
                                            @break
                                        @case('cancelled')
                                            სამწუხაროდ, თქვენი რეზერვაცია გაუქმდა. დამატებითი ინფორმაციისთვის გთხოვთ დაგვიკავშირდეთ ქვემოთ მოცემული კონტაქტებით.
                                            @break
                                        @case('completed')
                                            <strong>გმადლობთ!</strong> იმედოვნებთ, რომ კმაყოფილი დარჩით ჩვენს სერვისით. გელოდებით ხელახლა!
                                            @break
                                        @case('pending')
                                            თქვენი რეზერვაციის განაცხადი მიღებულია და განხილვაშია. უახლოეს მომავალში დაგიკავშირდებით დასტურის თაობაზე.
                                            @break
                                        @default
                                            თქვენი რეზერვაციის სტატუსი განახლდა. დეტალური ინფორმაციისთვის შეგიძლიათ დაგვიკავშირდეთ.
                                    @endswitch
                                </p>
                            </div>
                            
                        </td>
                    </tr>
                    
                    <!-- Footer -->
                    <tr>
                        <td class="footer" style="background: #2d3748; color: #ffffff; padding: 30px 20px; text-align: center;">
                            <div class="footer-brand">🍽️ FOODLY</div>
                            
                            <div class="footer-contact">
                                📧 <a href="mailto:info@foodly.space" style="color: #a0aec0;">info@foodly.space</a><br>
                                📞 <a href="tel:+995322152024" style="color: #a0aec0;">(+995) 032 215 20 24</a><br>
                                🌐 <a href="https://foodly.space" target="_blank" style="color: #a0aec0;">www.foodly.space</a>
                            </div>
                            
                            <div class="footer-note">
                                გმადლობთ, რომ აირჩიეთ <strong style="color: #667eea;">Foodly</strong> - საუკეთესო გამოცდილებისთვის!
                            </div>
                        </td>
                    </tr>
                    
                </table>
            </td>
        </tr>
    </table>
</body>
</html>
