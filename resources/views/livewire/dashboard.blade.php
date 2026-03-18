<div class="p-3 dark:bg-dark-bg dark:border dark:border-gray-500 rounded-lg bg-white">
<div class="flex justify-between items-start w-full">
  <!-- Left Side: Tasks & Activities -->
  <div class="flex items-center gap-1 mb-1">
    <h1 class="font-semibold text-base text-dark-bg dark:text-white">Photos & Videos</h1>
    <span class="px-1.5 py-0.5 text-xs rounded-full bg-yellow-600 text-white">Active</span>
    <!-- Help Button -->
    <button
        @mouseenter="showTooltip = true"
        @mouseleave="showTooltip = false"
        @click="$dispatch('open-help-modal')"
        class="relative group bg-gradient-to-r from-indigo-500 to-purple-500 text-white rounded-full p-1.5 flex items-center justify-center focus:outline-none focus:ring-2 focus:ring-offset-1 focus:ring-indigo-400 shadow-md hover:shadow-lg transition-all duration-200"
    >
        <!-- Constant Pulsing Background Effect -->
        <span class="absolute inset-0 rounded-full bg-indigo-400 opacity-30 animate-ping"></span>
        
        <!-- Constant Glowing Ring Effect -->
        <span class="absolute inset-0 rounded-full border-2 border-white opacity-30 animate-pulse"></span>
        
        <!-- Icon with subtle bounce animation -->
        <svg class="w-3.5 h-3.5 z-10 animate-bounce" style="animation-duration: 2s;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
        </svg>
    </button>
   
    <div 
        x-data="{ isOpen: false, copied: false }"
        class="relative inline-block"
    >
        {{-- Refer Program Icon Button --}}
        <button
            @click="isOpen = !isOpen"
            class="relative group bg-gradient-to-r from-blue-500 to-indigo-600 text-white rounded-full p-2 flex items-center justify-center focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-400 shadow-md hover:shadow-lg transition-all duration-200"
        >
            {{-- Ping Animation --}}
            <span class="absolute inset-0 rounded-full bg-indigo-400 opacity-30 animate-ping"></span>
            
            {{-- Glowing Ring --}}
            <span class="absolute inset-0 rounded-full border-2 border-white opacity-30 animate-pulse"></span>
            
            {{-- Share Icon --}}
            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 z-10" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.368 2.684 3 3 0 00-5.368-2.684z" />
            </svg>
        </button>

        {{-- Dropdown Menu --}}
        <div
            x-show="isOpen"
            @click.away="isOpen = false"
            x-transition:enter="transition ease-out duration-200"
            x-transition:enter-start="opacity-0 scale-95"
            x-transition:enter-end="opacity-100 scale-100"
            x-transition:leave="transition ease-in duration-150"
            x-transition:leave-start="opacity-100 scale-100"
            x-transition:leave-end="opacity-0 scale-95"
            class="absolute right-0 mt-2 w-64 origin-top-right rounded-md bg-white shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none z-50"
        >
            <div class="p-4">
                <h3 class="text-lg font-medium text-gray-900">Refer a Friend</h3>
                <p class="mt-1 text-sm text-gray-500">Share the link below and earn rewards for every friend who joins!</p>
                
                {{-- Referral Link --}}
                <div class="mt-3 flex">
                    <input
                        type="text"
                        value="{{ route('register', ['code' => base64_encode(auth()->user()->email) ?? '']) }}"
                        class="flex-1 rounded-l-md border border-gray-300 px-3 py-2 text-sm focus:border-indigo-500 focus:outline-none focus:ring-1 focus:ring-indigo-500 bg-gray-50"
                        readonly
                    />
                    <button
                        wire:click="copyReferralLink"
                        @click="copied = true; setTimeout(() => copied = false, 2000)"
                        class="inline-flex items-center rounded-r-md border border-l-0 border-gray-300 bg-gray-50 px-3 py-2 text-sm font-medium text-gray-700 hover:bg-gray-100 focus:outline-none"
                    >
                        <template x-if="!copied">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z" />
                            </svg>
                        </template>
                        <template x-if="copied">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                        </template>
                    </button>
                </div>
                
                <div class="mt-3">
                    <p class="text-xs text-gray-500">Share via:</p>
                    <div class="mt-2 flex space-x-2">
                       
                        
                        {{-- Email --}}
                        <a href="mailto:?subject=Join me!&body=Check out this amazing platform: {{ route('register', ['code' => auth()->user()->referral_code ?? 'USER123']) }}" class="inline-flex h-8 w-8 items-center justify-center rounded-full bg-gray-100 hover:bg-gray-200">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-700" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                            </svg>
                        </a>
                    </div>
                </div>
                
                <div class="mt-4 pt-3 border-t border-gray-200">
                    <a href="" class="text-sm text-indigo-600 hover:text-indigo-800">
                        View your referral stats →
                    </a>
                </div>
            </div>
        </div>
    </div>
  </div>

    <!-- Right Side: Plan Information -->
    <div class="hidden md:block md:ml-auto">
        <div class="relative overflow-hidden group">
            <!-- Main Container with Glass Morphism -->
            <div class="flex items-center gap-4 bg-gradient-to-r <?php echo (isset($allData['is_trial']) && $allData['is_trial'] == "yes") ? 'from-blue-400/90 to-indigo-500/90' : 'from-emerald-400/90 to-teal-500/90'; ?> backdrop-blur-md p-3 pr-5 rounded-lg shadow-lg transform transition-all duration-300 group-hover:scale-[1.02] border border-white/20">
            
            <!-- Animated Glow Effect -->
            <div class="absolute -inset-1 bg-gradient-to-r <?php echo (isset($allData['is_trial']) && $allData['is_trial'] == "yes") ? 'from-blue-600 via-indigo-400 to-blue-600' : 'from-emerald-600 via-teal-400 to-emerald-600'; ?> opacity-30 blur-xl group-hover:opacity-50 animate-pulse" style="animation-duration: 3s;"></div>
            
            <!-- Plan Icon with Floating Animation -->
            <div class="relative z-10 <?php echo (isset($allData['is_trial']) && $allData['is_trial'] == "yes") ? 'bg-blue-50' : 'bg-emerald-50'; ?> p-3 rounded-full shadow-md animate-float">
                <?php if(isset($allData['is_trial']) && $allData['is_trial'] == "yes") { ?>
                <!-- Trial Icon with Subtle Animation -->
                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" class="animate-dash" style="animation-duration: 8s;" />
                </svg>
                <?php } else { ?>
                <!-- Pro Icon with Subtle Animation -->
                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-emerald-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" class="animate-dash" style="animation-duration: 8s;" />
                </svg>
                <?php } ?>
                
                <!-- Pulsing Circle Indicator -->
                <span class="absolute top-0 right-0 h-3 w-3 <?php echo (isset($allData['is_trial']) && $allData['is_trial'] == "yes") ? 'bg-blue-500' : 'bg-emerald-500'; ?> rounded-full animate-ping-slow"></span>
            </div>
            
            <!-- Plan Information with Text Animations -->
            <div class="relative z-10 text-white">
                <?php if(isset($allData['is_trial']) && $allData['is_trial'] == "yes") { ?>

                    <?php if(round($allData['daysLeft'])>0) {?> 
                        <h2 class="font-bold text-base tracking-wide text-shadow-sm">TRIAL ACTIVATED</h2>
                        <?php }else{ ?>
                            <h2 class="font-bold text-base tracking-wide text-shadow-sm">TRIAL EXPIRED</h2>
                    <?php } ?>

                <?php } else { ?>
                       <?php if(round($allData['daysLeft'])>0) {?> 
                            <h2 class="font-bold text-base tracking-wide text-shadow-sm">PRO ACTIVATED</h2>
                        <?php }else{ ?>
                            <h2 class="font-bold text-base tracking-wide text-shadow-sm">PRO EXPIRED</h2>
                    <?php } ?>
                
                <?php } ?>
                
                <!-- Shimmering Days Remaining -->
                <div class="flex items-center gap-2 mt-0.5">
                <div class="relative bg-white/30 backdrop-blur-sm rounded-full px-3 py-0.5">
                    <span class="text-sm font-medium text-white"><?php echo round($allData['daysLeft']); ?> days remaining</span>
                    <!-- Shimmering Overlay -->
                    <div class="absolute inset-0 bg-gradient-to-r from-transparent via-white/30 to-transparent shimmer-effect rounded-full"></div>
                </div>
                </div>
            </div>
            
            <!-- Interactive Manage Button -->
            <a href="{{ route('upgrade-account') }}" class="relative z-10 ml-1 bg-white text-sm font-semibold rounded-md py-2 px-4 shadow-md hover:shadow-lg transition-all duration-300 <?php echo (isset($allData['is_trial']) && $allData['is_trial'] == "yes") ? 'text-blue-700 hover:bg-blue-50' : 'text-emerald-700 hover:bg-emerald-50'; ?> overflow-hidden group-hover:scale-105">
                <span class="relative z-10">Manage Plan</span>
                <!-- Button Shine Animation -->
                <div class="absolute inset-0 translate-x-full group-hover:translate-x-[-180%] transition-transform duration-1000 bg-gradient-to-r from-transparent via-white to-transparent shine-effect"></div>
            </a>
            
            <!-- Badge showing days in a prominent way -->
            <?php if($allData['daysLeft'] < 10) { ?>
            <div class="absolute -top-3 -right-3 z-20 <?php echo (isset($allData['is_trial']) && $allData['is_trial'] == "yes") ? 'bg-red-500' : 'bg-yellow-500'; ?> text-white font-bold rounded-full w-10 h-10 flex items-center justify-center shadow-lg border-2 border-white animate-pulse" style="animation-duration: 2s;">
                <?php echo round($allData['daysLeft']); ?>d
            </div>
            <?php } ?>
            </div>
        </div>
    </div>
    <style>
    @keyframes float {
    0%, 100% { transform: translateY(0px); }
    50% { transform: translateY(-5px); }
    }

    @keyframes dash {
    to { stroke-dashoffset: 0; }
    }

    @keyframes ping-slow {
    0% { transform: scale(1); opacity: 1; }
    75%, 100% { transform: scale(2); opacity: 0; }
    }

    @keyframes shimmer {
    0% { transform: translateX(-100%); }
    100% { transform: translateX(100%); }
    }

    .animate-float {
    animation: float 3s ease-in-out infinite;
    }

    .animate-dash {
    stroke-dasharray: 100;
    stroke-dashoffset: 100;
    animation: dash 8s linear infinite;
    }

    .animate-ping-slow {
    animation: ping-slow 2s cubic-bezier(0, 0, 0.2, 1) infinite;
    }

    .shimmer-effect {
    animation: shimmer 2s infinite;
    }

    .shine-effect {
    animation: shimmer 2s infinite;
    }

    .text-shadow-sm {
    text-shadow: 0 1px 2px rgba(0, 0, 0, 0.2);
    }
    </style>
