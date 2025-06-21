<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;

class VerifyEmailController extends Controller
{
    /**
     * Redirect to dashboard since email verification is not required.
     */
    public function __invoke(): RedirectResponse
    {
        // Email verification is not required, redirect to dashboard
        return redirect()->route('dashboard');
    }
}
