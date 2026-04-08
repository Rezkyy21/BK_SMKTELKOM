# BK Assistant - SMK Telkom Purwokerto

<!-- 
PROJECT TITLE & DESCRIPTION SECTION
This section provides a clear overview of the project purpose and goals.
/ 
JUDUL PROYEK & DESKRIPSI
Bagian ini memberikan gambaran jelas tentang tujuan dan sasaran proyek.
-->

## 📋 Deskripsi Proyek / Project Description

**BK Assistant** adalah platform Digital Guidance and Counseling (Bimbingan Konseling Digital) yang dirancang khusus untuk siswa SMK Telkom Purwokerto. Platform ini bertujuan untuk memberikan pendampingan dan konseling kepada siswa dalam berbagai aspek kehidupan, termasuk akademik, karir, sosial-emosional, dan pengembangan diri.

**BK Assistant** is a Digital Guidance and Counseling platform designed specifically for students at SMK Telkom Purwokerto. The platform aims to provide counseling and support to students in various life aspects, including academics, career development, socio-emotional well-being, and personal development.

### Fitur Utama / Key Features:
- 💬 **AI-Powered Chatbot** - Asisten BK berbasis AI (Google Gemini API)
- 🎓 **Karir & Jurusan** - Informasi lengkap tentang pilihan karir dan program studi
- 📚 **Belajar** - Resource pembelajaran dan tips akademik
- 👥 **Sosial** - Panduan hubungan sosial dan keterampilan berkomunikasi
- 🧠 **Pribadi** - Tips pengembangan diri dan motivasi
- 📋 **Konseling** - Formulir konseling dan tracking progress
- 📊 **Dashboard Admin** - Manajemen konten dan monitoring siswa

---

## 🛠️ Tech Stack / Teknologi yang Digunakan

<!-- 
TECH STACK SECTION
Lists all technologies, languages, and frameworks used in the project.
This helps developers understand the technology requirements.

BAGIAN TECH STACK
Mendaftar semua teknologi, bahasa, dan framework yang digunakan dalam proyek.
Ini membantu developer memahami persyaratan teknologi yang diperlukan.
-->

### **Backend**
| Technology | Version | Purpose |
|-----------|---------|---------|
| **PHP** | 8.2+ | Primary backend language |
| **Laravel** | 12.0 | Web application framework |
| **Laravel Reverb** | 1.9 | Real-time event broadcasting |
| **Filament** | 5.2 | Admin panel & CRUD operations |
| **Maatwebsite Excel** | 3.1 | Excel import/export functionality |
| **Laravel DomPDF** | 3.0 | PDF generation for reports |
| **Pusher** | 7.2 | Real-time notifications |

### **Frontend**
| Technology | Version | Purpose |
|-----------|---------|---------|
| **HTML/CSS/JavaScript** | ES6+ | Markup & styling |
| **Tailwind CSS** | 3.1 | Utility-first CSS framework |
| **Vite** | 7.0.7 | Frontend build tool |
| **Alpine.js** | 3.4.2 | Lightweight reactive framework |
| **Axios** | 1.11.0 | HTTP client |
| **Laravel Echo** | 2.3.1 | WebSocket wrapper |
| **Pusher.js** | 8.4.3 | Real-time library |

### **Development Tools**
| Tool | Version | Purpose |
|------|---------|---------|
| **Composer** | Latest | PHP dependency manager |
| **npm** | Latest | Node.js package manager |
| **PHPUnit** | 11.5.3 | PHP testing framework |
| **Laravel Pint** | 1.24 | Code formatter |
| **Laravel Sail** | 1.41 | Docker development environment |

---

## 📋 Kebutuhan Sistem / System Requirements

<!-- 
REQUIREMENTS SECTION
Specifies minimum requirements to run the project locally.
This ensures developers have the right setup before installation.

BAGIAN KEBUTUHAN
Menentukan persyaratan minimum untuk menjalankan proyek secara lokal.
Ini memastikan developer memiliki setup yang tepat sebelum instalasi.
-->

### **Persyaratan Minimum / Minimum Requirements:**
- **PHP**: 8.2 atau lebih tinggi
- **Composer**: 2.0 atau lebih tinggi (untuk mengelola dependencies PHP)
- **Node.js**: 18.0 atau lebih tinggi dengan npm 9.0+
- **Database**: MySQL 8.0+ atau PostgreSQL 12+
- **Web Server**: Apache atau Nginx
- **Git**: Terbaru (untuk clone repository)
- **Memory**: Minimum 2GB RAM
- **Disk Space**: Minimum 1GB free space

### **Opsional / Optional:**
- **Docker**: Untuk menggunakan Laravel Sail (development container)
- **Gemini API Key**: Untuk mengaktifkan AI chatbot (gratis dari Google)

