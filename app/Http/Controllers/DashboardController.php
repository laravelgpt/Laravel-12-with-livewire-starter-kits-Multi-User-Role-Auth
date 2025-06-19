<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\JsonResponse;

class DashboardController extends Controller
{
    /**
     * Display the main dashboard (redirects based on user role)
     */
    public function index(Request $request): \Illuminate\Http\RedirectResponse
    {
        $user = $request->user();
        
        if ($user->hasRole(['admin', 'staff'])) {
            return redirect()->route('admin.dashboard');
        }
        
        return redirect()->route('user.dashboard');
    }

    /**
     * Display the admin dashboard
     */
    public function admin(): View
    {
        $stats = $this->getAdminStats();
        
        return view('admin.dashboard', compact('stats'));
    }

    /**
     * Display the user dashboard
     */
    public function user(): View
    {
        $userData = $this->getUserData();
        
        return view('user.dashboard', compact('userData'));
    }

    /**
     * Display admin users management
     */
    public function users(): View
    {
        $users = \App\Models\User::with('roles')
            ->orderBy('created_at', 'desc')
            ->paginate(15);
            
        return view('admin.users', compact('users'));
    }

    /**
     * Display admin analytics
     */
    public function analytics(): View
    {
        $analytics = $this->getAnalyticsData();
        
        return view('admin.analytics', compact('analytics'));
    }

    /**
     * Display admin reports
     */
    public function reports(): View
    {
        $reports = $this->getReportsData();
        
        return view('admin.reports', compact('reports'));
    }

    /**
     * Display admin settings
     */
    public function settings(): View
    {
        $settings = $this->getSystemSettings();
        
        return view('admin.settings', compact('settings'));
    }

    /**
     * Display user profile
     */
    public function profile(): View
    {
        $user = auth()->user();
        
        return view('user.profile', compact('user'));
    }

    /**
     * Display user orders
     */
    public function orders(): View
    {
        $orders = $this->getUserOrders();
        
        return view('user.orders', compact('orders'));
    }

    /**
     * Display user products
     */
    public function products(): View
    {
        $products = $this->getUserProducts();
        
        return view('user.products', compact('products'));
    }

    /**
     * Get user statistics for API
     */
    public function userStats(): JsonResponse
    {
        $user = auth()->user();
        
        $stats = [
            'total_users' => \App\Models\User::count(),
            'active_users' => \App\Models\User::where('email_verified_at', '!=', null)->count(),
            'users_by_role' => $this->getUsersByRole(),
            'recent_registrations' => \App\Models\User::latest()->take(5)->get(['name', 'email', 'created_at']),
        ];
        
        return response()->json($stats);
    }

    /**
     * Get recent activity for API
     */
    public function recentActivity(): JsonResponse
    {
        $activity = [
            'latest_users' => \App\Models\User::latest()->take(10)->get(['name', 'email', 'created_at']),
            'system_events' => [], // Placeholder for system events
            'last_updated' => now()->toISOString(),
        ];
        
        return response()->json($activity);
    }

    /**
     * Get admin statistics
     */
    private function getAdminStats(): array
    {
        return [
            'total_users' => \App\Models\User::count(),
            'users_today' => \App\Models\User::whereDate('created_at', today())->count(),
            'users_this_week' => \App\Models\User::whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()])->count(),
            'users_this_month' => \App\Models\User::whereMonth('created_at', now()->month)->count(),
            'roles_distribution' => $this->getUsersByRole(),
        ];
    }

    /**
     * Get user data for user dashboard
     */
    private function getUserData(): array
    {
        $user = auth()->user();
        
        return [
            'user' => $user,
            'roles' => $user->getRoleNames(),
            'permissions' => $user->getAllPermissions()->pluck('name'),
            'recent_activity' => [], // Placeholder for user activity
        ];
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
     * Get analytics data
     */
    private function getAnalyticsData(): array
    {
        return [
            'user_growth' => $this->getUserGrowthData(),
            'role_distribution' => $this->getUsersByRole(),
            'verification_rate' => $this->getVerificationRate(),
        ];
    }

    /**
     * Get reports data
     */
    private function getReportsData(): array
    {
        return [
            'user_reports' => [],
            'system_reports' => [],
            'export_options' => ['csv', 'pdf', 'excel'],
        ];
    }

    /**
     * Get system settings
     */
    private function getSystemSettings(): array
    {
        return [
            'app_name' => config('app.name'),
            'app_env' => config('app.env'),
            'debug_mode' => config('app.debug'),
            'timezone' => config('app.timezone'),
        ];
    }

    /**
     * Get user orders (placeholder)
     */
    private function getUserOrders(): array
    {
        return [
            'orders' => [],
            'total_orders' => 0,
            'pending_orders' => 0,
        ];
    }

    /**
     * Get user products (placeholder)
     */
    private function getUserProducts(): array
    {
        return [
            'products' => [],
            'total_products' => 0,
            'active_products' => 0,
        ];
    }

    /**
     * Get user growth data
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
     * Get verification rate
     */
    private function getVerificationRate(): float
    {
        $totalUsers = \App\Models\User::count();
        $verifiedUsers = \App\Models\User::whereNotNull('email_verified_at')->count();
        
        return $totalUsers > 0 ? round(($verifiedUsers / $totalUsers) * 100, 2) : 0;
    }
} 