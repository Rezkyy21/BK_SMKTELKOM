{{-- Partial: daftar materi dengan kartu (gambar tidak terlalu besar) --}}
@if(isset($materis) && $materis->isNotEmpty())
    <div class="mt-10 pt-8 border-t border-gray-200">
        <h2 class="text-2xl font-semibold text-gray-800 mb-4">Daftar Materi {{ $kategoriLabel ?? '' }}</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($materis as $m)
                <a href="{{ route('materi.show', $m->slug) }}" class="block bg-gray-50 rounded-xl border border-gray-200 hover:shadow-md hover:border-gray-300 transition overflow-hidden group">
                    @if($m->thumbnail)
                        <div class="w-full h-28 overflow-hidden bg-gray-200">
                            <img src="{{ asset('storage/' . $m->thumbnail) }}" alt="{{ $m->judul }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-200">
                        </div>
                    @else
                        <div class="w-full h-28 bg-gradient-to-br from-gray-200 to-gray-100 flex items-center justify-center">
                            <span class="text-gray-400 text-sm">Tidak ada gambar</span>
                        </div>
                    @endif
                    <div class="p-4">
                        <h3 class="font-semibold text-gray-800 mb-1 line-clamp-2 group-hover:text-blue-600 transition">{{ $m->judul }}</h3>
                        <p class="text-sm text-gray-600 line-clamp-2 mb-3">{{ Str::limit(strip_tags($m->konten), 100) }}</p>
                        <span class="text-blue-600 text-sm font-medium">Baca selengkapnya →</span>
                    </div>
                </a>
            @endforeach
        </div>
    </div>
@endif
