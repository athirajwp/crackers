<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', App\Models\Setting::get('store_name', 'Cracker Demo') . ' | Sivakasi Online Crackers Shop')</title>
    
    <!-- Favicon -->
    <link rel="icon" type="image/png" href="https://img.icons8.com/color/48/fireworks.png">
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&family=Outfit:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Outfit', 'Poppins', 'sans-serif'],
                    },
                    colors: {
                        gold: {
                            50: '#fffdf0',
                            100: '#fef7c3',
                            200: '#fdf196',
                            300: '#fae459',
                            400: '#f8d82d',
                            500: '#e5bf13',
                            600: '#c2960b',
                            700: '#9b7009',
                            800: '#7d560c',
                            900: '#67460e',
                        },
                        crimson: {
                            50: '#fff1f1',
                            100: '#ffe1e1',
                            200: '#ffc7c7',
                            300: '#ffa0a0',
                            400: '#ff6969',
                            500: '#f83b3b',
                            600: '#e51d1d',
                            700: '#c01212',
                            800: '#9f1313',
                            900: '#831616',
                        }
                    }
                }
            }
        }
    </script>
    
    <!-- FontAwesome for Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Alpine.js CDN for Reactive Micro-Interactions -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    
    <!-- SweetAlert2 for elegant modal notifications -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
    <!-- Custom animations and styles -->
    <style>
        .glassmorphism {
            background: rgba(255, 255, 255, 0.7);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border: 1px solid rgba(0, 0, 0, 0.08);
        }
        
        .glow-gold:hover {
            box-shadow: 0 0 15px rgba(229, 191, 19, 0.4);
        }

        .marquee-container {
            overflow: hidden;
            white-space: nowrap;
        }

        .marquee-content {
            display: inline-block;
            animation: marquee 25s linear infinite;
        }

        @keyframes marquee {
            0% { transform: translateX(100%); }
            100% { transform: translateX(-100%); }
        }
    </style>
