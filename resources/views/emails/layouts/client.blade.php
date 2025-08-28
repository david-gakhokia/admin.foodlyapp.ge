<!DOCTYPE html>
<html lang="ka">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FOODLY - მხიარული შეტყობინება! 🎉</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Comic Sans MS', cursive;
            line-height: 1.6;
            color: #2d3748;
            background: linear-gradient(45deg, #667eea 0%, #764ba2 25%, #f093fb 50%, #f5576c 75%, #4facfe 100%);
            background-size: 400% 400%;
            animation: gradientShift 8s ease infinite;
            padding: 20px;
        }
        
        @keyframes gradientShift {
            0%, 100% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
        }
        
        .container {
            max-width: 600px;
            margin: 0 auto;
            background: white;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
            animation: bounce 0.6s ease-out;
        }
        
        @keyframes bounce {
            0% { transform: scale(0.8) translateY(-50px); opacity: 0; }
            60% { transform: scale(1.05) translateY(10px); }
            100% { transform: scale(1) translateY(0); opacity: 1; }
        }
        
        .header {
            background: linear-gradient(135deg, #ff9a9e 0%, #fecfef 50%, #fecfef 100%);
            color: #2d3748;
            padding: 40px 30px;
            text-align: center;
            position: relative;
            overflow: hidden;
        }
        
        .header::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><text y=".9em" font-size="20">🎉</text></svg>') repeat;
            animation: float 6s ease-in-out infinite;
            opacity: 0.1;
        }
        
        @keyframes float {
            0%, 100% { transform: translateY(0px) rotate(0deg); }
            50% { transform: translateY(-20px) rotate(5deg); }
        }
        
        .logo {
            font-size: 32px;
            font-weight: 900;
            margin-bottom: 15px;
            letter-spacing: 1px;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.1);
            position: relative;
            z-index: 1;
        }
        
        .status-badge {
            display: inline-block;
            background: rgba(255, 255, 255, 0.9);
            color: #2d3748;
            padding: 12px 20px;
            border-radius: 25px;
            font-size: 16px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
            position: relative;
            z-index: 1;
            animation: pulse 2s infinite;
        }
        
        @keyframes pulse {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.05); }
        }
        
        .content {
            padding: 40px 30px;
            background: linear-gradient(45deg, #f8f9ff 0%, #fff5f5 100%);
        }
        
        .title {
            font-size: 28px;
            font-weight: 800;
            color: #2d3748;
            margin-bottom: 25px;
            text-align: center;
            text-shadow: 1px 1px 2px rgba(0,0,0,0.05);
        }
        
        .celebration {
            text-align: center;
            font-size: 48px;
            margin: 20px 0;
            animation: bounce 1s ease-in-out infinite alternate;
        }
        
        .reservation-card {
            background: white;
            border-radius: 15px;
            padding: 25px;
            margin: 25px 0;
            box-shadow: 0 8px 25px rgba(0,0,0,0.08);
            border: 3px solid transparent;
            background-clip: padding-box;
            position: relative;
        }
        
        .reservation-card::before {
            content: '';
            position: absolute;
            top: -3px;
            left: -3px;
            right: -3px;
            bottom: -3px;
            background: linear-gradient(45deg, #ff9a9e, #fecfef, #fad0c4);
            border-radius: 18px;
            z-index: -1;
        }
        
        .detail-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 12px 0;
            border-bottom: 1px solid #f1f5f9;
        }
        
        .detail-row:last-child {
            border-bottom: none;
        }
        
        .detail-label {
            font-weight: 700;
            color: #4a5568;
            min-width: 140px;
            font-size: 16px;
        }
        
        .detail-value {
            color: #2d3748;
            font-weight: 600;
            font-size: 16px;
        }
        
        .message {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 25px;
            border-radius: 15px;
            margin: 25px 0;
            text-align: center;
            font-size: 18px;
            font-weight: 600;
            box-shadow: 0 8px 25px rgba(102, 126, 234, 0.3);
        }
        
        .footer {
            background: linear-gradient(135deg, #2d3748 0%, #4a5568 100%);
            color: white;
            padding: 30px;
            text-align: center;
        }
        
        .footer-logo {
            font-size: 24px;
            font-weight: 800;
            margin-bottom: 15px;
            color: #ffd700;
        }
        
        .footer-text {
            font-size: 16px;
            color: #e2e8f0;
            line-height: 1.6;
        }
        
        .contact-info {
            margin-top: 20px;
            font-size: 14px;
        }
        
        .contact-info a {
            color: #ffd700;
            text-decoration: none;
            font-weight: 600;
        }
        
        @media only screen and (max-width: 600px) {
            body { padding: 10px; }
            .container { border-radius: 15px; }
            .header, .content, .footer { padding: 20px; }
            .detail-row { flex-direction: column; align-items: flex-start; gap: 8px; }
            .detail-label { min-width: auto; font-size: 13px; }
            .detail-value { font-size: 14px; }
            .title { font-size: 20px; }
            .celebration { font-size: 32px; }
            .logo { font-size: 24px; }
            .status-badge { font-size: 14px; padding: 10px 16px; }
            .message { font-size: 15px; padding: 20px; }
            .footer-text { font-size: 13px; }
            .contact-info { font-size: 12px; }
        }
        
        .georgian {
            font-family: 'BPG Nino Mtavruli', 'Sylfaen', 'DejaVu Sans', -apple-system, BlinkMacSystemFont, sans-serif;
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Header -->
        <div class="header">
            <div class="logo">🍽️ FOODLY</div>
            <div class="status-badge">
                @switch($reservation->status ?? 'pending')
                    @case('pending')
                        🕐 ველოდებით
                        @break
                    @case('confirmed')
                        🎉 დადასტურდა
                        @break
                    @case('completed')
                        ✨ შესრულდა
                        @break
                    @case('cancelled')
                        😔 გაუქმდა
                        @break
                    @default
                        📋 მიმდინარე
                @endswitch
            </div>
        </div>

        <!-- Content -->
        <div class="content">
            @switch($reservation->status ?? 'pending')
                @case('pending')
                    <div class="celebration">🎊✨🎉</div>
                    <h1 class="title georgian">ვაუ! ახალი რეზერვაცია! 🎉</h1>
                    @break
                @case('confirmed')
                    <div class="celebration">🥳🎈🎊</div>
                    <h1 class="title georgian">ჰურააა! რეზერვაცია დადასტურდა! 🎉</h1>
                    @break
                @case('completed')
                    <div class="celebration">🌟⭐✨</div>
                    <h1 class="title georgian">შესანიშნავი! ყველაფერი შესრულდა! 🌟</h1>
                    @break
                @case('cancelled')
                    <div class="celebration">💙🤗💫</div>
                    <h1 class="title georgian">უღირსი არ ხარ, მალე ისევ მოვიდე! 💙</h1>
                    @break
                @default
                    <div class="celebration">🍽️✨🎊</div>
                    <h1 class="title georgian">FOODLY-დან მხიარული შეტყობინება! 🎉</h1>
            @endswitch

            <div class="reservation-card">
                <div class="detail-row">
                    <span class="detail-label">👤 შენი სახელი:</span>
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
                    <span class="detail-label">👥 სტუმრების რაოდენობა:</span>
                    <span class="detail-value">{{ $reservation->guests_count ?? 'N/A' }} ადამიანი 👫</span>
                </div>
                
                <div class="detail-row">
                    <span class="detail-label">📅 შენი სასურველი დღე:</span>
                    <span class="detail-value">{{ $reservation->reservation_date ?? 'N/A' }} 📆</span>
                </div>
                
                <div class="detail-row">
                    <span class="detail-label">🕐 დრო:</span>
                    <span class="detail-value">{{ $reservation->time_from ?? 'N/A' }} - {{ $reservation->time_to ?? 'N/A' }} ⏰</span>
                </div>
                
                <div class="detail-row">
                    <span class="detail-label">🏪 რესტორანი:</span>
                    <span class="detail-value georgian">{{ $restaurantName ?? 'N/A' }} 🍽️</span>
                </div>
                
                @if($reservation->notes ?? false)
                <div class="detail-row">
                    <span class="detail-label">📝 შენი შენიშვნა:</span>
                    <span class="detail-value georgian">{{ $reservation->notes }}</span>
                </div>
                @endif
            </div>

            <div class="message georgian">
                @switch($reservation->status ?? 'pending')
                    @case('pending')
                        🎊 ვაუ! ახალი რეზერვაცია მოვიდა! ეს ძალიან საინტერესოა და მალე მოვახერხებთ დადასტურებას! 
                        გთხოვთ ოდნავ მოითმინოთ, ყველაფერი კარგად იქნება! 🌟
                        @break
                    @case('confirmed')
                        🥳 ჰურააა! შენი რეზერვაცია დადასტურდა! 
                        ეს ნიშნავს, რომ ყველაფერი მზადაა შენი საუკეთესო გამოცდილებისთვის! 
                        ელოდებით შენს ვიზიტს და დარწმუნებული ვართ, რომ გაუთვალისწინებელი დღე გექნება! 🎉✨
                        @break
                    @case('completed')
                        ✨ ვაუ! შენი ვიზიტი შესრულდა! 
                        იმედოვნებთ, რომ ყველაფერი მოგეწონა და შესანიშნავი დრო გაატარე! 
                        FOODLY-ს გუნდი მადლობას გიხდის და ეიტვებოდება შენს კიდევ ერთ ვიზიტს! 🌟💕
                        @break
                    @case('cancelled')
                        💙 ეს არაფერი, ასე ხდება ზოგჯერ! 
                        ყველაზე მთავარია შენი კომფორტი და ხალისი! 
                        როცა კიდევ მოგინდება გემრიელი საჭმელი და მხიარული გარემო, 
                        ელოდებით შენს ახალ რეზერვაციას! 🤗💫
                        @break
                    @default
                        💕 მადლობთ FOODLY-ის არჩევისთვის! შენ ჩვენთვის ყველაზე მნიშვნელოვანი ხარ! 🌟
                @endswitch
            </div>
        </div>

        <!-- Footer -->
        <div class="footer">
            <div class="footer-logo">🍽️ FOODLY</div>
            <div class="footer-text georgian">
                საქართველოს ყველაზე მხიარული და გემრიელი რესტორნების ჯავშნის პლატფორმა! 🎉✨
            </div>
            <div class="contact-info georgian">
                📧 <a href="mailto:admin@foodlyapp.ge">admin@foodlyapp.ge</a><br>
                🌐 <a href="https://foodlyapp.ge">foodlyapp.ge</a><br>
                💕 ყოველთვის შენთან ერთად!
            </div>
        </div>
    </div>
</body>
</html>
