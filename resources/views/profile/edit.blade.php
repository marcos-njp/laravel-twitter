<x-app-layout>
    <div class="container py-4">
        <h2 class="fw-bold mb-4">Account Settings</h2>

        <div class="row g-4">
            <div class="col-md-6">
                <div class="card shadow-sm border-0">
                    <div class="card-header bg-white fw-bold py-3">Profile Information</div>
                    <div class="card-body">
                        <form method="post" action="{{ route('profile.update') }}">
                            @csrf
                            @method('patch')

                            <div class="mb-3">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $user->name) }}" required>
                                @error('name') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                            </div>

                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" name="email" id="email" class="form-control" value="{{ old('email', $user->email) }}" required>
                                @error('email') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                            </div>

                            <div class="mb-3">
                                <label for="bio" class="form-label">Bio <small class="text-muted">(Optional)</small></label>
                                <textarea name="bio" id="bio" class="form-control" rows="3" maxlength="160">{{ old('bio', $user->bio) }}</textarea>
                                <div class="form-text">Tell the world about yourself. Max 160 characters.</div>
                                @error('bio') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                            </div>

                            <button type="submit" class="btn btn-primary px-4">Save Changes</button>

                            @if (session('status') === 'profile-updated')
                                <span class="text-success ms-2 small fw-bold fade-out">Saved successfully.</span>
                            @endif
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card shadow-sm border-0 mb-4">
                    <div class="card-header bg-white fw-bold py-3">Update Password</div>
                    <div class="card-body">
                        <form method="post" action="{{ route('password.update') }}">
                            @csrf
                            @method('put')

                            <div class="mb-3">
                                <label for="current_password" class="form-label">Current Password</label>
                                <input type="password" name="current_password" id="current_password" class="form-control">
                                @error('current_password', 'updatePassword') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                            </div>

                            <div class="mb-3">
                                <label for="password" class="form-label">New Password</label>
                                <input type="password" name="password" id="password" class="form-control">
                                @error('password', 'updatePassword') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                            </div>

                            <div class="mb-3">
                                <label for="password_confirmation" class="form-label">Confirm New Password</label>
                                <input type="password" name="password_confirmation" id="password_confirmation" class="form-control">
                            </div>

                            <button type="submit" class="btn btn-dark px-4">Update Password</button>

                            @if (session('status') === 'password-updated')
                                <span class="text-success ms-2 small fw-bold fade-out">Saved.</span>
                            @endif
                        </form>
                    </div>
                </div>

                <div class="card border-danger shadow-sm">
                    <div class="card-header bg-danger text-white fw-bold py-3">Danger Zone</div>
                    <div class="card-body">
                        <h6 class="fw-bold text-danger">Delete Account</h6>
                        <p class="small text-muted">Once your account is deleted, all of its resources and data will be permanently deleted. This action cannot be undone.</p>
                        
                        <form method="post" action="{{ route('profile.destroy') }}" onsubmit="return confirm('Are you sure you want to delete your account? This IS PERMANENT.');">
                            @csrf
                            @method('delete')
                            
                            <div class="input-group mb-3">
                                <input type="password" name="password" class="form-control" placeholder="Enter password to confirm" required>
                                <button class="btn btn-outline-danger" type="button" onclick="this.form.submit()">Delete Account</button>
                            </div>
                            @error('password', 'userDeletion') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
