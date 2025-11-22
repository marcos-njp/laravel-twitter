<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Birdie - Share Your Insights</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&family=Merriweather:wght@300;400;700;900&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body style="background-color: #f8f5f2; font-family: 'Inter', sans-serif;">

    <nav class="navbar navbar-expand-md py-4 bg-transparent border-0">
        <div class="container">
            <a class="navbar-brand fw-bold fs-2 d-flex align-items-center gap-2" href="#" style="letter-spacing: -1px; color: #1a4d2e;">
                <x-heroicon-s-book-open style="width: 32px;" /> Birdie.
            </a>
            <div>
                @if (Route::has('login'))
                    @auth
                        <a href="{{ url('/tweets') }}" class="btn btn-outline-dark rounded-pill px-4 fw-bold">Go to Feed</a>
                    @else
                        <a href="{{ route('login') }}" class="text-dark text-decoration-none fw-bold me-3">Log in</a>
                        <a href="{{ route('register') }}" class="btn btn-dark rounded-pill px-4 fw-bold">Get Started</a>
                    @endauth
                @endif
            </div>
        </div>
    </nav>

    <div class="container py-5">
        <div class="row align-items-center py-5">
            <div class="col-lg-6">
                <h1 class="display-3 fw-bold mb-4" style="font-family: 'Merriweather', serif; color: #1c1917; line-height: 1.2;">
                    A minimalist space for daily insights.
                </h1>
                <p class="lead text-muted mb-5" style="font-size: 1.25rem; line-height: 1.6;">
                    Birdie is an educative social network designed for curious minds. Share what you learn, track your growth, and connect with a community of thinkers.
                </p>
                <div class="d-flex gap-3">
                    <a href="{{ route('register') }}" class="btn btn-primary btn-lg px-5 py-3 rounded-pill shadow-sm">Start Writing</a>
                    <a href="#features" class="btn btn-outline-dark btn-lg px-5 py-3 rounded-pill">Learn more</a>
                </div>
                <div class="mt-5 d-flex align-items-center gap-2 text-muted small">
                    <div class="d-flex">
                        <div class="rounded-circle bg-secondary border border-2 border-white" style="width: 30px; height: 30px;"></div>
                        <div class="rounded-circle bg-dark border border-2 border-white" style="width: 30px; height: 30px; margin-left: -10px;"></div>
                        <div class="rounded-circle bg-success border border-2 border-white" style="width: 30px; height: 30px; margin-left: -10px;"></div>
                    </div>
                    <span>Join 2,000+ members learning today.</span>
                </div>
            </div>
            <div class="col-lg-6 d-none d-lg-block text-end">
                <div class="position-relative d-inline-block">
                    <div class="modern-card p-4 text-start shadow-lg" style="width: 400px; transform: rotate(-2deg);">
                        <div class="d-flex align-items-center gap-3 mb-3">
                            <div class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">A</div>
                            <div>
                                <h6 class="mb-0 fw-bold">Admin</h6>
                                <small class="text-muted">2 mins ago</small>
                            </div>
                        </div>
                        <p class="fs-5">"Simplicity is the ultimate sophistication." - Leonardo da Vinci</p>
                        <div class="text-muted small mt-3">
                            <x-heroicon-s-heart style="width: 16px; display: inline; color: #ef4444;" /> 12 Likes
                        </div>
                    </div>
                    
                    <div class="modern-card p-4 text-start shadow-sm position-absolute top-100 start-0 translate-middle-y" style="width: 380px; transform: rotate(3deg); z-index: -1; opacity: 0.8;">
                        <div class="d-flex align-items-center gap-3 mb-3">
                            <div class="rounded-circle bg-dark text-white d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">G</div>
                            <div>
                                <h6 class="mb-0 fw-bold">Guest</h6>
                                <small class="text-muted">1 hour ago</small>
                            </div>
                        </div>
                        <p class="fs-5 text-muted">Just learned how to deploy Laravel on DigitalOcean! 🚀</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <footer class="py-5 border-top text-center">
        <p class="text-muted mb-2">Built with Laravel 11, Blade & Bootstrap 5</p>
        <p class="fw-bold text-dark mb-0">Developed by <span style="color: #1a4d2e;">Niño Marcos</span></p>
    </footer>

</body>
</html>