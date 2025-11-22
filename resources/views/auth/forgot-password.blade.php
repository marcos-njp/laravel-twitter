<x-guest-layout>
    <div class="text-center mb-4">
        <div class="bg-light rounded-circle d-inline-flex p-3 mb-3 text-dark">
            <x-heroicon-o-key style="width: 32px;" />
        </div>
        <h3 class="fw-bold" style="font-family: 'Merriweather', serif;">Reset Password</h3>
        
        <div class="alert alert-warning border-0 bg-warning bg-opacity-10 text-warning-emphasis small mt-3 text-start">
            <strong><x-heroicon-s-exclamation-circle style="width: 16px; display:inline;"/> Demo Mode:</strong> 
            Since this is a local demo using fake emails, actual reset links cannot be delivered. This form is for UI demonstration only.
        </div>
    </div>

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <div class="mb-4">
            <label for="email" class="form-label fw-bold small text-uppercase text-muted" style="font-family: 'Inter'; letter-spacing: 0.5px;">Email Address</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" 
                   class="form-control form-control-lg" style="font-family: 'Inter';" required autofocus>
            @error('email') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
        </div>

        <div class="d-grid gap-2 mb-3">
            <button type="button" class="btn btn-primary btn-lg py-3 disabled" disabled>Email Reset Link (Disabled)</button>
        </div>
        
        <div class="text-center">
            <a href="{{ route('login') }}" class="text-decoration-none small text-muted fw-bold">Back to Login</a>
        </div>
    </form>
</x-guest-layout>