<x-guest-layout>
    <h3 class="fw-bold mb-4 text-center" style="font-family: 'Merriweather', serif; color: #1c1917;">Welcome Back</h3>

    @if (session('status'))
        <div class="alert alert-success mb-3 small border-0 bg-success bg-opacity-10 text-success">
            {{ session('status') }}
        </div>
    @endif

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <div class="mb-4">
            <label for="email" class="form-label fw-bold small text-uppercase text-muted" style="font-family: 'Inter'; letter-spacing: 0.5px;">Email Address</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" 
                   class="form-control form-control-lg" 
                   style="font-family: 'Inter'; font-size: 1rem;"
                   placeholder="name@example.com" required autofocus>
            @error('email') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
        </div>

        <div class="mb-4">
            <div class="d-flex justify-content-between align-items-center mb-1">
                <label for="password" class="form-label fw-bold small text-uppercase text-muted" style="font-family: 'Inter'; letter-spacing: 0.5px;">Password</label>
                @if (Route::has('password.request'))
                    <a class="text-decoration-none small fw-bold" href="{{ route('password.request') }}" style="color: #1a4d2e;">
                        Forgot Password?
                    </a>
                @endif
            </div>
            <input id="password" type="password" name="password" 
                   class="form-control form-control-lg" 
                   style="font-family: 'Inter'; font-size: 1rem;"
                   placeholder="••••••••" required>
            @error('password') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
        </div>

        <div class="mb-4 form-check">
            <input id="remember_me" type="checkbox" class="form-check-input" name="remember">
            <label class="form-check-label small text-muted" for="remember_me" style="font-family: 'Inter';">Keep me logged in</label>
        </div>

        <div class="d-grid gap-2">
            <button type="submit" class="btn btn-primary btn-lg py-3">Log In</button>
        </div>

        <div class="text-center mt-4 pt-3 border-top">
            <p class="small text-muted mb-2" style="font-family: 'Inter';">Don't have an account yet?</p>
            <a class="btn btn-outline-dark w-100 fw-bold" href="{{ route('register') }}" style="font-family: 'Inter';">
                Create Free Account
            </a>
        </div>
    </form>
</x-guest-layout>