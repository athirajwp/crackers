<?php $__env->startSection('title', 'Manage Products | Admin Console'); ?>

<?php $__env->startSection('content'); ?>
<div x-data="{ addOpen: false, editOpen: false, editItem: {} }" class="space-y-8 select-none text-slate-800">
    
    <!-- Header -->
    <div class="flex justify-between items-center">
        <div>
            <h2 class="text-xl font-extrabold text-slate-900 tracking-tight">Product Inventory Registry</h2>
            <p class="text-[10px] text-slate-500 uppercase tracking-widest leading-none font-semibold">Add, edit, or remove store products</p>
        </div>
        
        <button @click="addOpen = true" class="bg-gradient-to-r from-crimson-600 to-crimson-500 hover:from-crimson-750 hover:to-crimson-655 text-white font-extrabold px-4 py-2.5 rounded-xl text-xs uppercase tracking-wider shadow transition-all active:scale-95 flex items-center gap-1.5">
            <i class="fa-solid fa-circle-plus"></i> Add Product
        </button>
    </div>

    <!-- Product list container -->
    <div class="bg-white border border-slate-200 rounded-2xl p-6 shadow-sm">
        
        <div class="overflow-x-auto border border-slate-200 rounded-xl shadow-inner">
            <table class="w-full text-left text-xs border-collapse">
                <thead>
                    <tr class="bg-slate-50 border-b border-slate-200 text-slate-500 font-bold uppercase tracking-wider text-[10px]">
                        <th class="py-4 px-4">Product Details</th>
                        <th class="py-4 px-4 w-40">Category</th>
                        <th class="py-4 px-4 w-28 text-center">Pack</th>
                        <th class="py-4 px-4 w-32 text-right">Pricing (MRP/Sell)</th>
                        <th class="py-4 px-4 w-24 text-center">Status</th>
                        <th class="py-4 px-4 w-28 text-center pr-4">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-150 text-slate-650 font-semibold">
                    <?php if($products->count() > 0): ?>
                        <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr class="hover:bg-slate-50/50">
                            
                            <!-- Name / Thumbnail -->
                            <td class="py-3 px-4 flex items-center gap-3">
                                <div class="w-10 h-10 rounded-lg bg-slate-50 border border-slate-200 flex items-center justify-center text-slate-400 overflow-hidden flex-shrink-0">
                                    <?php if($product->image): ?>
                                        <img src="/<?php echo e($product->image); ?>" alt="<?php echo e($product->name); ?>" class="object-cover w-full h-full">
                                    <?php else: ?>
                                        <i class="fa-solid fa-sparkles text-xs text-crimson-450/40"></i>
                                    <?php endif; ?>
                                </div>
                                <strong class="text-slate-800 font-extrabold text-xs leading-normal select-all"><?php echo e($product->name); ?></strong>
                            </td>

                            <!-- Category -->
                            <td class="py-3 px-4 font-bold text-slate-500">
                                <?php echo e($product->category->name); ?>

                            </td>

                            <!-- Pack size -->
                            <td class="py-3 px-4 text-center text-slate-550 font-bold font-mono">
                                <?php echo e($product->pack_size); ?>

                            </td>

                            <!-- Prices -->
                            <td class="py-3 px-4 text-right">
                                <div class="text-[10px] text-slate-400 line-through">₹<?php echo e(number_format($product->mrp, 2)); ?></div>
                                <div class="text-crimson-650 font-black text-xs">₹<?php echo e(number_format($product->selling_price, 2)); ?></div>
                                <div class="text-[9px] text-emerald-600 font-bold">(<?php echo e($product->discount_percentage); ?>% Off)</div>
                            </td>

                            <!-- Status -->
                            <td class="py-3 px-4 text-center">
                                <span class="px-2 py-0.5 rounded-full text-[9px] font-bold uppercase tracking-wider 
                                      <?php echo e($product->status === 'active' ? 'bg-emerald-50 text-emerald-600 border border-emerald-200' : 'bg-slate-100 text-slate-450 border border-slate-200'); ?>">
                                    <?php echo e($product->status); ?>

                                </span>
                            </td>

                            <!-- Actions -->
                            <td class="py-3 px-4 text-center pr-4">
                                <div class="inline-flex gap-2">
                                    <button @click="editItem = { 
                                                id: <?php echo e($product->id); ?>, 
                                                category_id: <?php echo e($product->category_id); ?>, 
                                                name: '<?php echo e(addslashes($product->name)); ?>', 
                                                pack_size: '<?php echo e(addslashes($product->pack_size)); ?>', 
                                                mrp: <?php echo e($product->mrp); ?>, 
                                                selling_price: <?php echo e($product->selling_price); ?>, 
                                                status: '<?php echo e($product->status); ?>' 
                                            }; editOpen = true" class="bg-slate-50 hover:bg-slate-100 border border-slate-200 w-8 h-8 rounded-lg text-slate-600 hover:text-slate-900 transition-colors shadow-sm" title="Edit Product">
                                        <i class="fa-solid fa-pen-to-square text-xs"></i>
                                    </button>
                                    
                                    <form action="<?php echo e(route('admin.products.destroy', $product->id)); ?>" method="POST" onsubmit="return confirm('Are you sure you want to delete this product?');">
                                        <?php echo csrf_field(); ?>
                                        <?php echo method_field('DELETE'); ?>
                                        <button type="submit" class="bg-slate-50 hover:bg-crimson-50 border border-slate-200 hover:border-crimson-200 w-8 h-8 rounded-lg text-slate-400 hover:text-crimson-600 transition-colors shadow-sm" title="Delete Product">
                                            <i class="fa-solid fa-trash-can text-xs"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>

                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="6" class="py-12 px-4 text-center text-slate-400 font-semibold italic">No products added yet. Click 'Add Product' to get started!</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

    </div>

    <!-- Product addition Modal Drawer -->
    <div x-show="addOpen" class="fixed inset-0 z-50 overflow-hidden" style="display: none;">
        <div @click="addOpen = false" class="absolute inset-0 bg-slate-900/40 backdrop-blur-sm transition-opacity"></div>
        <div class="absolute inset-y-0 right-0 max-w-full flex pl-10">
            <div class="w-screen max-w-md">
                <div class="h-full flex flex-col bg-white border-l border-slate-200 shadow-2xl overflow-y-auto">
                    
                    <div class="bg-slate-50 border-b border-slate-200 px-6 py-4 flex items-center justify-between">
                        <div>
                            <h3 class="text-sm font-bold text-slate-800 uppercase tracking-widest"><i class="fa-solid fa-circle-plus text-crimson-600 mr-1.5"></i> Add New Product</h3>
                            <p class="text-[9px] text-slate-500 font-semibold">Insert new firecracker inventory details</p>
                        </div>
                        <button @click="addOpen = false" class="text-slate-400 hover:text-slate-650 p-2 rounded-lg"><i class="fa-solid fa-xmark text-sm"></i></button>
                    </div>

                    <form action="<?php echo e(route('admin.products.store')); ?>" method="POST" enctype="multipart/form-data" class="p-6 space-y-4 text-xs font-semibold">
                        <?php echo csrf_field(); ?>
                        
                        <div>
                            <label class="block text-[9px] font-bold text-slate-500 uppercase tracking-wider mb-1.5">Product Name</label>
                            <input type="text" name="name" required placeholder="e.g. 10 Pcs Sparklers" class="w-full bg-slate-50 border border-slate-200 focus:border-slate-350 focus:bg-white rounded-xl px-3 py-2 text-slate-700 focus:outline-none transition-all">
                        </div>

                        <div>
                            <label class="block text-[9px] font-bold text-slate-500 uppercase tracking-wider mb-1.5">Inventory Category</label>
                            <select name="category_id" required class="w-full bg-slate-55 border border-slate-200 focus:border-slate-350 focus:bg-white rounded-xl px-3 py-2 text-slate-700 focus:outline-none transition-all">
                                <option value="" disabled selected>Select Category</option>
                                <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($category->id); ?>"><?php echo e($category->name); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-[9px] font-bold text-slate-500 uppercase tracking-wider mb-1.5">Printed MRP (₹)</label>
                                <input type="number" step="0.01" name="mrp" required placeholder="0.00" class="w-full bg-slate-50 border border-slate-200 focus:border-slate-350 focus:bg-white rounded-xl px-3 py-2 text-slate-700 focus:outline-none transition-all">
                            </div>
                            <div>
                                <label class="block text-[9px] font-bold text-slate-500 uppercase tracking-wider mb-1.5">Selling Price (₹)</label>
                                <input type="number" step="0.01" name="selling_price" required placeholder="0.00" class="w-full bg-slate-50 border border-slate-200 focus:border-slate-350 focus:bg-white rounded-xl px-3 py-2 text-slate-700 focus:outline-none transition-all">
                            </div>
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-[9px] font-bold text-slate-500 uppercase tracking-wider mb-1.5">Pack / Box details</label>
                                <input type="text" name="pack_size" required placeholder="e.g. 1 Box (10 Pcs)" class="w-full bg-slate-50 border border-slate-200 focus:border-slate-350 focus:bg-white rounded-xl px-3 py-2 text-slate-700 focus:outline-none transition-all">
                            </div>
                            <div>
                                <label class="block text-[9px] font-bold text-slate-500 uppercase tracking-wider mb-1.5">Activity Status</label>
                                <select name="status" required class="w-full bg-slate-55 border border-slate-200 focus:border-slate-350 focus:bg-white rounded-xl px-3 py-2 text-slate-700 focus:outline-none transition-all">
                                    <option value="active">Active</option>
                                    <option value="inactive">Inactive</option>
                                </select>
                            </div>
                        </div>

                        <div>
                            <label class="block text-[9px] font-bold text-slate-500 uppercase tracking-wider mb-1.5">Product Image Graphics</label>
                            <input type="file" name="image" class="w-full bg-slate-50 border border-slate-200 focus:border-slate-350 focus:bg-white rounded-xl px-3 py-2 text-slate-600 focus:outline-none transition-all">
                        </div>

                        <div class="pt-4 border-t border-slate-200">
                            <button type="submit" class="w-full bg-gradient-to-r from-crimson-600 to-crimson-500 hover:from-crimson-700 hover:to-crimson-600 text-white font-extrabold py-3.5 rounded-full text-xs uppercase tracking-wider shadow transform active:scale-95 transition-all">Save New Product</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Product editor Modal Drawer -->
    <div x-show="editOpen" class="fixed inset-0 z-50 overflow-hidden" style="display: none;">
        <div @click="editOpen = false" class="absolute inset-0 bg-slate-900/40 backdrop-blur-sm transition-opacity"></div>
        <div class="absolute inset-y-0 right-0 max-w-full flex pl-10">
            <div class="w-screen max-w-md">
                <div class="h-full flex flex-col bg-white border-l border-slate-200 shadow-2xl overflow-y-auto">
                    
                    <div class="bg-slate-50 border-b border-slate-200 px-6 py-4 flex items-center justify-between">
                        <div>
                            <h3 class="text-sm font-bold text-slate-800 uppercase tracking-widest"><i class="fa-solid fa-pen-to-square text-crimson-600 mr-1.5"></i> Edit Product</h3>
                            <p class="text-[9px] text-slate-500 font-semibold">Edit existing inventory information</p>
                        </div>
                        <button @click="editOpen = false" class="text-slate-400 hover:text-slate-650 p-2 rounded-lg"><i class="fa-solid fa-xmark text-sm"></i></button>
                    </div>

                    <form :action="`/admin/products/${editItem.id}`" method="POST" enctype="multipart/form-data" class="p-6 space-y-4 text-xs font-semibold">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('PUT'); ?>
                        
                        <div>
                            <label class="block text-[9px] font-bold text-slate-500 uppercase tracking-wider mb-1.5">Product Name</label>
                            <input type="text" name="name" required :value="editItem.name" class="w-full bg-slate-50 border border-slate-200 focus:border-slate-350 focus:bg-white rounded-xl px-3 py-2 text-slate-700 focus:outline-none transition-all">
                        </div>

                        <div>
                            <label class="block text-[9px] font-bold text-slate-500 uppercase tracking-wider mb-1.5">Inventory Category</label>
                            <select name="category_id" required :value="editItem.category_id" class="w-full bg-slate-55 border border-slate-200 focus:border-slate-350 focus:bg-white rounded-xl px-3 py-2 text-slate-700 focus:outline-none transition-all">
                                <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($category->id); ?>"><?php echo e($category->name); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-[9px] font-bold text-slate-500 uppercase tracking-wider mb-1.5">Printed MRP (₹)</label>
                                <input type="number" step="0.01" name="mrp" required :value="editItem.mrp" class="w-full bg-slate-50 border border-slate-200 focus:border-slate-350 focus:bg-white rounded-xl px-3 py-2 text-slate-700 focus:outline-none transition-all">
                            </div>
                            <div>
                                <label class="block text-[9px] font-bold text-slate-500 uppercase tracking-wider mb-1.5">Selling Price (₹)</label>
                                <input type="number" step="0.01" name="selling_price" required :value="editItem.selling_price" class="w-full bg-slate-50 border border-slate-200 focus:border-slate-350 focus:bg-white rounded-xl px-3 py-2 text-slate-700 focus:outline-none transition-all">
                            </div>
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-[9px] font-bold text-slate-500 uppercase tracking-wider mb-1.5">Pack / Box details</label>
                                <input type="text" name="pack_size" required :value="editItem.pack_size" class="w-full bg-slate-50 border border-slate-200 focus:border-slate-350 focus:bg-white rounded-xl px-3 py-2 text-slate-700 focus:outline-none transition-all">
                            </div>
                            <div>
                                <label class="block text-[9px] font-bold text-slate-500 uppercase tracking-wider mb-1.5">Activity Status</label>
                                <select name="status" required :value="editItem.status" class="w-full bg-slate-55 border border-slate-200 focus:border-slate-350 focus:bg-white rounded-xl px-3 py-2 text-slate-700 focus:outline-none transition-all">
                                    <option value="active">Active</option>
                                    <option value="inactive">Inactive</option>
                                </select>
                            </div>
                        </div>

                        <div>
                            <label class="block text-[9px] font-bold text-slate-500 uppercase tracking-wider mb-1.5">Update Product Image (Optional)</label>
                            <input type="file" name="image" class="w-full bg-slate-50 border border-slate-200 focus:border-slate-350 focus:bg-white rounded-xl px-3 py-2 text-slate-600 focus:outline-none transition-all">
                        </div>

                        <div class="pt-4 border-t border-slate-200">
                            <button type="submit" class="w-full bg-gradient-to-r from-crimson-600 to-crimson-500 hover:from-crimson-700 hover:to-crimson-600 text-white font-extrabold py-3.5 rounded-full text-xs uppercase tracking-wider shadow transform active:scale-95 transition-all">Apply Modifications</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Athi\OneDrive\Desktop\crackers\resources\views/admin/products/index.blade.php ENDPATH**/ ?>