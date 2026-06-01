@extends('layouts.app')

@section('title', 'About Us | ' . App\Models\Setting::get('store_name', 'Cracker Demo') . ' Sivakasi')

@section('content')
<div class="relative text-slate-800 select-none">

    <!-- 1. Premium Glassmorphic Hero Banner -->
    <section class="relative bg-white border-b border-slate-200 overflow-hidden py-20">
        <!-- Soft gradient mesh in background -->
        <div class="absolute inset-0 bg-[radial-gradient(circle_at_top_right,_var(--tw-gradient-stops))] from-crimson-100/20 via-white to-slate-50 opacity-90 pointer-events-none"></div>
        
        <div class="container mx-auto px-4 text-center relative z-10 space-y-4">
            <span class="inline-flex items-center gap-1.5 bg-gold-50 border border-gold-200 text-gold-700 text-xs font-extrabold uppercase tracking-widest px-3.5 py-1.5 rounded-full shadow-sm">
                <i class="fa-solid fa-fire text-crimson-600"></i> Pure sivakasi manufactured
            </span>
            <h2 class="text-4xl md:text-5xl font-black tracking-tight text-slate-900 leading-tight">
                About {{ App\Models\Setting::get('store_name', 'Cracker Demo') }}
            </h2>
            <p class="text-sm text-slate-550 max-w-xl mx-auto leading-relaxed font-semibold">
                Reputed and reliable Sivakasi fireworks dealers offering premium quality, highly colorful, and 100% safe crackers for all your celebrations.
            </p>
        </div>
    </section>

    <!-- 2. Premium Core Company Showcase Section -->
    <section class="container mx-auto px-4 py-16">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
            
            <!-- Left Column: Generated collage of products -->
            <div class="relative group">
                <div class="absolute -inset-2 bg-gradient-to-tr from-gold-500 to-crimson-600 rounded-3xl opacity-10 blur-xl group-hover:opacity-15 transition-opacity duration-500"></div>
                <div class="relative bg-white border border-slate-200 p-3.5 rounded-3xl shadow-lg overflow-hidden transform group-hover:scale-[1.01] transition-transform duration-300">
                    <img src="/images/about_showcase.png" alt="Sivakasi Fireworks Showcase" class="w-full h-auto object-cover rounded-2xl">
                </div>
            </div>

            <!-- Right Column: Content -->
            <div class="space-y-6">
                <div class="space-y-2">
                    <span class="text-xs font-bold text-crimson-600 uppercase tracking-widest"><i class="fa-solid fa-shield-heart mr-1"></i> A Decade of Quality</span>
                    <h3 class="text-2xl md:text-3xl font-black text-slate-900 tracking-tight leading-tight">We Provide Premium Quality Fireworks</h3>
                </div>
                <p class="text-xs text-slate-650 leading-relaxed font-semibold">
                    We are a highly reputed and reliable name involved in the field of Fireworks trading business for the past 10 years. 
                </p>
                <p class="text-xs text-slate-500 leading-relaxed font-medium">
                    We offer a wide range of fireworks products such as Sparklers, Ground Chakkars, Twinkling Stars, Chorsa, Rockets, Flower Pots, Pencils, Atom Bombs, Colour Matches, and other Fancy Aerial Items. We also offer standard and customized fireworks gift boxes at highly competitive Sivakasi wholesale prices.
                </p>
                <p class="text-xs text-slate-500 leading-relaxed font-medium">
                    Through websites, instant WhatsApp checkouts, and modern logistic systems, we are able to process, pack, and ship your orders to Kerala, Karnataka, Andhra, Telangana, and Tamilnadu faster, safer, and on-time to your complete satisfaction.
                </p>
                <div class="pt-4 border-t border-slate-100 flex flex-wrap gap-6 text-xs text-slate-650 font-bold">
                    <div class="flex items-center gap-2">
                        <i class="fa-solid fa-square-check text-emerald-600 text-lg"></i>
                        <span>Sivakasi Direct Stock</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <i class="fa-solid fa-square-check text-emerald-600 text-lg"></i>
                        <span>Flat 60% Wholesale Savings</span>
                    </div>
                </div>
            </div>

        </div>
    </section>

    <!-- 3. Dynamic Interactive CTA Section -->
    <section class="bg-gradient-to-tr from-slate-900 via-slate-800 to-slate-950 text-white py-16 relative overflow-hidden select-none shadow-inner border-y border-slate-900">
        <div class="absolute w-[500px] h-[500px] bg-[radial-gradient(circle,_rgba(229,191,19,0.05)_0%,_rgba(0,0,0,0)_70%)] -top-44 -left-44 pointer-events-none"></div>
        <div class="absolute w-[500px] h-[500px] bg-[radial-gradient(circle,_rgba(248,59,59,0.05)_0%,_rgba(0,0,0,0)_70%)] -bottom-44 -right-44 pointer-events-none"></div>
        
        <div class="container mx-auto px-4 text-center max-w-2xl relative z-10 space-y-6">
            <h3 class="text-2xl md:text-3xl font-black tracking-tight text-white leading-tight">
                Have any questions related to our Sivakasi products? Feel free to enquire!
            </h3>
            <p class="text-xs text-slate-400 font-semibold leading-relaxed">
                Our support team is active and ready to assist you with order bookings, bulk discounts, and transport logistics details.
            </p>
            <div class="pt-4 flex flex-wrap justify-center gap-4">
                <a href="https://wa.me/{{ App\Models\Setting::get('store_whatsapp', '919998887776') }}" target="_blank" class="bg-emerald-600 hover:bg-emerald-500 text-white px-6 py-3 rounded-full text-xs font-extrabold flex items-center gap-2 shadow shadow-emerald-950/20 transform active:scale-95 transition-all">
                    <i class="fa-brands fa-whatsapp text-sm"></i>
                    <span>Contact WhatsApp Support</span>
                </a>
                <a href="/" class="bg-gradient-to-r from-gold-500 to-amber-500 hover:from-gold-600 hover:to-amber-600 text-slate-950 px-6 py-3 rounded-full text-xs font-black uppercase tracking-wider shadow transform active:scale-95 transition-all flex items-center gap-2">
                    <i class="fa-solid fa-basket-shopping"></i>
                    <span>Browse Price List</span>
                </a>
            </div>
        </div>
    </section>

    <!-- 4. Three-Column Pillars Section (Why Choose Us & Vision/Mission & Safety) -->
    <section class="container mx-auto px-4 py-16">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            
            <!-- Column 1: Why Choose Us -->
            <div class="bg-white border border-slate-200 p-6 rounded-2xl shadow-sm space-y-6">
                <div class="space-y-1.5 border-b border-slate-100 pb-4">
                    <span class="text-[9px] text-crimson-600 font-bold uppercase tracking-widest block"><i class="fa-solid fa-star"></i> Core values</span>
                    <h3 class="text-lg font-black text-slate-800 tracking-tight">Why Choose Us</h3>
                </div>
                <p class="text-xs text-slate-500 leading-relaxed font-semibold">
                    Our company is renowned for providing high-grade fireworks products to our esteemed customers at the lowest Sivakasi market prices.
                </p>
                <ul class="space-y-2.5 text-xs text-slate-650 font-bold">
                    <li class="flex items-center gap-2.5">
                        <i class="fa-solid fa-fire text-gold-500 text-xs flex-shrink-0"></i>
                        <span>10+ Years of Trading Experience</span>
                    </li>
                    <li class="flex items-center gap-2.5">
                        <i class="fa-solid fa-fire text-gold-500 text-xs flex-shrink-0"></i>
                        <span>Direct Dealers of Reputed Brands</span>
                    </li>
                    <li class="flex items-center gap-2.5">
                        <i class="fa-solid fa-fire text-gold-500 text-xs flex-shrink-0"></i>
                        <span>Quality & Standard Safety Crackers</span>
                    </li>
                    <li class="flex items-center gap-2.5">
                        <i class="fa-solid fa-fire text-gold-500 text-xs flex-shrink-0"></i>
                        <span>Transparent & Ethical Operations</span>
                    </li>
                    <li class="flex items-center gap-2.5">
                        <i class="fa-solid fa-fire text-gold-500 text-xs flex-shrink-0"></i>
                        <span>Quick Responses & Swift Shipping</span>
                    </li>
                </ul>
            </div>

            <!-- Column 2: Center visual graphic -->
            <div class="bg-gradient-to-tr from-gold-50/50 to-crimson-50/50 border border-slate-200/60 p-6 rounded-2xl shadow-sm flex flex-col justify-center items-center text-center space-y-4">
                <div class="w-16 h-16 rounded-full bg-white border border-slate-200 flex items-center justify-center text-crimson-600 text-3xl shadow-sm">
                    <i class="fa-solid fa-fire-burner"></i>
                </div>
                <h4 class="font-extrabold text-sm text-slate-850 uppercase tracking-widest">{{ App\Models\Setting::get('store_name', 'Cracker Demo') }}</h4>
                <p class="text-[11px] text-slate-500 leading-normal max-w-xs font-semibold">
                    Spreading lights, sparkles, and infinite joy to all Indian households observing strict security and environment protocols.
                </p>
            </div>

            <!-- Column 3: Vision & Mission -->
            <div class="bg-white border border-slate-200 p-6 rounded-2xl shadow-sm space-y-6">
                <div class="space-y-1.5 border-b border-slate-100 pb-4">
                    <span class="text-[9px] text-gold-600 font-bold uppercase tracking-widest block"><i class="fa-solid fa-eye"></i> Goals & targets</span>
                    <h3 class="text-lg font-black text-slate-800 tracking-tight">Vision & Mission</h3>
                </div>
                
                <div class="space-y-4 text-xs font-semibold">
                    <div class="space-y-1">
                        <strong class="text-slate-800 block font-bold uppercase tracking-wider text-[10px]"><i class="fa-solid fa-circle-check text-gold-500 text-[9px] mr-1"></i> Our Vision</strong>
                        <p class="text-slate-500 leading-relaxed">
                            To be the finest wholesale and retail fireworks booking shop for Sivakasi fancy crackers and customized diwali giftboxes.
                        </p>
                    </div>
                    <div class="space-y-1 pt-3 border-t border-slate-100">
                        <strong class="text-slate-800 block font-bold uppercase tracking-wider text-[10px]"><i class="fa-solid fa-circle-check text-gold-500 text-[9px] mr-1"></i> Our Mission</strong>
                        <p class="text-slate-500 leading-relaxed">
                            To provide pure quality, highly innovative, and completely safe crackers to our valuable customers at highly affordable rates.
                        </p>
                    </div>
                </div>
            </div>

        </div>
    </section>

</div>
@endsection
