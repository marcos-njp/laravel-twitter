<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Birdie</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&family=Merriweather:wght@300;400;700;900&display=swap"
        rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="d-flex flex-column min-vh-100 justify-content-center align-items-center"
    style="background-color: #f8f5f2;">

    <div class="w-100" style="max-width: 480px; padding: 20px;">
        <div class="text-center mb-4">
            <a href="/" class="text-decoration-none d-flex align-items-center justify-content-center gap-2">
                <x-heroicon-s-book-open style="width: 32px; color: #1a4d2e;" />
                <span class="fw-bold fs-2"
                    style="font-family: 'Merriweather', serif; color: #1a4d2e; letter-spacing: -1px;">Birdie.</span>
            </a>
        </div>

        <div class="modern-card p-4 p-sm-5 bg-white shadow-sm" style="border-radius: 12px; border: 1px solid #e7e5e4;">
            {{ $slot }}
        </div>

        <div class="text-center mt-4 small text-muted" style="font-family: 'Inter';">
            &copy; 2025 Birdie Inc.
        </div>
    </div>

</body>

</html>

