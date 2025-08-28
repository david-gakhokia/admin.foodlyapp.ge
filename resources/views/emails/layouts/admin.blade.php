<!DOCTYPE html>
<html lang="ka">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FOODLY Admin - სისტემური შეტყობინება</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'SF Pro Display', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            line-height: 1.6;
            color: #2d3748;
            background-color: #f0f2f5;
            padding: 20px;
        }
        
        .container {
            max-width: 700px;
            margin: 0 auto;
            background: white;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
            border: 1px solid #e2e8f0;
        }
        
        .header {
            background: linear-gradient(135deg, #1a365d 0%, #2d3748 50%, #4a5568 100%);
            color: white;
            padding: 35px;
            text-align: center;
            position: relative;
            overflow: hidden;
        }
        
        .header::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="grid" width="10" height="10" patternUnits="userSpaceOnUse"><path d="M 10 0 L 0 0 0 10" fill="none" stroke="rgba(255,255,255,0.1)" stroke-width="1"/></pattern></defs><rect width="100" height="100" fill="url(%23grid)"/></svg>') repeat;
            opacity: 0.3;
        }
        
        .header-content {
            position: relative;
            z-index: 1;
        }
        
        .logo {
            font-size: 28px;
            font-weight: 800;
            margin-bottom: 8px;
            letter-spacing: 1px;
        }
        
        .subtitle {
            font-size: 14px;
            opacity: 0.9;
            font-weight: 500;
            margin-bottom: 15px;
        }
        
        .admin-badge {
            display: inline-block;
            background: rgba(255, 255, 255, 0.2);
            border: 1px solid rgba(255, 255, 255, 0.3);
            padding: 8px 16px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1px;
            backdrop-filter: blur(10px);
        }
        
        .content {
            padding: 35px;
        }
        
        .alert-banner {
            margin-bottom: 25px;
            padding: 20px;
            border-radius: 8px;
            border-left: 5px solid;
            position: relative;
        }
        
        .alert-pending {
            background: #fff5f5;
            border-left-color: #e53e3e;
            color: #742a2a;
        }
        
        .alert-confirmed {
            background: #f0fff4;
            border-left-color: #38a169;
            color: #276749;
        }
        
        .alert-completed {
            background: #ebf8ff;
            border-left-color: #3182ce;
            color: #2a4365;
        }
        
        .alert-cancelled {
            background: #fef5e7;
            border-left-color: #dd6b20;
            color: #7b341e;
        }
        
        .alert-icon {
            font-size: 20px;
            margin-right: 12px;
        }
        
        .alert-content {
            display: flex;
            align-items: center;
        }
        
        .alert-text {
            flex: 1;
        }
        
        .alert-title {
            font-weight: 700;
            font-size: 16px;
            margin-bottom: 4px;
        }
        
        .alert-description {
            font-size: 14px;
            opacity: 0.9;
        }
        
        .section {
            margin-bottom: 25px;
            background: #f8f9fa;
            border: 1px solid #e9ecef;
            border-radius: 8px;
            overflow: hidden;
        }
        
        .section-header {
            background: #e9ecef;
            padding: 15px 20px;
            border-bottom: 1px solid #dee2e6;
            font-weight: 700;
            font-size: 14px;
            color: #495057;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        
        .section-content {
            padding: 20px;
        }
        
        .data-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 13px;
        }
        
        .data-table th,
        .data-table td {
            padding: 10px 12px;
            text-align: left;
            border-bottom: 1px solid #e9ecef;
        }
        
        .data-table th {
            background: #f8f9fa;
            font-weight: 600;
            color: #495057;
            font-size: 11px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        
        .data-table td {
            color: #212529;
        }
        
        .data-table tr:hover {
            background: #f1f3f4;
        }
        
        .status-indicator {
            display: inline-block;
            width: 8px;
            height: 8px;
            border-radius: 50%;
            margin-right: 8px;
        }
        
        .status-pending { background: #e53e3e; }
        .status-confirmed { background: #38a169; }
        .status-completed { background: #3182ce; }
        .status-cancelled { background: #dd6b20; }
        
        .metric-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
            gap: 15px;
            margin-bottom: 20px;
        }
        
        .metric-card {
            background: white;
            border: 1px solid #e9ecef;
            border-radius: 6px;
            padding: 15px;
            text-align: center;
        }
        
        .metric-value {
            font-size: 24px;
            font-weight: 700;
            color: #2d3748;
            margin-bottom: 5px;
        }
        
        .metric-label {
            font-size: 11px;
            color: #6c757d;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        
        .system-info {
            background: #f8f9fa;
            border: 1px solid #e9ecef;
            border-radius: 6px;
            padding: 15px;
            font-size: 12px;
            color: #6c757d;
            margin-top: 20px;
        }
        
        .system-info-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 10px;
        }
        
        .system-info-item {
            display: flex;
            justify-content: space-between;
        }
        
        .footer {
            background: #1a365d;
            color: white;
            padding: 30px;
            text-align: center;
        }
        
        .footer-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
            margin-bottom: 20px;
        }
        
        .footer-section h4 {
            color: #90cdf4;
            font-size: 14px;
            margin-bottom: 10px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        
        .footer-section p,
        .footer-section a {
            color: #cbd5e0;
            font-size: 12px;
            text-decoration: none;
            line-height: 1.6;
        }
        
        .footer-section a:hover {
            color: #90cdf4;
        }
        
        .footer-bottom {
            border-top: 1px solid #2d3748;
            padding-top: 20px;
            font-size: 11px;
            color: #a0aec0;
        }
        
        @media only screen and (max-width: 600px) {
            body { padding: 10px; }
            .content { padding: 20px; }
            .metric-grid { grid-template-columns: 1fr; }
            .data-table { font-size: 11px; }
            .data-table th,
            .data-table td { padding: 8px; }
        }
        
        .georgian {
            font-family: 'BPG Nino Mtavruli', 'Sylfaen', 'DejaVu Sans', sans-serif;
        }
        
        .priority-urgent {
            animation: pulse 2s infinite;
        }
        
        @keyframes pulse {
            0% { opacity: 1; }
            50% { opacity: 0.7; }
            100% { opacity: 1; }
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Header -->
        <div class="header">
            <div class="header-content">
                <div class="logo">🛡️ FOODLY ADMIN</div>
                <div class="subtitle georgian">ადმინისტრაციული კონტროლის პანელი</div>
                <div class="admin-badge">სისტემური შეტყობინება</div>
            </div>
        </div>

        <!-- Content -->
        <div class="content">
            <!-- Alert Banner -->
            <div class="alert-banner alert-{{ $reservation->status ?? 'pending' }} @if(($reservation->status ?? 'pending') === 'pending') priority-urgent @endif">
                <div class="alert-content">
                    <div class="alert-icon">
                        @switch($reservation->status ?? 'pending')
                            @case('pending')
                                🔔
                                @break
                            @case('confirmed')
                                ✅
                                @break
                            @case('completed')
                                🎯
                                @break
                            @case('cancelled')
                                ⚠️
                                @break
                            @default
                                📋
                        @endswitch
                    </div>
                    <div class="alert-text">
                        <div class="alert-title georgian">
                            @switch($reservation->status ?? 'pending')
                                @case('pending')
                                    ახალი რეზერვაციის მოთხოვნა მიღებულია
                                    @break
                                @case('confirmed')
                                    რეზერვაცია დადასტურებულია
                                    @break
                                @case('completed')
                                    რეზერვაცია წარმატებით დასრულდა
                                    @break
                                @case('cancelled')
                                    რეზერვაცია გაუქმებულია
                                    @break
                                @default
                                    რეზერვაციის შეტყობინება
                            @endswitch
                        </div>
                        <div class="alert-description">
                            სისტემაში რეგისტრირებულია ახალი აქტივობა რესერვაცია ID: {{ $reservation->id ?? 'N/A' }}
                        </div>
                    </div>
                </div>
            </div>

            <!-- Metrics Overview -->
            <div class="section">
                <div class="section-header">
                    📊 რეზერვაციის მეტრიკები
                </div>
                <div class="section-content">
                    <div class="metric-grid">
                        <div class="metric-card">
                            <div class="metric-value">{{ $reservation->id ?? 'N/A' }}</div>
                            <div class="metric-label">რეზერვაციის ID</div>
                        </div>
                        <div class="metric-card">
                            <div class="metric-value">{{ $reservation->guests_count ?? 'N/A' }}</div>
                            <div class="metric-label">სტუმრების რაოდენობა</div>
                        </div>
                        <div class="metric-card">
                            <div class="metric-value">
                                <span class="status-indicator status-{{ $reservation->status ?? 'pending' }}"></span>
                                @switch($reservation->status ?? 'pending')
                                    @case('pending')
                                        მოლოდინი
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
                                        უცნობი
                                @endswitch
                            </div>
                            <div class="metric-label">სტატუსი</div>
                        </div>
                        <div class="metric-card">
                            <div class="metric-value">{{ now()->format('H:i') }}</div>
                            <div class="metric-label">ალერტის დრო</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Reservation Details -->
            <div class="section">
                <div class="section-header">
                    📋 რეზერვაციის სრული დეტალები
                </div>
                <div class="section-content">
                    <table class="data-table">
                        <thead>
                            <tr>
                                <th>პარამეტრი</th>
                                <th>მნიშვნელობა</th>
                                <th>ვალიდაცია</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><strong>კლიენტის სახელი</strong></td>
                                <td class="georgian">{{ $reservation->name ?? 'N/A' }}</td>
                                <td>✅ ვალიდური</td>
                            </tr>
                            <tr>
                                <td><strong>ელ-ფოსტა</strong></td>
                                <td>{{ $reservation->email ?? 'N/A' }}</td>
                                <td>✅ ვალიდური</td>
                            </tr>
                            <tr>
                                <td><strong>ტელეფონი</strong></td>
                                <td>{{ $reservation->phone ?? 'N/A' }}</td>
                                <td>✅ ვალიდური</td>
                            </tr>
                            <tr>
                                <td><strong>რესტორანი</strong></td>
                                <td class="georgian">{{ $restaurantName ?? 'N/A' }}</td>
                                <td>✅ ვალიდური</td>
                            </tr>
                            <tr>
                                <td><strong>რეზერვაციის თარიღი</strong></td>
                                <td>{{ $reservation->reservation_date ?? 'N/A' }}</td>
                                <td>✅ ვალიდური</td>
                            </tr>
                            <tr>
                                <td><strong>დროის ინტერვალი</strong></td>
                                <td>{{ $reservation->time_from ?? 'N/A' }} - {{ $reservation->time_to ?? 'N/A' }}</td>
                                <td>✅ ვალიდური</td>
                            </tr>
                            <tr>
                                <td><strong>სტუმრების რაოდენობა</strong></td>
                                <td>{{ $reservation->guests_count ?? 'N/A' }}</td>
                                <td>✅ ვალიდური</td>
                            </tr>
                            @if($reservation->notes ?? false)
                            <tr>
                                <td><strong>კლიენტის შენიშვნა</strong></td>
                                <td class="georgian">{{ $reservation->notes }}</td>
                                <td>✅ ვალიდური</td>
                            </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- System Information -->
            <div class="system-info">
                <div class="section-header" style="background: transparent; padding: 0 0 10px 0; border: none;">
                    🔧 სისტემური ინფორმაცია
                </div>
                <div class="system-info-grid">
                    <div class="system-info-item">
                        <span>შეტყობინების გენერაცია:</span>
                        <span>{{ now()->format('Y-m-d H:i:s') }}</span>
                    </div>
                    <div class="system-info-item">
                        <span>სერვერის სახელი:</span>
                        <span>{{ request()->getHost() }}</span>
                    </div>
                    <div class="system-info-item">
                        <span>ენვირონმენტი:</span>
                        <span>{{ config('app.env') }}</span>
                    </div>
                    <div class="system-info-item">
                        <span>აპლიკაციის ვერსია:</span>
                        <span>{{ config('app.version', '1.0.0') }}</span>
                    </div>
                    <div class="system-info-item">
                        <span>ფოსტის სისტემა:</span>
                        <span>{{ config('mail.default') }}</span>
                    </div>
                    <div class="system-info-item">
                        <span>რიგის სისტემა:</span>
                        <span>{{ config('queue.default') }}</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Footer -->
        <div class="footer">
            <div class="footer-grid">
                <div class="footer-section">
                    <h4>📊 სისტემა</h4>
                    <p>FOODLY Reservation Management</p>
                    <p>Admin Control Panel v2.0</p>
                    <p>Laravel Framework</p>
                </div>
                <div class="footer-section">
                    <h4>📞 ტექნიკური მხარდაჭერა</h4>
                    <p><a href="mailto:admin@foodlyapp.ge">admin@foodlyapp.ge</a></p>
                    <p><a href="mailto:support@foodlyapp.ge">support@foodlyapp.ge</a></p>
                    <p>24/7 მონიტორინგი</p>
                </div>
                <div class="footer-section">
                    <h4>🔗 მოწყობილობები</h4>
                    <p><a href="https://admin.foodlyapp.ge">Admin Panel</a></p>
                    <p><a href="https://api.foodlyapp.ge">API Documentation</a></p>
                    <p><a href="https://status.foodlyapp.ge">Status Page</a></p>
                </div>
            </div>
            <div class="footer-bottom">
                <p>© {{ now()->year }} FOODLY - ყველა უფლება დაცულია | ადმინისტრაციული შეტყობინება</p>
            </div>
        </div>
    </div>
</body>
</html>
