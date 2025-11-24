<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Contact Form Message</title>
</head>
<body>
    <h2>New Contact Form Message</h2>
    
    <p><strong>Name:</strong> {{ $data['name'] }}</p>
    <p><strong>Email:</strong> {{ $data['email'] }}</p>
    <p><strong>Subject:</strong> {{ $data['subject'] }}</p>
    
    <h3>Message:</h3>
    <p>{{ nl2br(e($data['message'])) }}</p>
    
    <hr>
    <p><small>This message was sent from the contact form on {{ config('app.name') }}</small></p>
</body>
</html>