---

## 🚀 Instalasi & Setup / Installation & Setup

<!-- 
INSTALLATION & SETUP SECTION
Step-by-step guide to get the project running locally.
Each step includes comments explaining why it's important.

BAGIAN INSTALASI & SETUP
Panduan langkah demi langkah untuk menjalankan proyek secara lokal.
Setiap langkah mencakup komentar yang menjelaskan mengapa itu penting.
-->

### **1️⃣ Clone Repository**
```bash
# Clone the repository from GitHub
# Kloning repository dari GitHub
git clone https://github.com/your-username/PSAJ.git

# Navigate into the project directory
# Navigasi ke direktori proyek
cd PSAJ
```

### **2️⃣ Install Backend Dependencies (Composer)**
```bash
# Install PHP dependencies listed in composer.json
# This downloads all required packages (Laravel, Filament, etc.)
# Instal dependensi PHP yang tercantum di composer.json
# Ini mengunduh semua paket yang diperlukan (Laravel, Filament, dll)
composer install
```

### **3️⃣ Install Frontend Dependencies (npm)**
```bash
# Install Node.js dependencies for Tailwind, Vite, etc.
# Instal dependensi Node.js untuk Tailwind, Vite, dll
npm install
```

### **4️⃣ Setup Environment Configuration**
```bash
# Copy the example environment file to create .env
# The .env file contains sensitive configuration (database, API keys, etc.)
# Salin file contoh lingkungan untuk membuat .env
# File .env berisi konfigurasi sensitif (database, kunci API, dll)
cp .env.example .env
```

### **5️⃣ Generate Application Key**
```bash
# Generate unique encryption key for Laravel
# This key is used to encrypt sensitive data in the application
# Buat kunci enkripsi unik untuk Laravel
# Kunci ini digunakan untuk mengenkripsi data sensitif dalam aplikasi
php artisan key:generate
```

### **6️⃣ Configure Database**
```bash
# Edit .env file and set database configuration
# Ubah .env file dan atur konfigurasi database:
# 
# DB_CONNECTION=mysql          # Database type (mysql, pgsql, sqlite)
# DB_HOST=127.0.0.1           # Database server address
# DB_PORT=3306                # Database port
# DB_DATABASE=psaj_db         # Your database name
# DB_USERNAME=root            # Database user
# DB_PASSWORD=your_password   # Database password
```

### **7️⃣ Run Database Migrations**
```bash
# Execute all database migrations to create tables
# Migrations are version-controlled database schema changes
# Jalankan semua migrasi database untuk membuat tabel
# Migrasi adalah perubahan skema database yang dikontrol versi
php artisan migrate
```

### **8️⃣ Create Storage Symlink**
```bash
# Create symbolic link from storage to public directory
# This allows users to access uploaded files via web URL
# Buat symbolic link dari storage ke direktori public
# Ini memungkinkan pengguna mengakses file yang diunggah melalui URL web
php artisan storage:link
```

### **9️⃣ Build Frontend Assets**
```bash
# Compile CSS, JavaScript, and other frontend assets
# Creates optimized production files in public/build directory
# Kompilasi CSS, JavaScript, dan aset frontend lainnya
# Membuat file produksi yang dioptimalkan di direktori public/build
npm run build  # For production / Untuk produksi
# OR / ATAU
npm run dev    # For development with hot reload / Untuk development dengan hot reload
```

### **🔟 Start Development Server**
```bash
# Option 1: Using normal PHP server
# Opsi 1: Menggunakan server PHP normal
php artisan serve
# Server will be available at http://localhost:8000

# Option 2: Using Laravel Sail (Docker - recommended for consistency)
# Opsi 2: Menggunakan Laravel Sail (Docker - direkomendasikan untuk konsistensi)
./vendor/bin/sail up

# Option 3: Using concurrent command (from composer scripts)
# Opsi 3: Menggunakan perintah concurrent
composer dev
```

---

## 🔑 Variabel Lingkungan / Environment Variables

<!-- 
ENVIRONMENT VARIABLES SECTION
Lists important .env configurations that need to be set.
Explains what each variable does and example values.

BAGIAN VARIABEL LINGKUNGAN
Mendaftar konfigurasi .env penting yang perlu diatur.
Menjelaskan apa yang dilakukan setiap variabel dan contoh nilainya.
-->

### **Konfigurasi Umum / General Configuration**
```env
# Application settings
APP_NAME="BK Assistant"
APP_ENV=local                    # Set to 'production' on production server
APP_DEBUG=true                   # Set to 'false' on production
APP_URL=http://localhost:8000    # Your application URL
APP_TIMEZONE=Asia/Jakarta        # Set to your timezone

# Database configuration (MySQL)
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=psaj_db
DB_USERNAME=root
DB_PASSWORD=your_password

# Cache configuration (for better performance)
CACHE_DRIVER=redis              # Or 'file', 'database'
SESSION_DRIVER=cookie           # Session storage method

# Queue configuration (for background jobs)
QUEUE_CONNECTION=async          # Or 'database', 'redis'
```

