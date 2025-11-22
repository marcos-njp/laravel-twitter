<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm sticky-top">
            <div class="container">
                <a class="navbar-brand fw-bold text-primary" href="{{ route('tweets.index') }}">
                    TwitterClone
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto">
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('tweets.index') ? 'active fw-bold' : '' }}" href="{{ route('tweets.index') }}">Home</a>
                        </li>
                    </ul>

                    <ul class="navbar-nav ms-auto">
                        @guest
                            <li class="nav-item"><a class="nav-link" href="{{ route('login') }}">Login</a></li>
                            <li class="nav-item"><a class="nav-link" href="{{ route('register') }}">Register</a></li>
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                                    {{ Auth::user()->name }}
                                </a>

                                <ul class="dropdown-menu dropdown-menu-end">
                                    <li><a class="dropdown-item" href="{{ route('profile.edit') }}">Profile</a></li>
                                    <li><hr class="dropdown-divider"></li>
                                    <li>
                                        <form method="POST" action="{{ route('logout') }}">
                                            @csrf
                                            <button type="submit" class="dropdown-item text-danger">Logout</button>
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-3 d-none d-md-block">
                        <div class="card border-0 bg-transparent">
                            <ul class="list-group list-group-flush bg-transparent">
                                <li class="list-group-item bg-transparent fw-bold"><a href="{{ route('tweets.index') }}" class="text-decoration-none text-dark">🏠 Home</a></li>
                                <li class="list-group-item bg-transparent fw-bold"><a href="{{ route('profile.edit') }}" class="text-decoration-none text-dark">👤 Profile</a></li>
                            </ul>
                        </div>
                    </div>

                    <div class="col-md-6">
                        @if (session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        @endif

                        {{ $slot }}
                    </div>

                    <div class="col-md-3 d-none d-lg-block">
                        <div class="card">
                            <div class="card-header bg-white fw-bold">What's Happening</div>
                            <div class="card-body">
                                <p class="text-muted small">Midterm Exams in progress...</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</body>
</html>