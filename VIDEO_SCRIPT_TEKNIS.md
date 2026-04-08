# SCRIPT VIDEO TEKNIS - BK Assistant Laravel Project

## PEMBUKAAN (30 detik)
*Halo teman-teman developer! Selamat datang di video penjelasan teknis project BK Assistant SMK Telkom Purwokerto.*

*Project ini adalah platform Digital Guidance and Counseling yang dibangun dengan Laravel untuk membantu siswa SMK Telkom Purwokerto dalam berbagai aspek kehidupan sekolah.*

*Di video ini saya akan jelaskan secara lengkap bagaimana aplikasi ini bekerja, mulai dari demo fitur, tech stack yang digunakan, sampai penjelasan detail alur kode di setiap file penting.*

*Mari kita mulai!*

---

## DEMO FITUR (1-2 menit)

*Pertama-tama, mari saya demo fitur-fitur utama aplikasi ini.*

*Ini adalah halaman dashboard siswa - tempat siswa melihat informasi penting dan akses ke semua fitur BK.*

[BUKA BROWSER: localhost:8000/siswa/dashboard]

*Di sini ada beberapa card utama: Karir, Belajar, Pribadi, Sosial, dan Konseling. Setiap card mengarah ke halaman khusus.*

*Mari saya klik Karir - di sini siswa bisa eksplorasi pilihan karir dan jurusan kuliah.*

[BUKA FILE: resources/views/siswa/karir.blade.php]
[ARAHKAN KURSOR KE: bagian materi karir]

*Halaman Belajar berisi tips akademik dan resource pembelajaran.*

[BUKA FILE: resources/views/siswa/belajar.blade.php]

*Halaman Pribadi untuk pengembangan diri dan motivasi.*

[BUKA FILE: resources/views/siswa/pribadi.blade.php]

*Halaman Sosial untuk panduan hubungan sosial dan komunikasi.*

[BUKA FILE: resources/views/siswa/sosial.blade.php]

*Dan yang paling penting - halaman Konseling untuk booking jadwal dengan Guru BK.*

[BUKA FILE: resources/views/siswa/konseling.blade.php]

*Fitur chatbot BK Assistant yang terintegrasi dengan AI Google Gemini.*

[BUKA FILE: resources/views/components/bk-chatbot.blade.php]
[ARAHKAN KURSOR KE: bagian chat widget]

*Untuk admin panel, kita menggunakan Filament yang powerful.*

[BUKA BROWSER: localhost:8000/admin]

*Di sini admin bisa manage siswa, guru BK, materi, dan semua data sistem.*

---

## TECH STACK (1 menit)

*Sekarang mari bahas teknologi yang digunakan dalam project ini.*

[BUKA FILE: composer.json]

*Dari sisi backend, kita menggunakan:*

*PHP 8.2+ sebagai bahasa utama*
*Laravel 12.0 sebagai framework web*
*Filament 5.2 untuk admin panel yang elegan*
*Maatwebsite Excel untuk import/export data*
*Laravel DomPDF untuk generate PDF laporan*
*Pusher untuk real-time notifications*

[BUKA FILE: package.json]

*Di frontend kita pakai:*

*Tailwind CSS 3.1 untuk styling*
*Vite untuk build tool yang super cepat*
*Alpine.js untuk reactive components*
*Axios untuk HTTP requests*
*Laravel Echo + Pusher.js untuk real-time features*

*Dan yang paling menarik - Google Gemini API untuk AI chatbot!*

---

## PENJELASAN ALUR KODE (5-7 menit)

*Sekarang bagian terpenting - penjelasan detail alur kode. Kita akan bahas routing, controller, model, database, dan AI integration.*

### 1. ROUTING - Titik Masuk Aplikasi (1 menit)

[BUKA FILE: routes/web.php]

*Mari mulai dari routing - ini adalah jantung navigasi aplikasi.*

[ARAHKAN KURSOR KE: Route::get('/siswa/dashboard')]

*Route ini menampilkan dashboard siswa, accessible untuk guest dan authenticated users.*

[ARAHKAN KURSOR KE: Route::post('/bk-assistant/message')]

*Route API untuk chatbot - ini yang handle komunikasi dengan Gemini AI.*

[ARAHKAN KURSOR KE: Route::middleware(['auth'])->group()]

*Routes yang butuh authentication ada di dalam middleware group ini.*

[ARAHKAN KURSOR KE: Route::prefix('siswa/career-plan')]

*Career planning khusus untuk siswa kelas 12.*

### 2. CONTROLLERS - Logic Bisnis (2 menit)

[BUKA FILE: app/Http/Controllers/SiswaController.php]

*SiswaController handle semua halaman siswa.*

[ARAHKAN KURSOR KE: public function dashboard()]

*Method dashboard() load user data dan guru BK untuk ditampilkan di view.*

[ARAHKAN KURSOR KE: public function karir()]

*Method karir() ambil materi dengan kategori 'karir' dari database.*

[ARAHKAN KURSOR KE: public function konseling()]

*Method konseling() untuk booking jadwal dengan guru BK.*

[Sekarang mari lihat controller yang handle AI chatbot]

[BUKA FILE: app/Http/Controllers/BkAssistantController.php]

[ARAHKAN KURSOR KE: public function message()]

*Ini method utama yang terima request dari frontend chatbot.*

[ARAHKAN KURSOR KE: $request->validate()]

*Validasi input messages array dengan struktur yang ketat.*

