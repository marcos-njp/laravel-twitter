<x-app-layout>
    <div class="row justify-content-center">
        <div class="col-lg-7">
            
            <div class="modern-card p-5 text-center mb-4 position-relative">
                
                <div class="rounded-circle bg-dark text-white d-flex align-items-center justify-content-center shadow-sm mx-auto mb-3" 
                     style="width: 90px; height: 90px; font-family: 'Merriweather', serif; font-weight: 700; font-size: 2.5rem;">
                    {{ substr($user->name, 0, 1) }}
                </div>

                <h3 class="fw-bold mb-1" style="font-family: 'Merriweather', serif;">{{ $user->name }}</h3>
                <p class="text-muted small mb-4">Joined {{ $user->created_at->format('F Y') }}</p>

                @if(Auth::id() === $user->id)
                    <div class="mb-4">
                        <a href="{{ route('profile.edit') }}" class="btn btn-sm btn-outline-dark rounded-pill px-4 fw-bold">
                            Edit Profile Settings
                        </a>
                    </div>
                @endif

                <div class="d-flex justify-content-center mb-4">
                    <p class="text-dark fst-italic" style="max-width: 400px; font-size: 0.95rem; line-height: 1.6;">
                        @if($user->bio)
                            {{ $user->bio }}
                        @else
                            <span class="text-muted opacity-50">No bio yet.</span>
                        @endif
                    </p>
                </div>

                <div class="d-flex justify-content-center gap-5 border-top pt-4">
                    <div class="text-center">
                        <h4 class="fw-bold mb-0" style="color: #1a4d2e;">{{ $tweetCount }}</h4>
                        <small class="text-muted text-uppercase" style="font-size: 0.7rem; letter-spacing: 1px;">Entries</small>
                    </div>
                    <div class="text-center">
                        <h4 class="fw-bold mb-0" style="color: #1a4d2e;">{{ $receivedLikesCount }}</h4>
                        <small class="text-muted text-uppercase" style="font-size: 0.7rem; letter-spacing: 1px;">Appreciation</small>
                    </div>
                </div>
            </div>

            <div class="d-flex mb-4 border-bottom px-3 gap-4">
                <a href="{{ route('users.show', ['user' => $user->id, 'tab' => 'tweets']) }}" 
                   class="text-decoration-none pb-3 fw-bold small text-uppercase {{ $tab == 'tweets' ? 'border-bottom border-2 border-dark text-dark' : 'text-muted' }}"
                   style="letter-spacing: 0.5px; transition: all 0.2s;">
                   Entries
                </a>
                <a href="{{ route('users.show', ['user' => $user->id, 'tab' => 'likes']) }}" 
                   class="text-decoration-none pb-3 fw-bold small text-uppercase {{ $tab == 'likes' ? 'border-bottom border-2 border-dark text-dark' : 'text-muted' }}"
                   style="letter-spacing: 0.5px; transition: all 0.2s;">
                   Liked
                </a>
            </div>

            @forelse ($tweets as $tweet)
                <div class="modern-card p-4">
                    <div class="d-flex gap-3">
                        <a href="{{ route('users.show', $tweet->user) }}" class="text-decoration-none">
                            <div class="rounded-1 bg-dark text-white d-flex align-items-center justify-content-center flex-shrink-0" 
                                 style="width: 48px; height: 48px; font-family: 'Merriweather', serif; font-weight: 700; font-size: 1.2rem;">
                                {{ substr($tweet->user->name, 0, 1) }}
                            </div>
                        </a>

                        <div class="w-100">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <div class="d-flex align-items-baseline gap-2">
                                    <a href="{{ route('users.show', $tweet->user) }}" class="text-decoration-none text-dark fw-bold" style="font-family: 'Merriweather', serif;">
                                        {{ $tweet->user->name }}
                                    </a>
                                    <span class="text-muted small" style="font-size: 0.85rem;">
                                        · {{ $tweet->created_at->diffForHumans() }}
                                    </span>
                                </div>
                                
                                @if (Auth::id() === $tweet->user_id)
                                     <div class="dropdown">
                                        <button class="btn btn-link text-muted p-0 text-decoration-none" data-bs-toggle="dropdown">
                                            <x-heroicon-m-ellipsis-horizontal style="width: 20px;" />
                                        </button>
                                        <ul class="dropdown-menu dropdown-menu-end border shadow-sm rounded-1">
                                            <li><a class="dropdown-item small" href="{{ route('tweets.edit', $tweet) }}">Edit</a></li>
                                            <li>
                                                <form action="{{ route('tweets.destroy', $tweet) }}" method="POST" onsubmit="return confirm('Delete?');">
                                                    @csrf @method('DELETE')
                                                    <button class="dropdown-item small text-danger">Delete</button>
                                                </form>
                                            </li>
                                        </ul>
                                    </div>
                                @endif
                            </div>

                            <p class="mb-3 text-dark fs-5" style="line-height: 1.7;">
                                {{ $tweet->content }}
                            </p>

                            <div class="d-flex align-items-center gap-4 border-top pt-3" style="border-color: #f5f5f4 !important;">
                                @php $userHasLiked = $tweet->likes->contains('user_id', Auth::id()); @endphp
                                <button 
                                    onclick="toggleLike(this, {{ $tweet->id }})"
                                    class="btn p-0 text-decoration-none d-flex align-items-center gap-2 like-btn {{ $userHasLiked ? 'text-danger' : 'text-muted' }}"
                                    style="border: none; background: none;">
                                    <div class="icon-outline {{ $userHasLiked ? 'd-none' : '' }}">
                                        <x-heroicon-o-heart style="width: 20px;" />
                                    </div>
                                    <div class="icon-solid {{ $userHasLiked ? '' : 'd-none' }}">
                                        <x-heroicon-s-heart style="width: 20px;" />
                                    </div>
                                    <span class="small font-monospace like-count">{{ $tweet->likes_count }}</span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="text-center py-5 text-muted">
                    <x-heroicon-o-document-text style="width: 48px; opacity: 0.5;" class="mx-auto mb-3" />
                    @if($tab == 'likes')
                        <h5>No liked entries yet</h5>
                        <p class="small">Tap the heart on posts you appreciate.</p>
                    @else
                        <h5>No entries yet</h5>
                        <p class="small">This user hasn't published anything.</p>
                    @endif
                </div>
            @endforelse
        </div>
    </div>
</x-app-layout>