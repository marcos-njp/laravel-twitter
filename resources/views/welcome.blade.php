<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Birdie</title>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&family=Merriweather:wght@300;400;700;900&display=swap"
        rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body style="background-color: #f8f5f2; font-family: 'Inter', sans-serif; overflow-x: hidden;">

    <nav class="navbar navbar-expand-md py-4 bg-transparent border-0">
        <div class="container">
            <a class="navbar-brand fw-bold fs-2 d-flex align-items-center gap-2" href="#"
                style="letter-spacing: -1px; color: #1a4d2e;">
                <x-heroicon-s-book-open style="width: 32px;" /> Birdie.
            </a>
            <div class="d-flex gap-3">
                <a href="{{ route('login') }}" class="btn btn-link text-dark text-decoration-none fw-bold">Log in</a>
                <a href="{{ route('register') }}" class="btn btn-dark rounded-pill px-4 fw-bold">Get Started</a>
            </div>
        </div>
    </nav>

    <div class="container py-5">
        <div class="row align-items-center min-vh-75">

            <div class="col-lg-5 z-1 my-5 my-lg-0">
                <div
                    class="d-inline-block px-3 py-1 rounded-pill border border-dark mb-4 bg-white small fw-bold text-uppercase tracking-wide">
                    The Journal Network
                </div>
                <h1 class="display-3 fw-bold mb-4"
                    style="font-family: 'Merriweather', serif; color: #1c1917; line-height: 1.1;">
                    Capture your <br> <span
                        style="color: #1a4d2e; text-decoration: underline; text-decoration-color: #fbbf24;">daily
                        growth.</span>
                </h1>
                <p class="lead text-muted mb-5" style="font-size: 1.2rem; line-height: 1.6;">
                    Birdie is a quiet corner of the internet for thinkers, learners, and writers. No noise, just
                    insights.
                </p>

                <div class="d-flex flex-column flex-sm-row gap-4 align-items-start align-items-sm-center">
                    <a href="{{ route('register') }}"
                        class="btn btn-primary btn-lg px-5 py-3 rounded-pill shadow-sm">Start Tweeting</a>

                    @if ($users->count() > 0)
                        <div class="d-flex align-items-center gap-2 text-muted small px-2">
                            <div class="d-flex">
                                @foreach ($users as $u)
                                    <div class="rounded-circle bg-white border border-2 border-white shadow-sm d-flex align-items-center justify-content-center fw-bold text-dark"
                                        style="width: 36px; height: 36px; margin-left: -12px; font-size: 0.8rem;">
                                        {{ substr($u->name, 0, 1) }}
                                    </div>
                                @endforeach
                            </div>
                            <span>Join {{ $totalUsers }}+ members</span>
                        </div>
                    @endif
                </div>
            </div>

            <div class="col-lg-7 position-relative d-none d-lg-block" style="height: 650px;">

                <div class="position-absolute top-50 start-50 translate-middle rounded-circle bg-success bg-opacity-10"
                    style="width: 500px; height: 500px; filter: blur(80px); z-index: 0; transform: translate(50px, -50px);">
                </div>


                <div class="position-absolute bg-white p-4 rounded-4 shadow-lg border"
                    style="width: 350px; top: 120px; left: 20px; transform: rotate(-3deg); z-index: 4;">
                    <div class="d-flex align-items-center gap-3 mb-3">
                        <div class="rounded-circle text-white d-flex align-items-center justify-content-center fw-bold"
                            style="width: 40px; height: 40px; background-color: #1a4d2e;">A</div>
                        <div>
                            <h6 class="mb-0 fw-bold">Admin</h6>
                            <small class="text-muted">2 mins ago</small>
                        </div>
                    </div>
                    <p class="fs-5" style="font-family: 'Merriweather', serif;">"Simplicity is the ultimate
                        sophistication."</p>
                    <div class="text-danger small mt-2"><x-heroicon-s-heart style="width: 16px; display: inline;" /> 24
                        Likes</div>
                </div>

                <div class="position-absolute bg-white p-4 rounded-4 shadow-sm border"
                    style="width: 310px; bottom: 150px; right: 100px; transform: rotate(6deg); z-index: 3; opacity: 0.95;">
                    <div class="d-flex align-items-center gap-3 mb-3">
                        <div class="rounded-circle bg-secondary text-white d-flex align-items-center justify-content-center fw-bold"
                            style="width: 40px; height: 40px;">G</div>
                        <div>
                            <h6 class="mb-0 fw-bold">Guest</h6>
                            <small class="text-muted">1 hour ago</small>
                        </div>
                    </div>
                    <p class="fs-6 text-muted mb-0">Just learned how to deploy Laravel! 🚀 Sharing my notes soon.</p>
                </div>

            </div>
        </div>
    </div>

</body>

</html>
