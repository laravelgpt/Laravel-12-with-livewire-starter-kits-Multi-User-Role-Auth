<?php

namespace App\Providers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Request;
use Laravel\Fortify\Fortify;
use App\Models\User;
use Illuminate\Support\ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    // public const HOME = '/user/dashboard';
    public const ADMIN_HOME = '/admin/dashboard';
    public const USER_HOME = '/user/dashboard';

    public function boot()
{
    
    Fortify::authenticateUsing(function (Request $request) {
        $user = User::where('email', $request->email)->first();
        if ($user && Hash::check($request->password, $user->password)) {
            Auth::login($user);

            if ($user->hasRole('admin')) {
                return redirect(self::ADMIN_HOME);
            } elseif ($user->hasRole('user')) {
                return redirect(self::USER_HOME);
            }
        }
    });
}
}