

<?php $__env->startSection('content'); ?>
<?php echo $__env->make('sweetalert::alert', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

<div class="max-w-xl mx-auto bg-white p-6 rounded-lg shadow-md mt-8">
    <h2 class="text-xl font-bold mb-4">Edit Kue</h2>

    <?php if($errors->any()): ?>
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Gagal',
                text: 'Silakan periksa kembali form Anda!',
            });
        </script>
    <?php endif; ?>

    <form action="<?php echo e(route('kue.update', $kue->id)); ?>" method="POST">
        <?php echo csrf_field(); ?>
        <?php echo method_field('PUT'); ?>

        <div class="mb-4">
            <label for="nama_kue" class="block text-gray-700">Nama Kue</label>
            <input type="text" id="nama_kue" name="nama_kue" value="<?php echo e(old('nama_kue', $kue->nama_kue)); ?>"
                   class="w-full border-gray-300 rounded-lg p-2 focus:ring focus:ring-blue-200">
            <?php $__errorArgs = ['nama_kue'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <p class="text-red-500 text-sm mt-1"><?php echo e($message); ?></p>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>

        <div class="mb-4">
            <label for="harga" class="block text-gray-700">Harga</label>
            <input type="number" id="harga" name="harga" min="1" value="<?php echo e(old('harga', $kue->harga)); ?>"
                   class="w-full border-gray-300 rounded-lg p-2 focus:ring focus:ring-blue-200">
            <?php $__errorArgs = ['harga'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <p class="text-red-500 text-sm mt-1"><?php echo e($message); ?></p>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>

        <div class="mb-4">
            <label for="stok" class="block text-gray-700">Stok</label>
            <input type="number" id="stok" name="stok" min="1" value="<?php echo e(old('stok', $kue->stok)); ?>"
                   class="w-full border-gray-300 rounded-lg p-2 focus:ring focus:ring-blue-200">
            <?php $__errorArgs = ['stok'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <p class="text-red-500 text-sm mt-1"><?php echo e($message); ?></p>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>

        <div class="mb-4">
            <label for="kategori" class="block text-gray-700">Kategori</label>
            <select name="kategori_id" id="kategori" class="w-full border border-gray-300 rounded-md p-2 focus:outline-none focus:ring-2 focus:ring-blue-300">
                <option value="">Pilih Kategori</option>
                <?php $__currentLoopData = $kategoris; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $kategori): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($kategori->id); ?>" <?php echo e(old('kategori_id', $kue->kategori_id) == $kategori->id ? 'selected' : ''); ?>>
                        <?php echo e($kategori->nama_kategori); ?>

                    </option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
            <?php $__errorArgs = ['kategori_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <p class="text-red-500 text-sm mt-1"><?php echo e($message); ?></p>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>

        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition">
            Simpan Perubahan
        </button>

        <a href="<?php echo e(route('dashboard')); ?>" class="ml-2 text-gray-600 hover:text-gray-900">Batal</a>
    </form>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\src\cake-shop\resources\views/kue/edit.blade.php ENDPATH**/ ?>