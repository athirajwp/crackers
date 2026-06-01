<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $__env->yieldContent('title', 'Admin Console | ' . App\Models\Setting::get('store_name', 'Cracker Demo') . ' Sivakasi'); ?></title>
    
    <!-- Favicon -->
    <link rel="icon" type="image/png" href="https://img.icons8.com/color/48/settings.png">
    
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
    
    <!-- SweetAlert2 for elegant modal notifications -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
    <!-- Custom styling -->
    <style>
        .custom-scrollbar::-webkit-scrollbar {
            width: 4px;
            height: 4px;
        }
        .custom-scrollbar::-webkit-scrollbar-track {
            background: #f1f5f9;
        }
        .custom-scrollbar::-webkit-scrollbar-thumb {
            background: #cbd5e1;
            border-radius: 9999px;
        }
    </style>
</head>
<body class="bg-slate-50 text-slate-800 min-h-screen flex font-sans">

    <!-- 1. Admin Sidebar Navigation (Premium Dark Sidebar) -->
    <aside class="w-64 bg-slate-900 border-r border-slate-800 flex flex-col justify-between flex-shrink-0 select-none hidden md:flex text-slate-100">
        
        <div class="space-y-6 py-6">
            <!-- Header Brand -->
            <div class="px-6 flex items-center gap-3">
                <div class="bg-gold-500 p-1.5 rounded-lg">
                    <i class="fa-solid fa-lock-keyhole text-slate-950 text-base"></i>
                </div>
                <div>
                    <h2 class="text-xs font-black uppercase tracking-widest text-white leading-none"><?php echo e(App\Models\Setting::get('store_name', 'Cracker Demo')); ?></h2>
                    <span class="text-[9px] text-slate-500 tracking-wider">Management Console</span>
                </div>
            </div>

            <!-- Main Menu Links -->
            <nav class="space-y-1.5 px-3">
                <a href="<?php echo e(route('admin.dashboard')); ?>" class="w-full flex items-center gap-3 px-4 py-2.5 rounded-xl text-xs font-bold <?php echo e(request()->routeIs('admin.dashboard') ? 'bg-gold-500 text-slate-950' : 'text-slate-400 hover:bg-slate-800/60 hover:text-slate-200'); ?> transition-colors">
                    <i class="fa-solid fa-chart-line text-sm"></i>
                    <span>Dashboard Metrics</span>
                </a>
                <a href="<?php echo e(route('admin.orders.index')); ?>" class="w-full flex items-center gap-3 px-4 py-2.5 rounded-xl text-xs font-bold <?php echo e(request()->routeIs('admin.orders.*') ? 'bg-gold-500 text-slate-950' : 'text-slate-400 hover:bg-slate-800/60 hover:text-slate-200'); ?> transition-colors">
                    <i class="fa-solid fa-truck-ramp-box text-sm"></i>
                    <span>Booked Orders</span>
                </a>
                <a href="<?php echo e(route('admin.products.index')); ?>" class="w-full flex items-center gap-3 px-4 py-2.5 rounded-xl text-xs font-bold <?php echo e(request()->routeIs('admin.products.*') ? 'bg-gold-500 text-slate-950' : 'text-slate-400 hover:bg-slate-800/60 hover:text-slate-200'); ?> transition-colors">
                    <i class="fa-solid fa-boxes-stacked text-sm"></i>
                    <span>Manage Inventory</span>
                </a>
                <a href="<?php echo e(route('admin.categories.index')); ?>" class="w-full flex items-center gap-3 px-4 py-2.5 rounded-xl text-xs font-bold <?php echo e(request()->routeIs('admin.categories.*') ? 'bg-gold-500 text-slate-950' : 'text-slate-400 hover:bg-slate-800/60 hover:text-slate-200'); ?> transition-colors">
                    <i class="fa-solid fa-list-check text-sm"></i>
                    <span>Categories List</span>
                </a>
                <a href="<?php echo e(route('admin.settings.index')); ?>" class="w-full flex items-center gap-3 px-4 py-2.5 rounded-xl text-xs font-bold <?php echo e(request()->routeIs('admin.settings.*') ? 'bg-gold-500 text-slate-950' : 'text-slate-400 hover:bg-slate-800/60 hover:text-slate-200'); ?> transition-colors">
                    <i class="fa-solid fa-sliders text-sm"></i>
                    <span>Store Settings</span>
                </a>
            </nav>
        </div>

        <!-- Footer actions inside sidebar -->
        <div class="p-4 border-t border-slate-800/80 space-y-2">
            <a href="/" target="_blank" class="w-full flex items-center justify-center gap-2 py-2 border border-slate-800 hover:border-slate-700 bg-slate-950 hover:bg-slate-900 rounded-xl text-xs font-bold text-slate-300 transition-colors">
                <i class="fa-solid fa-globe"></i>
                <span>Open Front Store</span>
            </a>
            <form action="<?php echo e(route('admin.logout')); ?>" method="POST" class="w-full">
                <?php echo csrf_field(); ?>
                <button type="submit" class="w-full flex items-center justify-center gap-2 py-2 bg-crimson-800 hover:bg-crimson-700 text-white rounded-xl text-xs font-black transition-colors">
                    <i class="fa-solid fa-arrow-right-from-bracket"></i>
                    <span>Logout</span>
                </button>
            </form>
        </div>

    </aside>

    <!-- 2. Main content pane (Premium Light Content) -->
    <div class="flex-grow flex flex-col min-w-0">
        
        <!-- Header -->
        <header class="bg-white border-b border-slate-250 h-16 flex items-center justify-between px-6 select-none shadow-sm">
            <div class="flex items-center gap-4">
                <!-- Mobile Nav toggle -->
                <button class="md:hidden text-slate-500 hover:text-slate-800 p-2 rounded-lg border border-slate-200">
                    <i class="fa-solid fa-bars"></i>
                </button>
                
                <h3 class="text-xs font-bold text-slate-500 uppercase tracking-widest hidden sm:block"><?php echo e(App\Models\Setting::get('store_name', 'Cracker Demo')); ?> Dashboard Control</h3>
            </div>

            <div class="flex items-center gap-3">
                <span class="text-xs text-slate-650 font-bold bg-slate-50 border border-slate-200 px-3 py-1 rounded-full flex items-center gap-1.5 shadow-sm">
                    <i class="fa-solid fa-circle text-[8px] text-emerald-500 animate-pulse"></i> Admin Panel
                </span>
            </div>
        </header>

        <!-- Main Workspace container -->
        <main class="flex-grow p-6 overflow-y-auto bg-slate-50 custom-scrollbar">
            
            <!-- SweetAlert flash prompts -->
            <?php if(session('success')): ?>
            <script>
                Swal.fire({
                    title: 'Success!',
                    text: "<?php echo e(session('success')); ?>",
                    icon: 'success',
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true,
                    confirmButtonColor: '#e5bf13'
                });
            </script>
            <?php endif; ?>

            <?php echo $__env->yieldContent('content'); ?>
        </main>
    </div>

    <?php echo $__env->yieldContent('scripts'); ?>
</body>
</html>
<?php /**PATH C:\Users\Athi\OneDrive\Desktop\crackers\resources\views/layouts/admin.blade.php ENDPATH**/ ?>