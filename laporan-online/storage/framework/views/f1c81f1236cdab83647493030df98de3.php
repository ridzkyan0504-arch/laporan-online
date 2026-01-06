<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Laporan</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="min-h-screen bg-gradient-to-br from-gray-50 via-white to-gray-100 text-gray-800 font-sans">

    <div class="max-w-6xl mx-auto py-10 px-4">
        <!-- Header -->
        <div class="text-center mb-10">
            <h1 class="text-4xl font-extrabold text-gray-700 mb-2 tracking-wide">
                 Daftar Laporan Online
            </h1>
            <p class="text-gray-500">Kelola laporan dengan mudah dan cepat</p>
        </div>

        <!-- Notifikasi -->
        <?php if(session('success')): ?>
            <div class="bg-green-50 border border-green-300 text-green-700 px-4 py-2 rounded mb-6 text-center shadow-sm">
                <?php echo e(session('success')); ?>

            </div>
        <?php endif; ?>

        <!-- Tombol Tambah -->
        <div class="flex justify-end mb-4">
            <a href="<?php echo e(route('laporan.create')); ?>" 
               class="bg-blue-600 hover:bg-blue-700 text-white font-medium px-5 py-2 rounded-lg shadow-md transition duration-200 transform hover:-translate-y-0.5">
               + Tambah Laporan
            </a>
        </div>

        <!-- Card Tabel -->
        <div class="bg-white shadow-xl rounded-2xl overflow-hidden border border-gray-200">
            <table class="min-w-full">
                <thead class="bg-gradient-to-r from-blue-600 to-indigo-600 text-white">
                    <tr>
                        <th class="py-3 px-4 text-left">No</th>
                        <th class="py-3 px-4 text-left">Nama</th>
                        <th class="py-3 px-4 text-left">Alamat</th>
                        <th class="py-3 px-4 text-left">Deskripsi</th>
                        <th class="py-3 px-4 text-left">Foto</th>
                        <th class="py-3 px-4 text-left">Tanggal</th>
                        <th class="py-3 px-4 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__empty_1 = true; $__currentLoopData = $laporans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $laporan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr class="border-b hover:bg-gray-50 transition duration-150">
                        <td class="py-3 px-4 text-center"><?php echo e($loop->iteration); ?></td>
                        <td class="py-3 px-4 font-medium text-gray-700"><?php echo e($laporan->nama); ?></td>
                        <td class="py-3 px-4"><?php echo e($laporan->alamat); ?></td>
                        <td class="py-3 px-4"><?php echo e($laporan->deskripsi); ?></td>
                        <td class="py-3 px-4">
                            <?php if($laporan->foto): ?>
                                <img src="<?php echo e(asset('storage/foto/'.$laporan->foto)); ?>" 
                                     alt="Foto Laporan"
                                     class="w-16 h-16 object-cover rounded-lg border shadow-sm hover:scale-105 transition duration-200">
                            <?php else: ?>
                                <span class="text-gray-400 italic">Tidak ada foto</span>
                            <?php endif; ?>
                        </td>
                        <td class="py-3 px-4 text-sm text-gray-900"><?php echo e($laporan->tanggal); ?></td>
                        <td class="py-3 px-4 text-center space-x-2">
                            <a href="<?php echo e(route('laporan.edit', $laporan->id)); ?>" 
                               class="bg-yellow-400 hover:bg-yellow-500 px-3 py-1.5 rounded-md text-white shadow-sm transition">
                               Edit
                            </a>
                            <form action="<?php echo e(route('laporan.destroy', $laporan->id)); ?>" method="POST" class="inline">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('DELETE'); ?>
                                <button type="submit" 
                                        onclick="return confirm('Yakin hapus data ini?')" 
                                        class="bg-red-500 hover:bg-red-600 px-3 py-1.5 rounded-md text-white shadow-sm transition">
                                    Hapus
                                </button>
                            </form>
                        </td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr>
                        <td colspan="7" class="py-6 text-center text-gray-500 italic">Belum ada laporan yang tersedia.</td>
                    </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        <!-- Footer -->
        <div class="text-center mt-10 text-gray-500 text-sm">
        </div>
    </div>

</body>
</html>
<?php /**PATH C:\Users\ASUS\laporan-online\laporan-online\resources\views/laporan/index.blade.php ENDPATH**/ ?>