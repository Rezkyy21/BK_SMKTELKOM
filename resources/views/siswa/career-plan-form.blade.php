@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900">
                <div class="mb-6">
                    <h2 class="text-3xl font-bold text-gray-800 mb-2">Rencana Karir Setelah Lulus</h2>
                    <p class="text-gray-600">Isi rencana karir Anda untuk dipantau oleh guru BK</p>
                </div>

                @if ($errors->any())
                    <div class="mb-4 p-4 bg-red-50 border border-red-200 rounded-lg">
                        <p class="text-red-800 font-semibold mb-2">Terjadi kesalahan:</p>
                        <ul class="list-disc list-inside text-red-700 text-sm">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <!-- pilihan kategori tombol -->
                <div id="categoryButtons" class="flex justify-center gap-6 mb-8">
                    <button class="px-8 py-4 bg-red-700 text-white rounded-lg hover:bg-red-800" onclick="showCard('kuliah')">Kuliah</button>
                    <button class="px-8 py-4 bg-red-700 text-white rounded-lg hover:bg-red-800" onclick="showCard('kerja')">Kerja</button>
                    <button class="px-8 py-4 bg-red-700 text-white rounded-lg hover:bg-red-800" onclick="showCard('usaha')">Wirausaha</button>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <!-- Kuliah Form Card -->
                    <div id="card-kuliah" class="bg-white p-6 rounded-lg shadow hidden">
                        <h3 class="text-2xl font-bold mb-2">Kuliah</h3>
                        <p class="text-sm text-gray-600 mb-4">Isi Form Berikut!</p>
                        <form action="{{ route('career-plan.update') }}" method="POST">
                            @csrf
                            @method('PATCH')
                            <input type="hidden" name="category" value="kuliah">

                            <div class="mb-3">
                                <label class="block text-sm text-gray-700 mb-1">Nama Lengkap</label>
                                <input type="text" name="student_name" value="{{ old('student_name', $careerPlan->student_name ?? auth()->user()->name) }}" class="w-full px-4 py-2 border rounded-lg">
                            </div>

                            <div class="mb-3">
                                <label class="block text-sm text-gray-700 mb-1">NIS</label>
                                <input type="text" name="nis" value="{{ old('nis', $careerPlan->nis ?? '') }}" class="w-full px-4 py-2 border rounded-lg">
                            </div>

                            <div class="mb-3">
                                <label class="block text-sm text-gray-700 mb-1">Kelas</label>
                                <input type="text" name="class_name" value="{{ old('class_name', $careerPlan->class_name ?? auth()->user()->classRoom?->name ?? '') }}" class="w-full px-4 py-2 border rounded-lg">
                            </div>

                            <div class="mb-3">
                                <label class="block text-sm text-gray-700 mb-1">Tahun Lulus</label>
                                <input type="number" name="graduation_year" value="{{ old('graduation_year', $careerPlan->graduation_year ?? '') }}" class="w-full px-4 py-2 border rounded-lg">
                            </div>

                            <div class="mb-3">
                                <label class="block text-sm text-gray-700 mb-1">Nama Kampus</label>
                                <input type="text" name="campus_name" value="{{ old('campus_name', $careerPlan->campus_name ?? '') }}" class="w-full px-4 py-2 border rounded-lg">
                            </div>

                            <div class="mb-3">
                                <label class="block text-sm text-gray-700 mb-1">Program Studi</label>
                                <input type="text" name="study_program" value="{{ old('study_program', $careerPlan->study_program ?? '') }}" class="w-full px-4 py-2 border rounded-lg">
                            </div>

                            <div class="mb-3">
                                <label class="block text-sm text-gray-700 mb-1">Tahun Masuk</label>
                                <input type="number" name="entrance_year" value="{{ old('entrance_year', $careerPlan->entrance_year ?? auth()->user()->tahun_masuk ?? '') }}" class="w-full px-4 py-2 border rounded-lg">
                            </div>

                            <div class="mb-3">
                                <label class="block text-sm text-gray-700 mb-1">Target Universitas</label>
                                <input type="text" name="target_university" value="{{ $careerPlan->target_university ?? '' }}" class="w-full px-4 py-2 border rounded-lg">
                            </div>

                            <div class="mb-3">
                                <label class="block text-sm text-gray-700 mb-1">Program Studi</label>
                                <input type="text" name="target_major" value="{{ $careerPlan->target_major ?? '' }}" class="w-full px-4 py-2 border rounded-lg">
                            </div>

                            <div class="mt-6">
                                <button type="submit" class="w-full bg-red-700 text-white py-3 rounded-full">Kirim</button>
                            </div>
                        </form>
                    </div>

                    <!-- Kerja Form Card -->
                    <div id="card-kerja" class="bg-white p-6 rounded-lg shadow hidden">
                        <h3 class="text-2xl font-bold mb-2">Kerja</h3>
                        <p class="text-sm text-gray-600 mb-4">Isi Form Berikut!</p>
                        <form action="{{ route('career-plan.update') }}" method="POST">
                            @csrf
                            @method('PATCH')
                            <input type="hidden" name="category" value="kerja">

                            <div class="mb-3">
                                <label class="block text-sm text-gray-700 mb-1">Nama Lengkap</label>
                                <input type="text" name="student_name" value="{{ old('student_name', $careerPlan->student_name ?? auth()->user()->name) }}" class="w-full px-4 py-2 border rounded-lg">
                            </div>
                            <div class="mb-3">
                                <label class="block text-sm text-gray-700 mb-1">NIS</label>
                                <input type="text" name="nis" value="{{ old('nis', $careerPlan->nis ?? '') }}" class="w-full px-4 py-2 border rounded-lg">
                            </div>
                            <div class="mb-3">
                                <label class="block text-sm text-gray-700 mb-1">Kelas</label>
                                <input type="text" name="class_name" value="{{ old('class_name', $careerPlan->class_name ?? auth()->user()->classRoom?->name ?? '') }}" class="w-full px-4 py-2 border rounded-lg">
                            </div>
                            <div class="mb-3">
                                <label class="block text-sm text-gray-700 mb-1">Tahun Lulus</label>
                                <input type="number" name="graduation_year" value="{{ old('graduation_year', $careerPlan->graduation_year ?? '') }}" class="w-full px-4 py-2 border rounded-lg">
                            </div>

                            <div class="mb-3">
                                <label class="block text-sm text-gray-700 mb-1">Nama Perusahaan</label>
                                <input type="text" name="target_company" value="{{ $careerPlan->target_company ?? '' }}" class="w-full px-4 py-2 border rounded-lg">
                            </div>

                            <div class="mb-3">
                                <label class="block text-sm text-gray-700 mb-1">Posisi</label>
                                <input type="text" name="target_position" value="{{ $careerPlan->target_position ?? '' }}" class="w-full px-4 py-2 border rounded-lg">
                            </div>

                            <div class="mb-3">
                                <label class="block text-sm text-gray-700 mb-1">Tahun Diterima</label>
                                <input type="number" name="accepted_year" value="{{ old('accepted_year', $careerPlan->accepted_year ?? '') }}" class="w-full px-4 py-2 border rounded-lg">
                            </div>

                            <div class="mt-6">
                                <button type="submit" class="w-full bg-red-700 text-white py-3 rounded-full">Kirim</button>
                            </div>
                        </form>
                    </div>

                    <!-- Wirausaha Form Card -->
                    <div id="card-usaha" class="bg-white p-6 rounded-lg shadow hidden">
                        <h3 class="text-2xl font-bold mb-2">Wirausaha</h3>
                        <p class="text-sm text-gray-600 mb-4">Isi Form Berikut!</p>
                        <form action="{{ route('career-plan.update') }}" method="POST">
                            @csrf
                            @method('PATCH')
                            <input type="hidden" name="category" value="usaha">

                            <div class="mb-3">
                                <label class="block text-sm text-gray-700 mb-1">Nama Lengkap</label>
                                <input type="text" name="student_name" value="{{ old('student_name', $careerPlan->student_name ?? auth()->user()->name) }}" class="w-full px-4 py-2 border rounded-lg">
                            </div>
                            <div class="mb-3">
                                <label class="block text-sm text-gray-700 mb-1">NIS</label>
                                <input type="text" name="nis" value="{{ old('nis', $careerPlan->nis ?? '') }}" class="w-full px-4 py-2 border rounded-lg">
                            </div>
                            <div class="mb-3">
                                <label class="block text-sm text-gray-700 mb-1">Kelas</label>
                                <input type="text" name="class_name" value="{{ old('class_name', $careerPlan->class_name ?? auth()->user()->classRoom?->name ?? '') }}" class="w-full px-4 py-2 border rounded-lg">
                            </div>
                            <div class="mb-3">
                                <label class="block text-sm text-gray-700 mb-1">Tahun Lulus</label>
                                <input type="number" name="graduation_year" value="{{ old('graduation_year', $careerPlan->graduation_year ?? '') }}" class="w-full px-4 py-2 border rounded-lg">
                            </div>

                            <div class="mb-3">
                                <label class="block text-sm text-gray-700 mb-1">Jenis Usaha</label>
                                <input type="text" name="business_type" value="{{ $careerPlan->business_type ?? '' }}" class="w-full px-4 py-2 border rounded-lg">
                            </div>

                            <div class="mb-3">
                                <label class="block text-sm text-gray-700 mb-1">Nama Usaha</label>
                                <input type="text" name="business_name" value="{{ $careerPlan->business_name ?? '' }}" class="w-full px-4 py-2 border rounded-lg">
                            </div>

                            <div class="mb-3">
                                <label class="block text-sm text-gray-700 mb-1">Tahun Berdiri</label>
                                <input type="number" name="established_year" value="{{ old('established_year', $careerPlan->established_year ?? '') }}" class="w-full px-4 py-2 border rounded-lg">
                            </div>

                            <div class="mb-3">
                                <label class="block text-sm text-gray-700 mb-1">Deskripsi Ide Bisnis</label>
                                <textarea name="business_idea" rows="4" class="w-full px-4 py-2 border rounded-lg">{{ $careerPlan->business_idea ?? '' }}</textarea>
                            </div>

                            <div class="mt-6">
                                <button type="submit" class="w-full bg-red-700 text-white py-3 rounded-full">Kirim</button>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="mt-6">
                    <a href="{{ route('siswa.karir') }}" class="px-6 py-2 bg-gray-200 text-gray-800 rounded-lg hover:bg-gray-300 font-medium">Kembali</a>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function showCard(name) {
    document.getElementById('categoryButtons').classList.add('hidden');
    document.getElementById('card-kuliah').classList.add('hidden');
    document.getElementById('card-kerja').classList.add('hidden');
    document.getElementById('card-usaha').classList.add('hidden');
    document.getElementById('card-' + name).classList.remove('hidden');
}

// jika sedang mengedit dan kategori sudah ada, tampilkan card yang sesuai
window.addEventListener('DOMContentLoaded', () => {
    const existing = '{{ $careerPlan->category }}';
    if (existing) {
        showCard(existing);
    }
});
</script>


@endsection
