<x-app-layout>
    <div class="modern-card p-4">
        <form action="{{ route('tweets.store') }}" method="POST" x-data="{ content: '' }">
            @csrf
            <div class="position-relative">
                <textarea 
                    name="content" 
                    x-model="content" 
                    class="form-control" 
                    rows="3" 
                    placeholder="Write something compelling..." 
                    style="resize: none; outline: none;"
                    required 
                    maxlength="280"
                ></textarea>
                
                <div class="d-flex justify-content-between align-items-center mt-3">
                    <span class="text-muted small fst-italic">Markdown supported</span>
                    <div class="d-flex align-items-center gap-3">
                        <small class="fw-bold" :class="content.length > 250 ? 'text-danger' : 'text-muted'" x-show="content.length > 0">
                            <span x-text="content.length"></span>/280
                        </small>
                        <button type="submit" class="btn btn-primary" 
                                :disabled="content.length === 0 || content.length > 280">
                            Post Entry
                        </button>
                    </div>
                </div>
            </div>
            @error('content') 
                <div class="text-danger small mt-2">{{ $message }}</div> 
            @enderror
        </form>
    </div>

    <div class="d-flex justify-content-between align-items-center mb-4 px-2">
        <h5 class="fw-bold mb-0 text-dark">Latest Entries</h5>
        <div class="dropdown">
            <button class="btn btn-white bg-white border shadow-sm px-3 py-1 text-muted dropdown-toggle d-flex align-items-center gap-2 small" 
                    type="button" data-bs-toggle="dropdown">
                {{ $sortDirection === 'oldest' ? 'Oldest' : 'Newest' }}
            </button>
            <ul class="dropdown-menu dropdown-menu-end shadow-sm border rounded-1">
                <li><a class="dropdown-item" href="{{ route('tweets.index', ['sort' => 'newest']) }}">Newest</a></li>
                <li><a class="dropdown-item" href="{{ route('tweets.index', ['sort' => 'oldest']) }}">Oldest</a></li>
            </ul>
        </div>
    </div>

    @foreach ($tweets as $tweet)
        <div class="modern-card p-4">
            <div class="d-flex gap-3">
                <a href="{{ route('users.show', $tweet->user) }}" class="text-decoration-none">
                    <div class="rounded-1 bg-dark text-white d-flex align-items-center justify-content-center flex-shrink-0" 
                         style="width: 45px; height: 45px; font-family: 'Merriweather', serif; font-weight: 700;">
                        {{ substr($tweet->user->name, 0, 1) }}
                    </div>
                </a>

                <div class="w-100">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <div class="d-flex align-items-baseline gap-2">
                            <a href="{{ route('users.show', $tweet->user) }}" class="text-decoration-none text-dark fw-bold" style="font-family: 'Merriweather', serif;">
                                {{ $tweet->user->name }}
                            </a>
                            <span class="text-muted small text-uppercase" style="font-size: 0.75rem; letter-spacing: 0.5px;">
                                {{ $tweet->created_at->format('M d') }}
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
                                <x-heroicon-o-heart style="width: 18px;" />
                            </div>
                            <div class="icon-solid {{ $userHasLiked ? '' : 'd-none' }}">
                                <x-heroicon-s-heart style="width: 18px;" />
                            </div>
                            <span class="small font-monospace like-count">{{ $tweet->likes_count }}</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</x-app-layout>