</head>
<body class="bg-slate-50 text-slate-800 min-h-screen flex flex-col font-sans selection:bg-gold-500 selection:text-slate-900">
    
    <!-- 1. Scrolling Marquee Header Alert -->
    <div class="bg-crimson-700 border-b border-crimson-800 text-white py-2 text-xs font-semibold marquee-container shadow-sm select-none">
        <div class="marquee-content flex gap-12 items-center">
            <span><i class="fa-solid fa-circle-exclamation text-gold-300 mr-2"></i>Minimum Order Value for Sivakasi Delivery is <strong>₹{{ App\Models\Setting::get('min_order_value', 3800) }}</strong></span>
            <span><i class="fa-solid fa-fire text-gold-300 mr-2"></i>Celebrate Diwali / Festivals with Flat <strong>{{ App\Models\Setting::get('discount_percent', 60) }}% Discount</strong>!</span>
            <span><i class="fa-solid fa-truck-fast text-gold-300 mr-2"></i>Express Lorry Transport Delivery Across Kerala, Karnataka, Tamilnadu, Andhra & Telangana!</span>
            <span><i class="fa-solid fa-phone text-gold-300 mr-2"></i>For Enquiries, Contact Support: <strong>{{ App\Models\Setting::get('store_phone', '+91 9998887776') }}</strong></span>
            <span><i class="fa-solid fa-shield-halved text-gold-300 mr-2"></i>100% Quality & Safe Sivakasi Manufactured Crackers</span>
        </div>
    </div>

    <!-- 2. Main Premium Glass Navbar -->
    <header x-data="{ mobileMenuOpen: false }" class="sticky top-0 z-50 bg-white/90 backdrop-blur-md border-b border-slate-200/80 shadow-sm">
        <div class="container mx-auto px-4 py-3 flex justify-between items-center">
            
            <!-- Logo / Branding -->
            <a href="/" class="flex items-center gap-2 md:gap-3 group flex-shrink-0">
                <div class="bg-gradient-to-tr from-gold-500 to-crimson-600 p-1.5 md:p-2 rounded-xl shadow-md group-hover:scale-105 transition-transform duration-300">
                    <i class="fa-solid fa-fire-burner text-lg md:text-2xl text-white"></i>
                </div>
                <div class="flex flex-col justify-center">
                    <h1 class="text-xs sm:text-sm md:text-base lg:text-lg font-black tracking-tight bg-gradient-to-r from-crimson-600 to-gold-500 bg-clip-text text-transparent group-hover:opacity-95 transition-opacity leading-none">
                        {{ strtoupper(App\Models\Setting::get('store_name', 'Cracker Demo')) }}
                    </h1>
                    <p class="text-[8px] md:text-[9px] text-slate-500 tracking-widest uppercase font-semibold leading-none mt-1">Sivakasi Online Booking</p>
                </div>
            </a>

            <!-- Nav Links -->
            <nav class="hidden md:flex items-center gap-6 text-sm font-semibold text-slate-650">
                <a href="/" class="hover:text-crimson-600 transition-colors"><i class="fa-solid fa-house mr-1.5 text-xs text-crimson-500"></i>Home</a>
                <a href="/" class="hover:text-crimson-600 transition-colors"><i class="fa-solid fa-list-check mr-1.5 text-xs text-crimson-500"></i>Quick Order</a>
                <a href="/track" class="hover:text-crimson-600 transition-colors"><i class="fa-solid fa-magnifying-glass mr-1.5 text-xs text-crimson-500"></i>Track Order</a>
                <a href="#about-us" class="hover:text-crimson-600 transition-colors"><i class="fa-solid fa-circle-info mr-1.5 text-xs text-crimson-500"></i>About Us</a>
            </nav>

            <!-- CTA / Contact Actions -->
            <div class="flex items-center gap-2 md:gap-3 flex-shrink-0">
                <a href="tel:{{ App\Models\Setting::get('store_phone', '+919998887776') }}" class="hidden lg:flex items-center gap-2 bg-slate-100 border border-slate-200 hover:border-slate-300 px-3.5 py-1.5 rounded-full text-xs font-bold text-slate-700 hover:bg-slate-200 transition-all shadow-sm">
                    <i class="fa-solid fa-phone text-crimson-600"></i>
                    <span>{{ App\Models\Setting::get('store_phone', '+91 9998887776') }}</span>
                </a>
                
                <!-- Desktop WhatsApp Button -->
                <a href="https://wa.me/{{ App\Models\Setting::get('store_whatsapp', '919998887776') }}" target="_blank" class="hidden sm:flex bg-emerald-600 hover:bg-emerald-500 text-white px-4 py-1.5 rounded-full text-xs font-extrabold items-center gap-1.5 shadow-sm hover:scale-105 transition-all">
                    <i class="fa-brands fa-whatsapp text-sm"></i>
                    <span>WhatsApp Booking</span>
                </a>
                
                <!-- Mobile Compact WhatsApp Button (Icon only) -->
                <a href="https://wa.me/{{ App\Models\Setting::get('store_whatsapp', '919998887776') }}" target="_blank" class="sm:hidden flex bg-emerald-600 hover:bg-emerald-500 text-white w-8 h-8 rounded-xl items-center justify-center shadow-sm hover:scale-105 transition-all" title="WhatsApp Booking">
                    <i class="fa-brands fa-whatsapp text-base"></i>
                </a>
                
                <!-- Admin login shortcut (Hidden on mobile header, available in mobile dropdown) -->
                <a href="{{ route('admin.login') }}" class="hidden sm:inline-flex text-slate-400 hover:text-slate-650 p-1.5 rounded-lg text-sm transition-colors" title="Admin Portal">
                    <i class="fa-solid fa-lock"></i>
                </a>

                <!-- Mobile Menu Hamburger Toggler -->
                <button @click="mobileMenuOpen = !mobileMenuOpen" class="md:hidden text-slate-500 hover:text-slate-800 p-2 rounded-xl border border-slate-200 focus:outline-none transition-colors" title="Toggle Navigation Menu">
                    <i :class="mobileMenuOpen ? 'fa-solid fa-xmark text-sm' : 'fa-solid fa-bars text-sm'"></i>
                </button>
            </div>
        </div>

        <!-- Mobile Dropdown Navigation Menu -->
        <div x-show="mobileMenuOpen" 
             x-transition:enter="transition ease-out duration-200" 
             x-transition:enter-start="opacity-0 -translate-y-4" 
             x-transition:enter-end="opacity-100 translate-y-0" 
             x-transition:leave="transition ease-in duration-150" 
             x-transition:leave-start="opacity-100 translate-y-0" 
             x-transition:leave-end="opacity-0 -translate-y-4" 
             class="md:hidden bg-white border-t border-slate-200/80 px-4 py-4 space-y-3 shadow-md"
             style="display: none;">
            <a href="/" class="block px-4 py-2.5 rounded-xl text-xs font-bold text-slate-650 hover:bg-slate-50 hover:text-crimson-600 transition-all flex items-center gap-2">
                <i class="fa-solid fa-house text-crimson-500 text-[10px]"></i> Home / Price List
            </a>
            <a href="/track" class="block px-4 py-2.5 rounded-xl text-xs font-bold text-slate-650 hover:bg-slate-50 hover:text-crimson-600 transition-all flex items-center gap-2">
                <i class="fa-solid fa-magnifying-glass text-crimson-500 text-[10px]"></i> Track Your Order
            </a>
            <a href="#about-us" @click="mobileMenuOpen = false" class="block px-4 py-2.5 rounded-xl text-xs font-bold text-slate-650 hover:bg-slate-50 hover:text-crimson-600 transition-all flex items-center gap-2">
                <i class="fa-solid fa-circle-info text-crimson-500 text-[10px]"></i> About Us / Contact
            </a>
            <a href="{{ route('admin.login') }}" class="block px-4 py-2.5 rounded-xl text-xs font-bold text-slate-650 hover:bg-slate-50 hover:text-crimson-600 transition-all flex items-center gap-2">
                <i class="fa-solid fa-lock text-crimson-500 text-[10px]"></i> Admin Console Gate
            </a>
            <div class="border-t border-slate-100 pt-3 flex flex-col gap-2">
                <a href="tel:{{ App\Models\Setting::get('store_phone', '+919998887776') }}" class="w-full flex items-center justify-center gap-2 bg-slate-100 border border-slate-200 px-3.5 py-2.5 rounded-full text-xs font-bold text-slate-700 hover:bg-slate-200 transition-all shadow-sm">
                    <i class="fa-solid fa-phone text-crimson-600"></i>
                    <span>Call Support: {{ App\Models\Setting::get('store_phone', '+91 9998887776') }}</span>
                </a>
            </div>
        </div>
    </header>

    <!-- 3. Dynamic Page Content -->
    <main class="flex-grow">
        @yield('content')
    </main>

    <!-- 4. Premium Responsive Footer -->
    <footer class="bg-slate-100 border-t border-slate-200 py-12 relative overflow-hidden" id="about-us">
        <div class="container mx-auto px-4 relative z-10">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                
                <!-- Corporate Info -->
                <div class="space-y-4">
                    <div class="flex items-center gap-2">
                        <div class="bg-gold-500 p-1.5 rounded-lg">
                            <i class="fa-solid fa-fire-burner text-slate-900"></i>
                        </div>
                        <span class="font-extrabold text-lg text-slate-800">{{ strtoupper(App\Models\Setting::get('store_name', 'Cracker Demo')) }}</span>
                    </div>
                    <p class="text-xs text-slate-550 leading-relaxed">
                        {{ App\Models\Setting::get('store_name', 'Cracker Demo') }} is a premier firecrackers retailer based in Sivakasi, Virudhunagar, Sivakasi Main Road. We deliver pure joy, colors, and dazzling displays across India, observing the highest safety codes.
                    </p>
                    <div class="flex gap-3 text-slate-400">
                        <a href="#" class="hover:text-crimson-600 transition-colors"><i class="fa-brands fa-facebook"></i></a>
                        <a href="#" class="hover:text-crimson-600 transition-colors"><i class="fa-brands fa-instagram"></i></a>
                        <a href="https://wa.me/{{ App\Models\Setting::get('store_whatsapp', '919998887776') }}" target="_blank" class="hover:text-crimson-600 transition-colors"><i class="fa-brands fa-whatsapp"></i></a>
                    </div>
                </div>

                <!-- Fast Links -->
                <div>
                    <h4 class="text-sm font-bold text-slate-700 uppercase tracking-widest border-b border-slate-200 pb-2 mb-4">Quick Navigation</h4>
                    <ul class="space-y-2 text-xs text-slate-500">
                        <li><a href="/" class="hover:text-crimson-600 transition-colors"><i class="fa-solid fa-chevron-right mr-1.5 text-[8px] text-crimson-500"></i>Home / Price List</a></li>
                        <li><a href="/track" class="hover:text-crimson-600 transition-colors"><i class="fa-solid fa-chevron-right mr-1.5 text-[8px] text-crimson-500"></i>Order Tracking lookup</a></li>
                        <li><a href="/admin/login" class="hover:text-crimson-600 transition-colors"><i class="fa-solid fa-chevron-right mr-1.5 text-[8px] text-crimson-500"></i>Admin Dashboard Login</a></li>
                    </ul>
                </div>

                <!-- Contact Particulars -->
                <div>
                    <h4 class="text-sm font-bold text-slate-700 uppercase tracking-widest border-b border-slate-200 pb-2 mb-4">Contact Details</h4>
                    <ul class="space-y-3 text-xs text-slate-500">
                        <li class="flex items-start gap-2.5">
                            <i class="fa-solid fa-location-dot text-crimson-500 mt-0.5"></i>
                            <span>{{ App\Models\Setting::get('store_address', 'Virudhunagar to Sivakasi Main Road, Sivakasi') }}</span>
                        </li>
                        <li class="flex items-center gap-2.5">
                            <i class="fa-solid fa-phone text-crimson-500"></i>
                            <span>{{ App\Models\Setting::get('store_phone', '+91 9998887776') }}</span>
                        </li>
                        <li class="flex items-center gap-2.5">
                            <i class="fa-solid fa-envelope text-crimson-500"></i>
                            <span>{{ App\Models\Setting::get('store_email', 'crackerdemo@gmail.com') }}</span>
                        </li>
                    </ul>
                </div>

                <!-- Booking Safety Reminder -->
                <div>
                    <h4 class="text-sm font-bold text-slate-700 uppercase tracking-widest border-b border-slate-200 pb-2 mb-4">Safety Disclaimer</h4>
                    <div class="bg-white border border-slate-200 p-3 rounded-lg text-[10px] text-slate-500 leading-normal space-y-1.5">
                        <p class="text-crimson-600 font-bold"><i class="fa-solid fa-triangle-exclamation mr-1"></i>Burst Wisely & Safely:</p>
                        <p>1. Keep a water bucket & fire extinguisher handy when bursting crackers.</p>
                        <p>2. Children must always perform fireworks under strict adult supervision.</p>
                        <p>3. Do not wear loose synthetic clothes near crackers; prefer thick cotton.</p>
                    </div>
                </div>

            </div>

            <!-- Bottom Credits -->
            <div class="border-t border-slate-200 mt-10 pt-6 flex flex-col md:flex-row justify-between items-center text-[10px] text-slate-400 gap-4">
                <p>&copy; 2026 {{ App\Models\Setting::get('store_name', 'Cracker Demo') }} Sivakasi. All Rights Reserved. Designed by pairs.</p>
                <div class="flex gap-4">
                    <span class="hover:text-slate-600 transition-colors">Privacy Policy</span>
                    <span>&bull;</span>
                    <span class="hover:text-slate-600 transition-colors">Terms of Booking</span>
                </div>
            </div>
        </div>
    </footer>

    <!-- 5. Floating Quick Action Dot (Back to Top Navigation Dot) -->
    <div x-data="{ showScrollTop: false }" 
         x-init="window.addEventListener('scroll', () => { showScrollTop = window.scrollY > 300 })"
         x-show="showScrollTop"
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="translate-y-16 opacity-0"
         x-transition:enter-end="translate-y-0 opacity-100"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="translate-y-0 opacity-100"
         x-transition:leave-end="translate-y-16 opacity-0"
         class="fixed bottom-6 right-6 z-45 select-none pointer-events-auto"
         style="display: none;">
        <button @click="window.scrollTo({ top: 0, behavior: 'smooth' })" 
                class="w-12 h-12 bg-gradient-to-tr from-gold-500 to-amber-500 text-slate-950 rounded-full flex items-center justify-center shadow-lg hover:scale-110 active:scale-95 transition-all duration-300 border border-gold-400/30 group" 
                title="Scroll to Top">
            <i class="fa-solid fa-arrow-up text-sm group-hover:-translate-y-0.5 transition-transform"></i>
        </button>
    </div>

    @yield('scripts')
</body>
</html>
