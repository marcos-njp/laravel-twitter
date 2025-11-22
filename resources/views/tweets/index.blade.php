<x-app-layout>
    <div class="card mb-4 shadow-sm">
        <div class="card-body">
            <form action="{{ route('tweets.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <textarea 
                        name="content" 
                        class="form-control @error('content') is-invalid @enderror" 
                        rows="3" 
                        placeholder="What's on your mind?" 
                        required 
                        maxlength="280"
                    ></textarea>
                    @error('content')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="d-flex justify-content-between align-items-center">
                    <small class="text-muted">Max 280 characters</small>
                    <button type="submit" class="btn btn-primary rounded-pill px-4">Tweet</button>
                </div>
            </form>
        </div>
    </div>

    @foreach ($tweets as $tweet)
        <div class="card mb-3 shadow-sm">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <h6 class="card-subtitle mb-2 text-muted fw-bold">
                        {{ $tweet->user->name }} 
                        <span class="fw-normal small text-muted">· {{ $tweet->created_at->diffForHumans() }}</span>
                        @if($tweet->is_edited)
                            <span class="small text-muted fst-italic" title="Edited"> (edited)</span>
                        @endif
                    </h6>

                    @if (Auth::id() === $tweet->user_id)
                        <div class="dropdown">
                            <button class="btn btn-link text-muted p-0 text-decoration-none" type="button" data-bs-toggle="dropdown">
                                •••
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li><a class="dropdown-item" href="{{ route('tweets.edit', $tweet) }}">Edit</a></li>
                                <li>
                                    <form action="{{ route('tweets.destroy', $tweet) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this tweet?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="dropdown-item text-danger">Delete</button>
                                    </form>
                                </li>
                            </ul>
                        </div>
                    @endif
                </div>

                <p class="card-text fs-5">{{ $tweet->content }}</p>

                <div class="d-flex gap-3">
                    <form action="{{ route('tweets.like', $tweet) }}" method="POST">
                        @csrf
                        @php
                            $userHasLiked = $tweet->likes->contains('user_id', Auth::id());
                        @endphp

                        <button type="submit" class="btn btn-sm {{ $userHasLiked ? 'btn-danger' : 'btn-light text-danger' }} border border-danger">
                            {{ $userHasLiked ? '❤️' : '🤍' }} 
                            <span class="ms-1 fw-bold">{{ $tweet->likes_count }}</span>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    @endforeach
</x-app-layout>