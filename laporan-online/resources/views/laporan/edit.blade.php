<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Laporan</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="min-h-screen bg-gradient-to-r from-purple-600 to-blue-600 text-white font-sans">
    <div class="max-w-2xl mx-auto py-10 px-4">
        <h1 class="text-3xl font-bold mb-6 text-center">Edit Laporan</h1>

        <form action="{{ route('laporan.update', $laporan->id) }}" method="POST" enctype="multipart/form-data" class="bg-white text-black p-6 rounded shadow-md">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label class="block font-semibold mb-1">Nama:</label>
                <input type="text" name="nama" value="{{ $laporan->nama }}" required class="w-full border border-gray-300 rounded px-3 py-2">
            </div>

            <div class="mb-4">
                <label class="block font-semibold mb-1">Alamat:</label>
                <input type="text" name="alamat" value="{{ $laporan->alamat }}" required class="w-full border border-gray-300 rounded px-3 py-2">
            </div>

            <div class="mb-4">
                <label class="block font-semibold mb-1">Deskripsi:</label>
                <textarea name="deskripsi" rows="4" required class="w-full border border-gray-300 rounded px-3 py-2">{{ $laporan->deskripsi }}</textarea>
            </div>

            <div class="mb-4">
                <label class="block font-semibold mb-1">Foto:</label>
                @if($laporan->foto)
                    <img src="{{ asset('storage/foto/'.$laporan->foto) }}" class="w-24 h-24 object-cover rounded mb-2"><br>
                @endif
                <input type="file" name="foto" accept="image/*" class="border border-gray-300 rounded px-3 py-2 w-full">
            </div>

            <div class="mb-4">
                <label class="block font-semibold mb-1">Tanggal:</label>
                <input type="date" name="tanggal" value="{{ $laporan->tanggal }}" required class="w-full border border-gray-300 rounded px-3 py-2">
            </div>

            <div class="flex justify-between">
                <a href="{{ route('laporan.index') }}" class="bg-gray-300 px-4 py-2 rounded hover:bg-gray-200 transition">Kembali</a>
                <button type="submit" class="bg-purple-700 px-4 py-2 rounded hover:bg-purple-800 transition text-white">Update</button>
            </div>
        </form>
    </div>
</body>
</html>
