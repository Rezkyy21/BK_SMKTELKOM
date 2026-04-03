<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>{{ $materi->judul }} - PSAJ</title>
<script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-50">



<!-- MAIN -->
<div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-10">

<!-- BACK BUTTON -->
<div class="mb-8">
<a href="javascript:history.back()"
class="inline-flex items-center gap-2 bg-white border px-4 py-2 rounded-lg shadow-sm text-gray-700 hover:bg-gray-100 transition text-sm font-medium">

<svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4"
fill="none" viewBox="0 0 24 24" stroke="currentColor">
<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
d="M15 19l-7-7 7-7"/>
</svg>

Kembali
</a>
</div>

<!-- ARTICLE CARD -->
<div class="bg-white rounded-xl shadow-md overflow-hidden">

<div class="p-6 sm:p-10">

<!-- TITLE -->
<h1 class="text-3xl sm:text-4xl font-bold text-gray-900 mb-6">
{{ $materi->judul }}
</h1>

<!-- META -->
<div class="flex flex-wrap items-center gap-4 mb-8 text-sm text-gray-600 border-b pb-5">

@if($materi->guru)
<span>
<span class="font-medium text-gray-700">Oleh:</span>
{{ $materi->guru->nama }}
</span>
@endif

@if($materi->kategori)
<span class="bg-gray-100 text-gray-700 px-3 py-1 rounded-full text-xs font-medium">
{{ $materi->kategori->nama_kategori }}
</span>
@endif

@if($materi->published_at)
<span>
@if(is_string($materi->published_at))
{{ \Carbon\Carbon::parse($materi->published_at)->format('d M Y') }}
@else
{{ $materi->published_at->format('d M Y') }}
@endif
</span>
@endif

</div>

<!-- THUMBNAIL -->
@if($materi->thumbnail)
<div class="mb-10 flex justify-center">
<img
src="{{ asset('storage/' . $materi->thumbnail) }}"
alt="{{ $materi->judul }}"
class="w-full max-w-md h-auto object-contain rounded-lg border">
</div>
@endif

<!-- CONTENT -->
<div class="mx-auto max-w-4xl text-gray-700 leading-relaxed text-[17px] break-words">

@if(strip_tags($materi->konten) !== $materi->konten)
{!! $materi->konten !!}
@else
{!! nl2br(e($materi->konten)) !!}
@endif

</div>

<!-- BUTTON -->
<div class="mt-12 pt-6 border-t">

<a href="javascript:history.back()"
class="inline-flex items-center gap-2 bg-red-500 text-white px-5 py-2.5 rounded-lg hover:bg-red-600 transition text-sm font-medium shadow">

<svg xmlns="http://www.w3.org/2000/svg"
class="w-4 h-4"
fill="none"
viewBox="0 0 24 24"
stroke="currentColor">

<path stroke-linecap="round"
stroke-linejoin="round"
stroke-width="2"
d="M15 19l-7-7 7-7"/>

</svg>

Kembali 

</a>

</div>

</div>
</div>
</div>

</body>
</html>