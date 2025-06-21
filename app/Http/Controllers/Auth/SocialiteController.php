<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;
use Spatie\Permission\Models\Role;

class SocialiteController extends Controller
{
    /**
     * Redirect the user to the OAuth provider.
     */
    public function redirect($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    /**
     * Obtain the user information from the OAuth provider.
     */
    public function callback($provider)
    {
        try {
            $socialUser = Socialite::driver($provider)->user();

            // Check if user already exists
            $user = User::where('email', $socialUser->getEmail())->first();

            if (!$user) {
                // Create new user
                $user = User::create([
                    'name' => $socialUser->getName() ?? $socialUser->getNickname(),
                    'email' => $socialUser->getEmail(),
                    'password' => Hash::make(Str::random(16)), // Random password for social users
                ]);

                // Assign default role (customer)
                $defaultRole = Role::where('name', 'customer')->first();
                if ($defaultRole) {
                    $user->assignRole($defaultRole);
                }

                // Store social provider information
                $user->update([
                    'provider' => $provider,
                    'provider_id' => $socialUser->getId(),
                ]);
            } else {
                // Update existing user's social provider info
                $user->update([
                    'provider' => $provider,
                    'provider_id' => $socialUser->getId(),
                ]);
            }

            // Log in the user
            Auth::login($user);

            // Redirect based on user role
            if ($user->hasRole('admin')) {
                return redirect()->route('admin.dashboard');
            } elseif ($user->hasRole('staff')) {
                return redirect()->route('staff.dashboard');
            } else {
                return redirect()->route('dashboard');
            }

        } catch (\Exception $e) {
            return redirect()->route('login')
                ->withErrors(['email' => 'Social authentication failed. Please try again.']);
        }
    }

    /**
     * Handle social authentication for specific roles.
     */
    public function redirectWithRole($provider, $role)
    {
        // Store the intended role in session
        session(['intended_role' => $role]);
        
        return Socialite::driver($provider)->redirect();
    }

    /**
     * Handle social authentication callback with role assignment.
     */
    public function callbackWithRole($provider)
    {
        try {
            $socialUser = Socialite::driver($provider)->user();
            $intendedRole = session('intended_role', 'customer');

            // Check if user already exists
            $user = User::where('email', $socialUser->getEmail())->first();

            if (!$user) {
                // Create new user
                $user = User::create([
                    'name' => $socialUser->getName() ?? $socialUser->getNickname(),
                    'email' => $socialUser->getEmail(),
                    'password' => Hash::make(Str::random(16)),
                    // Remove automatic email verification for social users
                ]);

                // Assign intended role
                $role = Role::where('name', $intendedRole)->first();
                if ($role) {
                    $user->assignRole($role);
                } else {
                    // Fallback to customer role
                    $defaultRole = Role::where('name', 'customer')->first();
                    if ($defaultRole) {
                        $user->assignRole($defaultRole);
                    }
                }

                // Store social provider information
                $user->update([
                    'provider' => $provider,
                    'provider_id' => $socialUser->getId(),
                ]);
            } else {
                // Update existing user's social provider info
                $user->update([
                    'provider' => $provider,
                    'provider_id' => $socialUser->getId(),
                ]);

                // Add intended role if user doesn't have it
                if (!$user->hasRole($intendedRole)) {
                    $role = Role::where('name', $intendedRole)->first();
                    if ($role) {
                        $user->assignRole($role);
                    }
                }
            }

            // Log in the user
            Auth::login($user);

            // Clear the intended role from session
            session()->forget('intended_role');

            // Redirect based on user role
            if ($user->hasRole('admin')) {
                return redirect()->route('admin.dashboard');
            } elseif ($user->hasRole('staff')) {
                return redirect()->route('staff.dashboard');
            } else {
                return redirect()->route('dashboard');
            }

        } catch (\Exception $e) {
            return redirect()->route('login')
                ->withErrors(['email' => 'Social authentication failed. Please try again.']);
        }
    }
} 