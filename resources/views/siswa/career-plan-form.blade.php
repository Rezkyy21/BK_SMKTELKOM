@extends('layouts.siswa')

@section('title', 'Career Plan Form - SMK Telkom')

@section('styles')
<style>
.nav-inner{
max-width:1200px;
margin:0 auto;
padding:0 24px;
display:flex;
justify-content:space-between;
align-items:center;
height:64px;
}

.nav-links{
display:flex;
gap:32px;
list-style:none;
}

.nav-links a{
text-decoration:none;
color:#64748b;
font-weight:600;
font-size:0.9rem;
padding:6px 0;
position:relative;
transition:color 0.3s;
}

.nav-links a:hover{
color:#1e293b;
}

.nav-links a.active{
color:#f43f5e;
}

.nav-links a.active::after{
content:'';
position:absolute;
bottom:-2px;
left:0;
right:0;
height:2px;
background:#f43f5e;
border-radius:2px;
}

.logo-img{
width:40px;
height:60px;
object-fit:contain;
}

.menu-btn{
display:none;
font-size:26px;
background:none;
border:none;
cursor:pointer;
}

@media (max-width:768px){

.menu-btn{
display:block;
}

.nav-links{
position:absolute;
top:64px;
left:0;
width:100%;
background:white;
flex-direction:column;
gap:0;
display:none;
border-top:1px solid #eee;
}

.nav-links li{
border-bottom:1px solid #f1f1f1;
}

.nav-links a{
display:block;
padding:14px 20px;
}

.nav-links.show{
display:flex;
}

.nav-links a.active{
color:#64748b;
}

.nav-links a.active::after{
display:none;
}

}

/* PROFILE BUTTON */
.profile-wrapper{
position:relative;
}

.profile-btn{
width:38px;
height:38px;
border-radius:50%;
background:#f3f4f6;
display:flex;
align-items:center;
justify-content:center;
cursor:pointer;
border:none;
transition:0.25s;
}

.profile-btn:hover{
background:#e5e7eb;
}

/* DROPDOWN */
.profile-dropdown{
position:absolute;
right:0;
top:48px;
width:230px;
background:white;
border-radius:10px;
box-shadow:0 8px 20px rgba(0,0,0,0.1);
border:1px solid #eee;
display:none;
overflow:hidden;
z-index:20;
}