### **Gemini AI API Configuration** (for BK Assistant Chatbot)
```env
# Google Gemini API Key
# Get free API key from: https://makersuite.google.com/app/apikey
# This is required for the AI chatbot to work
# Dapatkan kunci API gratis dari URL di atas
# Ini diperlukan agar chatbot AI berfungsi
GEMINI_API_KEY=your_gemini_api_key_here

# Gemini API Configuration
GEMINI_MODEL=gemini-1.5-flash   # Model to use for responses
GEMINI_MAX_TOKENS=400            # Maximum response length
```

### **Mail Configuration** (untuk notifikasi email)
```env
MAIL_MAILER=smtp
MAIL_HOST=smtp.mailtrap.io
MAIL_PORT=465
MAIL_USERNAME=your_email@example.com
MAIL_PASSWORD=your_app_password
MAIL_FROM_ADDRESS=noreply@bkassistant.local
MAIL_FROM_NAME="BK Assistant"
```

### **Pusher Real-time Configuration** (untuk notifikasi real-time)
```env
PUSHER_APP_ID=your_pusher_app_id
PUSHER_APP_KEY=your_pusher_app_key
PUSHER_APP_SECRET=your_pusher_app_secret
PUSHER_HOST=api-mt1.pusher.com
PUSHER_PORT=443
PUSHER_SCHEME=https
PUSHER_CLUSTER=mt1
```

---

## ✨ Fitur Utama / Main Features

<!-- 
FEATURES SECTION
Describes the main functionalities available in the application.
Helps developers understand the scope of the project.

BAGIAN FITUR
Menggambarkan fungsionalitas utama yang tersedia dalam aplikasi.
Membantu developer memahami ruang lingkup proyek.
-->

### **👨‍🎓 Untuk Siswa / For Students**
- ✅ **Dashboard Interaktif** - Tampilan ringkasan aktivitas dan informasi penting
- ✅ **Karir & Jurusan** - Eksplorasi pilihan karir, program studi, dan beasiswa
- ✅ **Materi Belajar** - Akses ke tips akademik dan resource pembelajaran
- ✅ **Konseling Online** - Formulir konseling dengan Guru BK
- ✅ **Pengembangan Sosial** - Panduan hubungan sosial dan komunikasi
- ✅ **Pengembangan Pribadi** - Tips motivasi dan pengembangan diri
- ✅ **BK Assistant Chatbot** (AI) - Obrolan real-time dengan AI untuk konseling 24/7
- ✅ **Career Planning** - Merencanakan karir dan goal setting
- ✅ **History Konseling** - Melihat riwayat sesi konseling

### **👨‍💼 Untuk Admin & Guru BK / For Admin & Counselors**
- ✅ **Admin Dashboard** - Manajemen keseluruhan sistem
- ✅ **Data Siswa** - CRUD siswa, tracking progress
- ✅ **Manajemen Konten** - Edit fitur-fitur karir, belajar, sosial, pribadi
- ✅ **Konseling Management** - Review dan follow-up sesi konseling
- ✅ **Report & Analytics** - Statistik dan laporan siswa
- ✅ **Manajemen File** - Upload dan kelola resources
- ✅ **Import/Export Data** - Bulk import siswa dari Excel

### **🤖 Teknologi AI & Real-time**
- ✅ **Google Gemini Integration** - AI chatbot dengan NLP canggih
- ✅ **Real-time Notifications** - Notifikasi instant ke pengguna
- ✅ **WebSocket Broadcasting** - Update real-time di dashboard

---

## 📁 Struktur Folder / Folder Structure

<!-- 
FOLDER STRUCTURE SECTION
Brief explanation of key directories and their purpose.
Helps developers navigate the project easily.

BAGIAN STRUKTUR FOLDER
Penjelasan singkat tentang direktori utama dan tujuannya.
Membantu developer menavigasi proyek dengan mudah.
-->

