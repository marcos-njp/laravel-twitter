<x-app-layout>
    <div class="card shadow-sm">
        <div class="card-header bg-white fw-bold">Edit Tweet</div>
        <div class="card-body">
            <form action="{{ route('tweets.update', $tweet) }}" method="POST">
                @csrf
                @method('PUT')
                
                <div class="mb-3">
                    <textarea 
                        name="content" 
                        class="form-control @error('content') is-invalid @enderror" 
                        rows="3" 
                        required 
                        maxlength="280"
                    >{{ old('content', $tweet->content) }}</textarea>
                    @error('content')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="d-flex justify-content-end gap-2">
                    <a href="{{ route('tweets.index') }}" class="btn btn-secondary">Cancel</a>
                    <button type="submit" class="btn btn-primary">Update Tweet</button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>