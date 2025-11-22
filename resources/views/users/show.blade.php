<x-app-layout>
    <div class="p-3 border-bottom bg-white">
        <div class="d-flex justify-content-between align-items-start mb-2">
            <div class="rounded-circle bg-secondary text-white d-flex align-items-center justify-content-center border border-4 border-white shadow-sm" 
                 style="width: 100px; height: 100px; font-size: 2.5rem; font-weight: bold; margin-top: -10px;">
                {{ substr($user->name, 0, 1) }}
            </div>

            @if(Auth::id() === $user->id)
                <a href="{{ route('profile.edit') }}" class="btn btn-outline-dark rounded-pill fw-bold px-3 py-1 btn-sm d-flex align-items-center gap-1">
                    <x-heroicon-m-pencil style="width: 16px;" /> Edit profile
                </a>
            @endif
        </div>

        <div>
            <h4 class="fw-bold mb-0 text-dark">{{ $user->name }}</h4>
            <div class="text-muted small mb-3">@ {{ strtolower(str_replace(' ', '', $user->name)) }}</div>

            @if($user->bio)
                <p class="mb-3 text-dark" style="font-size: 15px;">{{ $user->bio }}</p>
            @endif

            <div class="d-flex align-items-center gap-3 text-muted small mb-3">
                <span class="d-flex align-items-center gap-1">
                    <x-heroicon-m-calendar style="width: 18px;" />
                    Joined {{ $user->created_at->format('F Y') }}
                </span>
            </div>

            <div class="d-flex gap-4">
                <div class="d-flex gap-1 align-items-center hover-underline cursor-pointer">
                    <span class="fw-bold text-dark">{{ $tweetCount }}</span>
                    <span class="text-muted small">Tweets</span>
                </div>
                <div class="d-flex gap-1 align-items-center hover-underline cursor-pointer">
                    <span class="fw-bold text-dark">{{ $receivedLikesCount }}</span>
                    <span class="text-muted small">Likes Received</span>
                </div>
            </div>
        </div>
    </div>

    <div class="d-flex border-bottom text-center">
        <div class="flex-grow-1 p-3 fw-bold border-bottom border-primary border-3 text-dark cursor-pointer">
            Tweets
        </div>
        <div class="flex-grow-1 p-3 fw-bold text-muted cursor-pointer text-opacity-50">
            Likes
        </div>
        <div class="flex-grow-1 p-3 fw-bold text-muted cursor-pointer text-opacity-50">
            Media
        </div>
    </div>

    @forelse ($tweets as $tweet)
        <div class="tweet-item p-3 d-flex gap-3 border-bottom">
            <div class="rounded-circle bg-light text-secondary d-flex align-items-center justify-content-center flex-shrink-0 border" style="width: 48px; height: 48px; font-weight: bold;">
                {{ substr($tweet->user->name, 0, 1) }}
            </div>

            <div class="w-100">
                <div class="d-flex justify-content-between align-items-start">
                    <div class="d-flex align-items-center gap-2">
                        <span class="text-dark fw-bold">{{ $tweet->user->name }}</span>
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
    @empty
        <div class="p-5 text-center text-muted">
            <div class="mb-3 d-flex justify-content-center opacity-50">
                <x-heroicon-o-chat-bubble-left-right style="width: 48px; height: 48px;" />
            </div>
            <h5 class="fw-bold text-dark">No tweets yet</h5>
            <p class="small">When {{ $user->name }} posts, you'll see it here.</p>
        </div>
    @endforelse
</x-app-layout>