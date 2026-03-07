# DOKUMENTASI SISTEM KENAIKAN KELAS OTOMATIS

## 📋 Ringkasan

Sistem ini mengimplementasikan logika kenaikan kelas (promotion) otomatis untuk siswa berdasarkan tahun masuk mereka. Sistem akan secara otomatis:

1. **Menghitung durasi studi** siswa (selisih tahun sekarang dengan tahun masuk)
2. **Menaikkan grade level** siswa ke kelas yang sesuai
3. **Menandai siswa sebagai lulus** setelah 3 tahun durasi studi

---

## 🔧 STRUKTUR DATABASE

### 1. **Tabel `majors`** (Jurusan)

Menyimpan data jurusan sekolah.

```sql
CREATE TABLE majors (
    id BIGINT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(255) NOT NULL UNIQUE,  -- RPL, TKJ, TJA
    created_at TIMESTAMP,
    updated_at TIMESTAMP
);
```

**File Migration:**
- [database/migrations/2026_02_27_000001_create_majors_table.php](database/migrations/2026_02_27_000001_create_majors_table.php)

---

### 2. **Tabel `classes`** (Kelas)

Menyimpan data kelas dengan relasi ke jurusan dan tahun akademik.

```sql
CREATE TABLE classes (
    id BIGINT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(255) NOT NULL,                -- Nama kelas (RPL-10-2024)
    grade_level TINYINT UNSIGNED NOT NULL,    -- 10, 11, 12
    major_id BIGINT UNSIGNED NOT NULL,        -- FK ke majors
    academic_year VARCHAR(255) NOT NULL,      -- Tahun akademik (2024/2025)
    created_at TIMESTAMP,
    updated_at TIMESTAMP,
    
    UNIQUE KEY classes_unique (major_id, grade_level, academic_year),
    FOREIGN KEY (major_id) REFERENCES majors(id) ON DELETE CASCADE
);
```

**File Migration:**
- [database/migrations/2026_02_27_000002_create_classes_table.php](database/migrations/2026_02_27_000002_create_classes_table.php)

---

### 3. **Tabel `users`** (Update)

Menambahkan kolom untuk tracking akademik siswa.

```sql
ALTER TABLE users ADD COLUMN (
    major_id BIGINT UNSIGNED NULLABLE,        -- FK ke majors
    class_id BIGINT UNSIGNED NULLABLE,        -- FK ke classes
    tahun_masuk YEAR NULLABLE,                -- Tahun masuk siswa
    status ENUM('aktif', 'lulus') DEFAULT 'aktif'  -- Status siswa
);
```

**File Migration:**
- [database/migrations/2026_02_27_000003_update_users_add_major_class_and_status.php](database/migrations/2026_02_27_000003_update_users_add_major_class_and_status.php)

---

## 📦 MODEL ELOQUENT

### 1. **Major Model**

```php
namespace App\Models;

class Major extends Model {
    public function classes() { ... }      // HasMany relasi ke classes
    public function users() { ... }        // HasMany relasi ke users
}
```

**File:** [app/Models/Major.php](app/Models/Major.php)

---

### 2. **ClassRoom Model**

Nama model `ClassRoom` karena `classes` adalah reserved keyword di Laravel.

```php
namespace App\Models;

class ClassRoom extends Model {
    protected $table = 'classes';          // eksplisit nama table
    public function major() { ... }        // BelongsTo relasi ke major
    public function students() { ... }     // HasMany relasi ke users
}
```

**File:** [app/Models/ClassRoom.php](app/Models/ClassRoom.php)

---

### 3. **User Model** (Extended)

Tambahan relasi dan method untuk akademik:

```php
class User extends Authenticatable {
    
    // === RELASI ===
    public function major() { ... }           // BelongsTo Major
    public function classRoom() { ... }        // BelongsTo ClassRoom
    
    // === HELPER METHODS ===
    
    /**
     * Hitung berapa tahun siswa sudah bersekolah
     * @return int (0, 1, 2, atau 3+)
     */
    public function yearsEnrolled(): int { ... }
    
    /**
     * Otomatis promosikan siswa jika diperlukan
     * - Naik kelas jika tahun meningkat
     * - Tandai lulus jika sudah 3 tahun
     */
    public function promoteIfNecessary(): void { ... }
}
```

**File:** [app/Models/User.php](app/Models/User.php)

---

## 🚀 LARAVEL COMMAND

