<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sosial - SMK Telkom</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700;800;900&family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        :root {
            --teal: #14b8a6;
            --cyan: #06b6d4;
            --emerald: #10b981;
            --green: #22c55e;
            --sky: #0ea5e9;
            --red: #E63329;
            --orange: #F97316;
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

        .nav-links { display: flex; gap: 32px; list-style: none; }

        .nav-links a {
            text-decoration: none;
            color: #64748b;
            font-weight: 600;
            font-size: 0.9rem;
            padding: 6px 0;
            position: relative;
            transition: color 0.3s;
        }

        .nav-links a:hover { color: #1e293b; }
        .nav-links a.active { color: var(--teal); }
        .nav-links a.active::after {
            content: '';
            position: absolute;
            bottom: -2px; left: 0; right: 0;
            height: 2px;
            background: var(--teal);
            border-radius: 2px;
        }

        .profile-wrapper { position: relative; }
        .profile-btn {
            background: none; border: none; cursor: pointer;
            padding: 8px; border-radius: 50%;
            transition: background 0.2s;
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
        }
        .dropdown-item:hover { background: #f8fafc; }

        .artikel-card {
            display: flex;
            align-items: center;
            gap: 16px;
            background: white;
            border-radius: 16px;
            padding: 16px;
            box-shadow: 0 2px 12px rgba(0,0,0,0.06);
            transition: transform 0.25s, box-shadow 0.25s;
        }
        .artikel-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 24px rgba(0,0,0,0.10);
        }

        /* ===== HERO ===== */
        .hero {
            background: white;
            padding: 64px 24px 90px;
            position: relative;
            overflow: hidden;
        }

        .hero-blob {
            position: absolute;
            border-radius: 50%;
            filter: blur(70px);
            pointer-events: none;
            animation: blobFloat 7s ease-in-out infinite;
        }

        .hb1 {
            width: 450px; height: 450px;
            background: radial-gradient(circle, rgba(20,184,166,0.12), transparent);
            top: -100px; right: -100px;
        }
        .hb2 {
            width: 320px; height: 320px;
            background: radial-gradient(circle, rgba(6,182,212,0.1), transparent);
            bottom: -80px; left: -60px;
            animation-delay: 3s;
        }
        .hb3 {
            width: 220px; height: 220px;
            background: radial-gradient(circle, rgba(16,185,129,0.08), transparent);
            top: 40%; left: 35%;
            animation-delay: 1.5s;
        }

        @keyframes blobFloat {
            0%, 100% { transform: scale(1) translate(0,0); }
            33% { transform: scale(1.1) translate(20px,-15px); }
            66% { transform: scale(0.93) translate(-15px,12px); }
        }

        .hero-inner {
            max-width: 1200px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 60px;
            align-items: center;
            position: relative;
            z-index: 2;
        }

        .hero-text { animation: fadeInLeft 0.8s ease 0.2s both; }

        @keyframes fadeInLeft {
            from { opacity: 0; transform: translateX(-40px); }
            to { opacity: 1; transform: translateX(0); }
        }

        .hero-badge {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: linear-gradient(135deg, #f0fdfa, #ccfbf1);
            border: 1px solid #99f6e4;
            border-radius: 100px;
            padding: 6px 16px;
            font-size: 0.8rem;
            font-weight: 600;
            color: var(--teal);
            margin-bottom: 20px;
        }

        .hero-badge .dot {
            width: 8px; height: 8px;
            background: var(--teal);
            border-radius: 50%;
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0%, 100% { opacity: 1; transform: scale(1); }
            50% { opacity: 0.4; transform: scale(0.7); }
        }

        .hero h1 {
            font-family: 'Nunito', sans-serif;
            font-size: 2.8rem;
            font-weight: 900;
            line-height: 1.2;
            color: #1e293b;
            margin-bottom: 16px;
        }

        .hero h1 .highlight {
            background: linear-gradient(135deg, var(--red), var(--orange));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .hero p {
            color: #64748b;
            font-size: 1rem;
            line-height: 1.7;
            margin-bottom: 32px;
        }

        .hero-btns { display: flex; gap: 14px; align-items: center; flex-wrap: wrap; }

        .hero-cta {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            background: linear-gradient(135deg, var(--teal), var(--cyan));
            color: white;
            padding: 14px 32px;
            border-radius: 100px;
            font-weight: 700;
            font-size: 0.95rem;
            text-decoration: none;
            box-shadow: 0 8px 25px rgba(20,184,166,0.35);
            transition: transform 0.2s, box-shadow 0.2s;
        }

        .hero-cta:hover {
            transform: translateY(-2px);
            box-shadow: 0 12px 35px rgba(20,184,166,0.5);
        }

        .hero-cta svg { transition: transform 0.2s; }
        .hero-cta:hover svg { transform: translateX(4px); }

        .hero-cta-secondary {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            color: var(--teal);
            font-weight: 700;
            font-size: 0.9rem;
            text-decoration: none;
            padding: 14px 0;
            transition: gap 0.2s;
        }
        .hero-cta-secondary:hover { gap: 12px; }

        /* ===== BRAIN MASCOT ===== */
        .hero-image {
            display: flex;
            justify-content: center;
            animation: fadeInRight 0.8s ease 0.4s both;
            position: relative;
        }

        @keyframes fadeInRight {
            from { opacity: 0; transform: translateX(40px); }
            to { opacity: 1; transform: translateX(0); }
        }

        .brain-scene {
            position: relative;
            width: 320px;
            height: 320px;
        }

        .brain-aura {
            position: absolute;
            inset: -25px;
            background: radial-gradient(circle, rgba(20,184,166,0.1) 0%, rgba(6,182,212,0.06) 50%, transparent 70%);
            border-radius: 50%;
            animation: aura 5s ease-in-out infinite;
        }

        @keyframes aura {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.12); }
        }

        .orbit {
            position: absolute;
            inset: 0;
            animation: orbit 12s linear infinite;
        }

        .orbit-dot {
            position: absolute;
            top: 10px;
            left: 50%;
            transform: translateX(-50%);
            width: 10px; height: 10px;
            background: var(--teal);
            border-radius: 50%;
            box-shadow: 0 0 12px var(--teal);
        }

        .orbit2 { animation-duration: 8s; animation-direction: reverse; }
        .orbit2 .orbit-dot { top: auto; bottom: 20px; background: var(--cyan); box-shadow: 0 0 12px var(--cyan); width: 7px; height: 7px; }

        .orbit3 { animation-duration: 15s; }
        .orbit3 .orbit-dot { top: 50%; background: var(--emerald); box-shadow: 0 0 12px var(--emerald); width: 6px; height: 6px; }

        @keyframes orbit {
            from { transform: rotate(0deg); }
            to { transform: rotate(360deg); }
        }

        .brain-emoji {
            position: relative;
            z-index: 2;
            font-size: 180px;
            line-height: 320px;
            text-align: center;
            display: block;
            animation: brainLook 4s ease-in-out infinite;
            filter: drop-shadow(0 20px 40px rgba(20,184,166,0.2));
        }

        @keyframes brainLook {
            0%, 100% { transform: translateY(0) rotate(-2deg); }
            30% { transform: translateY(-10px) rotate(3deg); }
            60% { transform: translateY(-6px) rotate(-1deg); }
        }

        .skill-badge {
            position: absolute;
            background: white;
            border-radius: 14px;
            padding: 8px 14px;
            font-size: 0.75rem;
            font-weight: 700;
            box-shadow: 0 6px 24px rgba(0,0,0,0.1);
            z-index: 4;
            animation: floatBadge 3.5s ease-in-out infinite;
            white-space: nowrap;
        }

        @keyframes floatBadge {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-10px); }
        }

        .sb1 { top: 20px; left: -10px; color: var(--teal); animation-delay: 0s; }
        .sb2 { top: 70px; right: -20px; color: var(--cyan); animation-delay: 0.8s; }
        .sb3 { bottom: 70px; left: -20px; color: var(--emerald); animation-delay: 1.6s; }
        .sb4 { bottom: 30px; right: -5px; color: var(--sky); animation-delay: 0.4s; }

        /* ===== STATS BAR ===== */
        .stats-bar {
            background: linear-gradient(135deg, #0f766e 0%, #0e7490 50%, #1d4ed8 100%);
            padding: 40px 24px;
            position: relative;
            overflow: hidden;
        }

        .stats-bar::before {
            content: '';
            position: absolute;
            inset: 0;
            background: url("data:image/svg+xml,%3Csvg width='40' height='40' viewBox='0 0 40 40' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='%23ffffff' fill-opacity='0.04'%3E%3Ccircle cx='20' cy='20' r='3'/%3E%3C/g%3E%3C/svg%3E");
        }

        .stats-inner {
            max-width: 1200px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 24px;
            position: relative;
            z-index: 2;
        }

        .stat-card {
            text-align: center;
            padding: 24px 16px;
            border-radius: 16px;
            background: rgba(255,255,255,0.08);
            border: 1px solid rgba(255,255,255,0.12);
            transition: background 0.3s, transform 0.3s;
        }

        .stat-card:hover {
            background: rgba(255,255,255,0.15);
            transform: translateY(-4px);
        }

        .stat-icon { font-size: 1.8rem; margin-bottom: 10px; display: block; }

        .stat-number {
            font-family: 'Nunito', sans-serif;
            font-size: 2rem;
            font-weight: 900;
            background: linear-gradient(135deg, #5eead4, #67e8f9);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .stat-label {
            color: rgba(255,255,255,0.6);
            font-size: 0.8rem;
            margin-top: 4px;
            font-weight: 500;
        }

        /* ===== SECTION COMMON ===== */
        .section-header {
            text-align: center;
            margin-bottom: 48px;
        }

        .section-tag {
            display: inline-block;
            background: linear-gradient(135deg, #f0fdfa, #ccfbf1);
            color: var(--teal);
            font-size: 0.78rem;
            font-weight: 700;
            padding: 6px 16px;
            border-radius: 100px;
            margin-bottom: 12px;
            border: 1px solid #99f6e4;
            letter-spacing: 0.05em;
            text-transform: uppercase;
        }

        .section-title {
            font-family: 'Nunito', sans-serif;
            font-size: 2.2rem;
            font-weight: 900;
            color: #1e293b;
            margin-bottom: 12px;
        }

        .section-sub {
            color: #64748b;
            font-size: 0.95rem;
            max-width: 520px;
            margin: 0 auto;
            line-height: 1.7;
        }

        /* ===== LAYANAN SECTION ===== */
        .layanan-section {
            padding: 80px 24px;
            max-width: 1200px;
            margin: 0 auto;
        }

        .layanan-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 24px;
        }

        .layanan-card {
            background: white;
            border-radius: 24px;
            padding: 32px 28px;
            box-shadow: 0 4px 24px rgba(0,0,0,0.06);
            border: 1px solid #f0fdfa;
            transition: transform 0.3s, box-shadow 0.3s;
            cursor: pointer;
            position: relative;
            overflow: hidden;
        }

        .layanan-card::before {
            content: '';
            position: absolute;
            top: 0; left: 0; right: 0;
            height: 4px;
        }

        .layanan-card.teal::before { background: linear-gradient(90deg, var(--teal), var(--cyan)); }
        .layanan-card.emerald::before { background: linear-gradient(90deg, var(--emerald), var(--green)); }
        .layanan-card.sky::before { background: linear-gradient(90deg, var(--sky), #6366f1); }

        .layanan-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 24px 60px rgba(20,184,166,0.12);
        }

        .layanan-card::after {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(135deg, transparent 30%, rgba(255,255,255,0.6) 50%, transparent 70%);
            transform: translateX(-100%);
            transition: transform 0.6s;
        }

        .layanan-card:hover::after { transform: translateX(100%); }

        .lcard-icon {
            width: 60px; height: 60px;
            border-radius: 18px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.6rem;
            margin-bottom: 20px;
            position: relative;
            z-index: 2;
        }

        .layanan-card.teal .lcard-icon { background: linear-gradient(135deg, #f0fdfa, #ccfbf1); }
        .layanan-card.emerald .lcard-icon { background: linear-gradient(135deg, #f0fdf4, #dcfce7); }
        .layanan-card.sky .lcard-icon { background: linear-gradient(135deg, #f0f9ff, #e0f2fe); }

        .lcard-title {
            font-family: 'Nunito', sans-serif;
            font-size: 1.15rem;
            font-weight: 800;
            color: #1e293b;
            margin-bottom: 10px;
            position: relative;
            z-index: 2;
        }

        .lcard-desc {
            color: #64748b;
            font-size: 0.88rem;
            line-height: 1.65;
            margin-bottom: 24px;
            position: relative;
            z-index: 2;
        }

        .lcard-link {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            font-size: 0.85rem;
            font-weight: 700;
            text-decoration: none;
            transition: gap 0.2s;
            position: relative;
            z-index: 2;
        }

        .layanan-card.teal .lcard-link { color: var(--teal); }
        .layanan-card.emerald .lcard-link { color: var(--emerald); }
        .layanan-card.sky .lcard-link { color: var(--sky); }
        .lcard-link:hover { gap: 10px; }

        /* ===== TIPS SOSIAL ===== */
        .tips-section {
            padding: 0 24px 80px;
            max-width: 1200px;
            margin: 0 auto;
        }

        .tips-header { margin-bottom: 32px; }

        .tips-title {
            font-family: 'Nunito', sans-serif;
            font-size: 1.6rem;
            font-weight: 900;
            color: #1e293b;
        }

        .tips-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 20px;
        }

        .tip-card {
            background: white;
            border-radius: 20px;
            padding: 24px 26px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.05);
            border: 1px solid #f0fdfa;
            display: flex;
            gap: 18px;
            align-items: flex-start;
            transition: transform 0.3s, box-shadow 0.3s;
        }

        .tip-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 16px 40px rgba(20,184,166,0.1);
        }

        .tip-number {
            min-width: 40px; height: 40px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.2rem;
            font-weight: 900;
            font-family: 'Nunito', sans-serif;
            flex-shrink: 0;
        }

        .tip-card:nth-child(1) .tip-number { background: linear-gradient(135deg, #f0fdfa, #ccfbf1); color: var(--teal); }
        .tip-card:nth-child(2) .tip-number { background: linear-gradient(135deg, #f0f9ff, #e0f2fe); color: var(--sky); }
        .tip-card:nth-child(3) .tip-number { background: linear-gradient(135deg, #f0fdf4, #dcfce7); color: var(--emerald); }
        .tip-card:nth-child(4) .tip-number { background: linear-gradient(135deg, #fdf4ff, #fae8ff); color: #a855f7; }
        .tip-card:nth-child(5) .tip-number { background: linear-gradient(135deg, #fff7ed, #ffedd5); color: var(--orange); }
        .tip-card:nth-child(6) .tip-number { background: linear-gradient(135deg, #fef2f2, #fee2e2); color: var(--red); }

        .tip-content { flex: 1; }

        .tip-title {
            font-family: 'Nunito', sans-serif;
            font-size: 0.98rem;
            font-weight: 800;
            color: #1e293b;
            margin-bottom: 6px;
        }

        .tip-desc {
            color: #64748b;
            font-size: 0.83rem;
            line-height: 1.6;
        }

        /* ===== FOOTER ===== */
        footer {
            background: #1e293b;
            padding: 60px 24px 32px;
        }

        .footer-inner { max-width: 1200px; margin: 0 auto; }

        .footer-top {
            display: grid;
            grid-template-columns: 2fr 1fr 1fr 1fr;
            gap: 48px;
            margin-bottom: 48px;
        }

        .footer-brand .logo { color: white; margin-bottom: 16px; }
        .footer-brand p { font-size: 0.85rem; line-height: 1.7; color: rgba(255,255,255,0.5); }

        .footer-col h4 { color: white; font-weight: 700; font-size: 0.9rem; margin-bottom: 16px; }
        .footer-col ul { list-style: none; }
        .footer-col ul li { margin-bottom: 10px; }
        .footer-col ul li a { color: rgba(255,255,255,0.5); text-decoration: none; font-size: 0.85rem; transition: color 0.2s; }
        .footer-col ul li a:hover { color: white; }

        .footer-bottom {
            border-top: 1px solid rgba(255,255,255,0.1);
            padding-top: 24px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 0.8rem;
            color: rgba(255,255,255,0.4);
        }

        .footer-school { color: var(--teal); font-weight: 700; }

        /* ===== SCROLL REVEAL ===== */
        .scroll-reveal {
            opacity: 0;
            transform: translateY(30px);
            transition: opacity 0.7s ease, transform 0.7s ease;
        }
        .scroll-reveal.visible { opacity: 1; transform: translateY(0); }

        /* Responsive */
        @media (max-width: 768px) {
            .hero-inner { grid-template-columns: 1fr; text-align: center; }
            .hero h1 { font-size: 2rem; }
            .hero-image { order: -1; }
            .brain-scene { width: 240px; height: 240px; }
            .brain-emoji { font-size: 130px; line-height: 240px; }
            .hero-btns { justify-content: center; }
            .stats-inner { grid-template-columns: repeat(2, 1fr); }
            .layanan-grid { grid-template-columns: 1fr; }
            .tips-grid { grid-template-columns: 1fr; }
            .footer-top { grid-template-columns: 1fr 1fr; }
        }
    </style>
</head>
<body>

    <!-- Navigation -->
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
                <li><a href="{{ route('siswa.sosial') }}" class="active">Sosial</a></li>
                <li><a href="{{ route('siswa.konseling') }}">Konseling</a></li>
                @guest
                    <li><a href="{{ route('login') }}">Login</a></li>
                @endguest
            </ul>

            @auth
            <div class="profile-wrapper">
                <button class="profile-btn">
                    <svg width="22" height="22" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                    </svg>
                </button>
                <div class="profile-dropdown">
                    <div class="dropdown-header">
                        <div class="name">{{ auth()->user()->name ?? 'Nama Siswa' }}</div>
                        <div class="email">{{ auth()->user()->email ?? 'siswa@email.com' }}</div>
                    </div>
                    <a href="{{ route('siswa.profile.edit') }}" class="dropdown-item">Edit Profile</a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="dropdown-item" style="width:100%;text-align:left;background:none;border:none;cursor:pointer;">Logout</button>
                    </form>
                </div>
            </div>
            @endauth
        </div>
    </nav>

    <!-- Hero -->
    <section class="hero">
        <div class="hero-blob hb1"></div>
        <div class="hero-blob hb2"></div>
        <div class="hero-blob hb3"></div>

        <div class="hero-inner">
            <div class="hero-text">
                <div class="hero-badge">
                    <span class="dot"></span>
                    Komunitas & Sosial
                </div>
                <h1>Masih bingung mengembangkan <span class="highlight">soft skill dan hard skill?</span></h1>
                <p>Guru BK siap membantu kamu mengenali dan mengembangkan kemampuan diri. Bergabunglah dengan komunitas dan tingkatkan skill sosialmu!</p>
                <div class="hero-btns">
                    <a href="{{ route('siswa.konseling') }}" class="hero-cta">
                        Mulai Bimbingan
                        <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                        </svg>
                    </a>
                    <a href="#layanan-sosial" class="hero-cta-secondary">
                        Lihat Layanan
                        <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                        </svg>
                    </a>
                </div>
            </div>

            <div class="hero-image">
                <div class="brain-scene">
                    <div class="brain-aura"></div>
                    <div class="orbit"><div class="orbit-dot"></div></div>
                    <div class="orbit orbit2"><div class="orbit-dot"></div></div>
                    <div class="orbit orbit3"><div class="orbit-dot"></div></div>
                    <span class="brain-emoji">🔍</span>
                    <div class="skill-badge sb1">🤝 Kolaborasi</div>
                    <div class="skill-badge sb2">💬 Komunikasi</div>
                    <div class="skill-badge sb3">🌐 Jaringan</div>
                    <div class="skill-badge sb4">👑 Leadership</div>
                </div>
            </div>
        </div>
    </section>

    <!-- Stats Bar -->
    <section class="stats-bar">
        <div class="stats-inner">
            <div class="stat-card">
                <span class="stat-icon">👥</span>
                <div class="stat-number">2.4K+</div>
                <div class="stat-label">Siswa Aktif</div>
            </div>
            <div class="stat-card">
                <span class="stat-icon">🎯</span>
                <div class="stat-number">85+</div>
                <div class="stat-label">Program Sosial</div>
            </div>
            <div class="stat-card">
                <span class="stat-icon">🏆</span>
                <div class="stat-number">320+</div>
                <div class="stat-label">Kegiatan Selesai</div>
            </div>
            <div class="stat-card">
                <span class="stat-icon">⭐</span>
                <div class="stat-number">97%</div>
                <div class="stat-label">Kepuasan Siswa</div>
            </div>
        </div>
    </section>

    <!-- Layanan Sosial -->
    <section id="layanan-sosial">
        <div class="layanan-section">
            <div class="section-header scroll-reveal">
                <div class="section-tag">🌐 Layanan Sosial</div>
                <h2 class="section-title">Berkembang Bersama Komunitas</h2>
                <p class="section-sub">Ikuti berbagai kegiatan sosial dan program kepedulian untuk mengembangkan tanggung jawab sosial dan skill kamu.</p>
            </div>

            <div class="layanan-grid">
                <div class="layanan-card teal scroll-reveal">
                    <div class="lcard-icon">🤝</div>
                    <div class="lcard-title">Kegiatan Sosial</div>
                    <p class="lcard-desc">Bergabunglah dengan kegiatan sosial kami. Bantu masyarakat, bangun empati, dan jadilah agen perubahan positif.</p>
                    <a href="#tips-sosial" class="lcard-link">
                        Lihat Kegiatan
                        <svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                        </svg>
                    </a>
                </div>

                <div class="layanan-card emerald scroll-reveal" style="transition-delay:0.1s">
                    <div class="lcard-icon">⚡</div>
                    <div class="lcard-title">Kerja Sama Tim</div>
                    <p class="lcard-desc">Kembangkan keterampilan kerja sama, kepemimpinan, dan komunikasi bersama tim yang solid dan suportif.</p>
                    <a href="#tips-sosial" class="lcard-link">
                        Lihat Tips
                        <svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                        </svg>
                    </a>
                </div>

                <div class="layanan-card sky scroll-reveal" style="transition-delay:0.2s">
                    <div class="lcard-icon">💡</div>
                    <div class="lcard-title">Program Kepedulian</div>
                    <p class="lcard-desc">Ikuti program kepedulian sosial untuk memberdayakan masyarakat sekitar dan membangun dampak nyata.</p>
                    <a href="#tips-sosial" class="lcard-link">
                        Ikut Program
                        <svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Tips Sosial -->
    <section id="tips-sosial">
        <div class="tips-section">
            <div class="tips-header scroll-reveal">
                <h2 class="tips-title">💡 Tips Sosial untuk Kamu</h2>
            </div>
            <div class="tips-grid">
                <div class="tip-card scroll-reveal">
                    <div class="tip-number">🗣️</div>
                    <div class="tip-content">
                        <div class="tip-title">Jadilah Pendengar yang Baik</div>
                        <p class="tip-desc">Dengarkan orang lain dengan penuh perhatian tanpa memotong pembicaraan. Mendengar aktif membangun kepercayaan dan hubungan yang lebih kuat.</p>
                    </div>
                </div>
                <div class="tip-card scroll-reveal" style="transition-delay:0.1s">
                    <div class="tip-number">😊</div>
                    <div class="tip-content">
                        <div class="tip-title">Tunjukkan Empati</div>
                        <p class="tip-desc">Cobalah memahami perasaan dan sudut pandang orang lain. Empati adalah kunci untuk membangun koneksi sosial yang bermakna.</p>
                    </div>
                </div>
                <div class="tip-card scroll-reveal" style="transition-delay:0.1s">
                    <div class="tip-number">🤝</div>
                    <div class="tip-content">
                        <div class="tip-title">Bangun Kepercayaan</div>
                        <p class="tip-desc">Tepati janji dan konsisten dalam tindakanmu. Kepercayaan dibangun dari hal-hal kecil yang kamu lakukan setiap hari.</p>
                    </div>
                </div>
                <div class="tip-card scroll-reveal" style="transition-delay:0.2s">
                    <div class="tip-number">💬</div>
                    <div class="tip-content">
                        <div class="tip-title">Komunikasi Secara Positif</div>
                        <p class="tip-desc">Pilih kata-kata yang membangun, bukan menjatuhkan. Komunikasi positif menciptakan lingkungan yang nyaman dan aman bagi semua.</p>
                    </div>
                </div>
                <div class="tip-card scroll-reveal" style="transition-delay:0.2s">
                    <div class="tip-number">🌱</div>
                    <div class="tip-content">
                        <div class="tip-title">Hargai Perbedaan</div>
                        <p class="tip-desc">Setiap orang memiliki latar belakang dan cara pandang yang berbeda. Menghargai keberagaman memperluas wawasan dan memperkaya hidupmu.</p>
                    </div>
                </div>
                <div class="tip-card scroll-reveal" style="transition-delay:0.3s">
                    <div class="tip-number">🏆</div>
                    <div class="tip-content">
                        <div class="tip-title">Jadilah Proaktif di Komunitas</div>
                        <p class="tip-desc">Jangan tunggu diminta — inisiatiflah untuk berkontribusi. Keterlibatan aktif membuat kamu dikenal dan dihargai dalam lingkungan sosial.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Artikel Sosial Section -->
    <section class="py-16">
        <div class="max-w-6xl mx-auto px-6">
            <h2 class="text-3xl font-extrabold text-gray-900 mb-2 text-center">
                Artikel <span class="text-teal-500">Sosial</span>
            </h2>
            <p class="text-gray-500 text-center mb-10">Baca artikel terbaru tentang keterampilan sosial dan pengembangan komunitas</p>

            @php $materis = $materis ?? collect(); @endphp

            @if($materis->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                @foreach($materis as $materi)
                <div class="artikel-card">
                    <div class="w-28 h-20 rounded-xl overflow-hidden flex-shrink-0 bg-gray-100">
                        @if($materi->thumbnail)
                            <img src="{{ asset('storage/' . $materi->thumbnail) }}" alt="{{ $materi->judul }}" class="w-full h-full object-cover">
                        @else
                            <div class="w-full h-full bg-gradient-to-br from-teal-100 to-teal-200 flex items-center justify-center">
                                <svg class="w-8 h-8 text-teal-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/></svg>
                            </div>
                        @endif
                    </div>
                    <div class="flex-1 min-w-0">
                        <h4 class="font-bold text-gray-900 text-sm mb-1 line-clamp-2">{{ $materi->judul }}</h4>
                        <p class="text-gray-500 text-xs leading-relaxed line-clamp-3 mb-3">{{ Str::limit(strip_tags($materi->konten), 100) }}</p>
                        <div class="text-xs text-gray-400 flex items-center gap-2 mb-2">
                            <span>{{ optional($materi->guru)->nama ?? optional($materi->guru)->name ?? 'Guru BK' }}</span>
                            <span>•</span>
                            <span>{{ optional($materi->created_at)->format('d M Y') }}</span>
                        </div>
                        <a href="{{ route('materi.show', $materi->slug) }}" class="text-xs font-bold text-teal-600 hover:text-teal-800 uppercase tracking-wide transition">Read More →</a>
                    </div>
                </div>
                @endforeach
            </div>
            @else
            <div class="text-center py-16 text-gray-400">
                <svg class="w-16 h-16 mx-auto mb-4 opacity-30" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/></svg>
                <p class="text-lg font-medium">Belum ada artikel sosial</p>
                <p class="text-sm mt-1">Artikel akan muncul di sini setelah ditambahkan oleh guru.</p>
            </div>
            @endif
        </div>
    </section>

    <!-- Footer -->
    <footer>
        <div class="footer-inner">
            <div class="footer-top">
                <div class="footer-brand">
                    <a href="{{ route('siswa.dashboard') }}" class="logo" style="color:white; margin-bottom:16px; display:flex;">
                        <div class="logo-icon" style="margin-right:10px;">TS</div>
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
        // Scroll reveal
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) entry.target.classList.add('visible');
            });
        }, { threshold: 0.1, rootMargin: '0px 0px -40px 0px' });

        document.querySelectorAll('.scroll-reveal').forEach(el => observer.observe(el));

        // Counter animation
        const counters = document.querySelectorAll('.stat-number');
        const counterObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const el = entry.target;
                    const text = el.textContent;
                    const num = parseFloat(text.replace(/[^0-9.]/g, ''));
                    const suffix = text.replace(/[0-9.]/g, '');
                    let start = 0;
                    const step = num / (1500 / 16);
                    const timer = setInterval(() => {
                        start += step;
                        if (start >= num) {
                            el.textContent = text;
                            clearInterval(timer);
                        } else {
                            el.textContent = (start % 1 === 0 ? Math.floor(start) : start.toFixed(1)) + suffix;
                        }
                    }, 16);
                    counterObserver.unobserve(el);
                }
            });
        }, { threshold: 0.5 });

        counters.forEach(c => counterObserver.observe(c));
    </script>

</body>
</html>