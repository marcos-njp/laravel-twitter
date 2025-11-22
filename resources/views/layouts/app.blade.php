<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Birdie</title>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&family=Merriweather:wght@300;400;700;900&display=swap" rel="stylesheet">
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="d-flex flex-column min-vh-100">
    <div id="app" class="flex-grow-1">
        <nav class="navbar navbar-expand-md sticky-top">
            <div class="container">
                <a class="navbar-brand fw-bold fs-2 d-flex align-items-center gap-2" href="{{ route('tweets.index') }}" style="letter-spacing: -1px; color: #1a4d2e;">
                    <x-heroicon-s-book-open style="width: 28px;" /> Birdie.
                </a>
                
                <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navContent">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navContent">
                    <ul class="navbar-nav ms-auto align-items-center gap-4">
                        @guest
                            <li class="nav-item"><a class="nav-link text-uppercase small ls-1" href="{{ route('login') }}">Log in</a></li>
                            <li class="nav-item"><a class="btn btn-primary" href="{{ route('register') }}">Subscribe</a></li>
                        @else
                            <li class="nav-item">
                                <a href="{{ route('tweets.index') }}" class="nav-link d-flex align-items-center gap-2 {{ request()->routeIs('tweets.index') ? 'active' : '' }}">
                                    <x-heroicon-o-home style="width: 20px;" /> Feed
                                </a>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle d-flex align-items-center gap-2 text-dark fw-bold" href="#" role="button" data-bs-toggle="dropdown">
                                    {{ Auth::user()->name }}
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end border shadow-sm rounded-1 p-0 mt-2">
                                    <li><a class="dropdown-item py-3 px-4 border-bottom" href="{{ route('users.show', Auth::user()) }}">My Profile</a></li>
                                    <li><a class="dropdown-item py-3 px-4 border-bottom" href="{{ route('profile.edit') }}">Settings</a></li>
                                    <li>
                                        <form method="POST" action="{{ route('logout') }}">
                                            @csrf
                                            <button type="submit" class="dropdown-item py-3 px-4 text-danger">Sign Out</button>
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

    <footer class="py-5 mt-auto bg-white border-top">
        <div class="container text-center">
            
            <p class="text-muted small mb-2" style="font-family: 'Inter', sans-serif;">
                Built with <strong>Laravel 11</strong>, <strong>Blade</strong>, & <strong>Bootstrap 5</strong>.
            </p>
            
            <h6 class="text-dark mb-3" style="font-family: 'Merriweather', serif;">
                Developed by <span style="color: #1a4d2e;">Niño Marcos</span>
            </h6>
            
            <div class="d-flex justify-content-center gap-4">
                <a href="https://www.linkedin.com/in/ni%C3%B1o-marcos/" target="_blank" class="text-decoration-none text-muted d-flex align-items-center gap-1 fw-bold" style="font-family: 'Inter', sans-serif; font-size: 0.9rem;">
                    <svg style="width: 18px; fill: currentColor;" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z"/></svg>
                    LinkedIn
                </a>

                <a href="https://github.com/marcos-njp/laravel-twitter" target="_blank" class="text-decoration-none text-muted d-flex align-items-center gap-1 fw-bold" style="font-family: 'Inter', sans-serif; font-size: 0.9rem;">
                    <svg style="width: 18px; fill: currentColor;" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M12 0c-6.626 0-12 5.373-12 12 0 5.302 3.438 9.8 8.207 11.387.599.111.793-.261.793-.577v-2.234c-3.338.726-4.033-1.416-4.033-1.416-.546-1.387-1.333-1.756-1.333-1.756-1.089-.745.083-.729.083-.729 1.205.084 1.839 1.237 1.839 1.237 1.07 1.834 2.807 1.304 3.492.997.107-.775.418-1.305.762-1.604-2.665-.305-5.467-1.334-5.467-5.931 0-1.311.469-2.381 1.236-3.221-.124-.303-.535-1.524.117-3.176 0 0 1.008-.322 3.301 1.23.957-.266 1.983-.399 3.003-.404 1.02.005 2.047.138 3.006.404 2.291-1.552 3.297-1.23 3.297-1.23.653 1.653.242 2.874.118 3.176.77.84 1.235 1.911 1.235 3.221 0 4.609-2.807 5.624-5.479 5.921.43.372.823 1.102.823 2.222v3.293c0 .319.192.694.801.576 4.765-1.589 8.199-6.086 8.199-11.386 0-6.627-5.373-12-12-12z"/></svg>
                    GitHub
                </a>
            </div>
            
            <div class="mt-4 text-muted small opacity-50" style="font-family: 'Inter', sans-serif;">
                &copy; 2025 Birdie Inc.
            </div>
        </div>
    </footer>

    <script>
        async function toggleLike(btn, tweetId) {
            const isLiked = btn.classList.contains('text-danger');
            const outline = btn.querySelector('.icon-outline');
            const solid = btn.querySelector('.icon-solid');
            const countSpan = btn.querySelector('.like-count');
            let currentCount = parseInt(countSpan.innerText);

            if (isLiked) {
                btn.classList.remove('text-danger');
                btn.classList.add('text-muted');
                outline.classList.remove('d-none');
                solid.classList.add('d-none');
                countSpan.innerText = Math.max(0, currentCount - 1);
            } else {
                btn.classList.add('text-danger');
                btn.classList.remove('text-muted');
                outline.classList.add('d-none');
                solid.classList.remove('d-none');
                countSpan.innerText = currentCount + 1;
            }

            try {
                const response = await fetch(`/tweets/${tweetId}/like`, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        'Accept': 'application/json',
                        'Content-Type': 'application/json'
                    },
                });
                if (!response.ok) throw new Error('Network response was not ok');
                const data = await response.json();
                countSpan.innerText = data.count;
            } catch (error) {
                console.error('Error:', error);
            }
        }
    </script>
</body>
</html>