```
PSAJ/
├── app/
│   ├── Console/              # Artisan commands dan scheduled tasks
│   ├── Filament/             # Admin panel resources dan pages
│   ├── Http/
│   │   ├── Controllers/      # Application controllers (handle requests)
│   │   ├── Middleware/       # HTTP middleware (authentication, etc)
│   │   └── Requests/         # Form request validation
│   ├── Models/               # Eloquent models (database entities)
│   ├── Notifications/        # Email & notification classes
│   └── Observers/            # Model observers (lifecycle hooks)
│
├── bootstrap/
│   └── app.php              # Bootstrap configuration (loaded first)
│
├── config/                   # Configuration files
│   ├── app.php              # App settings
│   ├── database.php         # Database configuration
│   ├── auth.php             # Authentication config
│   └── mail.php             # Email configuration
│
├── database/
│   ├── migrations/          # Database schema changes
│   ├── seeders/             # Database seeding (test data)
│   └── factories/           # Model factories (for testing)
│
├── public/                   # Web root (accessible via browser)
│   ├── css/                 # Public CSS files
│   ├── js/                  # Public JavaScript files
│   ├── storage/             # Uploaded files (symlinked from storage/)
│   └── index.php            # Application entry point
│
├── resources/
│   ├── css/                 # Raw CSS files (compiled by Vite)
│   ├── js/                  # Raw JavaScript files
│   └── views/               # Blade templates
│       ├── siswa/           # Student pages
│       ├── guru/            # Counselor pages
│       ├── layouts/         # Layout templates
│       └── components/      # Reusable Blade components
│
├── routes/
│   ├── web.php              # Web routes
│   ├── auth.php             # Authentication routes
│   └── console.php          # Artisan commands
│
├── storage/
│   ├── app/                 # Application file storage
│   ├── framework/           # Framework storage
│   └── logs/                # Application logs
│
├── tests/                    # Test files
│   ├── Unit/                # Unit tests
│   └── Feature/             # Feature tests
│
├── vendor/                   # Composer dependencies (auto-generated)
├── node_modules/            # npm dependencies (auto-generated)
│
├── .env                      # Environment variables (NOT in git)
├── .env.example             # Example env file (template)
├── composer.json            # PHP dependencies definition
├── package.json             # Node.js dependencies definition
├── tailwind.config.js       # Tailwind CSS configuration
├── vite.config.js           # Vite build configuration
├── phpunit.xml              # PHPUnit testing configuration
└── README.md                # This file
```

### **Penjelasan Folder Penting / Important Folders Explanation:**

| Folder | Purpose / Tujuan |
|--------|-----------------|
| **app/Models** | Mendefinisikan struktur data (Siswa, GuruBK, Konseling, dll) |
| **app/Http/Controllers** | Logika bisnis aplikasi (handle requests dari user) |
| **resources/views** | Template HTML dengan Blade (user interface) |
| **database/migrations** | Versi database schema (dapat di-rollback) |
| **public** | File yang bisa diakses langsung dari browser |
| **storage** | File upload, session, cache, dll |

---

## 🧪 Running Tests / Menjalankan Testing

```bash
# Run all tests
composer test

# Run specific test file
php artisan test tests/Feature/AuthenticationTest.php

# Run with code coverage
php artisan test --coverage
```

---

## 📚 Useful Commands / Perintah Berguna

```bash
# Database commands
php artisan migrate                 # Run migrations
php artisan migrate:fresh          # Reset db (drop all) and re-run
php artisan migrate:refresh --seed # Reset and seed dummy data
php artisan db:seed               # Seed database only

# Cache commands
php artisan cache:clear            # Clear application cache
php artisan config:cache           # Cache configuration

# Queue commands
php artisan queue:listen           # Listen for queued jobs
php artisan queue:failed          # See failed jobs

# Tinker - Interactive shell
php artisan tinker                 # Interactive PHP shell to test code

# Vite dev server
npm run dev                        # Start development server with hot reload
npm run build                      # Build for production
```

---

## 🔐 Security Notes / Catatan Keamanan

<!-- 
SECURITY SECTION
Important reminders for keeping the project secure.

BAGIAN KEAMANAN
Pengingat penting untuk menjaga proyek tetap aman.
-->

> ⚠️ **Penting / Important:**
> - JANGAN commit file `.env` ke repository (sudah di `.gitignore`)
> - JANGAN share/expose `GEMINI_API_KEY`, `PUSHER_APP_SECRET`, dan credentials lainnya
> - Selalu gunakan HTTPS di production
> - Set `APP_DEBUG=false` di production
> - Regularly update dependencies: `composer update` dan `npm update`
> - Implement proper authentication & authorization checks

---

## 📞 Support & Contributing

Untuk pertanyaan, bug reports, atau kontribusi, silakan buat issue atau pull request di repository ini.

For questions, bug reports, or contributions, please create an issue or pull request in this repository.

---

## 📄 License

Proyek ini menggunakan MIT License. Silakan lihat LICENSE file untuk detail lebih lanjut.

This project uses MIT License. Please see the LICENSE file for more details.

---

**Dikembangkan oleh / Developed by:** Tim BK Digital SMK Telkom Purwokerto  
**Tahun / Year:** 2024-2026  
**Status:** Active Development 🚀

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
