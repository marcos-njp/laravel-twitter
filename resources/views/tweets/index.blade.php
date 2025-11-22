<x-app-layout>
    <div class="border-bottom p-3">
    <x-app-layout>
        <div class="modern-card p-4">
            <h5 class="text-muted mb-3 fw-bold">Share something new</h5>
            <form action="{{ route('tweets.store') }}" method="POST" x-data="{ content: '' }">
                @csrf
                <div class="position-relative">
                    <textarea 
                        name="content" 
                        x-model="content" 
                        class="form-control border-0 bg-light rounded-4 p-3 fs-5" 
                        rows="3" 
                        placeholder="Type your thoughts here..." 
                        style="resize: none; outline: none; box-shadow: none;"
                        required 
                        maxlength="280"
                    ></textarea>
                
                    <div class="d-flex justify-content-between align-items-center mt-3">
                        <div class="d-flex align-items-center gap-2 text-muted">
                            <x-heroicon-o-photo style="width: 20px;" />
                            <x-heroicon-o-gif style="width: 20px;" />
                            <x-heroicon-o-face-smile style="width: 20px;" />
                        </div>

                        <div class="d-flex align-items-center gap-3">
                            <small class="fw-bold" :class="content.length > 250 ? 'text-danger' : 'text-muted'" x-show="content.length > 0">
                                <span x-text="content.length"></span>/280
                            </small>
                            <button type="submit" class="btn btn-primary rounded-pill px-4" 
                                    :disabled="content.length === 0 || content.length > 280">
                                Publish
                            </button>
                        </div>
                    </div>
                </div>
                @error('content') <div class="text-danger small mt-2">{{ $message }}</div> @enderror
            </form>
        </div>

        <div class="d-flex justify-content-end mb-4">
            <div class="dropdown">
                <button class="btn btn-light bg-white border shadow-sm rounded-pill px-3 py-2 fw-bold text-muted dropdown-toggle d-flex align-items-center gap-2" 
                        type="button" data-bs-toggle="dropdown">
                    <x-heroicon-m-adjustments-horizontal style="width: 18px;" />
                    {{ $sortDirection === 'oldest' ? 'Oldest First' : 'Newest First' }}
                </button>
                <ul class="dropdown-menu dropdown-menu-end shadow-lg border-0 rounded-4 p-2">
                    <li><a class="dropdown-item rounded-3" href="{{ route('tweets.index', ['sort' => 'newest']) }}">Newest First</a></li>
                    <li><a class="dropdown-item rounded-3" href="{{ route('tweets.index', ['sort' => 'oldest']) }}">Oldest First</a></li>
                </ul>
            </div>
        </div>

        @foreach ($tweets as $tweet)
            <div class="modern-card p-4">
                <div class="d-flex gap-3">
                    <a href="{{ route('users.show', $tweet->user) }}" class="text-decoration-none">
                        <div class="rounded-circle bg-gradient text-white d-flex align-items-center justify-content-center flex-shrink-0 shadow-sm" 
                             style="width: 50px; height: 50px; font-weight: bold; font-size: 1.2rem; background: linear-gradient(135deg, #6366f1, #a855f7);">
                            {{ substr($tweet->user->name, 0, 1) }}
                        </div>
                    </a>

                    <div class="w-100">
                        <div class="d-flex justify-content-between">
                            <div>
                                <a href="{{ route('users.show', $tweet->user) }}" class="text-decoration-none text-dark fw-bold fs-6">
                                    {{ $tweet->user->name }}
                                </a>
                                <div class="text-muted small">
                                    {{ $tweet->created_at->diffForHumans() }} 
                                    @if($tweet->is_edited) · <span class="fst-italic">Edited</span> @endif
                                </div>
                            </div>

                            @if (Auth::id() === $tweet->user_id)
                                <div class="dropdown">
                                    <button class="btn btn-light btn-sm rounded-circle p-1 text-muted" data-bs-toggle="dropdown">
                                        <x-heroicon-m-ellipsis-horizontal style="width: 20px;" />
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-end shadow-lg border-0 rounded-3">
                                        <li><a class="dropdown-item" href="{{ route('tweets.edit', $tweet) }}">Edit</a></li>
                                        <li>
                                            <form action="{{ route('tweets.destroy', $tweet) }}" method="POST" onsubmit="return confirm('Delete?');">
                                                @csrf @method('DELETE')
                                                <button class="dropdown-item text-danger">Delete</button>
                                            </form>
                                        </li>
                                    </ul>
                                </div>
                            @endif
                        </div>

                        <p class="mt-3 mb-3 text-dark fs-5" style="line-height: 1.6;">{{ $tweet->content }}</p>

                        <div class="d-flex align-items-center gap-4 pt-3 border-top border-light">
                            <form action="{{ route('tweets.like', $tweet) }}" method="POST">
                                @csrf
                                @php $userHasLiked = $tweet->likes->contains('user_id', Auth::id()); @endphp
                                <button type="submit" class="btn p-0 text-decoration-none d-flex align-items-center gap-2 {{ $userHasLiked ? 'text-danger' : 'text-muted' }}">
                                    @if($userHasLiked)
                                        <x-heroicon-s-heart style="width: 22px;" />
                                    @else
                                        <x-heroicon-o-heart style="width: 22px;" />
                                    @endif
                                    <span class="fw-bold">{{ $tweet->likes_count }}</span>
                                </button>
                            </form>
                        
                            <button class="btn p-0 text-decoration-none d-flex align-items-center gap-2 text-muted">
                                <x-heroicon-o-chat-bubble-left style="width: 22px;" />
                                <span>Reply</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </x-app-layout>
        </form>
    </div>

    <div class="px-3 py-2 border-bottom bg-light d-flex justify-content-between align-items-center">
        <span class="small fw-bold text-muted">Timeline</span>
        
        <div class="dropdown">
            <button class="btn btn-sm btn-light border-0 dropdown-toggle fw-bold text-muted d-flex align-items-center gap-2" 
                    type="button" 
                    data-bs-toggle="dropdown">
                @if($sortDirection === 'oldest')
                    <x-heroicon-m-bars-arrow-up style="width: 18px;" /> Oldest First
                @else
                    <x-heroicon-m-bars-arrow-down style="width: 18px;" /> Newest First
                @endif
            </button>
            <ul class="dropdown-menu dropdown-menu-end shadow-sm border-0">
                <li>
                    <a class="dropdown-item d-flex align-items-center gap-2 {{ $sortDirection === 'newest' ? 'active fw-bold' : '' }}" 
                       href="{{ route('tweets.index', ['sort' => 'newest']) }}">
                       <x-heroicon-s-bars-arrow-down style="width: 18px;" /> Newest First
                    </a>
                </li>
                <li>
                    <a class="dropdown-item d-flex align-items-center gap-2 {{ $sortDirection === 'oldest' ? 'active fw-bold' : '' }}" 
                       href="{{ route('tweets.index', ['sort' => 'oldest']) }}">
                       <x-heroicon-s-bars-arrow-up style="width: 18px;" /> Oldest First
                    </a>
                </li>
            </ul>
        </div>
    </div>

    @foreach ($tweets as $tweet)
        <div class="tweet-item p-3 d-flex gap-3 border-bottom">
            <a href="{{ route('users.show', $tweet->user) }}" class="text-decoration-none">
                <div class="rounded-circle bg-light text-secondary d-flex align-items-center justify-content-center flex-shrink-0 border" style="width: 48px; height: 48px; font-weight: bold;">
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
                            <span class="text-muted" title="Edited">
                                <x-heroicon-m-pencil-square style="width: 14px;" />
                            </span>
                        @endif
                    </div>

                    @if (Auth::id() === $tweet->user_id)
                        <div class="dropdown">
                            <button class="btn btn-link text-muted p-0" style="line-height: 0;" data-bs-toggle="dropdown">
                                <x-heroicon-m-ellipsis-horizontal style="width: 20px;" />
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end shadow-sm border-0">
                                <li>
                                    <a class="dropdown-item d-flex align-items-center gap-2" href="{{ route('tweets.edit', $tweet) }}">
                                        <x-heroicon-s-pencil style="width: 16px;" /> Edit Post
                                    </a>
                                </li>
                                <li>
                                    <form action="{{ route('tweets.destroy', $tweet) }}" method="POST" onsubmit="return confirm('Delete this post?');">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="dropdown-item text-danger d-flex align-items-center gap-2">
                                            <x-heroicon-s-trash style="width: 16px;" /> Delete
                                        </button>
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
                            @if($userHasLiked)
                                <x-heroicon-s-heart style="width: 20px;" />
                            @else
                                <x-heroicon-o-heart style="width: 20px;" />
                            @endif
                            
                            <span class="small" style="font-weight: 500;">
                                {{ $tweet->likes_count > 0 ? $tweet->likes_count : '' }}
                            </span>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    @endforeach
</x-app-layout>