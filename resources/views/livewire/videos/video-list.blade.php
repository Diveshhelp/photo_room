<div class="mx-auto py-2 sm:px-6 lg:px-8" x-data="{
    showModal: false,
    todo: {
        status: '',  
        priority: '',  
        
    },    
    init() {
        this.$wire.on('show-todo-details', (data) => {
            console.log(data[0].todoData);
            this.todo = data[0].todoData;
            this.showModal = true;
        });
    },
    downloading: false,
    downloadFile(attachmentId) {
        this.downloading = true;
        this.$wire.downloadFile(attachmentId)
            .then(() => {
                this.downloading = false;
            })
            .catch(() => {
                this.downloading = false;
            });
    },

}" @keydown.escape.window="showModal = false" x-cloak>
    <div class="flex items-center justify-between">
        <div class="min-w-0 flex-1">
            <h3 class="text-sm md:text-lg font-medium text-gray-900 truncate">{{ $moduleTitle }} List</h3>
            <p class=" md:block mt-2 text-sm text-gray-600 leading-relaxed">
                Manage your videos efficiently
            </p>
        </div>
        <div class="ml-2 md:ml-4">
            <a href="{{ route('videos') }}"
                class="px-2 py-1 text-white hover:dark:text-dark-bg before:[content:''] relative z-[5] before:absolute before:left-0 before:h-full bg-primary dark:bg-secondary before:bg-secondary before:dark:bg-white hover:text-white no-underline transition-all ease-in-out duration-300 hover:before:w-full before:transition-all before:ease-in-out before:duration-300 before:z-[-1] flex justify-center items-center text-xs md:text-sm font-semibold before:w-0 border-0">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 md:h-5 md:w-5 mr-1 md:mr-2" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                </svg>
                <span class="hidden sm:inline">Add New Video</span>
                <span class="inline sm:hidden">Add</span>
            </a>
        </div>
    </div>
    <div x-data="{
    showFilters: false,
    search: @entangle('searchTitle'),
    priority: @entangle('filterPriority'),
    status: @entangle('filterStatus'),
    dueDate: @entangle('filterDueDate')
}" class="mt-2" wire:key="todo-manager-module-{{ time() }}">


              <!-- Todo List Table -->
        <div class="bg-white rounded-lg shadow overflow-hidden">
            <div>
                @if (session()->has('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif

                @if (session()->has('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif

                <!-- Rest of your todos list content -->
            </div>
            <div
                class="bg-white dark:bg-gray-950 p-6 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-800">
                <div class="flex justify-between items-center mb-6">
                    <h3 class="text-xl font-bold text-gray-900 dark:text-white">Recent Uploads</h3>
                    <div class="flex gap-2">
                        <button class="p-2 text-gray-400 hover:text-indigo-600"><i
                                class="bi bi-grid-3x3-gap-fill"></i></button>
                        <button class="p-2 text-gray-400 hover:text-indigo-600"><i class="bi bi-sort-down"></i></button>
                    </div>
                </div>

             <div class="p-6">
    
    <div x-data="{ 
        open: false, 
        currentIndex: 0, 
        attachments: [],
        openModal(photoAttachments, index) {
            this.attachments = photoAttachments;
            this.currentIndex = index;
            this.open = true;
        },
        next() {
            this.currentIndex = (this.currentIndex + 1) % this.attachments.length;
        },
        prev() {
            this.currentIndex = (this.currentIndex - 1 + this.attachments.length) % this.attachments.length;
        },
        {{-- Helper to check if the current file is a video --}}
        isVideo(path) {
            if(!path) return false;
            const videoExtensions = ['mp4', 'webm', 'ogg', 'mov'];
            const extension = path.split('.').pop().toLowerCase();
            return videoExtensions.includes(extension);
        }
    }" class="relative">

        {{-- Album Loop --}}
        <div class="space-y-6">
            @foreach($photos as $photo)
                <div class="album-group mb-8">
                    {{-- Enhanced Header --}}
                    <div class="flex items-center justify-between border-b border-gray-100 pb-2 mb-3 px-1">
                        <div class="flex items-baseline gap-2">
                            <h3 class="text-base font-bold text-gray-900 tracking-tight">{{ $photo->album_title }}</h3>
                            <span class="text-gray-300">•</span>
                            <span class="text-xs font-medium text-gray-500">{{ $photo->created_at->format('M d, Y') }}</span>
                            <div class="inline-flex items-center ml-2">
                                                <button type="button" wire:click="confirmDelete({{ $photo->id }})"
                                                    wire:confirm="Are you sure you want to delete this album?"
                                                    wire:loading.remove wire:target="confirmDelete({{ $photo->id }})"
                                                    class="text-gray-400 hover:text-red-600 transition-colors duration-200"
                                                    title="Delete Album">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2"
                                                        viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0">
                                                        </path>
                                                    </svg>
                                                </button>

                                                <div wire:loading wire:target="confirmDelete({{ $photo->id }})">
                                                    <svg class="animate-spin h-4 w-4 text-indigo-600"
                                                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                                        <circle class="opacity-25" cx="12" cy="12" r="10"
                                                            stroke="currentColor" stroke-width="4"></circle>
                                                        <path class="opacity-75" fill="currentColor"
                                                            d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                                                        </path>
                                                    </svg>
                                                </div>
                                            </div>
                        </div>
                         <div
                                            class="flex items-center gap-1.5 px-2 py-0.5 rounded-full bg-indigo-50 border border-indigo-100 text-[10px] font-bold text-indigo-600 uppercase tracking-tight shadow-sm">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                                                class="size-3">
                                                <path fill-rule="evenodd"
                                                    d="M1 5.25A2.25 2.25 0 0 1 3.25 3h13.5A2.25 2.25 0 0 1 19 5.25v9.5A2.25 2.25 0 0 1 16.75 17H3.25A2.25 2.25 0 0 1 1 14.75v-9.5Zm1.5 0v9.5c0 .414.336.75.75.75h13.5a.75.75 0 0 0 .75-.75v-9.5a.75.75 0 0 0-.75-.75H3.25a.75.75 0 0 0-.75.75ZM3.5 12.75l3.5-3.5 4.25 4.25 3.5-3.5 1.75 1.75v-5.5a.25.25 0 0 0-.25-.25H3.75a.25.25 0 0 0-.25.25v6.5Z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                            <span>{{ $photo->attachments->count() }} Videos</span>
                                        </div>
                    </div>

                    {{-- Grid Container --}}
                    <div class="flex flex-wrap gap-1.5">
                        @php
                            $jsAttachments = $photo->attachments->map(fn($a) => asset('storage/'.$a->file_path));
                        @endphp

                        @foreach($photo->attachments as $index => $attachment)
                            @php 
                                $isVid = in_array(pathinfo($attachment->file_path, PATHINFO_EXTENSION), ['mp4', 'webm', 'ogg', 'mov']); 
                            @endphp
                            
                            <div wire:key="attachment-{{ $attachment->id }}" 
                                 @click="openModal({{ $jsAttachments->toJson() }}, {{ $index }})"
                                 class="group relative h-20 w-20 flex-shrink-0 cursor-pointer overflow-hidden rounded-md bg-black shadow-sm transition-all hover:ring-2 hover:ring-indigo-500">
                                
                                @if($isVid)
                                    {{-- Video Thumbnail --}}
                                    <video class="size-full object-cover opacity-80 group-hover:opacity-100 transition-opacity">
                                        <source src="{{ asset('storage/'. $attachment->file_path) }}#t=0.1">
                                    </video>
                                    <div class="absolute inset-0 flex items-center justify-center pointer-events-none">
                                        <i class="bi bi-play-fill text-white text-xl"></i>
                                    </div>
                                @else
                                    {{-- Image Thumbnail --}}
                                    <img src="{{ asset('storage/'. $attachment->file_path) }}" 
                                         class="size-full object-cover transition-transform duration-500 group-hover:scale-110" loading="lazy">
                                @endif

                                                <button type="button" wire:click.stop="deleteAttachment({{ $attachment->id }})"
                                                    wire:confirm="Are you sure you want to remove this video?"
                                                    class="absolute top-1 right-1 z-10 hidden group-hover:flex h-5 w-5 items-center justify-center rounded-full bg-white text-red-600 shadow-md hover:bg-red-600 hover:text-white transition-colors"
                                                    title="Remove Photo">
                                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                                        fill="currentColor" class="size-3.5">
                                                        <path
                                                            d="M6.28 5.22a.75.75 0 0 0-1.06 1.06L8.94 10l-3.72 3.72a.75.75 0 1 0 1.06 1.06L10 11.06l3.72 3.72a.75.75 0 1 0 1.06-1.06L11.06 10l3.72-3.72a.75.75 0 0 0-1.06-1.06L10 8.94 6.28 5.22Z" />
                                                    </svg>
                                                </button>

                                                <div wire:loading wire:target="deleteAttachment({{ $attachment->id }})"
                                                    class="absolute inset-0 flex items-center justify-center bg-white/50">
                                                    <div
                                                        class="h-4 w-4 animate-spin rounded-full border-2 border-indigo-600 border-t-transparent">
                                                    </div>
                                                </div>
                                <div class="absolute inset-0 bg-black/0 group-hover:bg-black/10 transition-colors"></div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endforeach
        </div>        
        <div x-show="open" 
             x-transition.opacity
             @keydown.escape.window="open = false"
             @keydown.right.window="next()"
             @keydown.left.window="prev()"
             class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/95 backdrop-blur-sm"
             style="display: none;">
            
            <button @click="open = false" class="absolute top-5 right-5 text-white/70 hover:text-white z-[60]">
                <i class="bi bi-x-lg text-3xl"></i>
            </button>

            <div class="relative w-full h-full flex items-center justify-center">
                {{-- Navigation --}}
                <template x-if="attachments.length > 1">
                    <div class="absolute inset-x-0 flex justify-between px-4 z-50">
                        <button @click="prev()" class="p-3 rounded-full bg-white/10 text-white hover:bg-white/20 transition">
                            <i class="bi bi-chevron-left text-2xl"></i>
                        </button>
                        <button @click="next()" class="p-3 rounded-full bg-white/10 text-white hover:bg-white/20 transition">
                            <i class="bi bi-chevron-right text-2xl"></i>
                        </button>
                    </div>
                </template>

                {{-- Dynamic Media Player --}}
                <div class="max-h-[90vh] max-w-full flex items-center justify-center">
                    {{-- If Video --}}
                    <template x-if="isVideo(attachments[currentIndex])">
                        <video :src="attachments[currentIndex]" 
                               controls 
                               autoplay 
                               class="max-h-[90vh] rounded shadow-2xl">
                        </video>
                    </template>

                    {{-- If Image --}}
                    <template x-if="!isVideo(attachments[currentIndex])">
                        <img :src="attachments[currentIndex]" 
                             class="max-h-[90vh] max-w-full rounded shadow-2xl object-contain">
                    </template>
                </div>

                <div class="absolute bottom-5 bg-black/50 px-3 py-1 rounded-full text-white/80 text-sm">
                    <span x-text="currentIndex + 1"></span> / <span x-text="attachments.length"></span>
                </div>
            </div>
        </div>
    </div>
</div>

                 
                {{ $photos->links() }}
                </div>
            </div>
        </div>
    </div>
</div>