<x-app-layout>
    <div class="border-bottom p-3">
        <form action="{{ route('tweets.store') }}" method="POST" x-data="{ content: '' }">
            @csrf
            <div class="d-flex gap-3">
                <div class="rounded-circle bg-secondary text-white d-flex align-items-center justify-content-center flex-shrink-0" style="width: 48px; height: 48px; font-size: 1.2rem;">
                    {{ substr(Auth::user()->name, 0, 1) }}
                </div>
                
                <div class="w-100">
                    <textarea 
                        name="content" 
                        x-model="content" 
                        class="form-control border-0 fs-5 px-0" 
                        rows="2" 
                        placeholder="What is happening?!" 
                        style="resize: none; outline: none; box-shadow: none;"
                        required 
                        maxlength="280"
                    ></textarea>
                    
                    <div class="d-flex justify-content-between align-items-center mt-3 border-top pt-3">
                        <small class="fw-bold text-primary" x-show="content.length > 0">
                            <span x-text="content.length"></span>/280
                        </small>
                        <button type="submit" class="btn btn-primary rounded-pill px-4 fw-bold ms-auto" 
                                :disabled="content.length === 0 || content.length > 280">
                            Post
                        </button>
                    </div>
                    @error('content') <div class="text-danger small mt-2">{{ $message }}</div> @enderror
                </div>
            </div>
        </form>
    </div>

    <div class="px-3 py-2 border-bottom bg-light d-flex justify-content-between align-items-center">
        <span class="small fw-bold text-muted">Timeline</span>
        
        <div class="dropdown">
            <button class="btn btn-sm btn-light border-0 dropdown-toggle fw-bold text-dark d-flex align-items-center gap-2" 
                    type="button" 
                    data-bs-toggle="dropdown">
                @if($sortDirection === 'oldest')
                    <span>⬆️ Oldest First</span>
                @else
                    <span>⬇️ Newest First</span>
                @endif
            </button>
            <ul class="dropdown-menu dropdown-menu-end shadow-sm border-0">
                <li>
                    <a class="dropdown-item {{ $sortDirection === 'newest' ? 'active fw-bold' : '' }}" 
                       href="{{ route('tweets.index', ['sort' => 'newest']) }}">
                       ⬇️ Newest First
                    </a>
                </li>
                <li>
                    <a class="dropdown-item {{ $sortDirection === 'oldest' ? 'active fw-bold' : '' }}" 
                       href="{{ route('tweets.index', ['sort' => 'oldest']) }}">
                       ⬆️ Oldest First
                    </a>
                </li>
            </ul>
        </div>
    </div>

    @foreach ($tweets as $tweet)
        <div class="tweet-item p-3 d-flex gap-3 border-bottom">
            <a href="{{ route('users.show', $tweet->user) }}" class="text-decoration-none">
                <div class="rounded-circle bg-light text-secondary d-flex align-items-center justify-content-center flex-shrink-0 border" style="width: 48px; height: 48px; font-size: 1.2rem;">
                    {{ substr($tweet->user->name, 0, 1) }}
                </div>
            </a>

            <div class="w-100">
                <div class="d-flex justify-content-between align-items-start">
                    <div class="d-flex align-items-center gap-2">
                        <a href="{{ route('users.show', $tweet->user) }}" class="text-decoration-none text-dark fw-bold">
                            {{ $tweet->user->name }}
                        </a>
                        <span class="text-muted small">@ {{ strtolower(str_replace(' ', '', $tweet->user->name)) }} · {{ $tweet->created_at->diffForHumans(null, true, true) }}</span>
                        @if($tweet->is_edited)
                            <span class="small text-muted" title="Edited">✎</span>
                        @endif
                    </div>

                    @if (Auth::id() === $tweet->user_id)
                        <div class="dropdown">
                            <button class="btn btn-link text-muted p-0 text-decoration-none fs-5" style="line-height: 0.5;" data-bs-toggle="dropdown">...</button>
                            <ul class="dropdown-menu dropdown-menu-end shadow-sm border-0">
                                <li><a class="dropdown-item" href="{{ route('tweets.edit', $tweet) }}">Edit Post</a></li>
                                <li>
                                    <form action="{{ route('tweets.destroy', $tweet) }}" method="POST" onsubmit="return confirm('Delete this post?');">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="dropdown-item text-danger">Delete</button>
                                    </form>
                                </li>
                            </ul>
                        </div>
                    @endif
                </div>

                <p class="mb-2 text-dark" style="font-size: 15px; line-height: 1.5;">{{ $tweet->content }}</p>

                <div class="d-flex align-items-center mt-2">
                    <form action="{{ route('tweets.like', $tweet) }}" method="POST">
                        @csrf
                        @php $userHasLiked = $tweet->likes->contains('user_id', Auth::id()); @endphp
                        <button type="submit" class="btn btn-link p-0 text-decoration-none d-flex align-items-center gap-2 {{ $userHasLiked ? 'text-danger' : 'text-muted' }}">
                            <span style="font-size: 1.2rem;">{{ $userHasLiked ? '♥' : '♡' }}</span>
                            <span class="small">{{ $tweet->likes_count > 0 ? $tweet->likes_count : '' }}</span>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    @endforeach
</x-app-layout>