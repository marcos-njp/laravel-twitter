
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Birdie</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md sticky-top py-3">
            <div class="container">
                <a class="navbar-brand fw-bold text-primary fs-3 d-flex align-items-center gap-2" href="{{ route('tweets.index') }}">
                    <x-heroicon-s-paper-airplane style="width: 28px; transform: rotate(-45deg);" /> Birdie
                </a>
                
                <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navContent">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navContent">
                    <ul class="navbar-nav ms-auto align-items-center gap-3">
                        @guest
                            <li class="nav-item"><a class="nav-link" href="{{ route('login') }}">Log in</a></li>
                            <li class="nav-item"><a class="btn btn-primary rounded-pill" href="{{ route('register') }}">Get Started</a></li>
                        @else
                            <li class="nav-item">
                                <a href="{{ route('tweets.index') }}" class="nav-link {{ request()->routeIs('tweets.index') ? 'active' : '' }}">
                                    Feed
                                </a>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle d-flex align-items-center gap-2" href="#" role="button" data-bs-toggle="dropdown">
                                    <div class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center" 
                                         style="width: 32px; height: 32px; font-size: 0.9rem;">
                                        {{ substr(Auth::user()->name, 0, 1) }}
                                    </div>
                                    <span>{{ Auth::user()->name }}</span>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end border-0 shadow-lg rounded-4 p-2 mt-2">
                                    <li><a class="dropdown-item rounded-3 py-2" href="{{ route('users.show', Auth::user()) }}">My Profile</a></li>
                                    <li><a class="dropdown-item rounded-3 py-2" href="{{ route('profile.edit') }}">Settings</a></li>
                                    <li><hr class="dropdown-divider"></li>
                                    <li>
                                        <form method="POST" action="{{ route('logout') }}">
                                            @csrf
                                            <button type="submit" class="dropdown-item rounded-3 py-2 text-danger">Sign Out</button>
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-5">
            <div class="container">
                <div class="feed-container">
                    {{ $slot }}
                </div>
            </div>
        </main>
    </div>
</body>
</html>
