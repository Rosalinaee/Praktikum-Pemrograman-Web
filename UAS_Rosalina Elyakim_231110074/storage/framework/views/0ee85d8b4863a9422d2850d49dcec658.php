

<?php $__env->startSection('content'); ?>
    <div class="max-w-4xl mx-auto">
        <h1 class="text-2xl font-bold mb-4">Katalog Produk (User)</h1>

        <ul class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li class="border p-4 rounded shadow">
                    <h2 class="font-semibold"><?php echo e($product->name); ?></h2>
                    <p><?php echo e($product->description); ?></p>
                </li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ul>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\UAS_Rosalina Elyakim_231110074\resources\views/products/user_index.blade.php ENDPATH**/ ?>