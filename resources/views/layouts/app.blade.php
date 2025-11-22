

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
</body>
<script>
function toggleLike(btn, tweetId) {
    // Swap icons instantly
    const outline = btn.querySelector('.icon-outline');
    const solid = btn.querySelector('.icon-solid');
    const countSpan = btn.querySelector('.like-count');
    const liked = btn.classList.contains('text-danger');

    // Optimistic UI update
    if (liked) {
        btn.classList.remove('text-danger');
        btn.classList.add('text-muted');
        outline.classList.remove('d-none');
        solid.classList.add('d-none');
        countSpan.textContent = parseInt(countSpan.textContent) - 1;
    } else {
        btn.classList.remove('text-muted');
        btn.classList.add('text-danger');
        outline.classList.add('d-none');
        solid.classList.remove('d-none');
        countSpan.textContent = parseInt(countSpan.textContent) + 1;
    }

    // Send AJAX request
    fetch(`/tweets/${tweetId}/like`, {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            'Accept': 'application/json',
        },
        credentials: 'same-origin',
    })
    .then(response => response.json())
    .then(data => {
        // Sync UI with server response
        if (data.liked) {
            btn.classList.remove('text-muted');
            btn.classList.add('text-danger');
            outline.classList.add('d-none');
            solid.classList.remove('d-none');
        } else {
            btn.classList.remove('text-danger');
            btn.classList.add('text-muted');
            outline.classList.remove('d-none');
            solid.classList.add('d-none');
        }
        countSpan.textContent = data.count;
    })
    .catch(() => {
        // Revert UI on error
        if (liked) {
            btn.classList.add('text-danger');
            btn.classList.remove('text-muted');
            outline.classList.add('d-none');
            solid.classList.remove('d-none');
            countSpan.textContent = parseInt(countSpan.textContent) + 1;
        } else {
            btn.classList.add('text-muted');
            btn.classList.remove('text-danger');
            outline.classList.remove('d-none');
            solid.classList.add('d-none');
            countSpan.textContent = parseInt(countSpan.textContent) - 1;
        }
        alert('Could not update like. Please try again.');
    });
}
</script>
</html>
