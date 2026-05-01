<div class="min-h-screen bg-slate-50 p-4 md:p-8">
    <div class="max-w-6xl mx-auto">
        
        <!-- Dashboard Header -->
        <div class="mb-8">
            <h1 class="text-2xl font-extrabold text-slate-800 tracking-tight">System Dashboard</h1>
            <p class="text-slate-500 text-sm">Monitor your storage and account subscription status.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            
            <!-- Card 1: Subscription Status -->
            <div class="md:col-span-2 bg-white rounded-2xl shadow-sm border border-slate-200 p-6 flex flex-col justify-between">
                <div class="flex justify-between items-start">
                    <div>
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-bold <?php echo (isset($allData['is_trial']) && $allData['is_trial'] == 'yes') ? 'bg-blue-100 text-blue-700' : 'bg-emerald-100 text-emerald-700'; ?> uppercase tracking-wide">
                            <?php echo (isset($allData['is_trial']) && $allData['is_trial'] == 'yes') ? 'Trial Account' : 'Pro Subscription'; ?>
                        </span>
                        <h2 class="text-4xl font-black text-slate-800 mt-4">
                            <?php echo round($allData['daysLeft']); ?> <span class="text-lg font-medium text-slate-400">Days Remaining</span>
                        </h2>
                    </div>
                    <div class="p-3 bg-slate-50 rounded-xl">
                        <svg class="w-8 h-8 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                    </div>
                </div>
                
                <div class="mt-8 pt-6 border-t border-slate-100 flex items-center justify-between">
                    <p class="text-sm text-slate-500">
                        Need more time or features?
                    </p>
                    <a href="{{ route('upgrade-account') }}" class="px-6 py-2.5 bg-indigo-600 text-white text-sm font-bold rounded-xl hover:bg-indigo-700 transition-all shadow-md shadow-indigo-100">
                        Manage Plan[cite: 1]
                    </a>
                </div>
            </div>

            <!-- Card 2: Modified Storage Statistics -->
            <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-6">
                <h3 class="text-sm font-bold text-slate-400 uppercase tracking-widest mb-6">Storage Usage</h3>
                
                <div class="space-y-6">
                    <div>
                        <div class="flex justify-between text-sm mb-2">
                            <span class="font-bold text-slate-700">Total Files</span>
                            <!-- Replace with dynamic file count -->
                            <span class="text-slate-500"><?php echo number_format($totalFileCount ?? 0); ?> Files</span>
                        </div>
                        <div class="flex justify-between text-sm mb-2">
                            <span class="font-bold text-slate-700">Capacity</span>
                            <!-- Displays Usage in MB vs Limit -->
                            <span class="text-slate-500">
                                <?php echo round($totalMbUsage ?? 0, 2); ?> MB / <?php echo $maxStorageLimit ?? 500; ?> MB
                            </span>
                        </div>
                        
                        <!-- Progress Bar (Dynamic Width) -->
                        <?php 
                            $limit = $maxStorageLimit ?? 500;
                            $percentage = min((($totalMbUsage ?? 0) / $limit) * 100, 100);
                        ?>
                        <div class="w-full bg-slate-100 rounded-full h-2.5 mt-4">
                            <div class="bg-indigo-500 h-2.5 rounded-full transition-all duration-500" style="width: <?php echo $percentage; ?>%"></div>
                        </div>
                        <p class="text-[10px] text-slate-400 mt-2 font-medium uppercase tracking-tighter">
                            <?php echo round($percentage, 1); ?>% of your storage is occupied
                        </p>
                    </div>

                    <div class="pt-4 border-t border-slate-100 space-y-3">
                        <div class="flex items-center text-xs text-slate-500">
                            <div class="w-2 h-2 rounded-full bg-blue-500 mr-2"></div>
                            Photos: <?php echo round($photoMbUsage ?? 0, 2); ?> MB
                        </div>
                        <div class="flex items-center text-xs text-slate-500">
                            <div class="w-2 h-2 rounded-full bg-purple-500 mr-2"></div>
                            Videos: <?php echo round($videoMbUsage ?? 0, 2); ?> MB
                        </div>
                    </div>
                </div>
            </div>

            <!-- Card 3: Quick Action Grid -->
            <div class="md:col-span-3 grid grid-cols-2 md:grid-cols-4 gap-4 mt-2">
                <button class="p-4 bg-white border border-slate-200 rounded-2xl hover:border-indigo-300 hover:shadow-md transition-all flex flex-col items-center gap-2">
                    <div class="w-10 h-10 bg-indigo-50 text-indigo-600 rounded-full flex items-center justify-center">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                    </div>
                    <span class="text-xs font-bold text-slate-700">All Photos</span>
                </button>

                <button class="p-4 bg-white border border-slate-200 rounded-2xl hover:border-indigo-300 hover:shadow-md transition-all flex flex-col items-center gap-2">
                    <div class="w-10 h-10 bg-purple-50 text-purple-600 rounded-full flex items-center justify-center">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                    </div>
                    <span class="text-xs font-bold text-slate-700">All Videos</span>
                </button>

                <button class="p-4 bg-white border border-slate-200 rounded-2xl hover:border-indigo-300 hover:shadow-md transition-all flex flex-col items-center gap-2">
                    <div class="w-10 h-10 bg-emerald-50 text-emerald-600 rounded-full flex items-center justify-center">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M12 4v16m8-8H4"></path></svg>
                    </div>
                    <span class="text-xs font-bold text-slate-700">New Upload</span>
                </button>

                <button class="p-4 bg-white border border-slate-200 rounded-2xl hover:border-indigo-300 hover:shadow-md transition-all flex flex-col items-center gap-2">
                    <div class="w-10 h-10 bg-amber-50 text-amber-600 rounded-full flex items-center justify-center">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path></svg>
                    </div>
                    <span class="text-xs font-bold text-slate-700">Settings</span>
                </button>
            </div>
        </div>
    </div>
</div>