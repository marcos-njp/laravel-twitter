<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Birdie</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        /* Hide scrollbar for cleaner look */
        ::-webkit-scrollbar { width: 8px; }
        ::-webkit-scrollbar-track { background: #f1f1f1; }
        ::-webkit-scrollbar-thumb { background: #c1c1c1; border-radius: 4px; }
    </style>
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light sticky-top shadow-sm">
            <div class="container">
                <a class="navbar-brand fw-bold text-primary fs-3" href="{{ route('tweets.index') }}">Birdie</a>
                <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ms-auto align-items-center">
                        @guest
                            <li class="nav-item"><a class="nav-link fw-bold" href="{{ route('login') }}">Log in</a></li>
                            <li class="nav-item"><a class="btn btn-primary btn-sm rounded-pill ms-2 px-3" href="{{ route('register') }}">Sign up</a></li>
                        @else
                            <li class="nav-item me-3">
                                <a href="{{ route('tweets.index') }}" class="nav-link d-flex align-items-center gap-2 {{ request()->routeIs('tweets.index') ? 'text-dark fw-bold' : 'text-muted' }}">
                                    @if(request()->routeIs('tweets.index'))
                                        <x-heroicon-s-home style="width: 24px; height: 24px;" />
                                    @else
                                        <x-heroicon-o-home style="width: 24px; height: 24px;" />
                                    @endif
                                    <span class="d-none d-lg-inline">Home</span>
                                </a>
                            </li>
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link d-flex align-items-center gap-2 fw-bold text-dark dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                                    <x-heroicon-o-user-circle style="width: 24px; height: 24px;" />
                                    {{ Auth::user()->name }}
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end shadow border-0 rounded-4 mt-2 p-2">
                                    <li>
                                        <a class="dropdown-item py-2 d-flex align-items-center gap-2 rounded" href="{{ route('users.show', Auth::user()) }}">
                                            <x-heroicon-o-user style="width: 20px;" /> Profile
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item py-2 d-flex align-items-center gap-2 rounded" href="{{ route('profile.edit') }}">
                                            <x-heroicon-o-cog-6-tooth style="width: 20px;" /> Settings
                                        </a>
                                    </li>
                                    <li><hr class="dropdown-divider"></li>
                                    <li>
                                        <form method="POST" action="{{ route('logout') }}">
                                            @csrf
                                            <button type="submit" class="dropdown-item text-danger py-2 d-flex align-items-center gap-2 rounded">
                                                <x-heroicon-o-arrow-right-on-rectangle style="width: 20px;" /> Logout
                                            </button>
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <div class="container">
            <div class="row justify-content-center">
                
                <div class="col-lg-7 col-md-10 px-0 feed-container bg-white">
                    {{ $slot }}
                </div>

                <div class="col-lg-4 d-none d-lg-block pt-4 ms-4">
                    <div class="bg-light rounded-4 p-3 mb-3">
                        <h5 class="fw-bold mb-3 px-2">What's Happening</h5>
                        <div class="px-2 py-2 mb-2">
                            <small class="text-muted d-block">Technology · Trending</small>
                            <span class="fw-bold">Laravel & Bootstrap</span>
                            <small class="text-muted d-block">5,234 posts</small>
                        </div>
                        <div class="px-2 py-2">
                            <small class="text-muted d-block">Academics · Trending</small>
                            <span class="fw-bold">Midterm Exams</span>
                            <small class="text-muted d-block">10.5K posts</small>
                        </div>
                    </div>
                    
                    <div class="small text-muted px-3">
                        © 2025 Birdie Inc.
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
