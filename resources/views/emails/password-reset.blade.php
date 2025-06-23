<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }
        .header {
            background-color: #3490dc;
            color: white;
            padding: 20px;
            text-align: center;
            border-radius: 5px;
            margin-bottom: 20px;
        }
        .content {
            background-color: #f8fafc;
            padding: 20px;
            border-radius: 5px;
            border: 1px solid #e2e8f0;
        }
        .button {
            display: inline-block;
            background-color: #3490dc;
            color: white;
            padding: 12px 25px;
            text-decoration: none;
            border-radius: 5px;
            margin: 20px 0;
        }
        .footer {
            text-align: center;
            margin-top: 20px;
            color: #718096;
            font-size: 0.9em;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>{{ config('app.name') }}</h1>
    </div>
    
    <div class="content">
        <h2>Hello {{ $user->name }},</h2>
        
        <p>You are receiving this email because we received a password reset request for your account.</p>
        
        <p style="text-align: center;">
            <a href="{{ $resetUrl }}" class="button" style="color: white;">Reset Password</a>
        </p>
        
        <p>If you did not request a password reset, no further action is required.</p>
        
        <p>This password reset link will expire in 60 minutes.</p>
        
        <p>If you're having trouble clicking the "Reset Password" button, copy and paste the URL below into your web browser:</p>
        
        <p style="word-break: break-all;">{{ $resetUrl }}</p>
    </div>
    
    <div class="footer">
        <p>© {{ date('Y') }} {{ config('app.name') }}. All rights reserved.</p>
    </div>
</body>
</html> 