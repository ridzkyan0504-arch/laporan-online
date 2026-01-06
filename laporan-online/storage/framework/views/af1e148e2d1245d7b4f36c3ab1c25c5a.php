<!DOCTYPE html>
<html>
<head>
    <title>Edit Laporan</title>
</head>
<body>
<h1>Edit Laporan</h1>

<form action="<?php echo e(route('laporan.update', $laporan->id)); ?>" method="POST" enctype="multipart/form-data">
    <?php echo csrf_field(); ?>
    <?php echo method_field('PUT'); ?>

    <label>Nama:</label><br>
    <input type="text" name="nama" value="<?php echo e($laporan->nama); ?>" required><br><br>

    <label>Alamat:</label><br>
    <input type="text" name="alamat" value="<?php echo e($laporan->alamat); ?>" required><br><br>

    <label>Deskripsi:</label><br>
    <textarea name="deskripsi" rows="4" required><?php echo e($laporan->deskripsi); ?></textarea><br><br>

    <label>Foto:</label><br>
    <?php if($laporan->foto): ?>
        <img src="<?php echo e(asset('storage/foto/'.$laporan->foto)); ?>" width="100"><br>
    <?php endif; ?>
    <input type="file" name="foto" accept="image/*"><br><br>

    <label>Tanggal:</label><br>
    <input type="date" name="tanggal" value="<?php echo e($laporan->tanggal); ?>" required><br><br>

    <button type="submit">Update</button>
</form>

</body>
</html>
<?php /**PATH C:\Users\ASUS\laporan-online\laporan-online\resources\views/laporan/edit.blade.php ENDPATH**/ ?>