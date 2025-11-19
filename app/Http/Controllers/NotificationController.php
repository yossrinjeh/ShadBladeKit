<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Notifications\WelcomeNotification;

class NotificationController extends Controller
{
    public function test()
    {
        auth()->user()->notify(new WelcomeNotification('Test notification sent successfully!'));
        
        return back()->with('status', 'notification-sent');
    }

    public function markAsRead($id)
    {
        $notification = auth()->user()->notifications()->find($id);
        
        if ($notification) {
            $notification->markAsRead();
        }
        
        return back();
    }

    public function markAllAsRead()
    {
        auth()->user()->unreadNotifications->markAsRead();
        
        return back();
    }
}
