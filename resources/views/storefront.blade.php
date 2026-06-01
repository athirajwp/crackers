@extends('layouts.app')

@section('title', App\Models\Setting::get('store_name', 'Cracker Demo') . ' | Sivakasi Online Fireworks Booking Shop')

@section('content')
<div x-data="storefrontData()" x-init="initStorefront()" class="relative text-slate-800">

    <!-- Mobile Sticky Category Swiper (Premium horizontal bar sticking under header) -->
    <div class="lg:hidden sticky top-[64px] z-30 bg-white/95 backdrop-blur-md border-b border-slate-200/80 px-4 py-2.5 shadow-sm select-none overflow-x-auto scrollbar-none flex gap-1.5 items-center">
        <span class="text-[9px] font-black text-slate-400 uppercase tracking-wider pr-1 flex-shrink-0 flex items-center gap-1">
            <i class="fa-solid fa-filter text-crimson-600 text-xs"></i> Categories
        </span>
        <button @click="activeCategory = 'all'" :class="activeCategory === 'all' ? 'bg-crimson-600 text-white font-extrabold shadow' : 'bg-slate-50 text-slate-650 border border-slate-200'" class="px-3.5 py-1.5 rounded-full text-[10px] uppercase tracking-wider whitespace-nowrap transition-all duration-200 flex items-center gap-1">
            All
        </button>
        @foreach($categories as $category)
        <button @click="activeCategory = '{{ $category->slug }}'" :class="activeCategory === '{{ $category->slug }}' ? 'bg-crimson-600 text-white font-extrabold shadow' : 'bg-slate-50 text-slate-650 border border-slate-200'" class="px-3.5 py-1.5 rounded-full text-[10px] uppercase tracking-wider whitespace-nowrap transition-all duration-200">
            {{ $category->name }}
        </button>
        @endforeach
    </div>

    <!-- 1. Hero / Promotional Section -->
    <section class="relative bg-white border-b border-slate-200 overflow-hidden py-16">
        <!-- Soft gradient mesh in background -->
        <div class="absolute inset-0 bg-[radial-gradient(circle_at_top_right,_var(--tw-gradient-stops))] from-crimson-100/30 via-white to-slate-50 opacity-90 pointer-events-none"></div>
        
        <div class="container mx-auto px-4 text-center relative z-10 space-y-6">
            <span class="inline-flex items-center gap-1.5 bg-crimson-50 border border-crimson-100 text-crimson-700 text-xs font-extrabold uppercase tracking-widest px-3 py-1 rounded-full shadow-sm animate-pulse">
                <i class="fa-solid fa-gift"></i> Sivakasi Wholesale Booking Open
            </span>
            <h2 class="text-4xl md:text-5xl font-black tracking-tight text-slate-900 leading-tight">
                Get Best Sivakasi Crackers with <br class="hidden sm:inline">
                <span class="bg-gradient-to-r from-crimson-600 to-crimson-500 bg-clip-text text-transparent">Flat {{ $settings['discount_percent'] }}% Discount!</span>
            </h2>
            <p class="text-sm text-slate-600 max-w-xl mx-auto leading-relaxed font-medium">
                Add Sivakasi-manufactured fireworks directly from our price list. Minimum order value is ₹{{ number_format($settings['min_order_value']) }}. Place your order, check out, pay via UPI, and receive shipment details via WhatsApp!
            </p>
            <div class="flex flex-wrap justify-center gap-4 pt-2">
                <div class="flex items-center gap-2 bg-slate-100/80 border border-slate-200 px-4 py-2 rounded-xl text-xs font-semibold text-slate-650">
                    <i class="fa-solid fa-truck text-crimson-600"></i> Delivery by Lorry Transport
                </div>
                <div class="flex items-center gap-2 bg-slate-100/80 border border-slate-200 px-4 py-2 rounded-xl text-xs font-semibold text-slate-650">
                    <i class="fa-solid fa-badge-check text-crimson-600"></i> Pure Sulphurless Sparklers
                </div>
                <div class="flex items-center gap-2 bg-slate-100/80 border border-slate-200 px-4 py-2 rounded-xl text-xs font-semibold text-slate-650">
                    <i class="fa-solid fa-circle-check text-crimson-600"></i> Secure UPI Verification
                </div>
            </div>
        </div>
    </section>

    <!-- 2. Store Content Grid -->
    <section class="container mx-auto px-4 py-10 flex flex-col lg:flex-row gap-8 items-start">
        
        <!-- Left: Category sidebar filters (Hidden on Mobile, Sticky on Desktop) -->
        <aside class="hidden lg:block lg:w-64 flex-shrink-0 lg:sticky lg:top-24 space-y-4 select-none">
            <div class="bg-white border border-slate-200 p-4 rounded-2xl shadow-sm">
                <h3 class="text-sm font-bold text-slate-700 uppercase tracking-widest border-b border-slate-150 pb-2.5 mb-3 flex justify-between items-center">
                    <span>Categories</span>
                    <i class="fa-solid fa-filter text-slate-400 text-xs"></i>
                </h3>
                
                <div class="flex flex-row lg:flex-col overflow-x-auto lg:overflow-visible gap-1 pb-2 lg:pb-0 scrollbar-none">
                    <button @click="activeCategory = 'all'" :class="activeCategory === 'all' ? 'bg-crimson-600 text-white font-extrabold shadow' : 'text-slate-650 hover:bg-slate-100'" class="w-auto lg:w-full text-left px-3.5 py-2.5 rounded-xl text-xs flex items-center gap-2 whitespace-nowrap transition-all duration-200">
                        <i class="fa-solid fa-boxes-stacked text-[11px] opacity-80"></i> All Products
                    </button>
                    @foreach($categories as $category)
                    <button @click="activeCategory = '{{ $category->slug }}'" :class="activeCategory === '{{ $category->slug }}' ? 'bg-crimson-600 text-white font-extrabold shadow' : 'text-slate-650 hover:bg-slate-100'" class="w-auto lg:w-full text-left px-3.5 py-2.5 rounded-xl text-xs flex items-center gap-2 whitespace-nowrap transition-all duration-200">
                        <i class="fa-solid fa-fire-flame-curved text-[11px] opacity-80"></i> {{ $category->name }}
                    </button>
                    @endforeach
                </div>
            </div>

            <!-- Store Info Sidebar widget -->
            <div class="hidden lg:block bg-white border border-slate-200 p-4 rounded-2xl space-y-3.5 shadow-sm">
                <h4 class="text-xs font-bold text-slate-700 uppercase tracking-wider flex items-center gap-2">
                    <i class="fa-solid fa-circle-info text-crimson-600"></i> Store Info
                </h4>
                <div class="text-[11px] text-slate-500 space-y-2.5 leading-relaxed font-medium">
                    <div class="flex gap-2">
                        <i class="fa-solid fa-house-circle-check text-crimson-500/80 mt-0.5"></i>
                        <span><strong>Address:</strong> {{ $settings['store_address'] }}</span>
                    </div>
                    <div class="flex gap-2">
                        <i class="fa-solid fa-envelope text-crimson-500/80 mt-0.5"></i>
                        <span><strong>Support:</strong> {{ $settings['store_email'] }}</span>
                    </div>
                </div>
            </div>
        </aside>

        <!-- Right: Product list spreadsheet -->
        <div class="flex-grow w-full space-y-6">
            
            <!-- Search & Filters -->
            <div class="flex flex-col sm:flex-row gap-4 items-center justify-between bg-white border border-slate-200 p-4 rounded-2xl shadow-sm">
                <div class="relative w-full sm:max-w-md">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-3.5 pointer-events-none text-slate-400">
                        <i class="fa-solid fa-magnifying-glass text-xs"></i>
                    </span>
                    <input x-model="searchQuery" type="text" placeholder="Search firecrackers by name..." class="w-full bg-slate-50 border border-slate-200 focus:border-slate-350 focus:bg-white rounded-xl py-2 pl-10 pr-4 text-xs text-slate-700 placeholder-slate-400 focus:ring-1 focus:ring-slate-300 focus:outline-none transition-all">
                </div>
                
                <div class="flex items-center gap-2 text-xs text-slate-500 font-semibold select-none">
                    <span>Showing <strong class="text-crimson-600" x-text="filteredProductsCount">0</strong> products</span>
                </div>
            </div>

            <!-- Dynamic Spreadsheet Grid -->
            <div class="bg-white border border-slate-200 rounded-2xl overflow-hidden shadow-sm">
                <div class="overflow-x-auto">
                    <table class="w-full border-collapse text-left text-xs">
                        <thead>
                            <tr class="bg-slate-100/60 border-b border-slate-200 text-slate-500 font-bold uppercase tracking-wider text-[10px] select-none">
                                <th class="py-4 px-4">Cracker Details</th>
                                <th class="py-4 px-4 w-28 text-center">Unit / Box</th>
                                <th class="py-4 px-4 w-36 text-right">Price Tally (MRP)</th>
                                <th class="py-4 px-4 w-40 text-center">Order Qty</th>
                                <th class="py-4 px-4 w-28 text-right pr-6">Total (₹)</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-150">
                            
                            <!-- Loop Categories and products -->
                            @foreach($categories as $category)
                            <tr x-show="shouldShowCategory('{{ $category->slug }}')" class="bg-slate-50 font-bold text-slate-700 border-b border-slate-200/80 select-none">
                                <td colspan="5" class="py-3 px-4 flex items-center gap-2 text-crimson-650 tracking-wider">
                                    <i class="fa-solid fa-fire text-[10px] text-crimson-500"></i>
                                    <span>{{ $category->name }}</span>
                                </td>
                            </tr>

                            @foreach($category->products as $product)
                            <tr x-show="shouldShowProduct('{{ $category->slug }}', '{{ addslashes($product->name) }}')" class="hover:bg-slate-50/50 transition-colors">
                                
                                <!-- Description / Pic -->
                                <td class="py-3.5 px-4 flex items-center gap-3">
                                    <div class="w-10 h-10 rounded-lg bg-slate-50 border border-slate-200 flex items-center justify-center text-slate-400 overflow-hidden flex-shrink-0">
                                        @if($product->image)
                                            <img src="/{{ $product->image }}" alt="{{ $product->name }}" class="object-cover w-full h-full">
                                        @else
                                            <i class="fa-solid fa-sparkles text-sm text-crimson-450/40"></i>
                                        @endif
                                    </div>
                                    <div>
                                        <h4 class="font-extrabold text-slate-800 text-xs leading-normal">{{ $product->name }}</h4>
                                        <span class="text-[9px] font-bold text-slate-400 uppercase tracking-widest">{{ $category->name }}</span>
                                    </div>
                                </td>

                                <!-- Pack size -->
                                <td class="py-3.5 px-4 text-center text-slate-600 font-bold font-mono">
                                    {{ $product->pack_size }}
                                </td>

                                <!-- MRP vs Discount Price -->
                                <td class="py-3.5 px-4 text-right">
                                    <div class="text-slate-400 text-[10px] line-through">₹{{ number_format($product->mrp, 2) }}</div>
                                    <div class="text-crimson-650 font-extrabold">₹{{ number_format($product->selling_price, 2) }}</div>
                                </td>

                                <!-- Quantities selects -->
                                <td class="py-3.5 px-4 text-center">
                                    <div class="inline-flex items-center bg-slate-100 border border-slate-200 rounded-lg p-1 select-none">
                                        <button @click="decreaseQty({{ $product->id }})" class="w-7 h-7 text-slate-650 hover:text-slate-900 hover:bg-white rounded flex items-center justify-center font-bold text-xs transition-colors shadow-sm">
                                            <i class="fa-solid fa-minus text-[9px]"></i>
                                        </button>
                                        <input @input="updateInputQty({{ $product->id }}, $event.target.value)" type="number" :value="cart[{{ $product->id }}]?.qty || 0" min="0" class="w-12 text-center bg-transparent border-0 text-xs font-black text-slate-800 placeholder-slate-400 focus:ring-0 focus:outline-none [appearance:textfield] [&::-webkit-outer-spin-button]:appearance-none [&::-webkit-inner-spin-button]:appearance-none">
                                        <button @click="increaseQty({{ $product->id }}, {{ $product->mrp }}, {{ $product->selling_price }}, '{{ addslashes($product->name) }}', '{{ $product->pack_size }}')" class="w-7 h-7 text-slate-650 hover:text-slate-900 hover:bg-white rounded flex items-center justify-center font-bold text-xs transition-colors shadow-sm">
                                            <i class="fa-solid fa-plus text-[9px]"></i>
                                        </button>
                                    </div>
                                </td>

                                <!-- Row Tally -->
                                <td class="py-3.5 px-4 text-right font-extrabold text-slate-800 pr-6">
                                    ₹<span x-text="formatCurrency((cart[{{ $product->id }}]?.qty || 0) * {{ $product->selling_price }})">0.00</span>
                                </td>

                            </tr>
                            @endforeach
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>

        </div>

    </section>

    <!-- 3. Dynamic Floating Sticky Footer Cart Tally -->
    <div x-show="totalQty > 0" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="translate-y-full opacity-0" x-transition:enter-end="translate-y-0 opacity-100" x-transition:leave="transition ease-in duration-200" x-transition:leave-start="translate-y-0 opacity-100" x-transition:leave-end="translate-y-full opacity-0" class="fixed bottom-0 left-0 right-0 z-40 bg-white border-t border-slate-200/80 shadow-2xl py-4 backdrop-blur-md px-4 select-none">
        <div class="container mx-auto max-w-5xl flex flex-col md:flex-row gap-4 items-center justify-between">
            
            <!-- Cart details totals summary -->
            <div class="flex flex-wrap items-center gap-6 text-xs text-slate-500 w-full md:w-auto font-medium">
                <div class="text-slate-800">
                    <span class="text-[9px] text-slate-400 uppercase tracking-widest block font-bold">Total Items</span>
                    <strong class="text-base font-extrabold text-crimson-600" x-text="totalQty">0</strong> Items / <strong class="text-slate-700" x-text="totalUniqueProducts">0</strong> Products
                </div>
                
                <div>
                    <span class="text-[9px] text-slate-400 uppercase tracking-widest block font-bold">Original Price (MRP)</span>
                    <span class="line-through font-semibold text-slate-450">₹<span x-text="formatCurrency(totalMrp)">0.00</span></span>
                </div>
                
                <div class="text-crimson-700 bg-crimson-50 border border-crimson-100 px-3 py-1 rounded-xl shadow-sm">
                    <span class="text-[9px] text-crimson-500 uppercase tracking-widest block font-bold">Flat 60% Savings</span>
                    <strong class="font-extrabold">₹<span x-text="formatCurrency(totalDiscount)">0.00</span></strong>
                </div>
                
                <div class="text-slate-800">
                    <span class="text-[9px] text-slate-400 uppercase tracking-widest block font-bold">Net Payable Amount</span>
                    <strong class="text-lg font-black text-crimson-600">₹<span x-text="formatCurrency(totalNet)">0.00</span></strong>
                </div>
            </div>

            <!-- Checkout controls & meter progress -->
            <div class="flex flex-col sm:flex-row gap-3 w-full md:w-auto items-center">
                
                <!-- Minimum Order Value Progress bar -->
                <div class="w-full sm:w-48 text-center space-y-1.5" x-show="totalNet < {{ $settings['min_order_value'] }}">
                    <div class="flex justify-between text-[9px] text-slate-500 font-bold uppercase px-0.5">
                        <span>Min Order check</span>
                        <span class="text-crimson-650" x-text="minOrderProgressText()">Need ₹0 more</span>
                    </div>
                    <div class="w-full bg-slate-200 rounded-full h-2.5 border border-slate-300 overflow-hidden">
                        <div class="bg-gradient-to-r from-crimson-600 to-crimson-500 h-full rounded-full transition-all duration-300" :style="`width: ${minOrderProgressPercent()}%`"></div>
                    </div>
                </div>
                
                <!-- Standard Action Button -->
                <button @click="openCheckoutDrawer()" :disabled="totalNet < {{ $settings['min_order_value'] }}" :class="totalNet >= {{ $settings['min_order_value'] }} ? 'bg-gradient-to-r from-crimson-600 to-crimson-500 hover:from-crimson-700 hover:to-crimson-600 text-white shadow-md shadow-crimson-100 hover:scale-105 animate-bounce-subtle' : 'bg-slate-200 border border-slate-350 text-slate-400 cursor-not-allowed'" class="w-full sm:w-auto px-6 py-3 rounded-full text-xs font-extrabold uppercase tracking-wider transition-all duration-300 flex items-center justify-center gap-2">
                    <i class="fa-solid fa-basket-shopping-simple"></i>
                    <span>Checkout Now</span>
                </button>

            </div>
        </div>
    </div>

    <!-- 4. Slide-out Checkout Drawer -->
    <div x-show="checkoutOpen" x-transition:enter="transition ease-out duration-300" x-transition:leave="transition ease-in duration-300" class="fixed inset-0 z-50 overflow-hidden" style="display: none;">
        <!-- Backdrop overlay -->
        <div @click="closeCheckoutDrawer()" class="absolute inset-0 bg-slate-900/40 backdrop-blur-sm transition-opacity"></div>
        
        <div class="absolute inset-y-0 right-0 max-w-full flex pl-10">
            <div x-show="checkoutOpen" x-transition:enter="transform transition ease-out duration-300" x-transition:enter-start="translate-x-full" x-transition:enter-end="translate-x-0" x-transition:leave="transform transition ease-in duration-300" x-transition:leave-start="translate-x-0" x-transition:leave-end="translate-x-full" class="w-screen max-w-lg">
                
                <div class="h-full flex flex-col bg-white border-l border-slate-200 shadow-2xl overflow-y-auto">
                    
                    <!-- Header -->
                    <div class="bg-slate-50 border-b border-slate-200 px-6 py-4 flex items-center justify-between select-none">
                        <div>
                            <h3 class="text-sm font-bold text-slate-800 uppercase tracking-widest flex items-center gap-2">
                                <i class="fa-solid fa-basket-shopping text-crimson-650"></i> Finalize Booking
                            </h3>
                            <p class="text-[10px] text-slate-500 font-semibold">Provide shipping details to book Sivakasi crackers</p>
                        </div>
                        <button @click="closeCheckoutDrawer()" class="text-slate-400 hover:text-slate-650 p-2 rounded-lg transition-colors">
                            <i class="fa-solid fa-xmark text-sm"></i>
                        </button>
                    </div>

                    <!-- Checkout Form content -->
                    <form @submit.prevent="submitOrder()" class="flex-grow flex flex-col p-6 space-y-5">
                        
                        <!-- Customer details fields -->
                        <div class="space-y-4">
                            
                            <div>
                                <label class="block text-[9px] font-bold text-slate-500 uppercase tracking-wider mb-1.5"><i class="fa-solid fa-user mr-1 text-crimson-500/80"></i>Full Name <span class="text-crimson-500">*</span></label>
                                <input x-model="form.name" type="text" required placeholder="Full Name" class="w-full bg-slate-50 border border-slate-200 focus:border-slate-350 focus:bg-white rounded-xl px-3.5 py-2.5 text-xs text-slate-700 placeholder-slate-400 focus:outline-none transition-all">
                            </div>

                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-[9px] font-bold text-slate-500 uppercase tracking-wider mb-1.5"><i class="fa-solid fa-phone mr-1 text-crimson-500/80"></i>Mobile Number <span class="text-crimson-500">*</span></label>
                                    <input x-model="form.phone" type="tel" required placeholder="Active Mobile Number" class="w-full bg-slate-50 border border-slate-200 focus:border-slate-350 focus:bg-white rounded-xl px-3.5 py-2.5 text-xs text-slate-700 placeholder-slate-400 focus:outline-none transition-all font-mono">
                                </div>
                                <div>
                                    <label class="block text-[9px] font-bold text-slate-500 uppercase tracking-wider mb-1.5"><i class="fa-brands fa-whatsapp mr-1 text-crimson-500/80"></i>WhatsApp Number</label>
                                    <input x-model="form.whatsapp" type="tel" placeholder="WhatsApp Number" class="w-full bg-slate-50 border border-slate-200 focus:border-slate-350 focus:bg-white rounded-xl px-3.5 py-2.5 text-xs text-slate-700 placeholder-slate-400 focus:outline-none transition-all font-mono">
                                </div>
                            </div>

                            <div>
                                <label class="block text-[9px] font-bold text-slate-500 uppercase tracking-wider mb-1.5"><i class="fa-solid fa-envelope mr-1 text-crimson-500/80"></i>Email Address</label>
                                <input x-model="form.email" type="email" placeholder="Email Address (Optional)" class="w-full bg-slate-50 border border-slate-200 focus:border-slate-350 focus:bg-white rounded-xl px-3.5 py-2.5 text-xs text-slate-700 placeholder-slate-400 focus:outline-none transition-all">
                            </div>

                            <div>
                                <label class="block text-[9px] font-bold text-slate-500 uppercase tracking-wider mb-1.5"><i class="fa-solid fa-location-dot mr-1 text-crimson-500/80"></i>Delivery Address <span class="text-crimson-500">*</span></label>
                                <textarea x-model="form.address" required rows="3" placeholder="Full Delivery Address" class="w-full bg-slate-50 border border-slate-200 focus:border-slate-350 focus:bg-white rounded-xl px-3.5 py-2.5 text-xs text-slate-700 placeholder-slate-400 focus:outline-none transition-all resize-none"></textarea>
                            </div>

                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-[9px] font-bold text-slate-500 uppercase tracking-wider mb-1.5"><i class="fa-solid fa-map-pin mr-1 text-crimson-500/80"></i>Landmark</label>
                                    <input x-model="form.landmark" type="text" placeholder="Landmark (Optional)" class="w-full bg-slate-50 border border-slate-200 focus:border-slate-350 focus:bg-white rounded-xl px-3.5 py-2.5 text-xs text-slate-700 placeholder-slate-400 focus:outline-none transition-all">
                                </div>
                                <div>
                                    <label class="block text-[9px] font-bold text-slate-500 uppercase tracking-wider mb-1.5"><i class="fa-solid fa-city mr-1 text-crimson-500/80"></i>City / Town <span class="text-crimson-500">*</span></label>
                                    <input x-model="form.city" type="text" required placeholder="City or Town" class="w-full bg-slate-50 border border-slate-200 focus:border-slate-350 focus:bg-white rounded-xl px-3.5 py-2.5 text-xs text-slate-700 placeholder-slate-400 focus:outline-none transition-all">
                                </div>
                            </div>

                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-[9px] font-bold text-slate-500 uppercase tracking-wider mb-1.5"><i class="fa-solid fa-globe mr-1 text-crimson-500/80"></i>State <span class="text-crimson-500">*</span></label>
                                    <select x-model="form.state" required class="w-full bg-slate-50 border border-slate-200 focus:border-slate-350 focus:bg-white rounded-xl px-3.5 py-2.5 text-xs text-slate-700 focus:outline-none transition-all">
                                        <option value="Tamilnadu">Tamilnadu</option>
                                        <option value="Kerala">Kerala</option>
                                        <option value="Karnataka">Karnataka</option>
                                        <option value="Andhra Pradesh">Andhra Pradesh</option>
                                        <option value="Telangana">Telangana</option>
                                        <option value="Puducherry">Puducherry</option>
                                    </select>
                                </div>
                                <div>
                                    <label class="block text-[9px] font-bold text-slate-500 uppercase tracking-wider mb-1.5"><i class="fa-solid fa-map-location mr-1 text-crimson-500/80"></i>Pin Code <span class="text-crimson-500">*</span></label>
                                    <input x-model="form.pincode" type="text" required placeholder="Pin Code" class="w-full bg-slate-50 border border-slate-200 focus:border-slate-350 focus:bg-white rounded-xl px-3.5 py-2.5 text-xs text-slate-700 placeholder-slate-400 focus:outline-none transition-all font-mono">
                                </div>
                            </div>

                            <div>
                                <label class="block text-[9px] font-bold text-slate-500 uppercase tracking-wider mb-1.5"><i class="fa-solid fa-truck-ramp-box mr-1 text-crimson-500/80"></i>Preferred Lorry Transport Name</label>
                                <input x-model="form.transport_name" type="text" placeholder="Preferred Transport Name (Optional)" class="w-full bg-slate-50 border border-slate-200 focus:border-slate-350 focus:bg-white rounded-xl px-3.5 py-2.5 text-xs text-slate-700 placeholder-slate-400 focus:outline-none transition-all">
                            </div>

                            <div>
                                <label class="block text-[9px] font-bold text-slate-500 uppercase tracking-wider mb-1.5"><i class="fa-solid fa-pencil mr-1 text-crimson-500/80"></i>Special Delivery Instructions</label>
                                <textarea x-model="form.notes" rows="2" placeholder="Instructions/Notes (Optional)" class="w-full bg-slate-50 border border-slate-200 focus:border-slate-350 focus:bg-white rounded-xl px-3.5 py-2.5 text-xs text-slate-700 placeholder-slate-400 focus:outline-none transition-all resize-none"></textarea>
                            </div>

                        </div>

                        <!-- Drawer Footer -->
                        <div class="pt-4 border-t border-slate-250 space-y-4">
                            <div class="bg-slate-50 border border-slate-200 p-3 rounded-xl flex items-center justify-between text-xs font-semibold">
                                <span class="text-slate-500">Total Net Booking Amount:</span>
                                <span class="text-crimson-650 font-extrabold text-sm">₹<span x-text="formatCurrency(totalNet)">0.00</span></span>
                            </div>

                            <button type="submit" :disabled="submitting" class="w-full bg-gradient-to-r from-crimson-600 to-crimson-500 hover:from-crimson-700 hover:to-crimson-600 disabled:from-slate-200 disabled:to-slate-200 text-white disabled:text-slate-400 font-extrabold py-3.5 rounded-full text-xs uppercase tracking-wider shadow transform active:scale-95 transition-all flex items-center justify-center gap-2">
                                <template x-if="submitting">
                                    <i class="fa-solid fa-spinner-third animate-spin mr-1"></i>
                                </template>
                                <template x-if="!submitting">
                                    <i class="fa-solid fa-file-invoice-dollar mr-1"></i>
                                </template>
                                <span x-text="submitting ? 'Placing Order...' : 'Submit & Get UPI Invoice'">Submit & Get UPI Invoice</span>
                            </button>
                        </div>

                    </form>

                </div>
            </div>
        </div>
    </div>

