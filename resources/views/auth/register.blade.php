<x-guest-layout>
    <h3 class="fw-bold mb-2 text-center" style="font-family: 'Merriweather', serif; color: #1c1917;">Join Birdie</h3>
    <p class="text-muted text-center small mb-4" style="font-family: 'Inter';">Start your daily journal today.</p>

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <div class="mb-3">
            <label for="name" class="form-label fw-bold small text-uppercase text-muted" style="font-family: 'Inter'; letter-spacing: 0.5px;">Full Name</label>
            <input id="name" type="text" name="name" value="{{ old('name') }}" 
                   class="form-control form-control-lg" style="font-family: 'Inter';" required autofocus>
            @error('name') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label for="email" class="form-label fw-bold small text-uppercase text-muted" style="font-family: 'Inter'; letter-spacing: 0.5px;">Email Address</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" 
                   class="form-control form-control-lg" style="font-family: 'Inter';" required>
            @error('email') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label for="password" class="form-label fw-bold small text-uppercase text-muted" style="font-family: 'Inter'; letter-spacing: 0.5px;">Password</label>
            <input id="password" type="password" name="password" 
                   class="form-control form-control-lg" style="font-family: 'Inter';" required>
            @error('password') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
        </div>

        <div class="mb-4">
            <label for="password_confirmation" class="form-label fw-bold small text-uppercase text-muted" style="font-family: 'Inter'; letter-spacing: 0.5px;">Confirm Password</label>
            <input id="password_confirmation" type="password" name="password_confirmation" 
                   class="form-control form-control-lg" style="font-family: 'Inter';" required>
        </div>

        <div class="d-grid gap-2">
            <button type="submit" class="btn btn-primary btn-lg py-3">Create Account</button>
        </div>

        <div class="text-center mt-4 pt-3 border-top">
            <p class="small text-muted mb-2" style="font-family: 'Inter';">Already have an account?</p>
            <a class="btn btn-outline-dark w-100 fw-bold" href="{{ route('login') }}" style="font-family: 'Inter';">
                Sign In
            </a>
        </div>
    </form>
</x-guest-layout>