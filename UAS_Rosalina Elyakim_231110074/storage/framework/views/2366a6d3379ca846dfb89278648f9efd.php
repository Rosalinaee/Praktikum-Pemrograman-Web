<?php
use Illuminate\Support\Str;
?>



<?php $__env->startSection('content'); ?>
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

    
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold">Katalog Produk</h1>
        <?php if(auth()->guard()->check()): ?>
        <div class="space-x-2 bg-red-100 p-2 rounded">
            <a href="<?php echo e(route('products.create')); ?>"
               class="bg-blue-600 text-white px-4 py-2 rounded">
                + Tambah Produk
            </a>
            <a href="<?php echo e(route('categories.index')); ?>"
               class="bg-gray-600 text-white px-4 py-2 rounded">
                Kategori
            </a>
        </div>
        <?php endif; ?>
    </div>

    
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        <?php $__empty_1 = true; $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            
            <div class="bg-white rounded-lg shadow p-4">
                <?php if($product->image): ?>
                    <img src="<?php echo e(asset('storage/' . $product->image)); ?>"
                         alt="<?php echo e($product->name); ?>"
                         class="w-full h-48 object-cover rounded-t-md">
                <?php else: ?>
                    <div class="w-full h-48 bg-gray-200 flex items-center justify-center text-gray-500 rounded-t-md">
                        Tidak ada gambar
                    </div>
                <?php endif; ?>

                <h2 class="text-lg font-semibold mt-2"><?php echo e($product->name); ?></h2>
                <p class="text-sm text-gray-600">Kategori: <?php echo e($product->category->name); ?></p>
                <p class="text-sm"><?php echo e($product->description); ?></p>
                <p class="text-green-600 font-bold mt-2">Rp <?php echo e(number_format($product->price, 0, ',', '.')); ?></p>
                <p class="text-sm">Status: <?php echo e(ucfirst($product->status)); ?></p>

                <div class="flex justify-between items-center mt-4">
                    <a href="<?php echo e(route('products.edit', $product->id)); ?>" class="text-blue-600 hover:underline">Edit</a>
                    <form action="<?php echo e(route('products.destroy', $product->id)); ?>" method="POST"
                          onsubmit="return confirm('Yakin ingin menghapus produk ini?')">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('DELETE'); ?>
                        <button type="submit" class="text-red-600 hover:underline">Hapus</button>
                    </form>
                </div>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <p class="text-gray-500">Belum ada produk.</p>
        <?php endif; ?>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\UAS_Rosalina Elyakim_231110074\resources\views/products/index.blade.php ENDPATH**/ ?>