<x-app-layout>
    <div class="row justify-content-center">
        <div class="col-lg-10">
            
            <div class="d-flex align-items-center gap-3 mb-4">
                <a href="{{ route('users.show', Auth::user()) }}" 
                   class="btn btn-white bg-white border shadow-sm rounded-circle p-2 d-flex align-items-center justify-content-center text-dark"
                   style="width: 40px; height: 40px;">
                    <x-heroicon-m-arrow-left style="width: 20px;" />
                </a>
                <h2 class="fw-bold mb-0" style="font-family: 'Merriweather', serif;">Account Settings</h2>
            </div>

            <div class="row g-5" x-data="{ tab: 'profile', showPass: false }">
                
                <div class="col-md-4 col-lg-3">
                    <div class="list-group list-group-flush sticky-top" style="top: 100px;">
                        <button @click="tab = 'profile'" 
                            :class="tab === 'profile' ? 'text-dark fw-bold border-start border-3 border-success ps-3' : 'text-muted ps-3 border-start border-3 border-transparent'"
                            class="list-group-item list-group-item-action py-2 px-0 bg-transparent d-flex align-items-center gap-2 border-0 mb-2"
                            style="border-color: #1a4d2e !important; transition: all 0.2s;">
                            Profile Details
                        </button>
                        
                        <button @click="tab = 'security'" 
                            :class="tab === 'security' ? 'text-dark fw-bold border-start border-3 border-success ps-3' : 'text-muted ps-3 border-start border-3 border-transparent'"
                            class="list-group-item list-group-item-action py-2 px-0 bg-transparent d-flex align-items-center gap-2 border-0 mb-2"
                            style="border-color: #1a4d2e !important; transition: all 0.2s;">
                            Password
                        </button>
                        
                        <button @click="tab = 'danger'" 
                            :class="tab === 'danger' ? 'text-danger fw-bold border-start border-3 border-danger ps-3' : 'text-danger text-opacity-75 ps-3 border-start border-3 border-transparent'"
                            class="list-group-item list-group-item-action py-2 px-0 bg-transparent d-flex align-items-center gap-2 border-0">
                            Delete Account
                        </button>
                    </div>
                </div>

                <div class="col-md-8 col-lg-9">
                    
                    <div x-show="tab === 'profile'" x-transition.opacity class="modern-card p-5">
                        <h4 class="fw-bold mb-1" style="font-family: 'Merriweather', serif;">Profile Information</h4>
                        <p class="text-muted small mb-4 border-bottom pb-3">Update your public profile details.</p>

                        <form method="post" action="{{ route('profile.update') }}" enctype="multipart/form-data">
                            @csrf
                            @method('patch')

                            <div class="mb-4">
                                <label class="form-label fw-bold small text-uppercase text-muted" style="font-family: 'Inter';">Profile Photo</label>
                                <div class="d-flex align-items-center gap-3">
                                    @if($user->avatar)
                                        <img src="{{ asset('storage/' . $user->avatar) }}" alt="Avatar" class="rounded-circle object-fit-cover border" style="width: 60px; height: 60px;">
                                    @else
                                        <div class="rounded-circle bg-dark text-white d-flex align-items-center justify-content-center fw-bold fs-4" style="width: 60px; height: 60px;">
                                            {{ substr($user->name, 0, 1) }}
                                        </div>
                                    @endif
                                    
                                    <input type="file" name="avatar" class="form-control form-control-sm w-auto">
                                </div>
                                @error('avatar') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                            </div>

                            <div class="mb-4">
                                <label class="form-label fw-bold small text-uppercase text-muted" style="font-family: 'Inter'; letter-spacing: 0.5px;">Display Name</label>
                                <input type="text" name="name" class="form-control" value="{{ old('name', $user->name) }}" required>
                                @error('name') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                            </div>

                            <div class="mb-4">
                                <label class="form-label fw-bold small text-uppercase text-muted" style="font-family: 'Inter'; letter-spacing: 0.5px;">Email Address</label>
                                <input type="email" name="email" class="form-control" value="{{ old('email', $user->email) }}" required>
                                @error('email') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                            </div>

                            <div class="mb-4">
                                <label class="form-label fw-bold small text-uppercase text-muted" style="font-family: 'Inter'; letter-spacing: 0.5px;">Bio <span class="fw-normal text-lowercase">(optional)</span></label>
                                <textarea name="bio" class="form-control" rows="4" maxlength="160">{{ old('bio', $user->bio) }}</textarea>
                                <div class="form-text">Tell the world about yourself. Max 160 chars.</div>
                                @error('bio') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                            </div>

                            <div class="d-flex justify-content-end align-items-center gap-3">
                                @if (session('status') === 'profile-updated')
                                    <span x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 2000)" class="text-success fw-bold small">Saved</span>
                                @endif
                                <button type="submit" class="btn btn-primary px-4">Save Changes</button>
                            </div>
                        </form>
                    </div>

                    <div x-show="tab === 'security'" x-transition.opacity class="modern-card p-5" style="display: none;">
                        <h4 class="fw-bold mb-1" style="font-family: 'Merriweather', serif;">Update Password</h4>
                        <p class="text-muted small mb-4 border-bottom pb-3">Ensure your account is using a long, random password.</p>

                        <form method="post" action="{{ route('password.update') }}">
                            @csrf
                            @method('put')

                            <div class="mb-3">
                                <label class="form-label fw-bold small text-uppercase text-muted" style="font-family: 'Inter', sans-serif; letter-spacing: 0.5px;">Current Password</label>
                                <div class="position-relative">
                                    <input :type="showPass ? 'text' : 'password'" name="current_password" class="form-control pe-5">
                                    <button type="button" @click="showPass = !showPass" class="btn btn-link position-absolute top-0 end-0 text-muted text-decoration-none">
                                        <span x-show="!showPass" class="small">Show</span>
                                        <span x-show="showPass" class="small">Hide</span>
                                    </button>
                                </div>
                                @error('current_password', 'updatePassword') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-bold small text-uppercase text-muted" style="font-family: 'Inter', sans-serif; letter-spacing: 0.5px;">New Password</label>
                                <input :type="showPass ? 'text' : 'password'" name="password" class="form-control">
                                @error('password', 'updatePassword') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                            </div>

                            <div class="mb-4">
                                <label class="form-label fw-bold small text-uppercase text-muted" style="font-family: 'Inter', sans-serif; letter-spacing: 0.5px;">Confirm New Password</label>
                                <input :type="showPass ? 'text' : 'password'" name="password_confirmation" class="form-control">
                            </div>

                            <div class="d-flex justify-content-end align-items-center gap-3">
                                @if (session('status') === 'password-updated')
                                    <span x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 2000)" class="text-success fw-bold small">Updated</span>
                                @endif
                                <button type="submit" class="btn btn-dark px-4">Update Password</button>
                            </div>
                        </form>
                    </div>

                    <div x-show="tab === 'danger'" x-transition.opacity class="modern-card p-5 border border-danger border-opacity-25" style="display: none;">
                        <h4 class="fw-bold mb-1 text-danger" style="font-family: 'Merriweather', serif;">Delete Account</h4>
                        <p class="text-danger text-opacity-75 small mb-4 border-bottom border-danger border-opacity-25 pb-3">Permanently remove your account and data.</p>

                        <div class="alert alert-danger border-0 mb-4">
                            <strong>Warning: This is irreversible.</strong>
                            <p class="mb-0 small mt-1">All tweets, likes, and profile data will be wiped.</p>
                        </div>
                        
                        <form method="post" action="{{ route('profile.destroy') }}" onsubmit="return confirm('Are you sure?');">
                            @csrf @method('delete')
                            <div class="mb-3">
                                <label class="form-label fw-bold small text-uppercase text-danger" style="font-family: 'Inter', sans-serif;">Confirm Password</label>
                                <input type="password" name="password" class="form-control border-danger" required>
                                @error('password', 'userDeletion') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                            </div>
                            <div class="d-flex justify-content-end">
                                <button type="submit" class="btn btn-outline-danger px-4">Delete Account</button>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>