### Command: `PromoteStudents`

**Tujuan:** Melakukan promotion massal untuk semua siswa aktif.

**File:** [app/Console/Commands/PromoteStudents.php](app/Console/Commands/PromoteStudents.php)

#### Cara Menggunakan:

```bash
# Jalankan manual
php artisan students:promote

# Atau schedule di Kernel (sudah dikonfigurasi untuk jalan setiap hari jam 00:01)
```

#### Parameter dalam Command:

```bash
# Tidak ada parameter opsional. Command akan:
# 1. Ambil semua siswa dengan role='siswa' dan status='aktif'
# 2. Hitung yearsEnrolled() untuk masing-masing
# 3. Update class_id dan status sesuai logika kenaikan
```

#### Output Contoh:

```
Found 45 active students.
Processing Riki Andre (1), enrolled for 0 year(s)
--> promoted to grade 10
Processing Novi Vina (2), enrolled for 1 year(s)
--> promoted to grade 11
Processing Dara Putri (3), enrolled for 2 year(s)
--> promoted to grade 12
Processing Budi Santoso (4), enrolled for 3 year(s)
--> marked as lulus
...
Promotion job completed.
```

---

## 📊 LOGIKA PROMOTION

### Kondisi Kenaikan Kelas:

| Tahun Masuk | Tahun Sekarang | Years Enrolled | Grade Level Baru | Status |
|---|---|---|---|---|
| 2024 | 2024 | 0 | 10 | aktif |
| 2024 | 2025 | 1 | 11 | aktif |
| 2024 | 2026 | 2 | 12 | aktif |
| 2024 | 2027 | 3+ | - | **lulus** |

### Pseudocode Logika:

```
FUNCTION promoteStudents():
    FOR EACH siswa AS aktif:
        years = YEAR(NOW()) - siswa.tahun_masuk
        
        IF years >= 3 THEN
            siswa.status = "lulus"
            siswa.class_id = NULL
        ELSE
            gradeLevel = 10 + years
            classTarget = find_class(jurusan, gradeLevel, academicYear)
            IF classTarget EXISTS THEN
                siswa.class_id = classTarget.id
            END IF
        END IF
        
        siswa.save()
    END FOR
END FUNCTION
```

---

## 🔄 RELASI DATA

```
users (siswa)
├── belongs_to: majors (jurusan mereka)
├── belongs_to: classes (kelas mereka saat ini)
└── has_one: siswa (detail profil siswa dari tabel siswa)

majors
├── has_many: classes (kelas-kelas di jurusan ini)
└── has_many: users (siswa di jurusan ini)

classes
├── belongs_to: majors
└── has_many: users (siswa di kelas ini)
```

---

## 📝 CONTOH PENGGUNAAN DI LARAVEL

### 1. Mendapatkan Info Siswa

```php
$user = User::with(['major', 'classRoom'])->find(1);

echo $user->name;                  // Nama siswa
echo $user->major->name;           // Nama jurusan (RPL, TKJ, TJA)
echo $user->classRoom->name;       // Nama kelas
echo $user->yearsEnrolled();       // Berapa tahun sudah bersekolah
```

### 2. Promosi Manual Satu Siswa

```php
$user = User::find(1);
$user->promoteIfNecessary();  // Otomatis naik kelas/lulus jika perlu
```

### 3. Update Data Siswa Baru

```php
$newStudent = User::create([
    'name' => 'Ahmad Riyadi',
    'email' => 'ahmad@example.com',
    'password' => bcrypt('default_pass'),
    'role' => 'siswa',
    'status' => 'aktif',
    'major_id' => 1,              // ID jurusan RPL
    'class_id' => 12,             // ID kelas RPL-10-2024
    'tahun_masuk' => 2024,
]);
```

### 4. Query Siswa per Kelas

```php
$classRPL10 = ClassRoom::where('name', 'RPL-10-2024')->first();
$students = $classRPL10->students()->where('status', 'aktif')->get();

foreach($students as $student) {
    echo $student->name . "\n";
}
```

### 5. Cek Status Lulus

```php
$graduated = User::where('status', 'lulus')->count();
echo "Total siswa lulus: " . $graduated;
```

---

## 🎯 SCHEDULING

Command ini sudah dikonfigurasi di `Kernel.php` untuk berjalan **setiap hari jam 00:01 (tengah malam)**:

