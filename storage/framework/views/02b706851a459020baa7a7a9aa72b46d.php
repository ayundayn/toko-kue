

<?php $__env->startSection('content'); ?>

    <?php if(session('alert.config')): ?>
        <script>
            Swal.fire(<?php echo json_encode(session('alert.config'), 15, 512) ?>);
        </script>
    <?php endif; ?>

    <div class="max-w-3xl mx-auto bg-white p-6 rounded-lg shadow-md mt-8">
        <h2 class="text-xl font-bold mb-4">Daftar Kategori</h2>

        <!-- Tombol Tambah Kategori -->
        <a href="<?php echo e(route('kategori.create')); ?>" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition">
            + Tambah Kategori
        </a>

        <!-- Tabel -->
        <div class="mt-4">
            <table class="w-full border-collapse border border-gray-300">
                <thead>
                    <tr class="bg-gray-200">
                        <th class="border border-gray-300 px-4 py-2">No</th>
                        <th class="border border-gray-300 px-4 py-2">Nama Kategori</th>
                        <th class="border border-gray-300 px-4 py-2">Aksi</th> <!-- Tambah kolom aksi -->
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $kategoris; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr class="text-center">
                        <td class="border border-gray-300 px-4 py-2"><?php echo e($index + 1); ?></td>
                        <td class="border border-gray-300 px-4 py-2 text-start"><?php echo e($item->nama_kategori); ?></td>
                        <td class="border border-gray-300 px-4 py-2 text-center">
                            <div class="inline-flex space-x-2">
                                <!-- Tombol Edit -->
                                <a href="<?php echo e(route('kategori.edit', $item->id)); ?>" class="bg-yellow-500 text-white px-3 py-1 rounded hover:bg-yellow-600 transition">
                                    Edit
                                </a>

                                <!-- Tombol Hapus dengan Konfirmasi -->
                                <form action="<?php echo e(route('kategori.destroy', $item->id)); ?>" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus kategori ini?');">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('DELETE'); ?>
                                    <button type="submit" class="bg-red-600 text-white px-3 py-1 rounded hover:bg-red-700 transition">
                                        Hapus
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\src\cake-shop\resources\views/kategori/index.blade.php ENDPATH**/ ?>