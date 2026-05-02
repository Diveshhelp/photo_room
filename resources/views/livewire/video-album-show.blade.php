<div class="max-w-7xl mx-auto p-6">
    <!-- Header Section -->
    <div class="mb-8 flex items-end justify-between">
        <div>
            <!-- Updated Title to reflect Videos -->
            <h1 class="text-3xl font-bold text-gray-900">{{ $album->name ?? 'Video Gallery' }}</h1>
            <p class="text-sm text-gray-500 mt-1">
                Created {{ $album->created_at->format('M d, Y') }} • {{ $album->attachments->count() }} Videos
            </p>
        </div>
        
        <a href="{{ route('my-photos') }}" class="text-sm font-medium text-indigo-600 hover:text-indigo-500">
            &larr; Back to Albums
        </a>
    </div>

    <!-- Video Grid -->
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
        @forelse($album->attachments as $video)
            <div class="group relative aspect-square overflow-hidden rounded-xl bg-black shadow-sm border border-gray-200">
                <!-- Video Element -->
                <video 
                    src="{{ asset('storage/' . $video->file_path) }}" 
                    class="h-full w-full object-cover transition-transform duration-300 group-hover:scale-105"
                    muted
                    onmouseover="this.play()" 
                    onmouseout="this.pause(); this.currentTime = 0;"
                >
                    Your browser does not support the video tag.
                </video>

                <!-- Play Icon Overlay (Visible when not hovering) -->
                <div class="absolute inset-0 flex items-center justify-center pointer-events-none group-hover:opacity-0 transition-opacity">
                    <div class="bg-white/20 backdrop-blur-md p-3 rounded-full">
                        <svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M8 5v14l11-7z" />
                        </svg>
                    </div>
                </div>
                
                <!-- Hover Action Overlay -->
                <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center">
                    <a href="{{ asset('storage/' . $video->file_path) }}" target="_blank" class="px-4 py-2 bg-white text-gray-900 text-xs font-bold rounded-lg shadow-lg">
                        WATCH FULL SCREEN
                    </a>
                </div>
            </div>
        @empty
            <div class="col-span-full py-20 text-center border-2 border-dashed border-gray-200 rounded-2xl">
                <p class="text-gray-400">This video album is currently empty.</p>
            </div>
        @endforelse
    </div>
</div>