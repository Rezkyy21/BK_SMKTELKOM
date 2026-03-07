# Testing Rencana Karir Siswa Kelas 12

## 📝 Panduan Testing

Sistem rencana karir hanya tampil untuk **siswa kelas 12**. Berikut cara melakukan testing:

## ✅ Step 1: Setup Data Test

### A. Buat Jurusan (Major)

```sql
INSERT INTO majors (name, created_at, updated_at) VALUES 
('RPL', NOW(), NOW()),
('TKJ', NOW(), NOW()),
('TJA', NOW(), NOW());
```

Atau via PHP Artisan:
```bash
php artisan tinker
>>> Major::create(['name' => 'RPL'])
>>> Major::create(['name' => 'TKJ'])
>>> Major::create(['name' => 'TJA'])
```

### B. Buat Kelas (Classes)

```sql
INSERT INTO classes (name, grade_level, major_id, academic_year, created_at, updated_at) VALUES
('RPL-Kelas 10', 10, 1, '2024/2025', NOW(), NOW()),
('RPL-Kelas 11', 11, 1, '2024/2025', NOW(), NOW()),
('RPL-Kelas 12', 12, 1, '2024/2025', NOW(), NOW());
```

Atau via Tinker:
```bash
php artisan tinker
>>> ClassRoom::create(['name' => 'RPL-Kelas 12', 'grade_level' => 12, 'major_id' => 1, 'academic_year' => '2024/2025'])
```

### C. Update User Siswa dengan Data Akademik

**Via SQL:**
```sql
UPDATE users 
SET role = 'siswa', 
    major_id = 1, 
    class_id = 3,  -- ID dari RPL-Kelas 12
    tahun_masuk = 2024,
    status = 'aktif'
WHERE id = 1;  -- Ganti dengan user ID siswa Anda
```

**Via Tinker:**
```bash
php artisan tinker
>>> $user = User::find(1)
>>> $user->update(['role' => 'siswa', 'major_id' => 1, 'class_id' => 3, 'tahun_masuk' => 2024, 'status' => 'aktif'])
```

---

## 🔍 Step 2: Verifikasi Data

### Cek apakah user sudah memiliki kelas 12:

```bash
php artisan tinker
>>> $user = User::find(1)->load(['classRoom', 'major']);
>>> $user->classRoom
>>> $user->classRoom->grade_level  // Harus 12
```

---

## 🌐 Step 3: Akses Halaman

1. **Login** dengan akun siswa (ID: 1 atau sesuai test data)
2. **Dashboard** akan menampilkan alert:
   - "🎯 Isi Rencana Karir Anda Sekarang!"
   - Button "Buat Rencana"

3. **Halaman Karir** (`/siswa/karir`):
   - Will show section dengan button untuk edit rencana karir
   - Form kategori akan muncul

---

## 🎯 Step 4: Test Fitur Rencana Karir

### A. Buat Rencana Karir (Siswa)

1. Klik button "Buat Rencana" di dashboard atau halaman karir
2. Pilih salah satu kategori:
   - ✅ **Melanjutkan Kuliah** → Isi universitas & program studi
   - ✅ **Bekerja** → Isi perusahaan & posisi
   - ✅ **Membuka Usaha** → Isi nama usaha & deskripsi
   - ✅ **Lainnya** → Isi deskripsi custom

3. Klik "Simpan Rencana" (menyimpan sebagai draft)
4. Klik "Submit ke Guru BK" (untuk submit ke guru)

### B. Guru BK Melihat Rencana Karir

**Sebagai Guru BK:**

1. Login dengan akun guru BK
2. Akses `/guru/students/career-plans`
3. Akan melihat:
   - List semua rencana karir siswa
   - Filter berdasarkan status, kategori, kelas
   - Dashboard dengan statistik
   - Tombol "Lihat Detail" untuk melihat lengkap

---

## 🧪 SQL Queries untuk Testing Cepat

### Cek semua users dengan classRoom:
```sql
SELECT u.id, u.name, u.role, c.name as class_name, c.grade_level, m.name as major_name
FROM users u
LEFT JOIN classes c ON u.class_id = c.id
LEFT JOIN majors m ON u.major_id = m.id
WHERE u.role = 'siswa' AND c.grade_level = 12;
```

### Cek semua career plans:
```sql
SELECT cp.id, u.name, cp.category, cp.status, cp.submitted_at
FROM career_plans cp
LEFT JOIN users u ON cp.user_id = u.id
ORDER BY cp.created_at DESC;
```

### Lihat struktur table:
```sql
DESCRIBE career_plans;
DESCRIBE classes;
DESCRIBE majors;
```

---

## 🔧 Troubleshooting

### 1. Form tidak muncul di dashboard

**Penyebab:** User tidak di kelas 12 atau data classRoom not loaded

**Solusi:**
```bash
# Update user ke kelas 12
UPDATE users SET class_id = <id_class_12>, major_id = <id_major> WHERE id = <user_id>;

# Atau pastikan eloquent loading:
# Di Blade: auth()->user()->load(['classRoom', 'major', 'careerPlan'])
```

### 2. Error 403 saat akses form edit

**Penyebab:** User bukan siswa atau bukan kelas 12

**Solusi:**
- Pastikan `role = 'siswa'`
- Pastikan `classRoom->grade_level = 12`

### 3. Halaman redirect ke karir dengan warning

**Penyebab:** User tidak kelas 12

**Solusi:** Update class_id user ke kelas 12

---

## 📚 File-File untuk Reference

- **Migration:** `database/migrations/2026_02_27_000004_create_career_plans_table.php`
- **Model:** `app/Models/CareerPlan.php`
- **Controller Siswa:** `app/Http/Controllers/CareerPlanController.php`
- **Controller Guru:** `app/Http/Controllers/GuruController.php`
- **View Siswa:** `resources/views/siswa/career-plan-form.blade.php`
- **View Guru:** `resources/views/guru/student-career-plans.blade.php`

---

## ✨ Fitur yang Sudah Siap

✅ Form rencana karir dengan 4 kategori
✅ Save as draft & submit to guru
✅ Edit rencana anytime sebelum submit
✅ Dashboard guru untuk lihat semua rencana siswa
✅ Filter & search rencana karir
✅ Detail view per siswa
✅ Alert di dashboard & halaman karir untuk kelas 12
✅ Status tracking (draft/submitted)

---

## 🚀 Next Steps

Setelah testing berhasil:

1. **Data Production:** Migrate data siswa real ke database
2. **Customize:** Sesuaikan kategori rencana karir sesuai kebutuhan
3. **Monitoring:** Guru BK monitor dan konsultasi dengan siswa
4. **Reporting:** Export data rencana karir untuk laporan

---

**Terakhir diupdate:** 27 Februari 2026