```php
// File: app/Console/Kernel.php
protected function schedule(Schedule $schedule): void
{
    $schedule->command('students:promote')->dailyAt('00:01');
}
```

### Untuk mengubah jadwal:

```php
// Setiap jam
$schedule->command('students:promote')->hourly();

// Setiap hari kerja (Senin-Jumat) jam 6 pagi
$schedule->command('students:promote')->weekdays()->dailyAt('06:00');

// Setiap tanggal 1 bulan jam 00:01 (untuk tahun ajaran baru)
$schedule->command('students:promote')->monthlyOn(1, '00:01');
```

---

## ✅ BEST PRACTICES YANG DIIMPLEMENTASIKAN

1. **Eloquent Relations** 
   - Menggunakan BelongsTo/HasMany untuk relasi yang jelas dan efisien

2. **Method Chaining**
   - Query builder menggunakan where chaining untuk lebih readable

3. **Type Hints**
   - Semua method memiliki return type declaration

4. **Comments & Documentation**
   - Setiap class, method, dan logika penting dijelaskan dengan PHP Doc

5. **Separation of Concerns**
   - Logic promotion di Model, tidak di Controller/Command
   - Command hanya sebagai orchestrator

6. **Graceful Error Handling**
   - Pengecekan `if ($targetClass)` sebelum assign
   - Pengecekan `if (!$this->tahun_masuk)` sebelum kalkulasi

7. **Immutability & Transactions**
   - Setiap update disimpan dengan `.save()`

8. **Naming Convention**
   - Model: `ClassRoom` (singular, PascalCase)
   - Table: `classes` (plural, snake_case)
   - Method: `promoteIfNecessary()` (camelCase, descriptive)

---

## 🧪 TESTING (Opsional)

Untuk memverifikasi sistem bekerja:

```php
// tests/Feature/StudentPromotionTest.php

public function test_student_promoted_to_grade_11_after_one_year() {
    $siswa = User::create([
        'tahun_masuk' => 2025,
        'status' => 'aktif',
        'role' => 'siswa',
        // ... field lainnya
    ]);
    
    // Mock tahun ke 2026
    \Carbon\Carbon::setTestNow('2026-01-01');
    
    $siswa->promoteIfNecessary();
    $siswa->refresh();
    
    $this->assertEquals(11, $siswa->classRoom->grade_level);
}
```

---

## 📚 File-File yang Dibuat

| File | Deskripsi |
|------|-----------|
| `database/migrations/2026_02_27_000001_create_majors_table.php` | Tabel jurusan |
| `database/migrations/2026_02_27_000002_create_classes_table.php` | Tabel kelas |
| `database/migrations/2026_02_27_000003_update_users_add_major_class_and_status.php` | Update users table |
| `app/Models/Major.php` | Model untuk jurusan |
| `app/Models/ClassRoom.php` | Model untuk kelas |
| `app/Models/User.php` | Update dengan relasi akademik |
| `app/Console/Commands/PromoteStudents.php` | Artisan command |
| `app/Console/Kernel.php` | Schedule configuration |

---

## 🚀 LANGKAH IMPLEMENTASI

1. **Jalankan migrations:**
   ```bash
   php artisan migrate
   ```

2. **Seed data jurusan dan kelas (optional):**
   ```bash
   php artisan tinker
   >>> Major::create(['name' => 'RPL'])
   >>> Major::create(['name' => 'TKJ'])
   >>> Major::create(['name' => 'TJA'])
   >>> ClassRoom::create(['name' => 'RPL-10', 'grade_level' => 10, 'major_id' => 1, 'academic_year' => '2024/2025'])
   ```

3. **Update user siswa dengan data akademik:**
   ```bash
   php artisan tinker
   >>> $user = User::find(1)
   >>> $user->update(['major_id' => 1, 'class_id' => 1, 'tahun_masuk' => 2024, 'status' => 'aktif'])
   ```

4. **Jalankan command promotion:**
   ```bash
   php artisan students:promote
   ```

5. **Verifikasi hasil:**
   ```bash
   php artisan tinker
   >>> User::where('status', 'aktif')->with(['classRoom'])->get()
   ```

---

## 📖 Referensi

- [Laravel Eloquent Relations](https://laravel.com/docs/10.x/eloquent-relationships)
- [Laravel Artisan Commands](https://laravel.com/docs/10.x/artisan)
- [Task Scheduling](https://laravel.com/docs/10.x/scheduling)
