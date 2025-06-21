<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Get dashboard statistics
     */
    public function stats(Request $request): JsonResponse
    {
        $user = $request->user();
        
        $stats = [
            'total_users' => \App\Models\User::count(),
            'active_users' => \App\Models\User::count(), // All users are considered active since email verification is not required
            'users_today' => \App\Models\User::whereDate('created_at', today())->count(),
            'users_this_week' => \App\Models\User::whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()])->count(),
            'users_this_month' => \App\Models\User::whereMonth('created_at', now()->month)->count(),
            'roles_distribution' => $this->getUsersByRole(),
            'verification_rate' => $this->getVerificationRate(),
        ];
        
        return response()->json([
            'success' => true,
            'data' => $stats,
            'timestamp' => now()->toISOString(),
        ]);
    }

    /**
     * Get recent activity
     */
    public function activity(Request $request): JsonResponse
    {
        $activity = [
            'latest_users' => \App\Models\User::latest()->take(10)->get(['id', 'name', 'email', 'created_at']),
            'recent_logins' => [], // Placeholder for login activity
            'system_events' => [], // Placeholder for system events
            'last_updated' => now()->toISOString(),
        ];
        
        return response()->json([
            'success' => true,
            'data' => $activity,
            'timestamp' => now()->toISOString(),
        ]);
    }

    /**
     * Get analytics data
     */
    public function analytics(Request $request): JsonResponse
    {
        $analytics = [
            'user_growth' => $this->getUserGrowthData(),
            'role_distribution' => $this->getUsersByRole(),
            'verification_rate' => $this->getVerificationRate(),
            'user_activity' => $this->getUserActivityData(),
        ];
        
        return response()->json([
            'success' => true,
            'data' => $analytics,
            'timestamp' => now()->toISOString(),
        ]);
    }

    /**
     * Get users grouped by role
     */
    private function getUsersByRole(): array
    {
        $roles = \Spatie\Permission\Models\Role::withCount('users')->get();
        
        return $roles->pluck('users_count', 'name')->toArray();
    }

    /**
     * Get verification rate
     */
    private function getVerificationRate(): float
    {
        // Since email verification is no longer required, all users are considered verified
        return 100.0;
    }

    /**
     * Get user growth data for the last 30 days
     */
    private function getUserGrowthData(): array
    {
        $last30Days = collect(range(29, 0))->map(function ($day) {
            $date = now()->subDays($day);
            return [
                'date' => $date->format('Y-m-d'),
                'count' => \App\Models\User::whereDate('created_at', $date)->count(),
            ];
        });

        return $last30Days->toArray();
    }

    /**
     * Get user activity data
     */
    private function getUserActivityData(): array
    {
        return [
            'active_today' => \App\Models\User::whereDate('updated_at', today())->count(),
            'active_this_week' => \App\Models\User::whereBetween('updated_at', [now()->startOfWeek(), now()->endOfWeek()])->count(),
            'active_this_month' => \App\Models\User::whereMonth('updated_at', now()->month)->count(),
        ];
    }
} 