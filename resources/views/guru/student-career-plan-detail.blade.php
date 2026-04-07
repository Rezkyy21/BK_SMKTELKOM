@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900">
                <!-- Header -->
                <div class="flex items-center gap-4 mb-8 pb-6 border-b">
                    <div class="flex-1">
                        <h1 class="text-3xl font-bold text-gray-800">{{ $student->name }}</h1>
                        <p class="text-gray-600 mt-1">{{ $student->email }}</p>
                    </div>
                    <a href="{{ route('guru.students.career-plans') }}" class="px-4 py-2 bg-gray-300 text-gray-800 rounded-lg hover:bg-gray-400 font-medium">
                        ← Kembali
                    </a>
                </div>

                <!-- Info Siswa -->
                <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-8 p-4 bg-gray-50 rounded-lg">
                    <div>
                        <p class="text-sm text-gray-600">Kelas</p>
                        <p class="font-semibold text-gray-900">
                            {{ $student->classRoom?->full_name ?? '-' }}
                        </p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-600">Jurusan</p>
                        <p class="font-semibold text-gray-900">{{ $student->major->name ?? '-' }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-600">Tahun Masuk</p>
                        <p class="font-semibold text-gray-900">{{ $student->tahun_masuk ?? '-' }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-600">Status</p>
                        <p class="font-semibold text-gray-900">{{ ucfirst($student->status) }}</p>
                    </div>
                </div>

                <!-- Rencana Karir Detail -->
                <div class="mb-8">
                    <h2 class="text-2xl font-bold text-gray-800 mb-4">Rencana Karir</h2>

                    <!-- Status Badge -->
                    <div class="mb-6">
                        <div class="flex items-center gap-4">
                            <div>
                                @if ($careerPlan->status === 'submitted')
                                    <span class="inline-block px-4 py-2 bg-green-100 text-green-800 rounded-full font-semibold">
                                        ✓ Submitted
                                    </span>
                                @else
                                    <span class="inline-block px-4 py-2 bg-yellow-100 text-yellow-800 rounded-full font-semibold">
                                        ⚠ Draft (Belum Disubmit)
                                    </span>
                                @endif
                            </div>
                            @if ($careerPlan->submitted_at)
                                <p class="text-sm text-gray-600">
                                    <strong>Disubmit:</strong> {{ $careerPlan->submitted_at->format('d M Y \p\u\k\u\l H:i') }}
                                </p>
                            @endif
                        </div>
                    </div>

                    <!-- Kategori -->
                    <div class="mb-6 p-6 bg-blue-50 border border-blue-200 rounded-lg">
                        <h3 class="text-lg font-semibold text-blue-900 mb-4">Kategori Rencana</h3>
                        <div class="flex items-center gap-4">
                            @switch($careerPlan->category)
                                @case('kuliah')
                                    <div class="text-4xl">📚</div>
                                    <div>
                                        <p class="text-2xl font-bold text-blue-900">Melanjutkan Kuliah</p>
                                        <p class="text-blue-700">Siswa merencanakan untuk melanjutkan pendidikan ke universitas</p>
                                    </div>
                                    @break
                                @case('kerja')
                                    <div class="text-4xl">💼</div>
                                    <div>
                                        <p class="text-2xl font-bold text-blue-900">Bekerja</p>
                                        <p class="text-blue-700">Siswa merencanakan untuk langsung bekerja setelah lulus</p>
                                    </div>
                                    @break
                                @case('usaha')
                                    <div class="text-4xl">🏢</div>
                                    <div>
                                        <p class="text-2xl font-bold text-blue-900">Membuka Usaha / Entrepreneur</p>
                                        <p class="text-blue-700">Siswa merencanakan untuk membuka usaha atau bisnis sendiri</p>
                                    </div>
                                    @break
                                @case('lainnya')
                                    <div class="text-4xl">📝</div>
                                    <div>
                                        <p class="text-2xl font-bold text-blue-900">Lainnya</p>
                                        <p class="text-blue-700">Rencana karir lain yang tidak tercantum di atas</p>
                                    </div>
                                    @break
                            @endswitch
                        </div>
                    </div>

                    <!-- Detail Berdasarkan Kategori -->
                    <div class="space-y-6">
                        @if ($careerPlan->category === 'kuliah')
                            <div class="p-6 bg-purple-50 border border-purple-200 rounded-lg space-y-4">
                                <h4 class="text-lg font-semibold text-purple-900 mb-4">📚 Detail Rencana Kuliah</h4>

                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div>
                                        <p class="text-sm text-gray-600 font-medium">Nama Siswa</p>
                                        <p class="text-lg font-semibold text-gray-900 mt-1">
                                            {{ $careerPlan->student_name ?? $student->name }}
                                        </p>
                                    </div>
                                    <div>
                                        <p class="text-sm text-gray-600 font_medium">NIS</p>
                                        <p class="text-lg font-semibold text-gray-900 mt-1">
                                            {{ $careerPlan->nis ?? '-' }}
                                        </p>
                                    </div>
                                    <div>
                                        <p class="text-sm text-gray-600 font-medium">Kelas</p>
                                        <p class="text-lg font-semibold text-gray-900 mt-1">
                                            {{ $careerPlan->class_name ?? ($student->classRoom?->name ?? '-') }}
                                        </p>
                                    </div>
                                    <div>
                                        <p class="text-sm text-gray-600 font-medium">Tahun Lulus</p>
                                        <p class="text-lg font-semibold text-gray-900 mt-1">
                                            {{ $careerPlan->graduation_year ?? '-' }}
                                        </p>
                                    </div>
                                </div>

                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div>
                                        <p class="text-sm text-gray-600 font-medium">Nama Kampus</p>
                                        <p class="text-lg font-semibold text-gray-900 mt-1">
                                            {{ $careerPlan->campus_name ?? 'Belum diisi' }}
                                        </p>
                                    </div>
                                    <div>
                                        <p class="text-sm text-gray-600 font-medium">Program Studi</p>
                                        <p class="text-lg font-semibold text-gray-900 mt-1">
                                            {{ $careerPlan->study_program ?? 'Belum diisi' }}
                                        </p>
                                    </div>
                                    <div>
                                        <p class="text-sm text-gray-600 font-medium">Tahun Masuk</p>
                                        <p class="text-lg font-semibold text-gray-900 mt-1">
                                            {{ $careerPlan->entrance_year ?? ($student->tahun_masuk ?? '-') }}
                                        </p>
                                    </div>
                                </div>

                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div>
                                        <p class="text-sm text-gray-600 font-medium">Target Universitas</p>
                                        <p class="text-lg font-semibold text-gray-900 mt-1">
                                            {{ $careerPlan->target_university ?? 'Belum diisi' }}
                                        </p>
                                    </div>
                                    <div>
                                        <p class="text-sm text-gray-600 font-medium">Program Studi / Jurusan</p>
                                        <p class="text-lg font-semibold text-gray-900 mt-1">
                                            {{ $careerPlan->target_major ?? 'Belum diisi' }}
                                        </p>
                                    </div>
                                </div>
                            </div>

                        @elseif ($careerPlan->category === 'kerja')
                            <div class="p-6 bg-blue-50 border border-blue-200 rounded-lg space-y-4">
                                <h4 class="text-lg font-semibold text-blue-900 mb-4">💼 Detail Rencana Kerja</h4>

                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div>
                                        <p class="text-sm text-gray-600 font-medium">Nama Siswa</p>
                                        <p class="text-lg font-semibold text-gray-900 mt-1">
                                            {{ $careerPlan->student_name ?? $student->name }}
                                        </p>
                                    </div>
                                    <div>
                                        <p class="text-sm text-gray-600 font-medium">NIS</p>
                                        <p class="text-lg font-semibold text-gray-900 mt-1">
                                            {{ $careerPlan->nis ?? '-' }}
                                        </p>
                                    </div>
                                    <div>
                                        <p class="text-sm text-gray-600 font-medium">Kelas</p>
                                        <p class="text-lg font-semibold text-gray-900 mt-1">
                                            {{ $careerPlan->class_name ?? ($student->classRoom?->name ?? '-') }}
                                        </p>
                                    </div>
                                    <div>
                                        <p class="text-sm text-gray-600 font-medium">Tahun Lulus</p>
                                        <p class="text-lg font-semibold text-gray-900 mt-1">
                                            {{ $careerPlan->graduation_year ?? '-' }}
                                        </p>
                                    </div>
                                </div>

                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div>
                                        <p class="text-sm text-gray-600 font-medium">Target Perusahaan / Industri</p>
                                        <p class="text-lg font-semibold text-gray-900 mt-1">
                                            {{ $careerPlan->target_company ?? 'Belum diisi' }}
                                        </p>
                                    </div>
                                    <div>
                                        <p class="text-sm text-gray-600 font-medium">Posisi / Jabatan yang Diinginkan</p>
                                        <p class="text-lg font-semibold text-gray-900 mt-1">
                                            {{ $careerPlan->target_position ?? 'Belum diisi' }}
                                        </p>
                                    </div>
                                    <div>
                                        <p class="text-sm text-gray-600 font-medium">Tahun Diterima</p>
                                        <p class="text-lg font-semibold text-gray-900 mt-1">
                                            {{ $careerPlan->accepted_year ?? '-' }}
                                        </p>
                                    </div>
                                </div>
                            </div>

                        @elseif ($careerPlan->category === 'usaha')
                            <div class="p-6 bg-green-50 border border-green-200 rounded-lg space-y-4">
                                <h4 class="text-lg font-semibold text-green-900 mb-4">🏢 Detail Rencana Usaha</h4>

                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div>
                                        <p class="text-sm text-gray-600 font-medium">Nama Siswa</p>
                                        <p class="text-lg font-semibold text-gray-900 mt-1">
                                            {{ $careerPlan->student_name ?? $student->name }}
                                        </p>
                                    </div>
                                    <div>
                                        <p class="text-sm text-gray-600 font-medium">NIS</p>
                                        <p class="text-lg font-semibold text-gray-900 mt-1">
                                            {{ $careerPlan->nis ?? '-' }}
                                        </p>
                                    </div>
                                    <div>
                                        <p class="text-sm text-gray-600 font-medium">Kelas</p>
                                        <p class="text-lg font-semibold text-gray-900 mt-1">
                                            {{ $careerPlan->class_name ?? ($student->classRoom?->name ?? '-') }}
                                        </p>
                                    </div>
                                    <div>
                                        <p class="text-sm text-gray-600 font-medium">Tahun Lulus</p>
                                        <p class="text-lg font-semibold text-gray-900 mt-1">
                                            {{ $careerPlan->graduation_year ?? '-' }}
                                        </p>
                                    </div>
                                </div>

                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div>
                                        <p class="text-sm text-gray-600 font-medium">Jenis Usaha</p>
                                        <p class="text-lg font-semibold text-gray-900 mt-1">
                                            {{ $careerPlan->business_type ?? 'Belum diisi' }}
                                        </p>
                                    </div>
                                    <div>
                                        <p class="text-sm text-gray-600 font-medium">Nama Usaha / Bisnis</p>
                                        <p class="text-lg font-semibold text-gray-900 mt-1">
                                            {{ $careerPlan->business_name ?? 'Belum diisi' }}
                                        </p>
                                    </div>
                                    <div>
                                        <p class="text-sm text-gray-600 font-medium">Tahun Berdiri</p>
                                        <p class="text-lg font-semibold text-gray-900 mt-1">
                                            {{ $careerPlan->established_year ?? '-' }}
                                        </p>
                                    </div>
                                </div>

                                <div>
                                    <p class="text-sm text-gray-600 font-medium">Deskripsi Ide Bisnis</p>
                                    <p class="text-gray-900 mt-1 whitespace-pre-wrap">
                                        {{ $careerPlan->business_idea ?? 'Belum diisi' }}
                                    </p>
                                </div>
                            </div>

                        @elseif ($careerPlan->category === 'lainnya')
                            <div class="p-6 bg-gray-50 border border-gray-200 rounded-lg">
                                <h4 class="text-lg font-semibold text-gray-900 mb-4">📝 Deskripsi Rencana</h4>
                                <p class="text-gray-900 whitespace-pre-wrap">
                                    {{ $careerPlan->description ?? 'Belum diisi' }}
                                </p>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Catatan untuk Guru -->
                <div class="p-6 bg-amber-50 border-2 border-amber-300 rounded-lg">
                    <h3 class="text-lg font-semibold text-amber-900 mb-3">💡 Tips untuk Guru BK</h3>
                    <ul class="space-y-2 text-amber-800 text-sm">
                        <li>✓ Gunakan informasi ini untuk memberikan bimbingan karir yang tepat sasaran</li>
                        <li>✓ Jika rencana masih draft, minta siswa untuk menyelesaikan dan submit</li>
                        <li>✓ Pertimbangkan untuk melakukan konsultasi lebih lanjut sesuai kategori rencana</li>
                        <li>✓ Dokumentasikan hasil bimbingan karir di sistem sekolah</li>
                    </ul>
                </div>

                <!-- Timestamps -->
                <div class="mt-6 pt-6 border-t text-xs text-gray-500">
                    <p>Rencana dibuat: {{ $careerPlan->created_at->format('d M Y H:i') }}</p>
                    <p>Terakhir diubah: {{ $careerPlan->updated_at->format('d M Y H:i') }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
