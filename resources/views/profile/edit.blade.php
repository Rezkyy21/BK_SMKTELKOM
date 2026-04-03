<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile - SMK Telkom</title>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700;800;900&family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --red: #E63329;
            --orange: #F97316;
            --teal: #14b8a6;
            --cyan: #06b6d4;
            --emerald: #10b981;
        }

        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            font-family: 'Poppins', sans-serif;
            background: #f0fdfa;
            overflow-x: hidden;
        }

        /* ===== NAV ===== */
        nav {
            background: white;
            box-shadow: 0 2px 20px rgba(0,0,0,0.07);
            position: sticky;
            top: 0;
            z-index: 100;
            animation: slideDown 0.5s ease;
        }

        @keyframes slideDown {
            from { transform: translateY(-100%); opacity: 0; }
            to { transform: translateY(0); opacity: 1; }
        }

        .nav-inner {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 24px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            height: 64px;
        }

        .logo {
            display: flex;
            align-items: center;
            gap: 10px;
            font-family: 'Nunito', sans-serif;
            font-weight: 900;
            font-size: 1.2rem;
            color: #1e293b;
            text-decoration: none;
        }

        .logo-icon {
            width: 36px; height: 36px;
            background: linear-gradient(135deg, var(--red), var(--orange));
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1rem;
        }

        .nav-links { display: flex; gap: 28px; list-style: none; }

        .nav-links a {
            text-decoration: none;
            color: #64748b;
            font-weight: 600;
            font-size: 0.88rem;
            padding: 6px 0;
            position: relative;
            transition: color 0.3s;
        }

        .nav-links a:hover { color: #1e293b; }

        .profile-wrapper { position: relative; }

        .profile-btn {
            background: none; border: none; cursor: pointer;
            padding: 8px; border-radius: 50%;
            transition: background 0.2s;
            color: #64748b;
        }
        .profile-btn:hover { background: #f1f5f9; }

        .profile-dropdown {
            position: absolute; right: 0; top: calc(100% + 8px);
            background: white; border-radius: 12px;
            box-shadow: 0 8px 32px rgba(0,0,0,0.12);
            width: 200px; opacity: 0; visibility: hidden;
            transform: translateY(-8px);
            transition: all 0.2s; z-index: 200;
            border: 1px solid #f1f5f9;
        }
        .profile-wrapper:hover .profile-dropdown {
            opacity: 1; visibility: visible; transform: translateY(0);
        }
        .dropdown-header { padding: 14px 16px; border-bottom: 1px solid #f1f5f9; }
        .dropdown-header .name { font-weight: 700; font-size: 0.88rem; color: #1e293b; }
        .dropdown-header .email { font-size: 0.78rem; color: #94a3b8; margin-top: 2px; }
        .dropdown-item {
            display: block; padding: 10px 16px; font-size: 0.85rem;
            color: #475569; text-decoration: none; transition: background 0.15s;
            font-family: 'Poppins', sans-serif; border: none; background: none;
            width: 100%; text-align: left; cursor: pointer;
        }
        .dropdown-item:hover { background: #f8fafc; }

        /* ===== PROFILE HERO ===== */
        .profile-hero {
            background: white;
            border-bottom: 1px solid #f1f5f9;
            padding: 40px 24px 0;
            position: relative;
            overflow: hidden;
        }

        .profile-hero::before {
            content: '';
            position: absolute;
            top: 0; left: 0; right: 0;
            height: 4px;
            background: linear-gradient(90deg, var(--red), var(--orange), var(--teal));
        }

        .hero-blob {
            position: absolute;
            border-radius: 50%;
            filter: blur(70px);
            pointer-events: none;
        }

        .hb1 {
            width: 380px; height: 380px;
            background: radial-gradient(circle, rgba(230,51,41,0.07), transparent);
            top: -120px; right: -60px;
            animation: blobFloat 8s ease-in-out infinite;
        }

        .hb2 {
            width: 280px; height: 280px;
            background: radial-gradient(circle, rgba(20,184,166,0.06), transparent);
            bottom: -80px; left: -40px;
            animation: blobFloat 10s ease-in-out infinite reverse;
        }

        @keyframes blobFloat {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.12) translate(10px, -8px); }
        }

        .profile-hero-inner {
            max-width: 900px;
            margin: 0 auto;
            position: relative;
            z-index: 2;
        }

        .profile-header-top {
            display: flex;
            align-items: flex-end;
            gap: 24px;
            padding-bottom: 24px;
        }

        .avatar-wrap { position: relative; flex-shrink: 0; }

        .avatar-circle {
            width: 88px; height: 88px;
            border-radius: 24px;
            background: linear-gradient(135deg, var(--red), var(--orange));
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Nunito', sans-serif;
            font-size: 2.2rem;
            font-weight: 900;
            color: white;
            box-shadow: 0 8px 24px rgba(230,51,41,0.3);
            border: 3px solid white;
        }

        .avatar-online {
            position: absolute;
            bottom: -3px; right: -3px;
            width: 20px; height: 20px;
            background: var(--emerald);
            border-radius: 50%;
            border: 3px solid white;
        }

        .profile-name {
            font-family: 'Nunito', sans-serif;
            font-size: 1.8rem;
            font-weight: 900;
            color: #1e293b;
            margin-bottom: 5px;
        }

        .profile-email {
            font-size: 0.85rem;
            color: #64748b;
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .profile-tabs {
            display: flex;
            gap: 0;
            border-top: 1px solid #f1f5f9;
        }

        .tab-link {
            padding: 14px 22px;
            font-size: 0.83rem;
            font-weight: 600;
            color: #64748b;
            border-bottom: 2px solid transparent;
            text-decoration: none;
            transition: all 0.2s;
            display: flex;
            align-items: center;
            gap: 7px;
        }

        .tab-link:hover { color: #1e293b; background: #f8fafc; }
        .tab-link.active { color: var(--red); border-bottom-color: var(--red); }

        /* ===== CONTENT ===== */
        .content-wrap {
            max-width: 900px;
            margin: 0 auto;
            padding: 32px 24px 80px;
            display: grid;
            grid-template-columns: 240px 1fr;
            gap: 24px;
            align-items: start;
        }

        /* Sidebar */
        .sidebar {
            display: flex;
            flex-direction: column;
            gap: 14px;
            position: sticky;
            top: 88px;
        }

        .sidebar-card {
            background: white;
            border-radius: 18px;
            padding: 16px;
            box-shadow: 0 2px 16px rgba(0,0,0,0.05);
            border: 1px solid #f0fdfa;
        }

        .sidebar-nav-item {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 10px 12px;
            border-radius: 12px;
            font-size: 0.83rem;
            font-weight: 600;
            color: #64748b;
            cursor: pointer;
            text-decoration: none;
            transition: all 0.2s;
        }

        .sidebar-nav-item:hover { background: #f8fafc; color: #1e293b; }
        .sidebar-nav-item.active { background: linear-gradient(135deg, #fff1f0, #fecaca); color: var(--red); }

        .snav-icon {
            width: 32px; height: 32px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.95rem;
            background: #f1f5f9;
            flex-shrink: 0;
            transition: background 0.2s;
        }

        .sidebar-nav-item.active .snav-icon { background: rgba(230,51,41,0.1); }

        .sidebar-info-label {
            font-size: 0.7rem;
            font-weight: 700;
            color: #94a3b8;
            text-transform: uppercase;
            letter-spacing: 0.06em;
            margin-bottom: 10px;
        }

        .info-row {
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 8px 0;
            border-bottom: 1px solid #f8fafc;
            font-size: 0.78rem;
        }
        .info-row:last-child { border-bottom: none; }
        .info-label { color: #94a3b8; }
        .info-value { color: #1e293b; font-weight: 600; margin-left: auto; text-align: right; }

        /* Form cards */
        .form-cards { display: flex; flex-direction: column; gap: 20px; }

        .form-card {
            background: white;
            border-radius: 20px;
            box-shadow: 0 2px 16px rgba(0,0,0,0.05);
            border: 1px solid #f0fdfa;
            overflow: hidden;
        }

        .form-card.danger-zone { border-color: #fecaca; }

        .fcard-header {
            padding: 22px 28px 16px;
            border-bottom: 1px solid #f8fafc;
            display: flex;
            align-items: center;
            gap: 14px;
        }

        .fcard-icon {
            width: 44px; height: 44px;
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.2rem;
            flex-shrink: 0;
        }

        .fcard-icon.c-red   { background: linear-gradient(135deg, #fff1f0, #fecaca); }
        .fcard-icon.c-teal  { background: linear-gradient(135deg, #f0fdfa, #ccfbf1); }
        .fcard-icon.c-warn  { background: linear-gradient(135deg, #fef2f2, #fee2e2); }

        .fcard-title {
            font-family: 'Nunito', sans-serif;
            font-size: 1rem;
            font-weight: 800;
            color: #1e293b;
            margin-bottom: 2px;
        }

        .fcard-title.red { color: var(--red); }
        .fcard-desc { font-size: 0.77rem; color: #94a3b8; }

        .fcard-body { padding: 24px 28px; }

        /* Alerts */
        .alert-success {
            display: flex;
            align-items: center;
            gap: 10px;
            background: linear-gradient(135deg, #f0fdf4, #dcfce7);
            border: 1px solid #bbf7d0;
            color: #166534;
            padding: 12px 16px;
            border-radius: 12px;
            font-size: 0.82rem;
            font-weight: 600;
            margin-bottom: 20px;
        }

        /* Form */
        .form-group { margin-bottom: 16px; }

        .form-label {
            display: block;
            font-size: 0.8rem;
            font-weight: 700;
            color: #374151;
            margin-bottom: 7px;
        }

        .form-input {
            width: 100%;
            padding: 11px 14px;
            border: 1.5px solid #e5e7eb;
            border-radius: 12px;
            font-size: 0.87rem;
            font-family: 'Poppins', sans-serif;
            color: #1e293b;
            transition: border-color 0.2s, box-shadow 0.2s;
            background: white;
            outline: none;
        }

        .form-input:focus {
            border-color: var(--teal);
            box-shadow: 0 0 0 3px rgba(20,184,166,0.12);
        }

        .form-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 14px; }

        .form-error { color: #ef4444; font-size: 0.73rem; margin-top: 5px; }

        /* Buttons */
        .btn-save {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 11px 26px;
            border-radius: 12px;
            background: linear-gradient(135deg, var(--teal), var(--cyan));
            color: white;
            font-size: 0.87rem;
            font-weight: 700;
            border: none;
            cursor: pointer;
            transition: all 0.2s;
            box-shadow: 0 4px 14px rgba(20,184,166,0.3);
            font-family: 'Poppins', sans-serif;
        }

        .btn-save:hover {
            transform: translateY(-1px);
            box-shadow: 0 8px 22px rgba(20,184,166,0.4);
        }

        .btn-delete {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 11px 22px;
            border-radius: 12px;
            background: white;
            color: var(--red);
            border: 1.5px solid #fecaca;
            font-size: 0.87rem;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.2s;
            font-family: 'Poppins', sans-serif;
        }

        .btn-delete:hover {
            background: linear-gradient(135deg, #fff1f0, #fecaca);
            border-color: var(--red);
        }

        /* Danger warning box */
        .warn-box {
            background: linear-gradient(135deg, #fef2f2, #fff1f0);
            border: 1px solid #fecaca;
            border-radius: 12px;
            padding: 14px 16px;
            margin-bottom: 20px;
            font-size: 0.81rem;
            color: #991b1b;
            line-height: 1.65;
        }

        /* ===== MODAL ===== */
        .modal-overlay {
            position: fixed;
            inset: 0;
            background: rgba(15,23,42,0.6);
            backdrop-filter: blur(4px);
            z-index: 400;
            display: none;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .modal-overlay.open { display: flex; animation: fadeIn 0.2s ease; }

        @keyframes fadeIn { from { opacity: 0; } to { opacity: 1; } }

        .modal-box {
            background: white;
            border-radius: 24px;
            box-shadow: 0 24px 80px rgba(0,0,0,0.2);
            max-width: 420px;
            width: 100%;
            animation: slideUp 0.3s cubic-bezier(0.4,0,0.2,1);
            overflow: hidden;
        }

        @keyframes slideUp {
            from { opacity: 0; transform: translateY(20px) scale(0.97); }
            to   { opacity: 1; transform: translateY(0)    scale(1);    }
        }

        .modal-top {
            padding: 28px 28px 20px;
            text-align: center;
            border-bottom: 1px solid #f1f5f9;
        }

        .modal-icon {
            width: 64px; height: 64px;
            border-radius: 20px;
            background: linear-gradient(135deg, #fef2f2, #fee2e2);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.8rem;
            margin: 0 auto 16px;
        }

        .modal-title {
            font-family: 'Nunito', sans-serif;
            font-size: 1.2rem;
            font-weight: 900;
            color: #1e293b;
            margin-bottom: 8px;
        }

        .modal-desc { font-size: 0.81rem; color: #64748b; line-height: 1.65; }

        .modal-body { padding: 22px 28px 28px; }

        .modal-actions { display: grid; grid-template-columns: 1fr 1fr; gap: 10px; margin-top: 18px; }

        .btn-modal-cancel {
            padding: 12px;
            border-radius: 12px;
            border: 1.5px solid #e2e8f0;
            background: white;
            color: #64748b;
            font-size: 0.87rem;
            font-weight: 600;
            cursor: pointer;
            font-family: 'Poppins', sans-serif;
            transition: all 0.2s;
        }
        .btn-modal-cancel:hover { background: #f8fafc; }

        .btn-modal-confirm {
            padding: 12px;
            border-radius: 12px;
            background: linear-gradient(135deg, var(--red), var(--orange));
            color: white;
            font-size: 0.87rem;
            font-weight: 700;
            border: none;
            cursor: pointer;
            font-family: 'Poppins', sans-serif;
            transition: all 0.2s;
            box-shadow: 0 4px 14px rgba(230,51,41,0.3);
        }
        .btn-modal-confirm:hover { transform: translateY(-1px); box-shadow: 0 8px 20px rgba(230,51,41,0.4); }

        /* ===== FOOTER ===== */
        footer { background: #1e293b; padding: 56px 24px 28px; }

        .footer-inner { max-width: 1200px; margin: 0 auto; }

        .footer-top {
            display: grid;
            grid-template-columns: 2fr 1fr 1fr 1fr;
            gap: 48px;
            margin-bottom: 40px;
        }

        .footer-logo {
            display: flex;
            align-items: center;
            gap: 10px;
            color: white;
            font-family: 'Nunito', sans-serif;
            font-weight: 900;
            font-size: 1.1rem;
            text-decoration: none;
            margin-bottom: 12px;
        }

        .footer-brand p { font-size: 0.82rem; line-height: 1.75; color: rgba(255,255,255,0.45); }

        .footer-col h4 { color: white; font-weight: 700; font-size: 0.85rem; margin-bottom: 14px; }
        .footer-col ul { list-style: none; }
        .footer-col ul li { margin-bottom: 9px; }
        .footer-col ul li a { color: rgba(255,255,255,0.45); text-decoration: none; font-size: 0.82rem; transition: color 0.2s; }
        .footer-col ul li a:hover { color: rgba(255,255,255,0.9); }

        .footer-bottom {
            border-top: 1px solid rgba(255,255,255,0.08);
            padding-top: 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 0.78rem;
            color: rgba(255,255,255,0.35);
        }

        .footer-school { color: var(--teal); font-weight: 700; }

        /* Responsive */
        @media (max-width: 768px) {
            .content-wrap { grid-template-columns: 1fr; }
            .sidebar { position: static; }
            .form-grid { grid-template-columns: 1fr; }
            .footer-top { grid-template-columns: 1fr 1fr; }
        }

        @media (max-width: 480px) {
            .nav-links { display: none; }
            .footer-top { grid-template-columns: 1fr; }
            .profile-header-top { flex-direction: column; align-items: flex-start; }
        }
    </style>
</head>
<body>

    <!-- ===== NAVBAR ===== -->
    <nav>
        <div class="nav-inner">
            <a href="{{ route('siswa.dashboard') }}" class="logo">
                <div class="logo-icon">TS</div>
                <div class="logo-text">
                    <span class="school-name">SMK Telkom</span>
                    <span class="school-location">Purwokerto</span>
                </div>
            </a>

            <ul class="nav-links">
                <li><a href="{{ route('siswa.dashboard') }}">Home</a></li>
                <li><a href="{{ route('siswa.karir') }}">Karir</a></li>
                <li><a href="{{ route('siswa.belajar') }}">Belajar</a></li>
                <li><a href="{{ route('siswa.pribadi') }}">Pribadi</a></li>
                <li><a href="{{ route('siswa.sosial') }}">Sosial</a></li>
                <li><a href="{{ route('siswa.konseling') }}">Konseling</a></li>
            </ul>

            <div class="profile-wrapper">
                <button class="profile-btn">
                    <svg width="22" height="22" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                    </svg>
                </button>
                <div class="profile-dropdown">
                    <div class="dropdown-header">
                        <div class="name">{{ auth()->user()->name ?? 'Nama Siswa' }}</div>
                        <div class="email">{{ auth()->user()->email ?? 'siswa@email.com' }}</div>
                    </div>
                    <a href="{{ route('profile.edit') }}" class="dropdown-item">Edit Profile</a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="dropdown-item">Logout</button>
                    </form>
                </div>
            </div>
        </div>
    </nav>

    <!-- ===== PROFILE HERO ===== -->
    <div class="profile-hero">
        <div class="hero-blob hb1"></div>
        <div class="hero-blob hb2"></div>

        <div class="profile-hero-inner">
            <div class="profile-header-top">
                <div class="avatar-wrap">
                    <div class="avatar-circle">
                        {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                    </div>
                    <div class="avatar-online"></div>
                </div>
                <div>
                    <div class="profile-name">{{ auth()->user()->name }}</div>
                    <div class="profile-email">
                        <svg width="13" height="13" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                        </svg>
                        {{ auth()->user()->email }}
                    </div>
                </div>
            </div>

            <div class="profile-tabs">
                <a href="#info" class="tab-link active" data-section="info">
                    <svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                    </svg>
                    Profil
                </a>
                <a href="#password" class="tab-link" data-section="password">
                    <svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                    </svg>
                    Keamanan
                </a>
                <a href="#danger" class="tab-link" data-section="danger">
                    <svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                    </svg>
                    Zona Bahaya
                </a>
            </div>
        </div>
    </div>

    <!-- ===== MAIN CONTENT ===== -->
    <div class="content-wrap">

        <!-- Sidebar -->
        <div class="sidebar">
            <div class="sidebar-card">
                <a href="#info" class="sidebar-nav-item active" data-section="info">
                    <div class="snav-icon">👤</div>
                    Informasi Profil
                </a>
                <a href="#password" class="sidebar-nav-item" data-section="password">
                    <div class="snav-icon">🔒</div>
                    Ubah Password
                </a>
                <a href="#danger" class="sidebar-nav-item" data-section="danger">
                    <div class="snav-icon">⚠️</div>
                    Hapus Akun
                </a>
            </div>

            <div class="sidebar-card">
                <div class="sidebar-info-label">Info Akun</div>
                <div class="info-row">
                    <span class="info-label">👤 Nama</span>
                    <span class="info-value" style="font-size:0.77rem;">{{ auth()->user()->name }}</span>
                </div>
                <div class="info-row">
                    <span class="info-label">📧 Email</span>
                    <span class="info-value" style="font-size:0.72rem;">{{ Str::limit(auth()->user()->email, 16) }}</span>
                </div>
                <div class="info-row">
                    <span class="info-label">🏫 Sekolah</span>
                    <span class="info-value" style="font-size:0.72rem;">SMK Telkom</span>
                </div>
                <div class="info-row">
                    <span class="info-label">📅 Bergabung</span>
                    <span class="info-value">{{ auth()->user()->created_at->format('M Y') }}</span>
                </div>
            </div>
        </div>

        <!-- Form Cards -->
        <div class="form-cards">

            <!-- Profile Info -->
            <div class="form-card" id="info">
                <div class="fcard-header">
                    <div class="fcard-icon c-red">👤</div>
                    <div>
                        <div class="fcard-title">Informasi Profil</div>
                        <div class="fcard-desc">Perbarui nama dan alamat email akun kamu</div>
                    </div>
                </div>
                <div class="fcard-body">
                    @if(session('status') === 'profile-updated')
                        <div class="alert-success">✅ Profil berhasil diperbarui.</div>
                    @endif

                    <form method="POST" action="{{ route('profile.update') }}">
                        @csrf
                        @method('patch')

                        <div class="form-group">
                            <label class="form-label">Nama Lengkap</label>
                            <input type="text" name="name" class="form-input"
                                   value="{{ old('name', auth()->user()->name) }}" required autofocus>
                            @error('name')<div class="form-error">{{ $message }}</div>@enderror
                        </div>

                        <div class="form-group">
                            <label class="form-label">Alamat Email</label>
                            <input type="email" name="email" class="form-input"
                                   value="{{ old('email', auth()->user()->email) }}" required>
                            @error('email')<div class="form-error">{{ $message }}</div>@enderror
                        </div>

                        <button type="submit" class="btn-save">
                            <svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/>
                            </svg>
                            Simpan Perubahan
                        </button>
                    </form>
                </div>
            </div>

            <!-- Password -->
            <div class="form-card" id="password">
                <div class="fcard-header">
                    <div class="fcard-icon c-teal">🔒</div>
                    <div>
                        <div class="fcard-title">Ubah Password</div>
                        <div class="fcard-desc">Gunakan password yang kuat dan unik</div>
                    </div>
                </div>
                <div class="fcard-body">
                    @if(session('status') === 'password-updated')
                        <div class="alert-success">✅ Password berhasil diperbarui.</div>
                    @endif

                    <form method="POST" action="{{ route('password.update') }}">
                        @csrf
                        @method('put')

                        <div class="form-group">
                            <label class="form-label">Password Saat Ini</label>
                            <input type="password" name="current_password" class="form-input" autocomplete="current-password">
                            @error('current_password', 'updatePassword')<div class="form-error">{{ $message }}</div>@enderror
                        </div>

                        <div class="form-grid">
                            <div class="form-group">
                                <label class="form-label">Password Baru</label>
                                <input type="password" name="password" class="form-input" autocomplete="new-password">
                                @error('password', 'updatePassword')<div class="form-error">{{ $message }}</div>@enderror
                            </div>
                            <div class="form-group">
                                <label class="form-label">Konfirmasi Password</label>
                                <input type="password" name="password_confirmation" class="form-input" autocomplete="new-password">
                                @error('password_confirmation', 'updatePassword')<div class="form-error">{{ $message }}</div>@enderror
                            </div>
                        </div>

                        <button type="submit" class="btn-save">
                            <svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                            </svg>
                            Perbarui Password
                        </button>
                    </form>
                </div>
            </div>

            <!-- Danger Zone -->
            <div class="form-card danger-zone" id="danger">
                <div class="fcard-header">
                    <div class="fcard-icon c-warn">⚠️</div>
                    <div>
                        <div class="fcard-title red">Zona Bahaya</div>
                        <div class="fcard-desc">Tindakan ini permanen dan tidak dapat dibatalkan</div>
                    </div>
                </div>
                <div class="fcard-body">
                    <div class="warn-box">
                        ⚠️ Setelah akun dihapus, semua data termasuk riwayat konseling dan informasi pribadi akan dihapus secara permanen dan <strong>tidak dapat dipulihkan</strong>.
                    </div>
                    <button type="button" class="btn-delete" onclick="document.getElementById('deleteModal').classList.add('open')">
                        <svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                        </svg>
                        Hapus Akun Saya
                    </button>
                </div>
            </div>

        </div>
    </div>

    <!-- ===== DELETE MODAL ===== -->
    <div id="deleteModal" class="modal-overlay" onclick="if(event.target===this)this.classList.remove('open')">
        <div class="modal-box" onclick="event.stopPropagation()">
            <div class="modal-top">
                <div class="modal-icon">🗑️</div>
                <div class="modal-title">Hapus Akun?</div>
                <div class="modal-desc">Masukkan password kamu untuk konfirmasi. Semua data akan hilang secara permanen.</div>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('profile.destroy') }}">
                    @csrf
                    @method('delete')

                    <div class="form-group">
                        <label class="form-label">Konfirmasi Password</label>
                        <input type="password" name="password" class="form-input" placeholder="Masukkan password kamu">
                        @error('password', 'userDeletion')<div class="form-error">{{ $message }}</div>@enderror
                    </div>

                    <div class="modal-actions">
                        <button type="button" class="btn-modal-cancel"
                                onclick="document.getElementById('deleteModal').classList.remove('open')">
                            Batal
                        </button>
                        <button type="submit" class="btn-modal-confirm">Ya, Hapus Akun</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- ===== FOOTER ===== -->
    <footer>
        <div class="footer-inner">
            <div class="footer-top">
                <div class="footer-brand">
                    <a href="{{ route('siswa.dashboard') }}" class="footer-logo">
                        <div class="logo-icon">TS</div>
                        <div class="logo-text">
                            <span class="school-name">SMK Telkom</span>
                            <span class="school-location">Purwokerto</span>
                        </div>
                    </a>
                    <p>Platform pembelajaran dan konseling terpadu untuk siswa SMK Telkom Sandy Putra Purwokerto.</p>
                </div>
                <div class="footer-col">
                    <h4>Layanan Kami</h4>
                    <ul>
                        <li><a href="{{ route('siswa.karir') }}">Karir</a></li>
                        <li><a href="{{ route('siswa.belajar') }}">Belajar</a></li>
                        <li><a href="{{ route('siswa.pribadi') }}">Pribadi</a></li>
                        <li><a href="{{ route('siswa.sosial') }}">Sosial</a></li>
                        <li><a href="{{ route('siswa.konseling') }}">Konseling</a></li>
                    </ul>
                </div>
                <div class="footer-col">
                    <h4>Tentang</h4>
                    <ul>
                        <li><a href="#">Tentang Kami</a></li>
                        <li><a href="#">Tim Guru BK</a></li>
                        <li><a href="#">Kebijakan</a></li>
                        <li><a href="#">Kontak</a></li>
                    </ul>
                </div>
                <div class="footer-col">
                    <h4>Kontak</h4>
                    <ul>
                        <li><a href="mailto:bksmatel@gmail.com">bksmatel@gmail.com</a></li>
                        <li><a href="#">+62 862722551</a></li>
                        <li><a href="#">Purwokerto, Jawa Tengah</a></li>
                    </ul>
                </div>
            </div>
            <div class="footer-bottom">
                <span class="footer-school">SMK Telkom Sandy Putra Purwokerto</span>
                <span>© {{ date('Y') }} SMK Telkom Sandy Putra Purwokerto. All rights reserved.</span>
            </div>
        </div>
    </footer>

    <script>
        // Smooth scroll + active state for tabs & sidebar
        const allNavLinks = document.querySelectorAll('[data-section]');

        allNavLinks.forEach(link => {
            link.addEventListener('click', e => {
                e.preventDefault();
                const id = link.dataset.section;
                document.getElementById(id)?.scrollIntoView({ behavior: 'smooth', block: 'start' });
            });
        });

        // Update active on scroll
        const sections = ['info', 'password', 'danger'];

        window.addEventListener('scroll', () => {
            let current = 'info';
            sections.forEach(id => {
                const el = document.getElementById(id);
                if (el && el.getBoundingClientRect().top < 160) current = id;
            });
            allNavLinks.forEach(link => {
                link.classList.toggle('active', link.dataset.section === current);
            });
        });

        // ESC to close modal
        document.addEventListener('keydown', e => {
            if (e.key === 'Escape') document.getElementById('deleteModal').classList.remove('open');
        });
    </script>

</body>
</html>