<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ __('auth.reset_password_subject') }}</title>
    <style>
        body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; max-width: 600px; margin: 0 auto; padding: 20px; }
        .header { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; padding: 30px; text-align: center; border-radius: 10px 10px 0 0; }
        .content { background: #f8f9fa; padding: 30px; border-radius: 0 0 10px 10px; }
        .button { display: inline-block; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; padding: 12px 30px; text-decoration: none; border-radius: 5px; margin: 20px 0; }
        .footer { text-align: center; margin-top: 30px; color: #666; font-size: 14px; }
        .rtl { direction: rtl; text-align: right; }
    </style>
</head>
<body class="{{ app()->getLocale() === 'ar' ? 'rtl' : '' }}">
    <div class="header">
        <h1>{{ config('app.name') }}</h1>
        <p>{{ __('auth.reset_password_subject') }}</p>
    </div>
    
    <div class="content">
        <p>{{ __('auth.reset_password_greeting', ['name' => $user->name]) }}</p>
        
        <p>{{ __('auth.reset_password_message') }}</p>
        
        <div style="text-align: center;">
            <a href="{{ $url }}" class="button">{{ __('auth.reset_password_button') }}</a>
        </div>
        
        <p>{{ __('auth.reset_password_expire') }}</p>
        
        <p>{{ __('auth.reset_password_no_action') }}</p>
        
        <hr style="margin: 30px 0; border: none; border-top: 1px solid #ddd;">
        
        <p style="font-size: 14px; color: #666;">
            {{ __('auth.reset_password_trouble') }}<br>
            <a href="{{ $url }}" style="color: #667eea; word-break: break-all;">{{ $url }}</a>
        </p>
    </div>
    
    <div class="footer">
        <p>&copy; {{ date('Y') }} {{ config('app.name') }}. {{ __('auth.all_rights_reserved') }}</p>
    </div>
</body>
</html>