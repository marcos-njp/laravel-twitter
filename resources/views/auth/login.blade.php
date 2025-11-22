<x-guest-layout>
    <h4 class="fw-bold mb-3 text-center text-secondary">Welcome back</h4>

    @if (session('status'))
        <div class="alert alert-success mb-3 small">
            {{ session('status') }}
        </div>
    @endif

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <div class="mb-3">
            <label for="email" class="form-label small fw-bold text-muted">Email</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" 
                   class="form-control form-control-lg @error('email') is-invalid @enderror" 
                   placeholder="name@example.com" required autofocus>
            @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="password" class="form-label small fw-bold text-muted">Password</label>
            <input id="password" type="password" name="password" 
                   class="form-control form-control-lg @error('password') is-invalid @enderror" 
                   placeholder="Enter your password" required>
            @error('password')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="d-flex justify-content-between align-items-center mb-4">
            <div class="form-check">
                <input id="remember_me" type="checkbox" class="form-check-input" name="remember">
                <label class="form-check-label small" for="remember_me">Remember me</label>
            </div>
            
            @if (Route::has('password.request'))
                <a class="text-decoration-none small fw-bold" href="{{ route('password.request') }}">
                    Forgot password?
                </a>
            @endif
        </div>

        <div class="d-grid gap-2 mb-4">
            <button type="submit" class="btn btn-primary btn-lg fw-bold rounded-pill">Log in</button>
        </div>

        <div class="text-center border-top pt-3">
            <p class="small text-muted mb-0">Don't have an account?</p>
            <a class="text-decoration-none fw-bold fs-6" href="{{ route('register') }}">
                Sign up for Birdie
            </a>
        </div>
    </form>
</x-guest-layout>