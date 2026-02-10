<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Buat Materi - Guru</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 p-6">
    <div class="max-w-3xl mx-auto bg-white p-6 rounded shadow">
        <h1 class="text-xl font-bold mb-4">Buat Materi Baru</h1>

        @if($errors->any())
            <div class="mb-4 text-red-700">
                <ul>
                    @foreach($errors->all() as $err)
                        <li>{{ $err }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('guru.materi.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Kategori</label>
                <select name="kategori_id" class="mt-1 block w-full border rounded p-2">
                    @foreach($kategoris as $k)
                        <option value="{{ $k->id }}">{{ $k->nama_kategori }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Judul</label>
                <input type="text" name="judul" class="mt-1 block w-full border rounded p-2" required>
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Konten</label>
                <textarea name="konten" rows="8" class="mt-1 block w-full border rounded p-2" required></textarea>
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Thumbnail (opsional)</label>
                <input type="file" name="thumbnail" accept="image/*" class="mt-1">
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Status</label>
                <select name="status" class="mt-1 block w-full border rounded p-2">
                    <option value="draft">Draft</option>
                    <option value="publish">Publish</option>
                </select>
            </div>

            <div class="flex justify-end">
                <a href="{{ route('guru.materi.index') }}" class="mr-2 px-4 py-2 border rounded">Batal</a>
                <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded">Simpan</button>
            </div>
        </form>
    </div>
</body>
</html>
