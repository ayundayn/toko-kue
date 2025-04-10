

<?php $__env->startSection('content'); ?>
<div class="max-w-md mx-auto bg-white p-6 rounded-lg shadow-md mt-8 text-sm font-mono">
    <div class="text-center border-b pb-2 mb-2">
        <p class="font-bold">Nama Pelanggan: <?php echo e(optional($transaksi->pelanggan)->nama_pelanggan ?? '-'); ?></p>
        <p><?php echo e($transaksi->created_at->format('d/m/Y H:i')); ?></p>
    </div>

    <table class="w-full border-collapse">
        <thead>
            <tr class="border-b">
                <th class="text-left">Nama Kue</th>
                <th class="text-center">Jumlah</th>
                <th class="text-right">Harga</th>
            </tr>
        </thead>
        <tbody>
            <?php if($transaksi->detailTransaksi && $transaksi->detailTransaksi->isNotEmpty()): ?>
                <?php $__currentLoopData = $transaksi->detailTransaksi; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $detail): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td class="border-t"><?php echo e(optional($detail->kue)->nama_kue ?? '-'); ?></td>
                        <td class="border-t text-center"><?php echo e($detail->jumlah_kue ?? '-'); ?></td>
                        <td class="border-t text-right">Rp <?php echo e(number_format($detail->total_harga, 0, ',', '.')); ?></td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php else: ?>
                <tr>
                    <td colspan="3" class="text-center text-gray-500 border-t">Detail transaksi tidak tersedia</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>

    <div class="flex justify-between border-t mt-2 pt-2 font-bold">
        <p>Bayar: <?php echo e($transaksi->metode_bayar); ?></p>
        <p>Total: Rp <?php echo e(number_format($transaksi->total_harga, 0, ',', '.')); ?></p>
    </div>

    <div class="mt-4 text-center">
        <a href="<?php echo e(route('transaksi.index')); ?>" class="bg-gray-500 hover:bg-gray-600 text-white px-6 py-2 rounded-lg shadow-md transition-all duration-300">Kembali</a>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\src\cake-shop\resources\views/transaksi/detail.blade.php ENDPATH**/ ?>