/* tampil saat hover */
.profile-wrapper:hover .profile-dropdown{
display:block;
}

  /* Profile dropdown */
        .profile-wrapper { position: relative; }
        .profile-dropdown {
            position: absolute;
            right: 0;
            top: calc(100% + 8px);
            background: white;
            border-radius: 12px;
            box-shadow: 0 8px 32px rgba(0,0,0,0.12);
            width: 200px;
            opacity: 0;
            visibility: hidden;
            transform: translateY(-8px);
            transition: all 0.2s;
            z-index: 200;
            border: 1px solid #f1f5f9;
        }
        .profile-wrapper:hover .profile-dropdown {
            opacity: 1;
            visibility: visible;
            transform: translateY(0);
        }
        .dropdown-header { padding: 14px 16px; border-bottom: 1px solid #f1f5f9; }
        .dropdown-header .name { font-weight: 700; font-size: 0.88rem; color: #1e293b; }
        .dropdown-header .email { font-size: 0.78rem; color: #94a3b8; margin-top: 2px; }
        .dropdown-item {
            display: block;
            padding: 10px 16px;
            font-size: 0.85rem;
            color: #475569;
            text-decoration: none;
            transition: background 0.15s;
        }
        .dropdown-item:hover { background: #f8fafc; }



        
</style>
<!-- Navigation -->
 <nav class="bg-white shadow-sm sticky top-0 z-50">
    <div class="nav-inner">

        <!-- Logo -->
        <div class="flex items-center space-x-3">

            <button id="menuBtn" class="menu-btn">
                ☰
            </button>

            <img src="{{ asset('images/telkom.png') }}" alt="Logo Telkom" class="logo-img">

            <div>
                <p class="font-bold text-gray-900 text-sm leading-tight">SMK Telkom</p>
                <p class="text-gray-500 text-xs leading-tight">Purwokerto</p>
            </div>

        </div>

        <!-- Menu -->
        <ul class="nav-links" id="navMenu">
            <li><a href="{{ route('siswa.dashboard') }}">Home</a></li>
            <li><a href="{{ route('siswa.karir') }}" >Karir</a></li>
            <li><a href="{{ route('siswa.belajar') }}">Belajar</a></li>
            <li><a href="{{ route('siswa.pribadi') }}">Pribadi</a></li>
            <li><a href="{{ route('siswa.sosial') }}">Sosial</a></li>
            <li><a href="{{ route('siswa.konseling') }}">Konseling</a></li>

            @guest
            <li><a href="{{ route('login') }}">Login</a></li>
            @endguest
        </ul>

        <!-- Profile -->
        @auth
        <div class="relative group">
            <button class="w-9 h-9 rounded-full bg-gray-100 flex items-center justify-center hover:bg-gray-200 transition">
                <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                </svg>
            </button>

            <div class="absolute right-0 mt-2 w-64 bg-white rounded-xl shadow-lg opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 z-50 border border-gray-100">

                <div class="px-4 py-3 border-b border-gray-100">
                    <p class="text-sm font-semibold text-gray-800">{{ auth()->user()->name }}</p>
                    <p class="text-xs text-gray-500">{{ auth()->user()->email }}</p>
                </div>

                <a href="{{ route('siswa.profile.edit') }}" class="block px-4 py-2 text-gray-700 hover:bg-gray-50 text-sm">
                    Edit Profile
                </a>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="w-full text-left px-4 py-2 text-gray-700 hover:bg-gray-50 text-sm">
                        Logout
                    </button>
                </form>

            </div>
        </div>
        @endauth

    </div>
</nav>
<!-- HEADER -->
<div class="bg-gradient-to-r from-red-700 to-red-500 text-white">
    <div class="max-w-6xl mx-auto px-6 py-10">

        <h1 class="text-3xl font-bold mb-2">
            Rencana Karir Setelah Lulus
        </h1>

        <p class="text-red-100 max-w-xl">
            Tentukan rencana masa depanmu setelah lulus sekolah.
            Guru BK akan membantu memantau dan memberikan arahan terbaik.
        </p>

    </div>
</div>

<div class="bg-gray-50 min-h-screen py-10">

<div class="max-w-6xl mx-auto px-6">

@if ($errors->any())
<div class="mb-6 p-4 bg-red-50 border border-red-200 rounded-xl">
<p class="text-red-800 font-semibold mb-2">Terjadi kesalahan:</p>
<ul class="list-disc list-inside text-red-700 text-sm">
@foreach ($errors->all() as $error)
<li>{{ $error }}</li>
@endforeach
</ul>
</div>
@endif
<div class="bg-white border rounded-xl p-6 mb-10 shadow-sm">

<h3 class="text-lg font-semibold text-gray-800 mb-4">
Cara Mengisi Rencana Karir
</h3>

<div class="grid md:grid-cols-3 gap-4 text-sm text-gray-600">

<div class="flex items-start gap-3">
<div class="bg-red-100 text-red-600 font-bold px-3 py-1 rounded-lg">1</div>
<p>Pilih rencana karir setelah lulus (Kuliah, Kerja, atau Wirausaha).</p>
</div>

<div class="flex items-start gap-3">
<div class="bg-red-100 text-red-600 font-bold px-3 py-1 rounded-lg">2</div>
<p>Isi informasi rencana masa depanmu dengan lengkap.</p>
</div>

<div class="flex items-start gap-3">
<div class="bg-red-100 text-red-600 font-bold px-3 py-1 rounded-lg">3</div>
<p>Submit rencana agar dapat dipantau oleh Guru BK.</p>
</div>

</div>

</div>
<h2 class="text-xl font-bold text-gray-800 mb-4">
Pilih Rencana Karirmu
</h2>

<!-- PILIHAN KARIR -->
<div id="categoryButtons" class="grid md:grid-cols-3 gap-6 mb-10">

<button onclick="showCard('kuliah')"
class="bg-white p-6 rounded-xl shadow-sm border border-gray-200 hover:border-red-500 hover:shadow-md transition text-left">

<div class="text-3xl mb-3">🎓</div>

<h3 class="text-2xl font-semibold text-gray-800 mb-2">
Kuliah
</h3>

<p class="text-gray-500 text-sm leading-relaxed">
Melanjutkan pendidikan ke perguruan tinggi
</p>

</button>


<button onclick="showCard('kerja')"
class="bg-white p-6 rounded-xl shadow-sm border border-gray-200 hover:border-red-500 hover:shadow-md transition text-left">

<div class="text-3xl mb-3">💻</div>

<h3 class="text-2xl font-semibold text-gray-800 mb-2">
Bekerja
</h3>

<p class="text-gray-500 text-sm leading-relaxed">
Langsung bekerja setelah lulus
</p>

</button>


<button onclick="showCard('usaha')"
class="bg-white p-6 rounded-xl shadow-sm border border-gray-200 hover:border-red-500 hover:shadow-md transition text-left">

<div class="text-3xl mb-3">📈</div>

<h3 class="text-2xl font-semibold text-gray-800 mb-2">
Wirausaha
</h3>

<p class="text-gray-500 text-sm leading-relaxed">
Membangun usaha sendiri
</p>

</button>

</div>


<!-- FORM AREA -->

<div class="grid md:grid-cols-1">

<!-- KULIAH -->
<div id="card-kuliah" class="hidden bg-white p-8 rounded-2xl shadow-lg border">

<h2 class="text-2xl font-bold text-gray-800 mb-6">
Form Rencana Kuliah
</h2>

<form action="{{ route('career-plan.update') }}" method="POST">
    @csrf
    @method('PATCH')

    <input type="hidden" name="category" value="kuliah">

    <div class="grid md:grid-cols-2 gap-6">
        <div>
            <label class="text-sm font-medium text-gray-700">Nama</label>
            <input type="text" name="student_name"
                value="{{ old('student_name', $careerPlan->student_name ?? auth()->user()->name) }}"
                placeholder="Nama Lengkap"
                class="mt-1 w-full border rounded-lg px-4 py-2">
        </div>

        <div>
            <label class="text-sm font-medium text-gray-700">NIS</label>
            <input type="text" name="nis"
                value="{{ old('nis', $careerPlan->nis ?? '') }}"
                placeholder="NIS"
                class="mt-1 w-full border rounded-lg px-4 py-2">
        </div>

        <div>
            <label class="text-sm font-medium text-gray-700">Kelas</label>
            <input type="text" name="class_name"
                value="{{ old('class_name', $careerPlan->class_name ?? auth()->user()->classRoom?->name ?? '') }}"
                placeholder="Kelas"
                class="mt-1 w-full border rounded-lg px-4 py-2">
        </div>

        <div>
            <label class="text-sm font-medium text-gray-700">Tahun Lulus</label>
            <input type="number" name="graduation_year"
                value="{{ old('graduation_year', $careerPlan->graduation_year ?? '') }}"
                placeholder="Tahun Lulus"
                class="mt-1 w-full border rounded-lg px-4 py-2">
        </div>

        <div>
            <label class="text-sm font-medium text-gray-700">Tahun Masuk</label>
            <input type="number" name="entrance_year"
                value="{{ old('entrance_year', $careerPlan->entrance_year ?? auth()->user()->tahun_masuk ?? '') }}"
                placeholder="Tahun Masuk"
                class="mt-1 w-full border rounded-lg px-4 py-2">
        </div>

        <div>
            <label class="text-sm font-medium text-gray-700">Target Universitas</label>
            <input type="text" name="target_university"
                value="{{ $careerPlan->target_university ?? '' }}"
                placeholder="Contoh: Universitas Indonesia"
                class="mt-1 w-full border rounded-lg px-4 py-2">
        </div>

        <div class="md:col-span-2">
            <label class="text-sm font-medium text-gray-700">Target Program Studi</label>
            <input type="text" name="target_major"
                value="{{ $careerPlan->target_major ?? '' }}"
                placeholder="Contoh: Teknik Informatika"
                class="mt-1 w-full border rounded-lg px-4 py-2">
        </div>
    </div>

    <div class="flex flex-col gap-4 mt-6 md:flex-row">
        <button type="submit" name="action" value="draft"
            class="flex-1 bg-gray-600 hover:bg-gray-700 text-white py-3 rounded-xl font-semibold">
            Simpan Draft
        </button>

        <button type="submit" name="action" value="submit"
            class="flex-1 bg-red-700 hover:bg-red-800 text-white py-3 rounded-xl font-semibold">
            Submit ke Guru BK
        </button>

        <button type="button" onclick="backToChoice()"
            class="flex-1 bg-gray-200 hover:bg-gray-300 text-gray-700 py-3 rounded-xl font-semibold">
            Kembali
        </button>
    </div>
</form>


<!-- KERJA -->
<div id="card-kerja" class="hidden bg-white p-8 rounded-2xl shadow-lg border">

<h2 class="text-2xl font-bold text-gray-800 mb-6">
Form Rencana Kerja
</h2>

<form action="{{ route('career-plan.update') }}" method="POST">
    @csrf
    @method('PATCH')

    <input type="hidden" name="category" value="kerja">

    <div class="grid md:grid-cols-2 gap-6">
        <div>
            <label class="text-sm font-medium text-gray-700">Nama</label>
            <input type="text" name="student_name"
                value="{{ old('student_name', $careerPlan->student_name ?? auth()->user()->name) }}"
                placeholder="Nama Lengkap"
                class="mt-1 w-full border rounded-lg px-4 py-2">
        </div>

        <div>
            <label class="text-sm font-medium text-gray-700">NIS</label>
            <input type="text" name="nis"
                value="{{ old('nis', $careerPlan->nis ?? '') }}"
                placeholder="NIS"
                class="mt-1 w-full border rounded-lg px-4 py-2">
        </div>

        <div>
            <label class="text-sm font-medium text-gray-700">Kelas</label>
            <input type="text" name="class_name"
                value="{{ old('class_name', $careerPlan->class_name ?? auth()->user()->classRoom?->name ?? '') }}"
                placeholder="Kelas"
                class="mt-1 w-full border rounded-lg px-4 py-2">
        </div>

        <div>
            <label class="text-sm font-medium text-gray-700">Tahun Lulus</label>
            <input type="number" name="graduation_year"
                value="{{ old('graduation_year', $careerPlan->graduation_year ?? '') }}"
                placeholder="Tahun Lulus"
                class="mt-1 w-full border rounded-lg px-4 py-2">
        </div>

        <div>
            <label class="text-sm font-medium text-gray-700">Perusahaan Target</label>
            <input type="text" name="target_company"
                value="{{ $careerPlan->target_company ?? '' }}"
                placeholder="Contoh: Telkom Indonesia"
                class="mt-1 w-full border rounded-lg px-4 py-2">
        </div>

        <div>
            <label class="text-sm font-medium text-gray-700">Posisi Target</label>
            <input type="text" name="target_position"
                value="{{ $careerPlan->target_position ?? '' }}"
                placeholder="Contoh: Web Developer"
                class="mt-1 w-full border rounded-lg px-4 py-2">
        </div>

        <div class="md:col-span-2">
            <label class="text-sm font-medium text-gray-700">Tahun Target Diterima</label>
            <input type="number" name="accepted_year"
                value="{{ old('accepted_year', $careerPlan->accepted_year ?? '') }}"
                placeholder="Contoh: 2026"
                class="mt-1 w-full border rounded-lg px-4 py-2">
        </div>
    </div>

    <div class="flex gap-4 mt-6">
        <button type="submit"
            class="flex-1 bg-gray-600 hover:bg-gray-700 text-white py-3 rounded-xl font-semibold">
            Simpan Draft
        </button>

        <button type="button" onclick="backToChoice()"
            class="flex-1 bg-gray-200 hover:bg-gray-300 text-gray-700 py-3 rounded-xl font-semibold">
            Kembali
        </button>
    </div>
</div>


<!-- USAHA -->
<div id="card-usaha" class="hidden bg-white p-8 rounded-2xl shadow-lg border">

<h2 class="text-2xl font-bold text-gray-800 mb-6">
Form Rencana Wirausaha
</h2>

<form action="{{ route('career-plan.update') }}" method="POST">
@csrf
@method('PATCH')

<input type="hidden" name="category" value="usaha">

<div class="grid md:grid-cols-2 gap-6">

<div>
<label class="text-sm font-medium text-gray-700">Nama</label>
<input type="text" name="student_name"
value="{{ old('student_name', $careerPlan->student_name ?? auth()->user()->name) }}"
placeholder="Nama Lengkap"
class="mt-1 w-full border rounded-lg px-4 py-2">
</div>

<div>
<label class="text-sm font-medium text-gray-700">NIS</label>
<input type="text" name="nis"
value="{{ old('nis', $careerPlan->nis ?? '') }}"
placeholder="NIS"
class="mt-1 w-full border rounded-lg px-4 py-2">
</div>

<div>
<label class="text-sm font-medium text-gray-700">Kelas</label>
<input type="text" name="class_name"
value="{{ old('class_name', $careerPlan->class_name ?? auth()->user()->classRoom?->name ?? '') }}"
placeholder="Kelas"
class="mt-1 w-full border rounded-lg px-4 py-2">
</div>

<div>
<label class="text-sm font-medium text-gray-700">Tahun Lulus</label>
<input type="number" name="graduation_year"
value="{{ old('graduation_year', $careerPlan->graduation_year ?? '') }}"
placeholder="Tahun Lulus"
class="mt-1 w-full border rounded-lg px-4 py-2">
</div>

<div>
<label class="text-sm font-medium text-gray-700">Jenis Usaha</label>
<input type="text" name="business_type"
value="{{ $careerPlan->business_type ?? '' }}"
placeholder="Jenis Usaha"
class="mt-1 w-full border rounded-lg px-4 py-2">
</div>

<div>
<label class="text-sm font-medium text-gray-700">Nama Usaha</label>
<input type="text" name="business_name"
value="{{ $careerPlan->business_name ?? '' }}"
placeholder="Nama Usaha"
class="mt-1 w-full border rounded-lg px-4 py-2">
</div>

<div>
<label class="text-sm font-medium text-gray-700">Tahun Berdiri</label>
<input type="number" name="established_year"
value="{{ old('established_year', $careerPlan->established_year ?? '') }}"
placeholder="Contoh: 2026"
class="mt-1 w-full border rounded-lg px-4 py-2">
</div>

<div class="md:col-span-2">
<label class="text-sm font-medium text-gray-700">Deskripsi Ide Bisnis</label>
<textarea name="business_idea"
placeholder="Jelaskan ide usaha yang ingin kamu bangun..."
class="mt-1 w-full border rounded-lg px-4 py-2">{{ $careerPlan->business_idea ?? '' }}</textarea>
</div>

    <div class="flex flex-col gap-4 mt-6 md:flex-row">
        <button type="submit" name="action" value="draft"
            class="flex-1 bg-gray-600 hover:bg-gray-700 text-white py-3 rounded-xl font-semibold">
            Simpan Draft
        </button>

        <button type="submit" name="action" value="submit"
            class="flex-1 bg-red-700 hover:bg-red-800 text-white py-3 rounded-xl font-semibold">
            Submit ke Guru BK
        </button>

        <button type="button" onclick="backToChoice()"
            class="flex-1 bg-gray-200 hover:bg-gray-300 text-gray-700 py-3 rounded-xl font-semibold">
            Kembali
        </button>
    </div
</div>




</div>
</div>



<script>

function showCard(name){

document.getElementById('categoryButtons').classList.add('hidden');

document.getElementById('card-kuliah').classList.add('hidden');
document.getElementById('card-kerja').classList.add('hidden');
document.getElementById('card-usaha').classList.add('hidden');

document.getElementById('card-'+name).classList.remove('hidden');

}

window.addEventListener('DOMContentLoaded',()=>{

const existing='{{ $careerPlan->category ?? "" }}';

if(existing){
showCard(existing);
}

});
function backToChoice(){

document.getElementById('categoryButtons').classList.remove('hidden');

document.getElementById('card-kuliah').classList.add('hidden');
document.getElementById('card-kerja').classList.add('hidden');
document.getElementById('card-usaha').classList.add('hidden');

}
const menuBtn = document.getElementById("menuBtn");
const navMenu = document.getElementById("navMenu");

menuBtn.addEventListener("click", () => {
    navMenu.classList.toggle("show");
});
</script>

@endsection