<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactMessage;

class ContactController extends Controller
{
    public function show()
    {
        return view('contact');
    }

    public function send(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'subject' => 'required|string|max:255',
            'message' => 'required|string|max:5000'
        ]);

        try {
            Mail::to('contact@yosridev.com')->send(new ContactMessage($request->all()));
            return back()->with('status', 'message-sent');
        } catch (\Exception $e) {
            return back()->with('error', 'Failed to send message. Please try again.');
        }
    }
}