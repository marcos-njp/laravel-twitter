<x-app-layout>
    <div class="card mb-4 shadow-sm border-0">
        <div class="card-body text-center bg-white rounded p-5">
            
            <div class="mb-3">
                <div class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center mx-auto shadow" 
                     style="width: 80px; height: 80px; font-size: 2rem;">
                    {{ substr($user->name, 0, 1) }}
                </div>
            </div>
            
            <h3 class="fw-bold mb-1">{{ $user->name }}</h3>
            
            <p class="text-muted mb-3">Joined {{ $user->created_at->format('F d, Y') }}</p>
            
            @if($user->bio)
                <p class="text-dark mx-auto mb-4" style="max-width: 500px;">{{ $user->bio }}</p>
            @endif

            <div class="d-flex justify-content-center gap-5 border-top pt-4">
                <div class="text-center">
                    <h4 class="fw-bold mb-0">{{ $tweetCount }}</h4>
                    <small class="text-muted text-uppercase fw-bold" style="font-size: 0.75rem;">Tweets</small>
                </div>
                <div class="text-center">
                    <h4 class="fw-bold mb-0">{{ $receivedLikesCount }}</h4>
                    <small class="text-muted text-uppercase fw-bold" style="font-size: 0.75rem;">Likes Received</small>
                </div>
            </div>
        </div>
    </div>

    <h5 class="mb-3 fw-bold ps-2">Tweets</h5>
    
    @forelse ($tweets as $tweet)
        <div class="card mb-3 shadow-sm">
             <div class="card-body">
                <div class="d-flex justify-content-between">
                    <h6 class="card-subtitle mb-2 fw-bold text-dark">
                        {{ $tweet->user->name }}
                        <span class="fw-normal text-muted small">· {{ $tweet->created_at->diffForHumans() }}</span>
                        @if($tweet->is_edited)
                            <span class="small text-muted fst-italic"> (edited)</span>
                        @endif
                    </h6>
                </div>
                
                <p class="card-text fs-5">{{ $tweet->content }}</p>
                
                <div class="text-muted small">
                    ❤️ {{ $tweet->likes_count }} Likes
                </div>
             </div>
        </div>
    @empty
        <div class="text-center py-5 text-muted">
            <p>This user hasn't posted any tweets yet.</p>
        </div>
    @endforelse
</x-app-layout>