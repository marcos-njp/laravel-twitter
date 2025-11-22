<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Birdie</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&family=Merriweather:wght@300;400;700;900&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="d-flex flex-column min-vh-100 justify-content-center align-items-center" style="background-color: #f8f5f2;">
    
    <div class="w-100" style="max-width: 460px; padding: 20px;">
        
        <div class="text-center mb-4">
            <a href="/" class="text-decoration-none text-muted small fw-bold mb-3 d-inline-block hover-underline">
                &larr; Back to Home
            </a>
            <div class="d-flex align-items-center justify-content-center gap-2">
                <x-heroicon-s-book-open style="width: 36px; color: #1a4d2e;" />
                <span class="fw-bold fs-1" style="font-family: 'Merriweather', serif; color: #1a4d2e; letter-spacing: -1px;">Birdie.</span>
            </div>
        </div>

        <div class="bg-white p-4 p-sm-5" style="border-radius: 16px; border: 1px solid #d6d3d1; box-shadow: 0 2px 4px rgba(0,0,0,0.02);">
            {{ $slot }}
        </div>

        <div class="text-center mt-4 small text-muted" style="font-family: 'Inter'; opacity: 0.7;">
            &copy; 2025 Birdie Inc.
        </div>
    </div>

</body>
</html>