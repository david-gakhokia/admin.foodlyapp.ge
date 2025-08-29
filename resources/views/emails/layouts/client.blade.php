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
        
        /* Client-specific status colors */
        .status-pending {
            background: linear-gradient(135deg, #fed7aa 0%, #f7931e 100%);
        }
        
        .status-confirmed {
            background: linear-gradient(135deg, #86efac 0%, #22c55e 100%);
        }
        
        .status-cancelled {
            background: linear-gradient(135deg, #fca5a5 0%, #ef4444 100%);
        }
        
        .status-paid {
            background: linear-gradient(135deg, #fbbf24 0%, #f59e0b 100%);
        }
        
        .status-badge {
            display: inline-block;
            background: rgba(255, 255, 255, 0.2);
            padding: 12px 20px;
            border-radius: 25px;
            font-size: 16px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            border: 2px solid rgba(255, 255, 255, 0.3);
        }
        
        .content {
            padding: 40px 30px;
        }
        
        .title {
            font-size: 26px;
            font-weight: 700;
            color: #2d3748;
            margin-bottom: 25px;
            text-align: center;
        }
        
        .reservation-card {
            background: linear-gradient(135deg, #f7fafc 0%, #edf2f7 100%);
            border-radius: 12px;
            padding: 25px;
            margin: 25px 0;
            border-left: 5px solid #ff6b35;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
        }
        
        .detail-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 12px 0;
            border-bottom: 1px solid #e2e8f0;
        }
        
        .detail-row:last-child {
            border-bottom: none;
        }
        
        .detail-label {
            font-weight: 600;
            color: #4a5568;
            min-width: 140px;
            font-size: 15px;
        }
        
        .detail-value {
            color: #2d3748;
            font-weight: 500;
            font-size: 15px;
        }
        
        .message {
            background: linear-gradient(135deg, #edf2f7 0%, #e2e8f0 100%);
            padding: 25px;
            border-radius: 12px;
            margin: 25px 0;
            text-align: center;
            color: #4a5568;
            border: 1px solid #cbd5e0;
        }
        
        .footer {
            background: #2d3748;
            color: white;
            padding: 35px 30px;
            text-align: center;
        }
        
        .footer-logo {
            font-size: 22px;
            font-weight: 700;
            margin-bottom: 15px;
            color: #ff6b35;
        }
        
        .footer-text {
            font-size: 14px;
            color: #a0aec0;
            line-height: 1.6;
            margin-bottom: 20px;
        }
        
        .contact-info {
            font-size: 14px;
            line-height: 1.8;
        }
        
        .contact-info a {
            color: #ff6b35;
            text-decoration: none;
        }
        
        .contact-info a:hover {
            text-decoration: underline;
        }
        
        @media only screen and (max-width: 600px) {
            .container {
                margin: 0;
                border-radius: 0;
            }
            
            .header, .content, .footer {
                padding: 25px 20px;
            }
            
            .detail-row {
                flex-direction: column;
                align-items: flex-start;
                gap: 8px;
            }
            
            .detail-label {
                min-width: auto;
            }
            
            .title {
                font-size: 22px;
            }
        }
        
        /* Georgian font support */
        .georgian {
            font-family: 'BPG Nino Mtavruli', 'Sylfaen', 'DejaVu Sans', sans-serif;
        }
        
        /* Client-specific styling */
        .client-highlight {
            background: linear-gradient(135deg, #fff5f0 0%, #fed7aa 100%);
            border: 2px solid #ff6b35;
            border-radius: 8px;
            padding: 15px;
            margin: 15px 0;
        }
    </style>
</head>
<body>
    <div class="container">
        @yield('content')
    </div>
</body>
</html>
