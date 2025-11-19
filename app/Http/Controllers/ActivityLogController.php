<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Activitylog\Models\Activity;

class ActivityLogController extends Controller
{
    public function index(Request $request)
    {
        $query = Activity::with('causer', 'subject')
            ->latest();
        
        // Filter by event type
        if ($request->filled('event')) {
            $query->where('description', 'like', '%' . $request->event . '%');
        }
        
        // Filter by user
        if ($request->filled('user')) {
            $query->where('causer_id', $request->user);
        }
        
        // Filter by date range
        if ($request->filled('date_from')) {
            $query->whereDate('created_at', '>=', $request->date_from);
        }
        
        if ($request->filled('date_to')) {
            $query->whereDate('created_at', '<=', $request->date_to);
        }
        
        $activities = $query->paginate(20);
        $users = \App\Models\User::select('id', 'name')->get();
        
        return view('activity-logs.index', compact('activities', 'users'));
    }
}