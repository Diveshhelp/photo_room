<div class="max-w-7xl mx-auto p-6">
    <!-- Header Section -->
    <div class="mb-8 flex items-end justify-between">
        <div>
            <h1 class="text-3xl font-bold text-gray-900">{{ $album->name ?? 'Album Gallery' }}</h1>
            <p class="text-sm text-gray-500 mt-1">
                Created {{ $album->created_at->format('M d, Y') }} • {{ $album->attachments->count() }} Photos
            </p>
        </div>
        
        <a href="{{ route('my-photos') }}" class="text-sm font-medium text-indigo-600 hover:text-indigo-500">
            &larr; Back to Albums
        </a>
    </div>

    <!-- Photo Grid -->
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
        @forelse($album->attachments as $photo)
            <div class="group relative aspect-square overflow-hidden rounded-xl bg-gray-100 shadow-sm border border-gray-200">
                <img 
                    {{-- Note: we use 'storage/' because of the php artisan storage:link --}}
                    src="{{ asset('storage/' . $photo->file_path) }}" 
                    alt="Album Photo"
                    class="h-full w-full object-cover transition-transform duration-300 group-hover:scale-110"
                    onerror="this.src='https://placehold.co/600x600?text=Image+Not+Found'"
                >
                
                <!-- Hover Overlay -->
                <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center">
                    <a href="{{ asset('storage/' . $photo->file_path) }}" target="_blank" class="px-4 py-2 bg-white text-gray-900 text-xs font-bold rounded-lg shadow-lg">
                        VIEW FULL SIZE
                    </a>
                </div>
            </div>
        @empty
            <div class="col-span-full py-20 text-center border-2 border-dashed border-gray-200 rounded-2xl">
                <p class="text-gray-400">This album is currently empty.</p>
            </div>
        @endforelse
    </div>
</div>