</div>
@endsection

@section('scripts')
<script>
    function storefrontData() {
        return {
            activeCategory: 'all',
            searchQuery: '',
            cart: {}, // Format: { productId: { id, qty, mrp, selling_price, name, pack_size } }
            totalQty: 0,
            totalMrp: 0.00,
            totalDiscount: 0.00,
            totalNet: 0.00,
            totalUniqueProducts: 0,
            
            checkoutOpen: false,
            submitting: false,
            
            form: {
                name: '',
                phone: '',
                whatsapp: '',
                email: '',
                address: '',
                landmark: '',
                city: '',
                state: 'Tamilnadu',
                pincode: '',
                transport_name: '',
                notes: ''
            },

            initStorefront() {
                // Initialize cart from localStorage if exists
                if (localStorage.getItem('athi_cart')) {
                    try {
                        this.cart = JSON.parse(localStorage.getItem('athi_cart'));
                        this.calculateCart();
                    } catch (e) {
                        this.cart = {};
                    }
                }
            },

            formatCurrency(value) {
                return parseFloat(value).toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,');
            },

            increaseQty(id, mrp, selling_price, name, pack_size) {
                if (!this.cart[id]) {
                    this.cart[id] = {
                        id: id,
                        qty: 0,
                        mrp: parseFloat(mrp),
                        selling_price: parseFloat(selling_price),
                        name: name,
                        pack_size: pack_size
                    };
                }
                this.cart[id].qty++;
                this.saveCart();
            },

            decreaseQty(id) {
                if (this.cart[id]) {
                    this.cart[id].qty--;
                    if (this.cart[id].qty <= 0) {
                        delete this.cart[id];
                    }
                    this.saveCart();
                }
            },

            updateInputQty(id, val) {
                const qty = parseInt(val);
                if (isNaN(qty) || qty <= 0) {
                    if (this.cart[id]) {
                        delete this.cart[id];
                        this.saveCart();
                    }
                } else {
                    if (this.cart[id]) {
                        this.cart[id].qty = qty;
                        this.saveCart();
                    }
                }
            },

            saveCart() {
                localStorage.setItem('athi_cart', JSON.stringify(this.cart));
                this.calculateCart();
            },

            calculateCart() {
                let qtySum = 0;
                let mrpSum = 0;
                let netSum = 0;
                let uniques = 0;

                for (const id in this.cart) {
                    const item = this.cart[id];
                    if (item.qty > 0) {
                        qtySum += item.qty;
                        mrpSum += item.mrp * item.qty;
                        netSum += item.selling_price * item.qty;
                        uniques++;
                    }
                }

                this.totalQty = qtySum;
                this.totalMrp = mrpSum;
                this.totalNet = netSum;
                this.totalDiscount = mrpSum - netSum;
                this.totalUniqueProducts = uniques;
            },

            minOrderProgressPercent() {
                const min = {{ $settings['min_order_value'] }};
                if (this.totalNet >= min) return 100;
                return (this.totalNet / min) * 100;
            },

            minOrderProgressText() {
                const min = {{ $settings['min_order_value'] }};
                if (this.totalNet >= min) return "Met!";
                const needed = min - this.totalNet;
                return `Add ₹${needed.toFixed(2)} more`;
            },

            shouldShowCategory(slug) {
                if (this.activeCategory !== 'all' && this.activeCategory !== slug) {
                    return false;
                }
                return true;
            },

            shouldShowProduct(categorySlug, name) {
                if (this.activeCategory !== 'all' && this.activeCategory !== categorySlug) {
                    return false;
                }

                if (this.searchQuery.trim() !== '') {
                    const query = this.searchQuery.toLowerCase();
                    return name.toLowerCase().includes(query);
                }

                return true;
            },

            get filteredProductsCount() {
                let count = 0;
                const rows = document.querySelectorAll('tbody tr[x-show^="shouldShowProduct"]');
                rows.forEach(row => {
                    if (row.style.display !== 'none') {
                        count++;
                    }
                });
                return count;
            },

            openCheckoutDrawer() {
                if (this.totalNet >= {{ $settings['min_order_value'] }}) {
                    this.checkoutOpen = true;
                }
            },

            closeCheckoutDrawer() {
                this.checkoutOpen = false;
            },

            submitOrder() {
                this.submitting = true;
                
                const orderItems = [];
                for (const id in this.cart) {
                    orderItems.push({
                        id: id,
                        qty: this.cart[id].qty
                    });
                }

                const payload = {
                    ...this.form,
                    items: orderItems
                };

                fetch('/checkout', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify(payload)
                })
                .then(response => response.json())
                .then(data => {
                    this.submitting = false;
                    if (data.success) {
                        this.cart = {};
                        localStorage.removeItem('athi_cart');
                        this.calculateCart();
                        this.checkoutOpen = false;
                        window.location.href = data.redirect;
                    } else {
                        Swal.fire({
                            title: 'Error!',
                            text: data.error || 'Failed to place order.',
                            icon: 'error',
                            confirmButtonColor: '#e51d1d'
                        });
                    }
                })
                .catch(error => {
                    this.submitting = false;
                    Swal.fire({
                        title: 'Server Error!',
                        text: 'Unable to connect to the server. Please try again.',
                        icon: 'error',
                        confirmButtonColor: '#e51d1d'
                    });
                });
            }
        };
    }
</script>
@endsection
