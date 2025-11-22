<x-app-layout>
    <div class="card mb-4 shadow-sm border-0">
        <div class="card-body text-center bg-white rounded">
            <div class="mb-3">
                <div class="rounded-circle bg-secondary text-white d-flex align-items-center justify-content-center mx-auto" style="width: 100px; height: 100px; font-size: 2.5rem;">
                    {{ substr($user->name, 0, 1) }}
                </div>
            </div>
            
            <h3 class="fw-bold mb-1">{{ $user->name }}</h3>
            <p class="text-muted mb-2">Joined {{ $user->created_at->format('F Y') }}</p>

            @if($user->bio)
                <p class="mb-3 mx-auto text-dark" style="max-width: 500px;">
                    {{ $user->bio }}
                </p>
            @endif

            <div class="d-flex justify-content-center gap-4 border-top pt-3">
                <div class="text-center">
                    <h5 class="fw-bold mb-0">{{ $tweetCount }}</h5>
                    <small class="text-muted">Tweets</small>
                </div>
                <div class="text-center">
                    <h5 class="fw-bold mb-0">{{ $receivedLikesCount }}</h5>
                    <small class="text-muted">Likes Received</small>
                </div>
            </div>
        </div>
    </div>

    <h4 class="mb-3 fw-bold">Tweets</h4>

    @forelse ($tweets as $tweet)
        <div class="card mb-3 shadow-sm">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <h6 class="card-subtitle mb-2 text-muted fw-bold">
                        {{ $tweet->user->name }} 
                        <span class="fw-normal small text-muted">· {{ $tweet->created_at->diffForHumans() }}</span>
                    </h6>
                </div>
                <p class="card-text fs-5">{{ $tweet->content }}</p>
                <div class="d-flex gap-3">
                    <span class="text-muted">❤️ {{ $tweet->likes_count }}</span>
                </div>
            </div>
        </div>
    @empty
        <div class="text-center py-4 text-muted">
            This user hasn't tweeted yet.
        </div>
    @endforelse
</x-app-layout>