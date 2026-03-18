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
                Manage your photos efficiently
            </p>
        </div>
        <div class="ml-2 md:ml-4">
            <a href="{{ route('todos') }}"
                class="px-2 py-1 text-white hover:dark:text-dark-bg before:[content:''] relative z-[5] before:absolute before:left-0 before:h-full bg-primary dark:bg-secondary before:bg-secondary before:dark:bg-white hover:text-white no-underline transition-all ease-in-out duration-300 hover:before:w-full before:transition-all before:ease-in-out before:duration-300 before:z-[-1] flex justify-center items-center text-xs md:text-sm font-semibold before:w-0 border-0">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 md:h-5 md:w-5 mr-1 md:mr-2" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                </svg>
                <span class="hidden sm:inline">Add New Photo</span>
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

        <!-- Filter Toggle Button -->
        <a @click="showFilters = !showFilters"
            class="w-full mb-4 inline-flex items-center justify-between px-3 py-2 border border-gray-300 shadow-sm text-sm leading-4 font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
            <div class="flex items-center p-3">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z" />
                </svg>
                <span x-text="showFilters ? 'Hide Filters' : 'Show Filters'"></span>

                <!-- Active filters counter -->
                <span x-show="search || priority || status || dueDate"
                    class="ml-2 text-xs bg-blue-600 text-white px-2 py-0.5 rounded-full">
                    <span x-text="[search, priority, status, dueDate].filter(Boolean).length"></span>
                </span>
            </div>
            <!-- Toggle arrow -->
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 transition-transform duration-200"
                :class="showFilters ? 'rotate-180' : ''" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
            </svg>
        </a>

        <!-- Filter Panel -->
        <div x-show="showFilters" x-transition:enter="transition ease-out duration-200"
            x-transition:enter-start="opacity-0 transform scale-95"
            x-transition:enter-end="opacity-100 transform scale-100" x-transition:leave="transition ease-in duration-75"
            x-transition:leave-start="opacity-100 transform scale-100"
            x-transition:leave-end="opacity-0 transform scale-95" class="bg-white p-4 rounded-lg shadow-md mb-6">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                <!-- Search -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Search</label>
                    <input type="text" wire:model="searchTitle"
                        class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                        placeholder="Search todos...">
                </div>

                <!-- Priority Filter -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Priority</label>
                    <select wire:model="filterPriority"
                        class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                        <option value="">All Priorities</option>
                        <option value="high">High</option>
                        <option value="medium">Medium</option>
                        <option value="low">Low</option>
                    </select>
                </div>

                <!-- Status Filter -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                    <select wire:model="filterStatus"
                        class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                        <option value="">All Status</option>
                        <option value="not_started">Not Started</option>
                        <option value="in_progress">In Progress</option>
                        <option value="completed">Completed</option>
                        <option value="cancelled">Cancelled</option>
                    </select>
                </div>

                <!-- Due Date Filter -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Due Date</label>
                    <select wire:model="filterDueDate"
                        class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                        <option value="">All Dates</option>
                        <option value="today">Today</option>
                        <option value="week">This Week</option>
                        <option value="month">This Month</option>
                        <option value="overdue">Overdue</option>
                    </select>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="mt-4 flex justify-end space-x-2">
                <button wire:click="resetFilters"
                    class="px-2 py-1 text-white hover:dark:text-dark-bg before:[content:''] relative z-[5] before:absolute before:left-0 before:h-full bg-primary dark:bg-secondary before:bg-secondary before:dark:bg-white hover:text-white no-underline transition-all ease-in-out duration-300 hover:before:w-full before:transition-all before:ease-in-out before:duration-300 before:z-[-1] flex justify-center items-center text-sm font-semibold before:w-0 border-0">
                    Clear
                </button>
                <button wire:click="applyFilters"
                    class="px-2 py-1 text-white hover:dark:text-dark-bg before:[content:''] relative z-[5] before:absolute before:left-0 before:h-full bg-primary dark:bg-secondary before:bg-secondary before:dark:bg-white hover:text-white no-underline transition-all ease-in-out duration-300 hover:before:w-full before:transition-all before:ease-in-out before:duration-300 before:z-[-1] flex justify-center items-center text-sm font-semibold before:w-0 border-0">
                    <svg class="h-4 w-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                    Search
                </button>

            </div>
        </div>

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

                <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 xl:grid-cols-6 gap-4">

                    <div class="group relative flex flex-col cursor-pointer">
                        <div
                            class="relative aspect-square overflow-hidden rounded-xl bg-gray-100 shadow-sm transition-all group-hover:ring-2 group-hover:ring-indigo-500">
                            <img src="https://images.unsplash.com/photo-1501785888041-af3ef285b470?auto=format&fit=crop&w=500&q=80"
                                class="absolute inset-0 size-full object-cover">

                            <div
                                class="absolute top-2 left-2 size-5 rounded-full border-2 border-white bg-black/10 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center">
                                <i class="bi bi-check text-white text-xs"></i>
                            </div>

                            <div
                                class="absolute inset-x-0 bottom-0 h-1/3 bg-gradient-to-t from-black/60 to-transparent opacity-0 group-hover:opacity-100 transition-opacity flex items-end p-2">
                                <p class="text-[10px] text-white font-medium truncate">IMG_8492.jpg</p>
                            </div>
                        </div>

                        <div class="mt-2">
                            <p class="text-xs font-semibold text-gray-900 dark:text-gray-100 truncate">Maui Vacation</p>
                            <div class="flex items-center gap-1 text-[10px] text-gray-500">
                                <i class="bi bi-cloud-check"></i>
                                <span>Uploaded Oct 12</span>
                            </div>
                        </div>
                    </div>

                    <div class="group relative flex flex-col cursor-pointer">
                        <div
                            class="relative aspect-square overflow-hidden rounded-xl bg-gray-100 shadow-sm transition-all group-hover:ring-2 group-hover:ring-indigo-500">
                            <img src="https://images.unsplash.com/photo-1533174072545-7a4b6ad7a6c3?auto=format&fit=crop&w=500&q=80"
                                class="absolute inset-0 size-full object-cover brightness-90">

                            <div
                                class="absolute bottom-2 right-2 px-1.5 py-0.5 rounded bg-black/70 text-white text-[9px] font-bold">
                                0:45
                            </div>

                            <div class="absolute inset-0 flex items-center justify-center">
                                <i
                                    class="bi bi-play-fill text-white text-3xl opacity-80 group-hover:scale-110 transition-transform"></i>
                            </div>
                        </div>

                        <div class="mt-2">
                            <p class="text-xs font-semibold text-gray-900 dark:text-gray-100 truncate">Night City Vlog
                            </p>
                            <div class="flex items-center gap-1 text-[10px] text-gray-500">
                                <i class="bi bi-camera-video"></i>
                                <span>Uploaded Oct 14</span>
                            </div>
                        </div>
                    </div>

                    <div class="group relative flex flex-col cursor-pointer">
                        <div
                            class="relative aspect-square overflow-hidden rounded-xl bg-gray-100 shadow-sm transition-all group-hover:ring-2 group-hover:ring-indigo-500">
                            <img src="https://images.unsplash.com/photo-1472396961693-142e6e269027?auto=format&fit=crop&w=500&q=80"
                                class="absolute inset-0 size-full object-cover">
                            <div
                                class="absolute top-2 left-2 size-5 rounded-full border-2 border-white bg-black/10 opacity-0 group-hover:opacity-100 transition-opacity">
                            </div>
                        </div>
                        <div class="mt-2">
                            <p class="text-xs font-semibold text-gray-900 dark:text-gray-100 truncate">Forest Trail</p>
                            <p class="text-[10px] text-gray-500">Uploaded Oct 15 • 4.2 MB</p>
                        </div>
                    </div>

                    <div class="group flex flex-col">
                        <div
                            class="aspect-square rounded-xl border-2 border-dashed border-gray-200 dark:border-gray-800 flex flex-col items-center justify-center hover:bg-gray-50 dark:hover:bg-gray-800 transition-colors cursor-pointer">
                            <i
                                class="bi bi-plus-circle text-gray-300 group-hover:text-indigo-500 text-2xl transition-colors"></i>
                        </div>
                        <div class="mt-2 text-center">
                            <p class="text-xs font-bold text-gray-400">New Upload</p>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>