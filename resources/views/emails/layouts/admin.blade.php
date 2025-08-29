<!DOCTYPE html>
<html lang="ka">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FOODLY Admin - რეზერვაციის შეტყობინება</title>
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
            background-color: #f1f5f9;
        }
        
        .container {
            max-width: 700px;
            margin: 0 auto;
            background: white;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.08);
        }
        
        .header {
            background: linear-gradient(135deg, #4f46e5 0%, #7c3aed 100%);
            color: white;
            padding: 40px 30px;
            text-align: center;
            position: relative;
        }
        
        .header::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, #ff6b35, #f7931e);
        }
        
        .logo {
            font-size: 28px;
            font-weight: 800;
            margin-bottom: 10px;
            letter-spacing: 1px;
        }
        
        .admin-badge {
            display: inline-block;
            background: rgba(255, 255, 255, 0.15);
            padding: 6px 12px;
            border-radius: 15px;
            font-size: 12px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 15px;
        }
        
        /* Admin-specific status colors */
        .status-pending {
            background: linear-gradient(135deg, #fef3c7 0%, #f59e0b 100%);
            color: #92400e;
        }
        
        .status-confirmed {
            background: linear-gradient(135deg, #d1fae5 0%, #10b981 100%);
            color: #065f46;
        }
        
        .status-cancelled {
            background: linear-gradient(135deg, #fee2e2 0%, #ef4444 100%);
            color: #991b1b;
        }
        
        .status-paid {
            background: linear-gradient(135deg, #ddd6fe 0%, #8b5cf6 100%);
            color: #5b21b6;
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
            color: #1e293b;
            margin-bottom: 25px;
            text-align: center;
        }
        
        .admin-alert {
            background: linear-gradient(135deg, #fef9c3 0%, #fde047 100%);
            border: 2px solid #facc15;
            border-radius: 12px;
            padding: 20px;
            margin: 20px 0;
            text-align: center;
            font-weight: 600;
            color: #a16207;
        }
        
        .reservation-card {
            background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
            border-radius: 12px;
            padding: 25px;
            margin: 25px 0;
            border-left: 5px solid #4f46e5;
            box-shadow: 0 3px 6px rgba(0, 0, 0, 0.05);
        }
        
        .detail-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 12px 0;
            border-bottom: 1px solid #cbd5e0;
        }
        
        .detail-row:last-child {
            border-bottom: none;
        }
        
        .detail-label {
            font-weight: 700;
            color: #374151;
            min-width: 140px;
            font-size: 15px;
        }
        
        .detail-value {
            color: #1f2937;
            font-weight: 500;
            font-size: 15px;
        }
        
        .admin-actions {
            background: linear-gradient(135deg, #e0f2fe 0%, #bae6fd 100%);
            border: 2px solid #0ea5e9;
            border-radius: 12px;
            padding: 20px;
            margin: 25px 0;
            text-align: center;
        }
        
        .footer {
            background: #1e293b;
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
            color: #94a3b8;
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
        
        @media only screen and (max-width: 700px) {
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
        }
        
        /* Georgian font support */
        .georgian {
            font-family: 'BPG Nino Mtavruli', 'Sylfaen', 'DejaVu Sans', sans-serif;
        }
    </style>
</head>
<body>
    <div class="container">
        @yield('content')
    </div>
</body>
</html>