[ARAHKAN KURSOR KE: Transform messages ke format Gemini API]

*Code ini convert format Laravel ke format yang diminta Gemini API.*

[ARAHKAN KURSOR KE: $apiKey = env('GEMINI_API_KEY')]

*Ambil API key dari environment variables.*

[ARAHKAN KURSOR KE: Http::post() call]

*Kirim request ke Google Gemini API dengan system prompt dan conversation history.*

### 3. MODELS - Representasi Data (1.5 menit)

[BUKA FILE: app/Models/Siswa.php]

*Model Siswa adalah representasi tabel siswa di database.*

[ARAHKAN KURSOR KE: protected $fillable]

*Field yang bisa diisi massal - user_id, nis, nama, dll.*

[ARAHKAN KURSOR KE: public function user()]

*Relationship belongsTo ke User model.*

[ARAHKAN KURSOR KE: public function major() dan classRoom()]

*Relationship ke Major dan ClassRoom untuk data akademik.*

[BUKA FILE: app/Models/User.php]

[ARAHKAN KURSOR KE: protected $fillable]

*User model dengan role enum: admin, guru_bk, siswa.*

[ARAHKAN KURSOR KE: canAccessPanel()]

*Method untuk kontrol akses ke Filament admin panel.*

[BUKA FILE: app/Models/GuruBk.php]

[ARAHKAN KURSOR KE: public function jadwals()]

*Guru BK hasMany jadwal konseling.*

[ARAHKAN KURSOR KE: public function laporans()]

*Dan hasMany laporan hasil konseling.*

### 4. DATABASE MIGRATIONS - Struktur Database (1.5 menit)

[BUKA FILE: database/migrations/0001_01_01_000000_create_users_table.php]

*Tabel users sebagai foundation - email, password, role.*

[ARAHKAN KURSOR KE: enum('role', ['admin', 'guru_bk', 'siswa'])]

*Role enum untuk kontrol akses.*

[BUKA FILE: database/migrations/2026_02_08_232125_create_siswa_table.php]

*Tabel siswa dengan foreign key ke users.*

[ARAHKAN KURSOR KE: foreignId('user_id')->unique()]

*One-to-one relationship dengan users.*

[ARAHKAN KURSOR KE: foreignId('major_id') dan foreignId('class_id')]

*Relationship ke jurusan dan kelas.*

[BUKA FILE: database/migrations/2026_02_08_232217_create_booking_table.php]

*Tabel booking untuk jadwal konseling.*

[ARAHKAN KURSOR KE: foreign keys ke siswa, guru_bk, jadwal]

*Connect semua entitas yang terlibat dalam konseling.*

### 5. FILAMENT RESOURCES - Admin Panel (1 menit)

[BUKA FILE: app/Filament/Resources/Siswas/SiswaResource.php]

*Filament resource untuk manage data siswa.*

[ARAHKAN KURSOR KE: protected static ?string $model = Siswa::class]

*Point ke Siswa model.*

[ARAHKAN KURSOR KE: public static function form()]

*Define form fields untuk create/edit siswa.*

[ARAHKAN KURSOR KE: public static function table()]

*Define tabel columns dan actions.*

[ARAHKAN KURSOR KE: getPages() array]

*Routes untuk index, create, edit pages.*

### 6. AI CHATBOT INTEGRATION - Frontend & Backend (1 menit)

[BUKA FILE: resources/views/components/bk-chatbot.blade.php]

*Component Blade untuk chatbot widget.*

[ARAHKAN KURSOR KE: const GEMINI_URL]

*Route Laravel yang handle AI messages.*

[ARAHKAN KURSOR KE: conversation array]

*History chat dengan system prompt.*

[ARAHKAN KURSOR KE: sendMessage() function]

*Function yang kirim message ke backend.*

[ARAHKAN KURSOR KE: fetch(GEMINI_URL) call]

*AJAX request ke Laravel controller.*

---

## HUBUNGAN ANTAR FILE (30 detik)

*Mari saya jelaskan bagaimana semua komponen ini saling terhubung.*

*Ketika siswa buka halaman dashboard:*

1. *Browser request ke route /siswa/dashboard*
2. *Route call SiswaController::dashboard()*
3. *Controller query Siswa model dan load relationships*
4. *Model ambil data dari tabel siswa, users, dll*
5. *Data dikirim ke view siswa.dashboard*
6. *View render HTML dengan data siswa*

*Untuk chatbot:*

1. *User ketik message di frontend*
2. *JavaScript kirim AJAX ke /bk-assistant/message*
3. *BkAssistantController::message() terima request*
4. *Controller transform data ke format Gemini API*
5. *Kirim HTTP request ke Google Gemini*
6. *Response dikembalikan ke frontend*
7. *Chat bubble update dengan jawaban AI*

*Untuk admin panel:*

1. *Admin akses /admin*
2. *Filament load SiswaResource*
3. *Resource query Siswa model*
4. *Data ditampilkan di tabel admin*

---

## PENUTUP (15 detik)

*Demikian penjelasan teknis lengkap project BK Assistant Laravel ini.*

*Project ini menunjukkan bagaimana Laravel bisa digunakan untuk membangun aplikasi web yang kompleks dengan fitur AI integration, real-time notifications, dan admin panel yang powerful.*

*Terima kasih sudah menonton! Jika ada pertanyaan, silakan tulis di komentar.*

*Jangan lupa like, subscribe, dan share video ini ke teman-teman developer lainnya.*

*See you di video selanjutnya! 👋*