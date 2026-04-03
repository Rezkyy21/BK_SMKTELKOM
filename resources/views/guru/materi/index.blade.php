<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Manajemen Materi - Guru</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 p-6">
    <div class="max-w-4xl mx-auto">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold">Materi Saya</h1>
            <a href="{{ route('guru.materi.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded">Buat Materi</a>
        </div>

        @if(session('success'))
            <div class="mb-4 p-3 bg-green-100 text-green-800 rounded">{{ session('success') }}</div>
        @endif

        <div class="space-y-4">
            @forelse($materis as $m)
                <div class="bg-white p-4 rounded shadow">
                    <h2 class="font-semibold text-lg">{{ $m->judul }}</h2>
                    <p class="text-sm text-gray-600">Status: {{ $m->status }} | Dipublikasikan: {{ $m->published_at ?? '-' }}</p>
                </div>
            @empty
                <div class="text-gray-600">Belum ada materi yang Anda buat.</div>
            @endforelse
        </div>
    </div>
</body>
</html>
