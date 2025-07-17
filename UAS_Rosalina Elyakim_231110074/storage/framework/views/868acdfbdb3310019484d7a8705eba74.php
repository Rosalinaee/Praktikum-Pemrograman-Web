

<?php $__env->startSection('content'); ?>
<div class="max-w-3xl mx-auto bg-white p-6 rounded-lg shadow-md">
    <h1 class="text-2xl font-bold mb-6">Tambah Produk Baru</h1>

    <?php if($errors->any()): ?>
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
            <ul>
                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li><?php echo e($error); ?></li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
        </div>
    <?php endif; ?>

    <form action="<?php echo e(route('products.store')); ?>" method="POST" enctype="multipart/form-data" class="space-y-5">
        <?php echo csrf_field(); ?>

        <div>
            <label for="name" class="block font-medium text-gray-700">Nama Produk</label>
            <input type="text" name="name" value="<?php echo e(old('name')); ?>" class="w-full mt-1 p-2 border rounded-md focus:outline-none focus:ring focus:border-blue-300" required>
        </div>

        <div>
            <label for="description" class="block font-medium text-gray-700">Deskripsi</label>
            <textarea name="description" rows="4" class="w-full mt-1 p-2 border rounded-md focus:outline-none focus:ring focus:border-blue-300"><?php echo e(old('description')); ?></textarea>
        </div>

        <div>
            <label for="category_id" class="block font-medium text-gray-700">Kategori</label>
            <select name="category_id" id="categorySelect" class="w-full mt-1 p-2 border rounded-md focus:outline-none focus:ring focus:border-blue-300" required>
                <option value="">-- Pilih Kategori --</option>
                <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($category->id); ?>" <?php echo e(old('category_id') == $category->id ? 'selected' : ''); ?>>
                        <?php echo e($category->name); ?>

                    </option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </div>

        <div>
            <label for="price" class="block font-medium text-gray-700">Harga</label>
            <input type="number" name="price" value="<?php echo e(old('price')); ?>" class="w-full mt-1 p-2 border rounded-md focus:outline-none focus:ring focus:border-blue-300" required>
        </div>

        <div>
            <label for="download_link" class="block font-medium text-gray-700">Link Download</label>
            <input type="url" name="download_link" value="<?php echo e(old('download_link')); ?>" class="w-full mt-1 p-2 border rounded-md focus:outline-none focus:ring focus:border-blue-300">
        </div>

        
        <div>
            <label for="upload_file" class="block font-medium text-gray-700">Upload File Produk Digital(Opsional)</label>
            <input type="file" name="upload_file" id="upload_file" class="mt-1 w-full" accept=".pdf,.zip,.rar,.docx,.xlsx,.pptx,.jpg,.jpeg,.png">
            <p class="text-sm text-gray-500 mt-1">
                Pilih file sesuai kategori: PDF untuk eBook, ZIP/RAR untuk software, atau format lainnya.
            </p>
            <p class="text-sm text-gray-400 mt-1">
                Maksimal ukuran file: 50MB
            </p>
        </div>

        <div>
            <label for="status" class="block font-medium text-gray-700">Status</label>
            <select name="status" class="w-full mt-1 p-2 border rounded-md focus:outline-none focus:ring focus:border-blue-300" required>
                <option value="aktif" <?php echo e(old('status') == 'aktif' ? 'selected' : ''); ?>>Aktif</option>
                <option value="nonaktif" <?php echo e(old('status') == 'nonaktif' ? 'selected' : ''); ?>>Nonaktif</option>
            </select>
        </div>

        <div>
            <label for="image" class="block font-medium text-gray-700">Gambar Produk</label>
            <input type="file" name="image" accept="image/*" class="mt-1">
            <p class="text-sm text-gray-500 mt-1">
                Gambar preview produk (JPG, PNG, maksimal 2MB)
            </p>
        </div>

        <div class="flex items-center gap-4 pt-4">
            <button type="submit" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-md">
                Simpan
            </button>
            <a href="<?php echo e(route('products.index')); ?>" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-md">
                Batal
            </a>
        </div>
    </form>
</div>

<script>
document.getElementById('categorySelect').addEventListener('change', function() {
    const uploadFile = document.getElementById('upload_file');
    const category = this.options[this.selectedIndex].text.toLowerCase();
    
    if (category.includes('ebook')) {
        uploadFile.setAttribute('accept', '.pdf');
    } else {
        uploadFile.setAttribute('accept', '.pdf,.zip,.rar,.docx,.xlsx,.pptx,.jpg,.jpeg,.png');
    }
});
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\UAS_Rosalina Elyakim_231110074\resources\views/products/create.blade.php ENDPATH**/ ?>