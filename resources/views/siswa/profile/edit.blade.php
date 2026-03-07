<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lengkapi Profil - SMK Telkom Purwokerto</title>
    <link href="https://fonts.googleapis.com/css2?family=Syne:wght@400;600;700;800&family=DM+Sans:ital,opsz,wght@0,9..40,300;0,9..40,400;0,9..40,500;1,9..40,300&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        :root {
            --red: #E31837;
            --red-dark: #b5122b;
            --red-glow: rgba(227, 24, 55, 0.18);
            --cream: #FFF8F5;
            --charcoal: #1A1A1A;
            --muted: #6B6B6B;
            --border: #E8E0DC;
            --card-bg: #FFFFFF;
            --input-bg: #FAF6F4;
            --disabled-bg: #F0EAE7;
        }

        body {
            font-family: 'DM Sans', sans-serif;
            background: var(--cream);
            min-height: 100vh;
            display: flex;
            align-items: stretch;
            overflow-x: hidden;
        }

        /* Left panel */
        .left-panel {
            width: 380px;
            min-height: 100vh;
            background: var(--charcoal);
            position: fixed;
            top: 0; left: 0;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            padding: 52px 44px;
            overflow: hidden;
            z-index: 1;
        }

        .left-panel::before {
            content: '';
            position: absolute;
            width: 500px; height: 500px;
            border-radius: 50%;
            background: radial-gradient(circle, var(--red-glow) 0%, transparent 70%);
            top: -100px; left: -100px;
            pointer-events: none;
        }

        .left-panel::after {
            content: '';
            position: absolute;
            width: 350px; height: 350px;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(227,24,55,0.1) 0%, transparent 70%);
            bottom: 80px; right: -80px;
            pointer-events: none;
        }

        .school-badge {
            display: flex;
            align-items: center;
            gap: 14px;
            position: relative;
            z-index: 2;
        }

        .badge-icon {
            width: 46px; height: 46px;
            background: var(--red);
            border-radius: 12px;
            display: flex; align-items: center; justify-content: center;
            font-size: 22px;
            flex-shrink: 0;
            box-shadow: 0 0 20px var(--red-glow);
        }

        .badge-text {
            font-family: 'Syne', sans-serif;
            font-size: 13px;
            font-weight: 700;
            color: #fff;
            line-height: 1.3;
            letter-spacing: 0.03em;
            text-transform: uppercase;
        }

        .badge-text span {
            display: block;
            font-weight: 400;
            color: rgba(255,255,255,0.45);
            font-size: 11px;
            letter-spacing: 0.05em;
            text-transform: none;
            font-family: 'DM Sans', sans-serif;
        }

        .panel-headline {
            position: relative;
            z-index: 2;
        }

        .panel-headline h2 {
            font-family: 'Syne', sans-serif;
            font-size: 38px;
            font-weight: 800;
            color: #fff;
            line-height: 1.1;
            letter-spacing: -0.02em;
            margin-bottom: 18px;
        }

        .panel-headline h2 em {
            font-style: normal;
            color: var(--red);
        }

        .panel-headline p {
            font-size: 14.5px;
            color: rgba(255,255,255,0.5);
            line-height: 1.7;
            font-weight: 300;
        }

        .steps-list {
            position: relative;
            z-index: 2;
            display: flex;
            flex-direction: column;
            gap: 18px;
        }

        .step-item {
            display: flex;
            align-items: center;
            gap: 14px;
            opacity: 0.45;
            transition: opacity 0.3s;
        }

        .step-item.active { opacity: 1; }

        .step-dot {
            width: 32px; height: 32px;
            border-radius: 50%;
            border: 2px solid rgba(255,255,255,0.15);
            display: flex; align-items: center; justify-content: center;
            flex-shrink: 0;
            font-size: 12px;
            font-weight: 600;
            color: rgba(255,255,255,0.4);
            font-family: 'Syne', sans-serif;
        }

        .step-item.active .step-dot {
            background: var(--red);
            border-color: var(--red);
            color: #fff;
            box-shadow: 0 0 12px var(--red-glow);
        }

        .step-label {
            font-size: 13.5px;
            color: rgba(255,255,255,0.5);
            font-weight: 400;
        }

        .step-item.active .step-label {
            color: #fff;
            font-weight: 500;
        }

        .panel-footer {
            position: relative;
            z-index: 2;
            font-size: 12px;
            color: rgba(255,255,255,0.25);
            line-height: 1.6;
        }

        /* Right / main area */
        .main-area {
            margin-left: 380px;
            flex: 1;
            padding: 56px 60px 80px;
            min-height: 100vh;
        }

        .form-header {
            margin-bottom: 44px;
        }

        .form-header .tag {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            background: #FDE8EC;
            color: var(--red);
            font-size: 11.5px;
            font-weight: 600;
            letter-spacing: 0.06em;
            text-transform: uppercase;
            padding: 5px 12px;
            border-radius: 20px;
            margin-bottom: 14px;
        }

        .form-header h1 {
            font-family: 'Syne', sans-serif;
            font-size: 32px;
            font-weight: 800;
            color: var(--charcoal);
            letter-spacing: -0.02em;
            line-height: 1.15;
            margin-bottom: 10px;
        }

        .form-header p {
            font-size: 15px;
            color: var(--muted);
            font-weight: 300;
            line-height: 1.6;
        }

        /* Alert */
        .alert-error {
            background: #FFF0F3;
            border: 1.5px solid #FFCDD5;
            border-radius: 14px;
            padding: 16px 20px;
            margin-bottom: 28px;
        }

        .alert-error p {
            font-size: 13.5px;
            font-weight: 600;
            color: var(--red);
            margin-bottom: 8px;
        }

        .alert-error ul {
            list-style: none;
            font-size: 13px;
            color: #c41230;
        }

        .alert-error li { padding: 2px 0; }
        .alert-error li::before { content: '→ '; opacity: 0.6; }

        /* Form card sections */
        .section-card {
            background: var(--card-bg);
            border: 1.5px solid var(--border);
            border-radius: 20px;
            padding: 32px 36px;
            margin-bottom: 20px;
            position: relative;
            overflow: hidden;
            animation: slideUp 0.4s ease both;
        }

        .section-card:nth-child(1) { animation-delay: 0.05s; }
        .section-card:nth-child(2) { animation-delay: 0.12s; }
        .section-card:nth-child(3) { animation-delay: 0.19s; }

        @keyframes slideUp {
            from { opacity: 0; transform: translateY(18px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .section-card::before {
            content: '';
            position: absolute;
            top: 0; left: 0; right: 0;
            height: 3px;
            background: linear-gradient(90deg, var(--red), transparent);
            opacity: 0;
            transition: opacity 0.3s;
        }

        .section-card:hover::before { opacity: 1; }

        .section-title {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 26px;
        }

        .section-icon {
            width: 38px; height: 38px;
            background: #FDE8EC;
            border-radius: 10px;
            display: flex; align-items: center; justify-content: center;
            font-size: 17px;
            flex-shrink: 0;
        }

        .section-title-text h3 {
            font-family: 'Syne', sans-serif;
            font-size: 16px;
            font-weight: 700;
            color: var(--charcoal);
            line-height: 1.2;
        }

        .section-title-text p {
            font-size: 12.5px;
            color: var(--muted);
            margin-top: 2px;
        }

        .fields-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 18px;
        }

        .field-full { grid-column: 1 / -1; }

        .field-group { display: flex; flex-direction: column; gap: 7px; }

        .field-group label {
            font-size: 12.5px;
            font-weight: 600;
            color: var(--charcoal);
            letter-spacing: 0.02em;
            display: flex;
            align-items: center;
            gap: 4px;
        }

        .field-group label .req { color: var(--red); }

        .field-input {
            width: 100%;
            background: var(--input-bg);
            border: 1.5px solid var(--border);
            border-radius: 12px;
            padding: 13px 16px;
            font-size: 14.5px;
            color: var(--charcoal);
            font-family: 'DM Sans', sans-serif;
            transition: border-color 0.2s, box-shadow 0.2s, background 0.2s;
            outline: none;
            appearance: none;
        }

        .field-input:focus {
            border-color: var(--red);
            box-shadow: 0 0 0 3px var(--red-glow);
            background: #fff;
        }

        .field-input:disabled,
        .field-input[disabled] {
            background: var(--disabled-bg);
            color: var(--muted);
            cursor: not-allowed;
            border-color: #E0D8D5;
        }

        .field-hint {
            font-size: 11.5px;
            color: #A0938F;
        }

        select.field-input {
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='16' height='16' viewBox='0 0 24 24' fill='none' stroke='%236B6B6B' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpolyline points='6 9 12 15 18 9'%3E%3C/polyline%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 14px center;
            padding-right: 40px;
            cursor: pointer;
        }

        /* Password strength */
        .pw-strength {
            display: flex;
            gap: 4px;
            margin-top: 6px;
        }

        .pw-bar {
            height: 3px;
            flex: 1;
            background: var(--border);
            border-radius: 2px;
            transition: background 0.3s;
        }

        .pw-bar.weak { background: #ff6b6b; }
        .pw-bar.medium { background: #f7b731; }
        .pw-bar.strong { background: #20bf6b; }

        /* Info box */
        .info-box {
            background: linear-gradient(135deg, #EEF6FF 0%, #E8F0FE 100%);
            border: 1.5px solid #C8D8F8;
            border-radius: 14px;
            padding: 16px 20px;
            margin-bottom: 28px;
            display: flex;
            gap: 12px;
            align-items: flex-start;
        }

        .info-box .info-icon {
            font-size: 18px;
            flex-shrink: 0;
            margin-top: 1px;
        }

        .info-box p {
            font-size: 13.5px;
            color: #1E40AF;
            line-height: 1.6;
        }

        .info-box p strong { font-weight: 600; }

        /* Submit area */
        .submit-area {
            display: flex;
            flex-direction: column;
            gap: 14px;
        }

        .btn-submit {
            width: 100%;
            background: var(--red);
            color: #fff;
            border: none;
            border-radius: 14px;
            padding: 17px 28px;
            font-family: 'Syne', sans-serif;
            font-size: 16px;
            font-weight: 700;
            letter-spacing: 0.01em;
            cursor: pointer;
            position: relative;
            overflow: hidden;
            transition: background 0.2s, transform 0.1s, box-shadow 0.2s;
            box-shadow: 0 6px 28px rgba(227,24,55,0.3);
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
        }

        .btn-submit::after {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(135deg, rgba(255,255,255,0.12) 0%, transparent 60%);
            pointer-events: none;
        }

        .btn-submit:hover {
            background: var(--red-dark);
            box-shadow: 0 8px 32px rgba(227,24,55,0.4);
            transform: translateY(-1px);
        }

        .btn-submit:active { transform: translateY(0); }

        .btn-submit svg {
            width: 18px; height: 18px;
            fill: none; stroke: #fff;
            stroke-width: 2.5;
            stroke-linecap: round;
            stroke-linejoin: round;
        }

        .footer-link {
            text-align: center;
            font-size: 13px;
            color: var(--muted);
        }

        .footer-link a {
            color: var(--red);
            text-decoration: none;
            font-weight: 600;
            transition: color 0.2s;
        }

        .footer-link a:hover { color: var(--red-dark); }

        /* Floating decorative shape */
        .deco-ring {
            position: fixed;
            right: -60px;
            top: 50%;
            transform: translateY(-50%);
            width: 220px; height: 220px;
            border-radius: 50%;
            border: 40px solid rgba(227,24,55,0.04);
            pointer-events: none;
            z-index: 0;
        }

        /* Responsive */
        @media (max-width: 960px) {
            .left-panel { display: none; }
            .main-area { margin-left: 0; padding: 36px 24px 60px; }
            .fields-grid { grid-template-columns: 1fr; }
        }
    </style>
</head>
<body>

    <!-- Left Panel -->
    <aside class="left-panel">
        <div class="school-badge">
            <div class="badge-icon">📡</div>
            <div class="badge-text">
                SMK Telkom
                <span>Purwokerto · Sistem Informasi</span>
            </div>
        </div>

        <div class="panel-headline">
            <h2>Selamat<br>Datang,<br><em>Siswa Baru.</em></h2>
            <p>Lengkapi profilmu untuk mulai mengakses semua fitur pembelajaran digital.</p>
        </div>

        <div class="steps-list">
            <div class="step-item active">
                <div class="step-dot">1</div>
                <span class="step-label">Data Pribadi</span>
            </div>
            <div class="step-item active">
                <div class="step-dot">2</div>
                <span class="step-label">Informasi Pendidikan</span>
            </div>
            <div class="step-item active">
                <div class="step-dot">3</div>
                <span class="step-label">Buat Password</span>
            </div>
            <div class="step-item">
                <div class="step-dot">4</div>
                <span class="step-label">Dashboard Siswa</span>
            </div>
        </div>

        <div class="panel-footer">
            © 2025 SMK Telkom Purwokerto<br>Sistem Informasi Akademik
        </div>
    </aside>

    <div class="deco-ring"></div>

    <!-- Main Form Area -->
    <main class="main-area">
        <div class="form-header">
            <div class="tag">
                <svg width="10" height="10" viewBox="0 0 10 10" fill="currentColor"><circle cx="5" cy="5" r="5"/></svg>
                Langkah Terakhir
            </div>
            <h1>Lengkapi Profilmu</h1>
            <p>Hanya butuh beberapa menit untuk mengisi data ini.</p>
        </div>

        <!-- Error alert (hidden by default in static preview) -->
        <!-- <div class="alert-error">
            <p>Terdapat beberapa kesalahan:</p>
            <ul>
                <li>Field jurusan wajib diisi</li>
            </ul>
        </div> -->

        <form method="POST" action="#">

            <!-- Card 1: Data Pribadi -->
            <div class="section-card">
                <div class="section-title">
                    <div class="section-icon">👤</div>
                    <div class="section-title-text">
                        <h3>Data Pribadi</h3>
                        <p>Informasi yang sudah terdaftar di sistem sekolah</p>
                    </div>
                </div>
                <div class="fields-grid">
                    <div class="field-group field-full">
                        <label for="nama">Nama Lengkap</label>
                        <input id="nama" type="text" value="Budi Santoso" disabled class="field-input">
                        <span class="field-hint">Data terdaftar — tidak dapat diubah</span>
                    </div>
                    <div class="field-group">
                        <label for="nis">NIS</label>
                        <input id="nis" type="text" value="2024001234" disabled class="field-input">
                        <span class="field-hint">Nomor Induk Siswa</span>
                    </div>
                    <div class="field-group">
                        <label for="kelas">Kelas</label>
                        <input id="kelas" type="text" value="XII RPL 1" disabled class="field-input">
                        <span class="field-hint">Kelas saat ini</span>
                    </div>
                </div>
            </div>

            <!-- Card 2: Informasi Pendidikan -->
            <div class="section-card">
                <div class="section-title">
                    <div class="section-icon">🎓</div>
                    <div class="section-title-text">
                        <h3>Informasi Pendidikan</h3>
                        <p>Pilih jurusan dan kelas yang sesuai</p>
                    </div>
                </div>
                <div class="fields-grid">
                    <div class="field-group field-full">
                        <label for="major_id">Jurusan <span class="req">*</span></label>
                        <select id="major_id" name="major_id" class="field-input" required>
                            <option value="">— Pilih Jurusan —</option>
                            <option value="1">Rekayasa Perangkat Lunak (RPL)</option>
                            <option value="2">Teknik Komputer & Jaringan (TKJ)</option>
                            <option value="3">Multimedia (MM)</option>
                        </select>
                    </div>
                    <div class="field-group field-full">
                        <label for="class_id">Kelas <span class="req">*</span></label>
                        <select id="class_id" name="class_id" class="field-input" required>
                            <option value="">— Pilih Kelas —</option>
                            <option value="1">RPL - XII A (Grade 12)</option>
                            <option value="2">RPL - XII B (Grade 12)</option>
                            <option value="3">TKJ - XI A (Grade 11)</option>
                        </select>
                    </div>
                    <div class="field-group field-full">
                        <label for="tahun_masuk">Tahun Masuk <span class="req">*</span></label>
                        <input id="tahun_masuk" name="tahun_masuk" type="number" min="2000" max="2025"
                               class="field-input" placeholder="Contoh: 2023" required>
                    </div>
                </div>
            </div>

            <!-- Card 3: Password -->
            <div class="section-card">
                <div class="section-title">
                    <div class="section-icon">🔐</div>
                    <div class="section-title-text">
                        <h3>Buat Password</h3>
                        <p>Password kuat untuk keamanan akunmu</p>
                    </div>
                </div>
                <div class="fields-grid">
                    <div class="field-group field-full">
                        <label for="password">Password Baru <span class="req">*</span></label>
                        <input id="password" name="password" type="password"
                               class="field-input" placeholder="Minimal 8 karakter"
                               minlength="8" required oninput="checkStrength(this.value)">
                        <div class="pw-strength">
                            <div class="pw-bar" id="bar1"></div>
                            <div class="pw-bar" id="bar2"></div>
                            <div class="pw-bar" id="bar3"></div>
                            <div class="pw-bar" id="bar4"></div>
                        </div>
                        <span class="field-hint">Kombinasi huruf besar, huruf kecil, angka, dan simbol</span>
                    </div>
                    <div class="field-group field-full">
                        <label for="password_confirmation">Konfirmasi Password <span class="req">*</span></label>
                        <input id="password_confirmation" name="password_confirmation" type="password"
                               class="field-input" placeholder="Ulangi password baru"
                               minlength="8" required>
                    </div>
                </div>
            </div>

            <!-- Info box -->
            <div class="info-box">
                <div class="info-icon">💡</div>
                <p><strong>Catatan:</strong> Setelah menyelesaikan pengisian profil ini, kamu akan diarahkan ke dashboard siswa dan dapat mengakses semua fitur aplikasi.</p>
            </div>

            <!-- Submit -->
            <div class="submit-area">
                <button type="submit" class="btn-submit">
                    Simpan Profil &amp; Lanjutkan
                    <svg viewBox="0 0 24 24"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
                </button>
                <div class="footer-link">
                    Ada pertanyaan? <a href="#">Hubungi Guru BK</a>
                </div>
            </div>
        </form>
    </main>

    <script>
        function checkStrength(val) {
            const bars = [
                document.getElementById('bar1'),
                document.getElementById('bar2'),
                document.getElementById('bar3'),
                document.getElementById('bar4'),
            ];
            bars.forEach(b => { b.className = 'pw-bar'; });
            if (!val) return;

            let score = 0;
            if (val.length >= 8) score++;
            if (/[A-Z]/.test(val)) score++;
            if (/[0-9]/.test(val)) score++;
            if (/[^A-Za-z0-9]/.test(val)) score++;

            const cls = score <= 1 ? 'weak' : score <= 2 ? 'medium' : score <= 3 ? 'medium' : 'strong';
            for (let i = 0; i < score; i++) {
                bars[i].classList.add(cls);
            }
        }
    </script>
</body>
</html>