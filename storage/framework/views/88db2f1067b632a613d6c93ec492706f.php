

<?php $__env->startSection('content'); ?>

<?php echo $__env->make('sweetalert::alert', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

<div class="max-w-md mx-auto bg-white p-6 rounded-lg shadow-md mt-8">
    <h2 class="text-xl font-bold mb-4">Edit Transaksi</h2>

    <?php if($errors->any()): ?>
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Gagal',
                text: 'Silakan periksa kembali form Anda!',
            });
        </script>
    <?php endif; ?>

    <form action="<?php echo e(route('transaksi.update', $transaksi->id)); ?>" method="POST">
        <?php echo csrf_field(); ?>
        <?php echo method_field('PUT'); ?>

        <!-- Pilih Pelanggan -->
        <div class="mb-4">
            <label for="pelanggan" class="block text-sm font-medium text-gray-700">Pelanggan</label>
            <select name="pelanggan_id" id="pelanggan" class="w-full border border-gray-300 rounded-md p-2">
                <option value="">Pilih Pelanggan</option>
                <?php $__currentLoopData = $pelanggans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pelanggan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($pelanggan->id); ?>" <?php echo e($transaksi->pelanggan_id == $pelanggan->id ? 'selected' : ''); ?>>
                        <?php echo e($pelanggan->nama_pelanggan); ?>

                    </option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
            <?php $__errorArgs = ['pelanggan_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <p class="text-red-500 text-xs mt-1"><?php echo e($message); ?></p>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>

        <!-- Pilih Kue & Jumlah Kue -->
        <div id="kue-container">
            <?php $__currentLoopData = $transaksi->detailTransaksi; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $detail): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="mb-4 flex space-x-2 kue-row">
                <div class="w-1/2">
                    <label class="block text-sm font-medium text-gray-700">Kue</label>
                    <select name="kue_id[]" class="kue-select w-full border border-gray-300 rounded-md p-2">
                        <option value="">Pilih Kue</option>
                        <?php $__currentLoopData = $kues; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $kue): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($kue->id); ?>" data-harga="<?php echo e($kue->harga); ?>" data-stok="<?php echo e($kue->stok); ?>" <?php echo e($detail->kue_id == $kue->id ? 'selected' : ''); ?>>
                                <?php echo e($kue->nama_kue); ?> (Rp<?php echo e(number_format($kue->harga)); ?>) - Stok: <?php echo e($kue->stok); ?>

                            </option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                    <?php $__errorArgs = ['kue_id.*'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <p class="text-red-500 text-xs mt-1"><?php echo e($message); ?></p>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>
                <div class="w-1/3">
                    <label class="block text-sm font-medium text-gray-700">Jumlah</label>
                    <input type="number" name="jumlah_kue[]" class="jumlah-input w-full border border-gray-300 rounded-md p-2" min="1" step="1" value="<?php echo e($detail->jumlah_kue); ?>">
                    <?php $__errorArgs = ['jumlah_kue.*'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <p class="text-red-500 text-xs mt-1"><?php echo e($message); ?></p>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>
                <button type="button" class="remove-kue bg-red-500 text-white px-3 py-2 rounded-md hover:bg-red-700 mt-auto">
                    🗑️
                </button>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>

        <button type="button" id="add-kue" class="bg-green-500 text-white px-3 py-2 rounded-md hover:bg-green-700 mb-4">
            + Tambah Kue
        </button>

        <!-- Total Harga -->
        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700">Total Harga</label>
            <input type="text" id="total_harga_display" class="w-full border border-gray-300 rounded-md p-2 bg-gray-100" readonly value="Rp <?php echo e(number_format($transaksi->total_harga)); ?>">
            <input type="hidden" name="total_harga" id="total_harga" value="<?php echo e($transaksi->total_harga); ?>">
        </div>

        <!-- Metode Pembayaran -->
        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700">Metode Pembayaran</label>
            <select name="metode_bayar" class="w-full border border-gray-300 rounded-md p-2">
                <option value="Cash" <?php echo e($transaksi->metode_bayar == 'cash' ? 'selected' : ''); ?>>Cash</option>
                <option value="Transfer" <?php echo e($transaksi->metode_bayar == 'transfer' ? 'selected' : ''); ?>>Transfer</option>
            </select>
            
            <?php $__errorArgs = ['metode_bayar'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <p class="text-red-500 text-xs mt-1"><?php echo e($message); ?></p>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>

        <div class="flex justify-between">
            <a href="<?php echo e(route('transaksi.index')); ?>" class="bg-gray-300 text-gray-800 px-4 py-2 rounded-lg hover:bg-gray-400">Kembali</a>
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">Simpan Perubahan</button>
        </div>
    </form>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const kueContainer = document.getElementById("kue-container");
        const addKueBtn = document.getElementById("add-kue");
        const totalHargaDisplay = document.getElementById("total_harga_display");
        const totalHargaInput = document.getElementById("total_harga");

        function updateTotalHarga() {
            let total = 0;
            document.querySelectorAll(".kue-row").forEach(row => {
                const kueSelect = row.querySelector(".kue-select");
                const jumlahInput = row.querySelector(".jumlah-input");
                const harga = parseInt(kueSelect.options[kueSelect.selectedIndex]?.getAttribute("data-harga")) || 0;
                const jumlah = parseInt(jumlahInput.value) || 1;
                total += harga * jumlah;
            });
            totalHargaDisplay.value = 'Rp ' + total.toLocaleString("id-ID");
            totalHargaInput.value = total;
        }

        addKueBtn.addEventListener("click", function () {
            const newRow = kueContainer.firstElementChild.cloneNode(true);
            newRow.querySelector(".jumlah-input").value = 1;
            newRow.querySelector(".kue-select").selectedIndex = 0;

            // Tambahkan event listener baru untuk input jumlah
            newRow.querySelector(".jumlah-input").addEventListener("input", updateTotalHarga);
            newRow.querySelector(".kue-select").addEventListener("change", updateTotalHarga);

            kueContainer.appendChild(newRow);
        });

        // Gunakan event delegation untuk tombol hapus
        kueContainer.addEventListener("click", function (event) {
            if (event.target.classList.contains("remove-kue")) {
                event.target.closest(".kue-row").remove();
                updateTotalHarga();
            }
        });

        // Tambahkan event listener pada elemen yang sudah ada
        document.querySelectorAll(".kue-select, .jumlah-input").forEach(input => {
            input.addEventListener("input", updateTotalHarga);
        });

        updateTotalHarga();
    });
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\src\cake-shop\resources\views/transaksi/edit.blade.php ENDPATH**/ ?>