<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <title>{{ config('app.name', 'Laravel') }} - Email Verification</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    
    <style>
        body {
            font-family: 'Figtree', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            line-height: 1.6;
            color: #374151;
            background-color: #f9fafb;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
        }
        .header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            padding: 40px 30px;
            text-align: center;
            color: white;
        }
        .header h1 {
            margin: 0;
            font-size: 28px;
            font-weight: 600;
            letter-spacing: -0.025em;
        }
        .header p {
            margin: 10px 0 0 0;
            opacity: 0.9;
            font-size: 16px;
        }
        .content {
            padding: 40px 30px;
        }
        .welcome-text {
            font-size: 18px;
            font-weight: 500;
            color: #111827;
            margin-bottom: 20px;
        }
        .description {
            color: #6b7280;
            margin-bottom: 30px;
            font-size: 16px;
            line-height: 1.6;
        }
        .verification-button {
            display: inline-block;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white !important;
            text-decoration: none;
            padding: 16px 32px;
            border-radius: 8px;
            font-weight: 600;
            font-size: 16px;
            text-align: center;
            margin: 20px 0;
            transition: all 0.3s ease;
        }
        .verification-button:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(102, 126, 234, 0.3);
        }
        .verification-link {
            word-break: break-all;
            background-color: #f3f4f6;
            padding: 15px;
            border-radius: 8px;
            font-family: 'Courier New', monospace;
            font-size: 14px;
            color: #374151;
            margin: 20px 0;
            border: 1px solid #e5e7eb;
        }
        .info-box {
            background-color: #eff6ff;
            border: 1px solid #dbeafe;
            border-radius: 8px;
            padding: 20px;
            margin: 30px 0;
        }
        .info-box h3 {
            color: #1e40af;
            margin: 0 0 10px 0;
            font-size: 16px;
            font-weight: 600;
        }
        .info-box p {
            color: #1e3a8a;
            margin: 0;
            font-size: 14px;
            line-height: 1.5;
        }
        .footer {
            background-color: #f9fafb;
            padding: 30px;
            text-align: center;
            border-top: 1px solid #e5e7eb;
        }
        .footer p {
            color: #6b7280;
            font-size: 14px;
            margin: 5px 0;
        }
        .logo {
            font-size: 24px;
            font-weight: 700;
            color: white;
            text-decoration: none;
        }
        .expiry-notice {
            background-color: #fef3c7;
            border: 1px solid #f59e0b;
            border-radius: 8px;
            padding: 15px;
            margin: 20px 0;
            color: #92400e;
            font-size: 14px;
        }
        .unsubscribe {
            text-align: center;
            margin-top: 20px;
            padding-top: 20px;
            border-top: 1px solid #e5e7eb;
        }
        .unsubscribe a {
            color: #6b7280;
            text-decoration: none;
            font-size: 12px;
        }
        @media (max-width: 600px) {
            .container {
                margin: 10px;
                border-radius: 8px;
            }
            .header, .content, .footer {
                padding: 20px;
            }
            .header h1 {
                font-size: 24px;
            }
            .verification-button {
                display: block;
                width: 100%;
                box-sizing: border-box;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <a href="{{ url('/') }}" class="logo">{{ config('app.name', 'Laravel') }}</a>
            <h1>Verify Your Email Address</h1>
            <p>Complete your registration by verifying your email</p>
        </div>
        
        <div class="content">
            <div class="welcome-text">
                Hello {{ $user->name }}! 👋
            </div>
            
            <div class="description">
                Thank you for registering with {{ config('app.name', 'Laravel') }}. To complete your registration and access your account, please verify your email address by clicking the button below.
            </div>
            
            <div style="text-align: center;">
                <a href="{{ $verificationUrl }}" class="verification-button">
                    Verify Email Address
                </a>
            </div>
            
            <div class="expiry-notice">
                <strong>⚠️ Important:</strong> This verification link will expire in {{ config('auth.verification.expire', 60) }} minutes for security reasons.
            </div>
            
            <div class="info-box">
                <h3>🔒 Security Notice</h3>
                <p>If you didn't create an account with {{ config('app.name', 'Laravel') }}, you can safely ignore this email. Your email address will not be used for any other purpose.</p>
            </div>
            
            <div class="description">
                <strong>Having trouble clicking the button?</strong><br>
                Copy and paste the following link into your web browser:
            </div>
            
            <div class="verification-link">
                {{ $verificationUrl }}
            </div>
            
            <div class="description">
                <strong>Need help?</strong><br>
                If you're having trouble verifying your email, please contact our support team and we'll be happy to help you.
            </div>
        </div>
        
        <div class="footer">
            <p><strong>{{ config('app.name', 'Laravel') }}</strong></p>
            <p>This email was sent to {{ $user->email }}</p>
            <p>© {{ date('Y') }} {{ config('app.name', 'Laravel') }}. All rights reserved.</p>
            
            <div class="unsubscribe">
                <a href="mailto:{{ config('mail.from.address') }}?subject=Unsubscribe">Unsubscribe from emails</a>
            </div>
        </div>
    </div>
</body>
</html> 