</div>
    <div class="flex flex-col md:flex-row gap-3">
        <!-- Stats Cards (Slightly Larger) -->
        <div class="w-full md:w-1/2 lg:w-1/2">
            Coming Soon!
        </div>
        
        <!-- Large Product Advertisement Section with Light Gradient -->

    <div class="w-full md:w-2/3 lg:w-3/4 bg-gradient-to-r from-blue-100 via-indigo-50 to-purple-100 rounded shadow-md overflow-hidden border border-indigo-200">
        <div class="p-4 flex flex-col md:flex-row h-full">
            <!-- Text Content -->
            <div class="flex flex-col md:flex-row gap-6">
                <div class="w-full md:w-1/2 text-indigo-900 flex flex-col justify-between">
                    <div>
                        <div class="flex items-start gap-1">
                            <span class="bg-indigo-500 text-white text-xs px-1.5 py-0.5 rounded-sm font-bold">PRO</span>
                            <span class="bg-amber-400 text-amber-800 text-xs px-1.5 py-0.5 rounded-sm">Limited Offer</span>
                        </div>
                        <h3 class="text-lg font-bold mt-2 mb-1 text-indigo-800">Advanced Customized Features!</h3>
                        <p class="text-sm text-indigo-700 mb-2">We can develop premium tools for you as per your business requirement!</p>
                    
                        <ul class="text-xs space-y-2 mb-4 text-indigo-800">
                            <li class="flex items-center">
                                <svg class="w-3.5 h-3.5 mr-1.5 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                </svg>
                                Modules designed for your vertical with relevant metrics and workflows
                            </li>
                            <li class="flex items-center">
                                <svg class="w-3.5 h-3.5 mr-1.5 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                </svg>
                                Seamlessly connect with your existing tools and software ecosystem
                            </li>
                            <li class="flex items-center">
                                <svg class="w-3.5 h-3.5 mr-1.5 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                </svg>
                                Team collaboration tools updates as per your needs!
                            </li>
                            <li class="flex items-center">
                                <svg class="w-3.5 h-3.5 mr-1.5 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                </svg>
                                Mobile-responsive access with dedicated app for on-the-go management 
                            </li>
                        </ul>
                    </div>
                    <style>
                        .card-container {
                            position: relative;
                            transition: all 0.4s ease;
                            overflow: hidden;
                        }
                        
                        .card-container:hover {
                            transform: translateY(-8px);
                            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
                        }
                        
                        .contact-icon {
                            transition: all 0.3s ease;
                        }
                        
                        .card-container:hover .contact-icon {
                            transform: scale(1.1);
                        }
                        
                        .glow {
                            position: absolute;
                            width: 100%;
                            height: 100%;
                            top: 0;
                            left: 0;
                            background: radial-gradient(circle at center, rgba(99, 102, 241, 0.4) 0%, rgba(99, 102, 241, 0) 70%);
                            border-radius: 9999px;
                            opacity: 0;
                            transition: opacity 0.5s ease;
                        }
                        
                        .card-container:hover .glow {
                            opacity: 1;
                        }
                        
                        .notification-badge {
                            position: absolute;
                            top: -5px;
                            right: -5px;
                            display: flex;
                            align-items: center;
                            justify-content: center;
                            animation: pulse 2s infinite;
                        }
                        
                        @keyframes pulse {
                            0% {
                                transform: scale(0.95);
                                box-shadow: 0 0 0 0 rgba(220, 38, 38, 0.7);
                            }
                            
                            70% {
                                transform: scale(1);
                                box-shadow: 0 0 0 10px rgba(220, 38, 38, 0);
                            }
                            
                            100% {
                                transform: scale(0.95);
                                box-shadow: 0 0 0 0 rgba(220, 38, 38, 0);
                            }
                        }
                        
                        .feature-item {
                            position: relative;
                            transition: all 0.3s ease;
                        }
                        
                        .feature-item:before {
                            content: "";
                            position: absolute;
                            left: -5px;
                            top: 50%;
                            transform: translateY(-50%);
                            width: 0;
                            height: 0;
                            border-style: solid;
                            border-width: 5px 0 5px 5px;
                            border-color: transparent transparent transparent #4F46E5;
                            opacity: 0;
                            transition: all 0.3s ease;
                        }
                        
                        .card-container:hover .feature-item:before {
                            opacity: 1;
                            left: 0;
                        }
                        
                        .card-container:hover .feature-item {
                            padding-left: 12px;
                        }
                        
                        .arrow-icon {
                            transition: all 0.3s ease;
                        }
                        
                        .card-container:hover .arrow-icon {
                            transform: translateX(5px);
                        }
                        
                        .ripple {
                            position: absolute;
                            border-radius: 50%;
                            background: rgba(99, 102, 241, 0.3);
                            transform: scale(0);
                            animation: ripple 1.5s linear infinite;
                        }
                        
                        @keyframes ripple {
                            0% {
                                transform: scale(0);
                                opacity: 1;
                            }
                            100% {
                                transform: scale(2);
                                opacity: 0;
                            }
                        }
                        .or-divider {
            position: relative;
            text-align: center;
            margin: 20px 0;
        }
        
        .or-divider:before, .or-divider:after {
            content: "";
            position: absolute;
            top: 50%;
            width: 45%;
            height: 1px;
            background: #CBD5E0;
        }
        
        .or-divider:before {
            left: 0;
        }
        
        .or-divider:after {
            right: 0;
        }
        
        .or-text {
            display: inline-block;
            position: relative;
            padding: 0 10px;
            background: white;
            z-index: 1;
        }
        
        .or-badge {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 36px;
            height: 36px;
            background: #EDF2F7;
            border-radius: 50%;
            border: 1px solid #CBD5E0;
            margin: 0 auto;
            font-weight: bold;
            color: #4A5568;
            animation: float 3s ease-in-out infinite;
        }
        
        @keyframes float {
            0%, 100% {
                transform: translateY(0);
            }
            50% {
                transform: translateY(-5px);
            }
        }
                    </style>
                    <div class="flex items-center justify-between">
                        <div class="card-container bg-white rounded-xl shadow-lg p-6 w-80">
                            <!-- Header Section -->
                            <div class="flex items-center mb-6">
                                <div class="relative">
                                    <div class="bg-indigo-100 rounded-full p-3 relative">
                                        <div class="glow"></div>
                                        <svg class="contact-icon w-8 h-8 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"></path>
                                        </svg>
                                        <div class="ripple" style="width: 60px; height: 60px; top: -5px; left: -5px;"></div>
                                    </div>
                                    <div class="notification-badge bg-red-600 text-white text-xs font-bold rounded-full w-5 h-5">
                                        3
                                    </div>
                                </div>
                                <div class="ml-4">
                                    <h3 class="text-xl font-bold text-gray-800">Let's Get In Touch</h3>
                                    <p class="text-gray-500 text-sm">Unlock exclusive benefits</p>
                                </div>
                            </div>
                            
                            <!-- Features Section -->
                            <div class="mb-6">
                                <div class="feature-item mb-2 pl-2 text-gray-700 text-sm">Premium support & onboarding</div>
                                <div class="feature-item mb-2 pl-2 text-gray-700 text-sm">Advanced feature customization</div>
                                <div class="feature-item pl-2 text-gray-700 text-sm">Special offer discounts</div>
                            </div>
                            
                            <!-- CTA Button -->
                            <button class="w-full  inline-flex items-center justify-center px-2 py-1.5 text-white text-xs sm:text-sm font-medium hover:dark:text-dark-bg before:[content:''] relative z-[5] before:absolute before:left-0 before:h-full bg-primary dark:bg-secondary before:bg-secondary before:dark:bg-white hover:text-white no-underline transition-all ease-in-out duration-300 hover:before:w-full before:transition-all before:ease-in-out before:duration-300 before:z-[-1] before:w-0 border-0">
                                <span><a href="#myForm">Contact Us Now</a></span>
                                <svg class="arrow-icon ml-2 w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                                </svg>
                            </button>
                        </div>
                    </div>
                <!-- OR Section -->
                    <div class="or-divider my-8">
                            <div class="or-badge">OR</div>
                    </div>

                    <!-- Contact Details Section -->
                    <div class="p-4 bg-indigo-50 rounded-md border border-indigo-100">
                        <h4 class="font-bold text-sm text-indigo-800 mb-2">Contact Us</h4>
                        <ul class="text-xs space-y-2 text-indigo-700">
                            <li class="flex items-center">
                                <svg class="w-4 h-4 mr-2 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                </svg>
                                <span><a href="mailto:{{ env('ADMIN_EMAIL') }}">{{ env('ADMIN_EMAIL') }}</a></span>
                            </li>
                            <li class="flex items-center">
                                <svg class="w-4 h-4 mr-2 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                                </svg>
                                <span>{{ env('MOBILE') }}</span>
                            </li>
                            <li class="flex items-center">
                                <svg class="w-4 h-4 mr-2 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                                <span>{{ env('ADDRESS') }}</span>
                            </li>
                        </ul>
                    </div>
                </div>
                <script>
                    document.addEventListener('DOMContentLoaded', function() {
                        window.addEventListener('contact-form-submitted', event => {
                            setTimeout(() => {
                                @this.showSuccessMessage = false;
                            }, 5000);
                        });
                    });
                </script>
                
                <!-- Contact Form -->
                <div class="w-full md:w-1/2 bg-white p-5 rounded-lg border border-indigo-100 shadow-sm" id="myForm">
                    <h3 class="text-md font-bold text-indigo-800 mb-4">Request Custom Solution</h3>
                     <!-- Success Message -->
                        @if($showSuccessMessage)
                            <div class="bg-green-100 text-green-700 p-3 rounded-md mb-4">
                                Thank you for your inquiry! Our team will contact you within 2 hours.
                            </div>
                        @endif
                        
                        <!-- Form -->
                        <form class="space-y-4" wire:submit.prevent="submitContactForm">
                            <div>
                                <label class="block text-xs font-medium text-indigo-700 mb-1" for="name">Full Name</label>
                                <input type="text" id="name" wire:model="contact_name" class="w-full px-3 py-2 text-sm border border-indigo-200 rounded-md focus:outline-none focus:ring-1 focus:ring-indigo-500" placeholder="Your Name">
                                @error('contact_name') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                            </div>
                            <div>
                                <label class="block text-xs font-medium text-indigo-700 mb-1" for="email">Email Address</label>
                                <input type="email" id="email" wire:model="email" class="w-full px-3 py-2 text-sm border border-indigo-200 rounded-md focus:outline-none focus:ring-1 focus:ring-indigo-500" placeholder="your@email.com">
                                @error('email') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                            </div>
                            <div>
                                <label class="block text-xs font-medium text-indigo-700 mb-1" for="phone">Phone Number</label>
                                <input type="tel" id="phone" wire:model="phone" class="w-full px-3 py-2 text-sm border border-indigo-200 rounded-md focus:outline-none focus:ring-1 focus:ring-indigo-500" placeholder="+91 98765 43210">
                                @error('phone') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                            </div>
                            <div>
                                <label class="block text-xs font-medium text-indigo-700 mb-1" for="company">Company Name</label>
                                <input type="text" id="company" wire:model="company" class="w-full px-3 py-2 text-sm border border-indigo-200 rounded-md focus:outline-none focus:ring-1 focus:ring-indigo-500" placeholder="Your Company">
                                @error('company') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                            </div>
                            <div>
                                <label class="block text-xs font-medium text-indigo-700 mb-1" for="requirements">Business Requirements</label>
                                <textarea id="requirements" wire:model="requirements" rows="3" class="w-full px-3 py-2 text-sm border border-indigo-200 rounded-md focus:outline-none focus:ring-1 focus:ring-indigo-500" placeholder="Tell us about your specific needs..."></textarea>
                                @error('requirements') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                            </div>
                            
                             <!-- Math CAPTCHA -->
                            <div>
                                <label class="block text-xs font-medium text-indigo-700 mb-1">Verify You're Human</label>
                                <div class="flex items-center space-x-2 bg-indigo-50 p-3 rounded-md">
                                    <div class="text-indigo-800 font-medium">{{ $captchaQuestion }}</div>
                                    <input type="number" wire:model="captchaAnswer" class="w-20 px-2 py-1 text-sm border border-indigo-200 rounded-md focus:outline-none focus:ring-1 focus:ring-indigo-500" placeholder="?">
                                    <button type="button" wire:click="generateMathCaptcha" class="text-indigo-600 hover:text-indigo-800">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                                        </svg>
                                    </button>
                                </div>
                                @error('captchaAnswer') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                            </div>
                            <button type="submit" class="w-full inline-flex items-center justify-center px-2 py-1.5 text-white text-xs sm:text-sm font-medium hover:dark:text-dark-bg before:[content:''] relative z-[5] before:absolute before:left-0 before:h-full bg-primary dark:bg-secondary before:bg-secondary before:dark:bg-white hover:text-white no-underline transition-all ease-in-out duration-300 hover:before:w-full before:transition-all before:ease-in-out before:duration-300 before:z-[-1] before:w-0 border-0">
                                Submit Request
                                <div wire:loading wire:target="submitContactForm" class="ml-2">
                                    <svg class="animate-spin -ml-1 mr-3 h-4 w-4 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                    </svg>
                                </div>
                            </button>
                            <p class="text-xs text-center text-indigo-600">Our team will get back to you within 2 hours</p>
                        </form>
                </div>
            </div>
        </div>
    </div>

    </div>
    <!-- Enhanced Help Modal Component -->
    <div 
        x-data="{ 
            isOpen: false, 
            activeSection: 'main',
            searchQuery: '',
            showSearch: false,
            highlightedItem: null,
            menuExplanations: {
                main: [
                    { name: 'Dashboard', description: 'Overview of all system activities, statistics, and important notifications. Provides real-time data visualizations and performance metrics.', icon: 'M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6', color: 'bg-blue-500', shortcuts: ['Alt+D'] },
                    { name: 'Doc Master', description: 'Manage all documents in the system. Create, edit, and organize your files with powerful editing tools. Supports version control and collaborative editing.', icon: 'M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z', color: 'bg-emerald-500', shortcuts: ['Alt+M'] },
                    { name: 'Doc Categories', description: 'Organize documents into custom categories for easier access. Create hierarchical folder structures with custom tags and metadata.', icon: 'M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z', color: 'bg-amber-500', shortcuts: ['Alt+C'] },
                    { name: 'Deleted Docs', description: 'Access and restore previously deleted documents. Automatic retention policies keep your data safe with a 30-day recovery window.', icon: 'M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16', color: 'bg-red-500', shortcuts: ['Alt+R'] },
                    { name: 'Tasks', description: 'Manage and track team assignments with priorities and deadlines. Includes Kanban views, sprint planning tools, and automated reminders for upcoming deadlines.', icon: 'M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01', color: 'bg-purple-500', shortcuts: ['Alt+T'] },
                    { name: 'Todos', description: 'Personal task management for your daily activities. Prioritize tasks, set reminders, and track completion status with customizable to-do lists.', icon: 'M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2', color: 'bg-indigo-500', shortcuts: ['Alt+O'] },
                    { name: 'Leave', description: 'Request and manage time off. Track vacation days, sick leave, and other absence types with approval workflows and calendar integration.', icon: 'M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z', color: 'bg-teal-500', shortcuts: ['Alt+L'] },
                    { name: 'Calendar', description: 'View and manage events, deadlines, and meetings. Supports team scheduling, resource booking, and integration with popular calendar applications.', icon: 'M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z', color: 'bg-pink-500', shortcuts: ['Alt+A'] },
                    { name: 'Graphs', description: 'Visual representations of data and performance metrics. Create custom charts, export reports, and analyze trends with interactive data visualizations.', icon: 'M7 12l3-3 3 3 4-4M8 21l4-4 4 4M3 4h18M4 4h16v12a1 1 0 01-1 1H5a1 1 0 01-1-1V4z', color: 'bg-orange-500', shortcuts: ['Alt+G'] }
                ],
                settings: [
                    { name: 'Departments', description: 'Create and manage organizational departments and team structures. Define hierarchies, assign managers, and set department-specific permissions.', icon: 'M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4', color: 'bg-fuchsia-500', shortcuts: ['Alt+E'] },
                    { name: 'Type of Work', description: 'Define different work types and activities for tracking. Customize work categories with specific fields, approval flows, and reporting attributes.', icon: 'M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z', color: 'bg-cyan-500', shortcuts: ['Alt+W'] },
                    { name: 'User Management', description: 'Manage user accounts, permissions, and access levels. Control role-based access, enable two-factor authentication, and track user activity.', icon: 'M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z', color: 'bg-violet-500', shortcuts: ['Alt+U'] },
                    { name: 'System Settings', description: 'Configure system-wide preferences and options. Adjust notification settings, customize UI themes, and manage system integrations with third-party services.', icon: 'M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z', color: 'bg-slate-500', shortcuts: ['Alt+S'] },
                    { name: 'Files Download', description: 'Access and download system files and reports. Schedule automated exports, customize report templates, and manage bulk downloads with compression options.', icon: 'M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4', color: 'bg-lime-500', shortcuts: ['Alt+F'] },
                    { name: 'API Integration', description: 'Manage external API connections and webhooks. Generate API keys, monitor usage, and configure third-party service integrations.', icon: 'M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4', color: 'bg-sky-500', shortcuts: ['Alt+I'] },
                    { name: 'Audit Logs', description: 'Review system activity and security logs. Track user actions, system changes, and access attempts with detailed timestamps.', icon: 'M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z', color: 'bg-yellow-500', shortcuts: ['Alt+Y'] }
                ],
                help: [
                    { name: 'User Guides', description: 'Step-by-step tutorials and comprehensive documentation for all system features and workflows.', icon: 'M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253', color: 'bg-rose-500', shortcuts: ['Alt+H, G'] },
                    { name: 'Video Tutorials', description: 'Visual learning resources with screen recordings and narrated walkthroughs of key system functions.', icon: 'M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z', color: 'bg-green-500', shortcuts: ['Alt+H, V'] },
                    { name: 'FAQ', description: 'Frequently asked questions and troubleshooting tips organized by topic and usage scenario.', icon: 'M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z', color: 'bg-blue-400', shortcuts: ['Alt+H, F'] }
                ]
            },
            get filteredItems() {
                if (!this.searchQuery.trim()) {
                    return this.menuExplanations[this.activeSection];
                }
                
                const query = this.searchQuery.toLowerCase().trim();
                const allItems = [
                    ...this.menuExplanations.main,
                    ...this.menuExplanations.settings,
                    ...this.menuExplanations.help
                ];
                
                return allItems.filter(item => 
                    item.name.toLowerCase().includes(query) || 
                    item.description.toLowerCase().includes(query)
                );
            },
            getTip() {
                const tips = [
                    'Use keyboard shortcuts to navigate quickly',
                    'Search for features using the search bar',
                    'Hover over items in the navigation map for quick preview',
                    'Click on any section title to expand its details',
                    'Most recent features are highlighted with a New badge'
                ];
                return tips[Math.floor(Math.random() * tips.length)];
            }
        }"
        @open-help-modal.window="isOpen = true"
        @keydown.escape="isOpen = false"
        @keydown.alt.d.window="activeSection = 'main'; highlightedItem = 'Dashboard'"
        @keydown.alt.s.window="activeSection = 'settings'; highlightedItem = 'System Settings'"
        @keydown.alt.h.window="activeSection = 'help'"
        class="relative"
        x-cloak
    >
        <!-- Modal Backdrop with blur effect -->
        <div 
            x-show="isOpen" 
            x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100"
            x-transition:leave="transition ease-in duration-200"
            x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0"
            class="fixed inset-0 bg-gray-700 bg-opacity-60 backdrop-blur-sm z-40"
            @click="isOpen = false"
        ></div>

        <!-- Modal Content -->
        <div 
            x-show="isOpen" 
            x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0 transform scale-95"
            x-transition:enter-end="opacity-100 transform scale-100"
            x-transition:leave="transition ease-in duration-200"
            x-transition:leave-start="opacity-100 transform scale-100"
            x-transition:leave-end="opacity-0 transform scale-95"
            class="fixed inset-0 z-50 overflow-y-auto"
            @click.away="isOpen = false"
        >
            <div class="flex items-center justify-center min-h-screen p-4">
                <div class="relative bg-white rounded-xl shadow-2xl max-w-5xl w-full max-h-[90vh] overflow-hidden flex flex-col border border-gray-200">
                    <!-- Modal Header with improved gradient -->
                    <div class="bg-gradient-to-r from-indigo-600 via-purple-500 to-pink-500 px-6 py-4 border-b border-gray-200">
                        <div class="flex items-center justify-between">
                            <div>
                                <h3 class="text-xl font-semibold text-white flex items-center">
                                    <svg class="h-6 w-6 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    Help Center
                                </h3>
                                <p class="text-sm text-indigo-100 mt-1">Discover features and learn how to use the application efficiently</p>
                            </div>
                            <button 
                                @click="isOpen = false"
                                class="text-white hover:text-gray-200 focus:outline-none transition-transform hover:scale-110"
                            >
                                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>
                        </div>
                        
                        <!-- Search Bar -->
                        <div class="mt-4 relative">
                            <div class="relative">
                                <input 
                                    x-model="searchQuery"
                                    @focus="showSearch = true"
                                    type="text" 
                                    placeholder="Search for features..." 
                                    class="w-full pl-10 text-white pr-4 py-2 rounded-lg bg-white bg-opacity-20  placeholder-indigo-100 border border-indigo-300 focus:outline-none focus:ring-2 focus:ring-white focus:border-transparent"
                                >
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-indigo-100" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                    </svg>
                                </div>
                                <button 
                                    x-show="searchQuery" 
                                    @click="searchQuery = ''" 
                                    class="absolute inset-y-0 right-0 pr-3 flex items-center text-indigo-100 hover:text-white"
                                >
                                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                    </svg>
                                </button>
                            </div>
                            
                            <!-- Search Results -->
                            <div 
                                x-show="showSearch && searchQuery.length > 0" 
                                @click.away="showSearch = false"
                                class="absolute mt-1 w-full bg-white rounded-md shadow-lg overflow-hidden z-10 max-h-60 overflow-y-auto"
                            >
                                <div class="py-1">
                                    <template x-for="(item, index) in filteredItems" :key="index">
                                        <a 
                                            @click="activeSection = item.name.toLowerCase().includes('user') ? 'settings' : (item.name.toLowerCase().includes('guide') || item.name.toLowerCase().includes('faq') || item.name.toLowerCase().includes('tutorial') ? 'help' : 'main'); highlightedItem = item.name; showSearch = false; searchQuery = ''"
                                            class="block px-4 py-2 text-sm text-gray-700 hover:bg-indigo-100 cursor-pointer"
                                        >
                                            <div class="flex items-center">
                                                <div class="h-6 w-6 rounded-md flex items-center justify-center mr-3" :class="item.color">
                                                    <svg class="h-4 w-4 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" x-bind:d="item.icon"></path>
                                                    </svg>
                                                </div>
                                                <div>
                                                    <div class="font-medium" x-text="item.name"></div>
                                                    <div class="text-xs text-gray-500 truncate" x-text="item.description.substring(0, 60) + '...'"></div>
                                                </div>
                                            </div>
                                        </a>
                                    </template>
                                    <div x-show="filteredItems.length === 0" class="px-4 py-3 text-sm text-gray-500 italic">
                                        No features found matching your search
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Tab Navigation with improved styling -->
                    <div class="bg-gray-50 border-b border-gray-200 sticky top-0 z-10">
                        <div class="flex space-x-1 p-2 px-4">
                            <button 
                                @click="activeSection = 'main'; highlightedItem = null"
                                :class="activeSection === 'main' ? 'bg-indigo-100 text-indigo-700 border-indigo-500' : 'text-gray-600 hover:text-gray-800 hover:bg-gray-100 border-transparent'"
                                class="px-4 py-2 text-sm font-medium rounded-md transition-all border-b-2 flex items-center"
                            >
                                <svg class="h-4 w-4 mr-1.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h7" />
                                </svg>
                                Main Menu
                            </button>
                            <button 
                                @click="activeSection = 'settings'; highlightedItem = null"
                                :class="activeSection === 'settings' ? 'bg-indigo-100 text-indigo-700 border-indigo-500' : 'text-gray-600 hover:text-gray-800 hover:bg-gray-100 border-transparent'"
                                class="px-4 py-2 text-sm font-medium rounded-md transition-all border-b-2 flex items-center"
                            >
                                <svg class="h-4 w-4 mr-1.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                                </svg>
                                Settings
                            </button>
                            <button 
                                @click="activeSection = 'help'; highlightedItem = null"
                                :class="activeSection === 'help' ? 'bg-indigo-100 text-indigo-700 border-indigo-500' : 'text-gray-600 hover:text-gray-800 hover:bg-gray-100 border-transparent'"
                                class="px-4 py-2 text-sm font-medium rounded-md transition-all border-b-2 flex items-center"
                            >
                                <svg class="h-4 w-4 mr-1.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                Help Resources
                            </button>
                        </div>
                    </div>
                    
                    <!-- Modal Body with card layout -->
                    <div class="p-6 overflow-y-auto flex-1 modal-body-items">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <template x-for="(item, index) in menuExplanations[activeSection]" :key="item.name">
                                <div 
                                    :class="{'ring-2 ring-indigo-400 shadow-md transform scale-[1.01]': highlightedItem === item.name}"
                                    class="bg-white border border-gray-200 rounded-lg p-5 hover:shadow-lg transition-all duration-200"
                                    @mouseenter="highlightedItem = item.name"
                                    @mouseleave="highlightedItem = null"
                                >
                                    <div class="flex items-start">
                                        <div class="flex-shrink-0">
                                            <div class="h-10 w-10 rounded-lg flex items-center justify-center" :class="item.color">
                                                <svg class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" x-bind:d="item.icon"></path>
                                                </svg>
                                            </div>
                                        </div>
                                        <div class="ml-4 flex-1">
                                            <div class="flex items-center justify-between">
                                                <h4 class="text-base font-medium text-gray-900" x-text="item.name"></h4>
                                                <div x-show="index === 0 && activeSection === 'help'" class="bg-indigo-500 text-white text-xs px-2 py-0.5 rounded-full">New</div>
                                            </div>
                                            <p class="mt-1 text-sm text-gray-600" x-text="item.description"></p>
                                            
                                            <!-- Keyboard shortcuts -->
                                            <div class="mt-3 flex items-center">
                                                <span class="text-xs text-gray-500 mr-2">Shortcut:</span>
                                                <template x-for="(shortcut, i) in item.shortcuts" :key="i">
                                                    <div class="flex items-center">
                                                        <template x-for="(key, j) in shortcut.split(',')" :key="j">
                                                            <div class="flex items-center">
                                                                <span class="bg-gray-100 text-gray-800 text-xs px-1.5 py-0.5 rounded border border-gray-300" x-text="key"></span>
                                                                <span x-show="j < shortcut.split(',').length - 1" class="mx-1 text-gray-400">then</span>
                                                            </div>
                                                        </template>
                                                        <span x-show="i < item.shortcuts.length - 1" class="mx-1.5 text-gray-400">or</span>
                                                    </div>
                                                </template>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </template>
                        </div>
                    </div>
                    
                    <!-- Modal Footer with Quick Tips -->
                    <div class="bg-gray-50 px-6 py-4 border-t border-gray-200">
                        <div class="flex flex-col md:flex-row justify-between items-start md:items-center space-y-3 md:space-y-0">
                            
                            <div class="flex space-x-2">
                                <button
                                    @click="isOpen = false"
                                    class="px-4 py-2 bg-gradient-to-r from-indigo-600 to-purple-600 text-white text-sm font-medium rounded-lg hover:from-indigo-700 hover:to-purple-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 shadow-md transition-all duration-200 hover:shadow-lg"
                                >
                                    Close Help
                                </button>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
        
        <!-- Keyboard Shortcut Helper -->
        <div 
            x-show="isOpen" 
            x-transition
            class="fixed bottom-6 left-6 bg-white rounded-lg shadow-lg border border-gray-200 p-4 z-50 max-w-xs"
        >
            <div class="text-sm font-medium text-gray-700 mb-2 flex items-center">
                <svg class="h-4 w-4 text-indigo-500 mr-1.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z" />
                </svg>
                Keyboard Shortcuts
            </div>
            <div class="space-y-1.5">
                <div class="flex items-center justify-between">
                    <span class="text-xs text-gray-500">Toggle Help</span>
                    <span class="bg-gray-100 text-gray-800 text-xs px-1.5 py-0.5 rounded border border-gray-300">?</span>
                </div>
                <div class="flex items-center justify-between">
                    <span class="text-xs text-gray-500">Close Modal</span>
                    <span class="bg-gray-100 text-gray-800 text-xs px-1.5 py-0.5 rounded border border-gray-300">Esc</span>
                </div>
                <div class="flex items-center justify-between">
                    <span class="text-xs text-gray-500">Search</span>
                    <span class="bg-gray-100 text-gray-800 text-xs px-1.5 py-0.5 rounded border border-gray-300">Ctrl+K</span>
                </div>
            </div>
        </div>
    </div>
</div>