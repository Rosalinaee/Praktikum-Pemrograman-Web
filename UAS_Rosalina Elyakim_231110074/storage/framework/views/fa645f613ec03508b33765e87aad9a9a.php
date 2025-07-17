

<?php $__env->startSection('content'); ?>
<div class="max-w-xl mx-auto bg-white p-6 rounded-lg shadow-md">
    <h1 class="text-2xl font-bold mb-6">Edit Kategori</h1>

    <form action="<?php echo e(route('categories.update', $category->id)); ?>" method="POST" class="space-y-5">
        <?php echo csrf_field(); ?>
        <?php echo method_field('PUT'); ?>

        <div>
            <label for="name" class="block text-gray-700 font-medium">Nama Kategori</label>
            <input type="text" name="name" class="w-full mt-1 p-2 border rounded-md focus:outline-none focus:ring focus:border-blue-300"
                   value="<?php echo e(old('name', $category->name)); ?>" required>
        </div>

        <div>
            <label for="description" class="block text-gray-700 font-medium">Deskripsi</label>
            <textarea name="description" rows="4"
                      class="w-full mt-1 p-2 border rounded-md focus:outline-none focus:ring focus:border-blue-300"><?php echo e(old('description', $category->description)); ?></textarea>
        </div>

        <div class="flex items-center gap-4 pt-4">
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md">
                Update
            </button>
            <a href="<?php echo e(route('categories.index')); ?>" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-md">
                Batal
            </a>
        </div>
    </form>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\UAS_Rosalina Elyakim_231110074\resources\views/categories/edit.blade.php ENDPATH**/ ?>