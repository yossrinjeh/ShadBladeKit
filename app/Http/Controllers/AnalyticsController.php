<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class AnalyticsController extends Controller
{
    public function dashboard()
    {
        $metrics = $this->getDashboardMetrics();
        $chartData = $this->getChartData();
        $recentActivity = $this->getRecentActivity();
        
        return view('analytics.dashboard', compact('metrics', 'chartData', 'recentActivity'));
    }
    
    public function api()
    {
        return response()->json([
            'metrics' => $this->getDashboardMetrics(),
            'charts' => $this->getChartData(),
            'activity' => $this->getRecentActivity()
        ]);
    }
    
    private function getDashboardMetrics()
    {
        $now = Carbon::now();
        $lastMonth = $now->copy()->subMonth();
        
        // Total users
        $totalUsers = User::count();
        $newUsersThisMonth = User::where('created_at', '>=', $lastMonth)->count();
        $userGrowth = $totalUsers > 0 ? round(($newUsersThisMonth / $totalUsers) * 100, 1) : 0;
        
        // Active users (logged in last 30 days)
        $activeUsers = User::where('updated_at', '>=', $lastMonth)->count();
        $activeRate = $totalUsers > 0 ? round(($activeUsers / $totalUsers) * 100, 1) : 0;
        
        // Admin users
        $adminUsers = User::role('admin')->count();
        
        // Recent registrations (last 7 days)
        $recentRegistrations = User::where('created_at', '>=', $now->copy()->subDays(7))->count();
        
        return [
            'total_users' => [
                'value' => $totalUsers,
                'change' => $userGrowth,
                'trend' => $userGrowth > 0 ? 'up' : 'down'
            ],
            'active_users' => [
                'value' => $activeUsers,
                'percentage' => $activeRate,
                'trend' => 'up'
            ],
            'admin_users' => [
                'value' => $adminUsers,
                'percentage' => $totalUsers > 0 ? round(($adminUsers / $totalUsers) * 100, 1) : 0
            ],
            'recent_registrations' => [
                'value' => $recentRegistrations,
                'period' => 'Last 7 days'
            ]
        ];
    }
    
    private function getChartData()
    {
        // User registrations over last 30 days
        $registrations = User::select(
            DB::raw('DATE(created_at) as date'),
            DB::raw('COUNT(*) as count')
        )
        ->where('created_at', '>=', Carbon::now()->subDays(30))
        ->groupBy('date')
        ->orderBy('date')
        ->get();
        
        // Fill missing dates with 0
        $dates = [];
        $counts = [];
        for ($i = 29; $i >= 0; $i--) {
            $date = Carbon::now()->subDays($i)->format('Y-m-d');
            $dates[] = Carbon::parse($date)->format('M j');
            $counts[] = $registrations->where('date', $date)->first()->count ?? 0;
        }
        
        // Role distribution
        $roleData = DB::table('model_has_roles')
            ->join('roles', 'model_has_roles.role_id', '=', 'roles.id')
            ->select('roles.name', DB::raw('COUNT(*) as count'))
            ->groupBy('roles.name')
            ->get();
            
        return [
            'user_registrations' => [
                'labels' => $dates,
                'data' => $counts
            ],
            'role_distribution' => [
                'labels' => $roleData->pluck('name')->toArray(),
                'data' => $roleData->pluck('count')->toArray()
            ]
        ];
    }
    
    private function getRecentActivity()
    {
        return [
            [
                'type' => 'user_registered',
                'message' => 'New user registered',
                'user' => User::latest()->first()?->name ?? 'Unknown',
                'time' => User::latest()->first()?->created_at?->diffForHumans() ?? 'N/A',
                'icon' => 'user-plus'
            ],
            [
                'type' => 'system_update',
                'message' => 'System backup completed',
                'user' => 'System',
                'time' => '2 hours ago',
                'icon' => 'shield-check'
            ],
            [
                'type' => 'admin_action',
                'message' => 'User roles updated',
                'user' => 'Admin',
                'time' => '4 hours ago',
                'icon' => 'settings'
            ]
        ];
    }
}
