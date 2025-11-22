<x-app-layout>
    <div class="container py-4">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-sm border-0">
                    <div class="card-header bg-white fw-bold py-3">Edit Tweet</div>
                    
                    <div class="card-body">
                        <form action="{{ route('tweets.update', $tweet) }}" method="POST" 
                              x-data="{ content: '{{ $tweet->content }}' }">
                            @csrf
                            @method('PUT')
                            
                            <div class="mb-3">
                                <textarea 
                                    name="content" 
                                    x-model="content"
                                    class="form-control @error('content') is-invalid @enderror" 
                                    rows="4" 
                                    required 
                                    maxlength="280"
                                ></textarea>
                                @error('content')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="d-flex justify-content-between align-items-center">
                                <small class="fw-bold" 
                                       :class="content.length > 250 ? 'text-danger' : 'text-muted'">
                                    <span x-text="content.length"></span> / 280
                                </small>

                                <div class="d-flex gap-2">
                                    <a href="{{ route('tweets.index') }}" class="btn btn-light">Cancel</a>
                                    <button type="submit" class="btn btn-primary px-4"
                                            :disabled="content.length === 0 || content.length > 280">
                                        Update Tweet
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
