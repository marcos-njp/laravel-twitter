<x-guest-layout>
    <div class="text-center mb-4">
        <div class="bg-light rounded-circle d-inline-flex p-3 mb-3 text-dark">
            <x-heroicon-o-key style="width: 32px;" />
        </div>
        <h3 class="fw-bold" style="font-family: 'Merriweather', serif;">Reset Password</h3>
        <p class="text-muted small mt-2">
            Enter your email and we'll send you a link to get back into your account.
        </p>
    </div>

    @if (session('status'))
        <div class="alert alert-success mb-4 small border-0 bg-success bg-opacity-10 text-success">
            {{ session('status') }}
        </div>
    @endif

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <div class="mb-4">
            <label for="email" class="form-label fw-bold small text-uppercase text-muted" style="font-family: 'Inter'; letter-spacing: 0.5px;">Email Address</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" 
                   class="form-control form-control-lg" required autofocus>
            @error('email') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
        </div>

        <div class="d-grid gap-2 mb-3">
            <button type="submit" class="btn btn-primary btn-lg">Email Reset Link</button>
        </div>
        
        <div class="text-center">
            <a href="{{ route('login') }}" class="text-decoration-none small text-muted">Back to Login</a>
        </div>
    </form>
</x-guest-layout>