

<?php $__env->startSection('content'); ?>
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

    <h1 class="text-3xl font-bold mb-8 text-center">📚 Katalog Produk Digital</h1>

    
    <?php $__currentLoopData = ['success' => 'green', 'error' => 'red', 'info' => 'blue']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $type => $color): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php if(session($type)): ?>
            <div class="bg-<?php echo e($color); ?>-100 border border-<?php echo e($color); ?>-400 text-<?php echo e($color); ?>-700 px-4 py-3 rounded mb-6">
                <?php echo e(session($type)); ?>

            </div>
        <?php endif; ?>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

    
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        <?php $__empty_1 = true; $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <div class="bg-white rounded-2xl shadow-lg overflow-hidden flex flex-col">
                
                <?php if($product->image): ?>
                    <img src="<?php echo e(asset('storage/' . $product->image)); ?>"
                         alt="<?php echo e($product->name); ?>"
                         class="w-full h-auto max-h-[500px] object-contain mx-auto bg-white">
                <?php else: ?>
                    <div class="w-full h-64 bg-gray-200 flex items-center justify-center text-gray-500">
                        Tidak ada gambar
                    </div>
                <?php endif; ?>

                
                <div class="p-5 flex flex-col flex-1">
                    <h2 class="text-xl font-semibold mb-1"><?php echo e($product->name); ?></h2>
                    <p class="text-sm text-gray-500 mb-1">
                        Kategori: <span class="font-medium"><?php echo e($product->category->name ?? '-'); ?></span>
                    </p>
                    <p class="text-green-600 font-bold text-lg mb-2">
                        Rp <?php echo e(number_format($product->price, 0, ',', '.')); ?>

                    </p>

                    
                    <?php if($product->file_pdf || $product->file_path): ?>
                        <p class="text-xs text-gray-500 mb-3">
                            📁 File tersedia:
                            <?php if($product->file_pdf): ?>
                                PDF
                            <?php elseif($product->file_path): ?>
                                <?php echo e(strtoupper(pathinfo($product->file_path, PATHINFO_EXTENSION))); ?>

                            <?php endif; ?>
                        </p>
                    <?php endif; ?>

                    
                    <div class="mt-auto">
                        <?php if(auth()->check() && auth()->user()->purchases->contains('product_id', $product->id)): ?>
                            
                            <?php if($product->file_pdf || $product->file_path): ?>
                                <a href="<?php echo e(route('produk.download', $product)); ?>"
                                   class="block w-full bg-green-500 hover:bg-green-600 text-white text-center py-2 rounded mb-2 text-sm">
                                    📥 Download Produk
                                </a>
                            <?php endif; ?>

                            <?php if($product->download_link): ?>
                                <a href="<?php echo e($product->download_link); ?>" target="_blank"
                                   class="block w-full bg-blue-500 hover:bg-blue-600 text-white text-center py-2 rounded text-sm">
                                    🔗 Link Download
                                </a>
                            <?php endif; ?>
                        <?php else: ?>
                            <?php if(auth()->guard()->check()): ?>
                                <form action="<?php echo e(route('produk.beli', $product)); ?>" method="POST" class="w-full">
                                    <?php echo csrf_field(); ?>
                                    <button class="w-full bg-blue-500 hover:bg-blue-600 text-white py-2 rounded text-sm">
                                        🛒 Beli Sekarang
                                    </button>
                                </form>
                            <?php else: ?>
                                <a href="<?php echo e(route('login.user')); ?>"
                                   class="text-blue-600 hover:text-blue-800 underline text-sm block text-center mt-2">
                                    👤 Login untuk membeli
                                </a>
                            <?php endif; ?>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <div class="col-span-full text-center py-12">
                <p class="text-gray-500 text-lg">Tidak ada produk tersedia saat ini.</p>
            </div>
        <?php endif; ?>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\UAS_Rosalina Elyakim_231110074\resources\views/products/katalog.blade.php ENDPATH**/ ?>