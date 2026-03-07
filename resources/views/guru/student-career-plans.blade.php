@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900">
                <!-- Header -->
                <div class="mb-6">
                    <h1 class="text-3xl font-bold text-gray-800 mb-2">Rencana Karir Siswa</h1>
                    <p class="text-gray-600">Pantau rencana karir siswa kelas 12 setelah lulus</p>
                </div>

                <!-- Filter & Search -->
                <form action="{{ route('guru.students.career-plans') }}" method="GET" class="mb-6 p-4 bg-gray-50 rounded-lg">
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-4">
                        <!-- Search -->
                        <div>
                            <input type="text" name="search" placeholder="Cari nama / email siswa..."
                                value="{{ request('search') }}"
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
                        </div>

                        <!-- Status Filter -->
                        <div>
                            <select name="status" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
                                <option value="">Semua Status</option>
                                <option value="draft" {{ request('status') === 'draft' ? 'selected' : '' }}>Draft</option>
                                <option value="submitted" {{ request('status') === 'submitted' ? 'selected' : '' }}>Submitted</option>
                            </select>
                        </div>

                        <!-- Category Filter -->
                        <div>
                            <select name="category" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
                                <option value="">Semua Kategori</option>
                                <option value="kuliah" {{ request('category') === 'kuliah' ? 'selected' : '' }}>Kuliah</option>
                                <option value="kerja" {{ request('category') === 'kerja' ? 'selected' : '' }}>Kerja</option>
                                <option value="usaha" {{ request('category') === 'usaha' ? 'selected' : '' }}>Usaha</option>
                                <option value="lainnya" {{ request('category') === 'lainnya' ? 'selected' : '' }}>Lainnya</option>
                            </select>
                        </div>

                        <!-- Grade Filter -->
                        <div>
                            <select name="grade" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
                                <option value="">Semua Kelas</option>
                                <option value="10" {{ request('grade') === '10' ? 'selected' : '' }}>Kelas 10</option>
                                <option value="11" {{ request('grade') === '11' ? 'selected' : '' }}>Kelas 11</option>
                                <option value="12" {{ request('grade') === '12' ? 'selected' : '' }}>Kelas 12</option>
                            </select>
                        </div>

                        <!-- Button -->
                        <div class="flex gap-2">
                            <button type="submit" class="flex-1 px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 font-medium">
                                Filter
                            </button>
                            <a href="{{ route('guru.students.career-plans') }}" class="px-4 py-2 bg-gray-400 text-white rounded-lg hover:bg-gray-500 font-medium">
                                Reset
                            </a>
                        </div>
                    </div>
                </form>

                <!-- Statistics -->
                <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
                    <div class="p-4 bg-blue-50 border border-blue-200 rounded-lg">
                        <p class="text-sm text-blue-600 font-medium">Total Rencana</p>
                        <p class="text-2xl font-bold text-blue-900">{{ $careerPlans->total() }}</p>
                    </div>
                    <div class="p-4 bg-yellow-50 border border-yellow-200 rounded-lg">
                        <p class="text-sm text-yellow-600 font-medium">Draft</p>
                        <p class="text-2xl font-bold text-yellow-900">
                            {{ $careerPlans->where('status', 'draft')->count() }}
                        </p>
                    </div>
                    <div class="p-4 bg-green-50 border border-green-200 rounded-lg">
                        <p class="text-sm text-green-600 font-medium">Submitted</p>
                        <p class="text-2xl font-bold text-green-900">
                            {{ $careerPlans->where('status', 'submitted')->count() }}
                        </p>
                    </div>
                    <div class="p-4 bg-purple-50 border border-purple-200 rounded-lg">
                        <p class="text-sm text-purple-600 font-medium">Kuliah</p>
                        <p class="text-2xl font-bold text-purple-900">
                            {{ $careerPlans->where('category', 'kuliah')->count() }}
                        </p>
                    </div>
                </div>

                <!-- Table -->
                @if ($careerPlans->count() > 0)
                    <div class="overflow-x-auto border border-gray-200 rounded-lg">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-100">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">
                                        Nama Siswa
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">
                                        Kelas
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">
                                        Kategori
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">
                                        Detail
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">
                                        Status
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">
                                        Tanggal Submit
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">
                                        Aksi
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach ($careerPlans as $plan)
                                    <tr class="hover:bg-gray-50 transition">
                                        <td class="px-6 py-4 text-sm font-medium text-gray-900">
                                            {{ $plan->user->name }}
                                            <p class="text-xs text-gray-500">{{ $plan->user->email }}</p>
                                        </td>
                                        <td class="px-6 py-4 text-sm text-gray-700">
                                            @if ($plan->user->classRoom)
                                                <span class="inline-block px-2 py-1 bg-blue-100 text-blue-800 rounded text-xs font-medium">
                                                    Kelas {{ $plan->user->classRoom->grade_level }}
                                                </span>
                                                <p class="text-xs text-gray-500 mt-1">{{ $plan->user->major->name ?? 'N/A' }}</p>
                                            @else
                                                <span class="text-gray-500">-</span>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4 text-sm">
                                            @switch($plan->category)
                                                @case('kuliah')
                                                    <span class="inline-block px-3 py-1 bg-purple-100 text-purple-800 rounded-full text-xs font-medium">
                                                        📚 Kuliah
                                                    </span>
                                                    @break
                                                @case('kerja')
                                                    <span class="inline-block px-3 py-1 bg-blue-100 text-blue-800 rounded-full text-xs font-medium">
                                                        💼 Kerja
                                                    </span>
                                                    @break
                                                @case('usaha')
                                                    <span class="inline-block px-3 py-1 bg-green-100 text-green-800 rounded-full text-xs font-medium">
                                                        🏢 Usaha
                                                    </span>
                                                    @break
                                                @case('lainnya')
                                                    <span class="inline-block px-3 py-1 bg-gray-100 text-gray-800 rounded-full text-xs font-medium">
                                                        📝 Lainnya
                                                    </span>
                                                    @break
                                            @endswitch
                                        </td>
                                        <td class="px-6 py-4 text-sm text-gray-700">
                                            <div class="max-w-xs">
                                                @if ($plan->category === 'kuliah')
                                                    <p class="text-xs"><strong>Univ:</strong> {{ $plan->target_university ?? '-' }}</p>
                                                    <p class="text-xs"><strong>Jurusan:</strong> {{ $plan->target_major ?? '-' }}</p>
                                                @elseif ($plan->category === 'kerja')
                                                    <p class="text-xs"><strong>Perusahaan:</strong> {{ $plan->target_company ?? '-' }}</p>
                                                    <p class="text-xs"><strong>Posisi:</strong> {{ $plan->target_position ?? '-' }}</p>
                                                @elseif ($plan->category === 'usaha')
                                                    <p class="text-xs"><strong>Usaha:</strong> {{ $plan->business_name ?? '-' }}</p>
                                                @else
                                                    <p class="text-xs">{{ Str::limit($plan->description ?? '-', 50) }}</p>
                                                @endif
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 text-sm">
                                            @if ($plan->status === 'submitted')
                                                <span class="inline-block px-3 py-1 bg-green-100 text-green-800 rounded-full text-xs font-semibold">
                                                    ✓ Submitted
                                                </span>
                                            @else
                                                <span class="inline-block px-3 py-1 bg-yellow-100 text-yellow-800 rounded-full text-xs font-semibold">
                                                    ⚠ Draft
                                                </span>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4 text-sm text-gray-700">
                                            @if ($plan->submitted_at)
                                                {{ $plan->submitted_at->format('d M Y') }}
                                                <p class="text-xs text-gray-500">{{ $plan->submitted_at->format('H:i') }}</p>
                                            @else
                                                <span class="text-gray-500">-</span>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4 text-sm">
                                            <a href="{{ route('guru.students.career-plan.show', $plan->user_id) }}"
                                                class="inline-block px-4 py-2 bg-blue-600 text-white text-xs rounded hover:bg-blue-700 font-medium">
                                                Lihat Detail
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    <div class="mt-6">
                        {{ $careerPlans->links() }}
                    </div>
                @else
                    <div class="text-center py-12 bg-gray-50 rounded-lg border border-dashed border-gray-300">
                        <p class="text-gray-500 text-lg mb-2">📭 Belum ada rencana karir</p>
                        <p class="text-gray-400 text-sm">Siswa belum membuat rencana karir mereka</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
