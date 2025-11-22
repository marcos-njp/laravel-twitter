<x-app-layout>
    <div class="row justify-content-center g-5">
        
        <div class="col-lg-7">
            
            <div class="modern-card p-4 border-0 mb-4 position-relative overflow-hidden" 
                 style="background-color: #1a4d2e; color: white;">
                
                <div class="position-absolute top-0 end-0 opacity-10" style="transform: rotate(10deg); margin-right: -20px; margin-top: -10px;">
                    <x-heroicon-s-book-open style="width: 140px; color: white;" />
                </div>

                <div class="d-flex align-items-start gap-3 position-relative z-1">
                    <div class="p-2 rounded bg-white bg-opacity-10 shadow-sm">
                        <x-heroicon-o-academic-cap style="width: 32px; color: #fbbf24;" />
                    </div>
                    <div>
                        <h4 class="mb-2 fw-bold text-white" style="font-family: 'Merriweather', serif;">Welcome to Birdie.</h4>
                        <p class="mb-0 text-white opacity-90" style="font-size: 0.95rem; line-height: 1.6; max-width: 90%;">
                            A minimalist space designed for curious minds. Share your daily learnings, research notes, and quick insights. Connect with a community of thinkers in a distraction-free environment.
                        </p>
                    </div>
                </div>
            </div>

            <div class="modern-card p-4">
                <h6 class="fw-bold text-muted mb-3 d-flex align-items-center gap-2">
                    <x-heroicon-s-pencil-square style="width: 20px; color: #1a4d2e;" />
                    Create Post
                </h6>
                
                <form action="{{ route('tweets.store') }}" method="POST" x-data="{ content: '' }">
                    @csrf
                    <div class="position-relative">
                        <textarea 
                            name="content" 
                            x-model="content" 
                            class="form-control border bg-light" 
                            rows="3" 
                            placeholder="What did you learn today?" 
                            style="resize: none; outline: none; font-size: 1.1rem;"
                            required 
                            maxlength="280"
                        ></textarea>
                        
                        <div class="d-flex justify-content-between align-items-center mt-3">
                            <small class="fw-bold transition-all" 
                                   :class="content.length > 250 ? 'text-danger' : 'text-muted'" 
                                   style="font-size: 0.85rem;">
                                <span x-text="content.length">0</span> / 280
                            </small>

                            <button type="submit" class="btn btn-primary px-4 py-2 rounded-pill shadow-sm d-flex align-items-center gap-2" 
                                    :disabled="content.length === 0 || content.length > 280">
                                <x-heroicon-s-paper-airplane style="width: 16px;" />
                                Post
                            </button>
                        </div>
                    </div>
                    @error('content') <div class="text-danger small mt-2">{{ $message }}</div> @enderror
                </form>
            </div>

            <div class="d-flex justify-content-between align-items-center mb-4 px-2">
                <h5 class="fw-bold mb-0 text-dark" style="font-family: 'Merriweather', serif;">Feed</h5>
                <div class="dropdown">
                    <button class="btn btn-white bg-white border shadow-sm px-3 py-1 text-muted dropdown-toggle d-flex align-items-center gap-2 small" 
                            type="button" data-bs-toggle="dropdown">
                        {{ $sortDirection === 'oldest' ? 'Oldest First' : 'Newest First' }}
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end shadow-sm border rounded-1">
                        <li><a class="dropdown-item" href="{{ route('tweets.index', ['sort' => 'newest']) }}">Newest First</a></li>
                        <li><a class="dropdown-item" href="{{ route('tweets.index', ['sort' => 'oldest']) }}">Oldest First</a></li>
                    </ul>
                </div>
            </div>

            @foreach ($tweets as $tweet)
                <div class="modern-card p-4">
                    <div class="d-flex gap-3">
                        <a href="{{ route('users.show', $tweet->user) }}" class="text-decoration-none">
                            <div class="rounded-1 bg-dark text-white d-flex align-items-center justify-content-center flex-shrink-0 shadow-sm" 
                                 style="width: 48px; height: 48px; font-family: 'Merriweather', serif; font-weight: 700; font-size: 1.2rem;">
                                {{ substr($tweet->user->name, 0, 1) }}
                            </div>
                        </a>

                        <div class="w-100">
                            <div class="d-flex justify-content-between align-items-start mb-2">
                                <div class="d-flex flex-column">
                                    <div class="d-flex align-items-center gap-2">
                                        <a href="{{ route('users.show', $tweet->user) }}" class="text-decoration-none text-dark fw-bold" style="font-family: 'Merriweather', serif;">
                                            {{ $tweet->user->name }}
                                        </a>
                                        
                                        @if (Auth::id() === $tweet->user_id)
                                            <span class="badge-owner">You</span>
                                        @endif
                                    </div>
                                    
                                    <div class="d-flex align-items-center gap-2 text-muted small" style="font-size: 0.8rem;">
                                        <span>{{ $tweet->created_at->diffForHumans() }}</span>
                                        
                                        @if($tweet->is_edited)
                                            <span>·</span>
                                            <span class="d-flex align-items-center gap-1 fst-italic text-warning-emphasis" title="Edited">
                                                <x-heroicon-m-pencil-square style="width: 12px;" /> Edited
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                
                                @if (Auth::id() === $tweet->user_id)
                                     <div class="dropdown">
                                        <button class="btn btn-link text-muted p-0 text-decoration-none" data-bs-toggle="dropdown">
                                            <x-heroicon-m-ellipsis-horizontal style="width: 20px;" />
                                        </button>
                                        <ul class="dropdown-menu dropdown-menu-end border shadow-sm rounded-1">
                                            <li><a class="dropdown-item small" href="{{ route('tweets.edit', $tweet) }}">Edit Post</a></li>
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

                            <p class="mb-3 text-dark fs-5" style="line-height: 1.6;">
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
            @endforeach
        </div>

        <div class="col-lg-4 d-none d-lg-block">
            <div class="sticky-top" style="top: 100px; z-index: 1;">
                
                <div class="modern-card p-4">
                    <h6 class="fw-bold text-dark mb-4" style="font-family: 'Merriweather', serif;">Community</h6>
                    <div class="d-flex flex-column gap-4">
                        @foreach($newestUsers as $user)
                            <div class="d-flex align-items-start gap-3">
                                <a href="{{ route('users.show', $user) }}" class="text-decoration-none">
                                    <div class="rounded-circle bg-light text-muted d-flex align-items-center justify-content-center border" 
                                         style="width: 40px; height: 40px; font-weight: bold; font-size: 1rem;">
                                        {{ substr($user->name, 0, 1) }}
                                    </div>
                                </a>
                                <div class="d-flex flex-column" style="line-height: 1.2;">
                                    <a href="{{ route('users.show', $user) }}" class="text-decoration-none text-dark fw-bold small">
                                        {{ $user->name }}
                                    </a>
                                    <div class="d-flex align-items-center gap-2 mt-1">
                                        <span class="badge bg-light text-dark border" style="font-size: 0.65rem; font-weight: 600;">
                                            {{ $user->tweets_count }} Posts
                                        </span>
                                        <small class="text-muted" style="font-size: 0.7rem;">{{ $user->created_at->format('M d') }}</small>
                                    </div>
                                    
                                    @if($user->bio)
                                        <p class="small text-muted mt-2 mb-0 fst-italic opacity-75" style="font-size: 0.75rem;">
                                            "{{ Str::limit($user->bio, 45) }}"
                                        </p>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                    
                    @if($newestUsers->isEmpty())
                        <p class="text-muted small fst-italic">No members yet.</p>
                    @endif
                </div>

            </div>
        </div>
    </div>
</x-app-layout>