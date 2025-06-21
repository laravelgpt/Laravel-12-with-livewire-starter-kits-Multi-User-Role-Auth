@props([
    'title' => 'Error',
    'description' => 'Something went wrong.',
    'code' => '500',
    'showHomeButton' => true,
    'showBackButton' => true,
    'showHelpfulLinks' => true,
])

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{ $code }} - {{ $title }} | {{ config('app.name', 'Laravel') }}</title>
        
        <link rel="icon" href="/favicon.ico" sizes="any">
        <link rel="icon" href="/favicon.svg" type="image/svg+xml">
        <link rel="apple-touch-icon" href="/apple-touch-icon.png">
        
        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />
        
        <!-- Styles -->
        <style>
            body {
                font-family: 'Instrument Sans', ui-sans-serif, system-ui, sans-serif;
                background-color: #FDFDFC;
                color: #1b1b18;
                margin: 0;
                padding: 0;
                min-height: 100vh;
                display: flex;
                flex-direction: column;
            }
            
            @media (prefers-color-scheme: dark) {
                body {
                    background-color: #0a0a0a;
                    color: #EDEDEC;
                }
            }
            
            .container {
                max-width: 1200px;
                margin: 0 auto;
                padding: 0 1.5rem;
            }
            
            .header {
                padding: 1.5rem 0;
                border-bottom: 1px solid #e3e3e0;
            }
            
            .dark .header {
                border-bottom-color: #3E3E3A;
            }
            
            .nav {
                display: flex;
                justify-content: space-between;
                align-items: center;
            }
            
            .logo {
                font-size: 1.125rem;
                font-weight: 600;
                color: #1b1b18;
                text-decoration: none;
                transition: color 0.3s ease;
            }
            
            .dark .logo {
                color: #EDEDEC;
            }
            
            .logo:hover {
                color: #f53003;
            }
            
            .dark .logo:hover {
                color: #FF4433;
            }
            
            .nav-links {
                display: flex;
                gap: 1rem;
                align-items: center;
            }
            
            .nav-link {
                display: inline-block;
                padding: 0.375rem 1.25rem;
                border: 1px solid #19140035;
                border-radius: 0.125rem;
                font-size: 0.875rem;
                text-decoration: none;
                color: #1b1b18;
                transition: all 0.3s ease;
            }
            
            .dark .nav-link {
                color: #EDEDEC;
                border-color: #3E3E3A;
            }
            
            .nav-link:hover {
                border-color: #1915014a;
            }
            
            .dark .nav-link:hover {
                border-color: #62605b;
            }
            
            .nav-link.primary {
                background-color: #1b1b18;
                color: white;
                border-color: #1b1b18;
            }
            
            .dark .nav-link.primary {
                background-color: #eeeeec;
                color: #1C1C1A;
                border-color: #eeeeec;
            }
            
            .nav-link.primary:hover {
                background-color: #000;
            }
            
            .dark .nav-link.primary:hover {
                background-color: #fff;
                color: #000;
            }
            
            .main {
                flex: 1;
                display: flex;
                align-items: center;
                justify-content: center;
                padding: 2rem 0;
            }
            
            .error-content {
                text-align: center;
                max-width: 600px;
                margin: 0 auto;
            }
            
            .error-code {
                font-size: 6rem;
                font-weight: 600;
                line-height: 1;
                margin: 0;
                color: #1b1b18;
            }
            
            .dark .error-code {
                color: #EDEDEC;
            }
            
            .error-title {
                font-size: 2rem;
                font-weight: 500;
                margin: 1rem 0;
                color: #1b1b18;
            }
            
            .dark .error-title {
                color: #EDEDEC;
            }
            
            .error-description {
                font-size: 1.125rem;
                color: #706f6c;
                margin-bottom: 2rem;
                line-height: 1.6;
            }
            
            .dark .error-description {
                color: #A1A09A;
            }
            
            .error-actions {
                display: flex;
                gap: 1rem;
                justify-content: center;
                flex-wrap: wrap;
            }
            
            .btn {
                display: inline-flex;
                align-items: center;
                justify-content: center;
                padding: 0.75rem 1.5rem;
                border-radius: 0.5rem;
                font-size: 0.875rem;
                font-weight: 500;
                text-decoration: none;
                transition: all 0.3s ease;
                border: 1px solid;
                cursor: pointer;
            }
            
            .btn-primary {
                background-color: #1b1b18;
                color: white;
                border-color: #1b1b18;
            }
            
            .dark .btn-primary {
                background-color: #eeeeec;
                color: #1C1C1A;
                border-color: #eeeeec;
            }
            
            .btn-primary:hover {
                background-color: #000;
                border-color: #000;
            }
            
            .dark .btn-primary:hover {
                background-color: #fff;
                color: #000;
                border-color: #fff;
            }
            
            .btn-secondary {
                background-color: white;
                color: #1b1b18;
                border-color: #e3e3e0;
            }
            
            .dark .btn-secondary {
                background-color: #161615;
                color: #EDEDEC;
                border-color: #3E3E3A;
            }
            
            .btn-secondary:hover {
                background-color: #f5f5f5;
            }
            
            .dark .btn-secondary:hover {
                background-color: rgba(255, 255, 255, 0.07);
            }
            
            .btn-icon {
                width: 1rem;
                height: 1rem;
                margin-right: 0.5rem;
            }
            
            .helpful-links {
                margin-top: 2rem;
                padding-top: 1.5rem;
                border-top: 1px solid #e3e3e0;
            }
            
            .dark .helpful-links {
                border-top-color: #3E3E3A;
            }
            
            .helpful-links h3 {
                font-size: 0.875rem;
                font-weight: 500;
                margin-bottom: 0.75rem;
                color: #1b1b18;
            }
            
            .dark .helpful-links h3 {
                color: #EDEDEC;
            }
            
            .helpful-links a {
                color: #f53003;
                text-decoration: none;
                font-size: 0.875rem;
                margin-right: 1rem;
                transition: color 0.3s ease;
            }
            
            .dark .helpful-links a {
                color: #FF4433;
            }
            
            .helpful-links a:hover {
                text-decoration: underline;
            }
            
            .footer {
                padding: 1.5rem 0;
                text-align: center;
                border-top: 1px solid #e3e3e0;
                color: #706f6c;
                font-size: 0.875rem;
            }
            
            .dark .footer {
                border-top-color: #3E3E3A;
                color: #A1A09A;
            }
            
            @media (max-width: 768px) {
                .error-code {
                    font-size: 4rem;
                }
                
                .error-title {
                    font-size: 1.5rem;
                }
                
                .error-actions {
                    flex-direction: column;
                    align-items: center;
                }
                
                .btn {
                    width: 100%;
                    max-width: 300px;
                }
            }
        </style>
    </head>
    <body>
        <!-- Header -->
        <header class="header">
            <div class="container">
                <nav class="nav">
                    <a href="{{ url('/') }}" class="logo">
                        {{ config('app.name', 'Laravel') }}
                    </a>
                    
                    <div class="nav-links">
                        @auth
                            <a href="{{ url('/dashboard') }}" class="nav-link">
                                Dashboard
                            </a>
                        @else
                            <a href="{{ route('login') }}" class="nav-link">
                                Log in
                            </a>
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="nav-link primary">
                                    Register
                                </a>
                            @endif
                        @endauth
                    </div>
                </nav>
            </div>
        </header>

        <!-- Main Content -->
        <main class="main">
            <div class="container">
                <div class="error-content">
                    <h1 class="error-code">{{ $code }}</h1>
                    <h2 class="error-title">{{ $title }}</h2>
                    <p class="error-description">
                        {{ $description }}
                    </p>
                    
                    @if($showHomeButton || $showBackButton)
                        <div class="error-actions">
                            @if($showHomeButton)
                                <a href="{{ url('/') }}" class="btn btn-primary">
                                    <svg class="btn-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                                    </svg>
                                    Go Home
                                </a>
                            @endif
                            
                            @if($showBackButton)
                                <button onclick="history.back()" class="btn btn-secondary">
                                    <svg class="btn-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                                    </svg>
                                    Go Back
                                </button>
                            @endif
                            
                            {{ $actions ?? '' }}
                        </div>
                    @endif
                    
                    @if($showHelpfulLinks)
                        <div class="helpful-links">
                            <h3>Need help? Try these links:</h3>
                            <div>
                                @auth
                                    <a href="{{ url('/dashboard') }}">Dashboard</a>
                                @else
                                    <a href="{{ route('login') }}">Login</a>
                                    @if (Route::has('register'))
                                        <a href="{{ route('register') }}">Register</a>
                                    @endif
                                @endauth
                                <a href="{{ url('/') }}">Home</a>
                            </div>
                        </div>
                    @endif
                    
                    {{ $slot }}
                </div>
            </div>
        </main>

        <!-- Footer -->
        <footer class="footer">
            <div class="container">
                <p>&copy; {{ date('Y') }} {{ config('app.name', 'Laravel') }}. All rights reserved.</p>
            </div>
        </footer>
    </body>
</html> 