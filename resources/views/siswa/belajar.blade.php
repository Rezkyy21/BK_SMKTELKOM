@extends('layouts.siswa')

@section('title', 'Belajar - SMK Telkom')

@section('styles')
<style>
    :root {
        --red: #E63329;
        --orange: #F97316;
        --yellow: #FBBF24;
        --green: #22C55E;
        --cyan: #06B6D4;
        --blue: #3B82F6;
        --purple: #8B5CF6;
        --pink: #EC4899;
    }

    * { margin: 0; padding: 0; box-sizing: border-box; }
     * { font-family: 'Plus Jakarta Sans', sans-serif; }

    body {
        font-family: 'Plus Jakarta Sans', sans-serif;
        background: #f8f9ff;
        overflow-x: hidden;
    }

    /* ===== NAV ===== */
    nav {
        background: white;
        box-shadow: 0 2px 20px rgba(0,0,0,0.08);
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
            font-family: 'Roboto', sans-serif;
            font-weight: 900;
            font-size: 1.2rem;
            color: #1e293b;
        }

        .logo-icon {
            width: 40px;
            height: 40px;
            background: #e53e3e;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 0.9rem;
            font-weight: 700;
        }

        .logo-text {
            display: flex;
            flex-direction: column;
            line-height: 1;
        }
        .logo-text .school-name {
            font-size: 1rem;
            font-weight: 700;
        }
        .logo-text .school-location {
            font-size: 0.75rem;
            color: #64748b;
        }

        .nav-links {
            display: flex;
            gap: 32px;
            list-style: none;
        }

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

        .nav-links a.active {
            color: var(--red);
        }

        .nav-links a.active::after {
            content: '';
            position: absolute;
            bottom: -2px;
            left: 0; right: 0;
            height: 2px;
            background: var(--red);
            border-radius: 2px;
        }

        .profile-btn {
            background: none;
            border: none;
            cursor: pointer;
            padding: 8px;
            border-radius: 50%;
            transition: background 0.2s;
        }
        .profile-btn:hover { background: #f1f5f9; }

        /* ===== HERO ===== */
            .hero {
                background: white;
                padding: 30px 24px 80px; /* tadi 100px */
                position: relative;
                overflow: hidden;
                min-height: 100vh;
                display: flex;
                align-items: center;
            }

        .hero::before {
            content: '';
            position: absolute;
            top: -100px; right: -100px;
            width: 400px; height: 500px;
            background: radial-gradient(circle, rgba(230,51,41,0.08) 0%, transparent 70%);
            pointer-events: none;
        }

        .hero::after {
            content: '';
            position: absolute;
            bottom: -80px; left: -80px;
            width: 350px; height: 350px;
            background: radial-gradient(circle, rgba(249,115,22,0.06) 0%, transparent 70%);
            pointer-events: none;
        }

        .hero-inner {
            max-width: 1200px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 60px;
            align-items: center;
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
            background: #fff5f5;
            border: 1px solid #fecaca;
            border-radius: 100px;
            padding: 6px 16px;
            font-size: 0.8rem;
            font-weight: 600;
            color: var(--red);
            margin-bottom: 20px;
        }

        .hero-badge .dot {
            width: 8px; height: 8px;
            background: var(--red);
            border-radius: 50%;
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0%, 100% { opacity: 1; transform: scale(1); }
            50% { opacity: 0.5; transform: scale(0.8); }
        }

        .hero h1 {
            font-family: 'Roboto', sans-serif;
            font-size: 2.8rem;
            font-weight: 900;
            line-height: 1.2;
            color: #1e293b;
            margin-bottom: 16px;
        }

        .hero h1 span {
            color: var(--red);
            position: relative;
        }

        .hero h1 span::after {
            content: '';
            position: absolute;
            bottom: 2px; left: 0; right: 0;
            height: 4px;
            background: linear-gradient(90deg, var(--red), var(--orange));
            border-radius: 2px;
            opacity: 0.3;
        }

        .hero p {
            color: #64748b;
            font-size: 1rem;
            line-height: 1.7;
            margin-bottom: 10px;
        }

        .hero-cta {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            background: linear-gradient(135deg, var(--red), #c0392b);
            color: white;
            padding: 14px 32px;
            border-radius: 100px;
            font-weight: 700;
            font-size: 0.95rem;
            text-decoration: none;
            box-shadow: 0 8px 25px rgba(230,51,41,0.35);
            transition: transform 0.2s, box-shadow 0.2s;
        }

        .hero-cta:hover {
            transform: translateY(-2px);
            box-shadow: 0 12px 35px rgba(230,51,41,0.45);
        }

        .hero-cta svg {
            transition: transform 0.2s;
        }

        .hero-cta:hover svg {
            transform: translateX(4px);
        }

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

        .brain-container {
            position: relative;
            width: 280px;
            height: 280px;
        }

        .brain-bg {
            position: absolute;
            inset: -20px;
            background: radial-gradient(circle, #fff5f5 0%, #fff0eb 50%, transparent 70%);
            border-radius: 50%;
            animation: breathe 4s ease-in-out infinite;
        }

        @keyframes breathe {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.08); }
        }

       .brain-emoji {
            position: relative;
            z-index: 2;
            width: 300px;    
            height: auto;     
            display: block;
            margin: 0 auto;
            animation: brainLook 4s ease-in-out infinite;
            filter: drop-shadow(0 20px 40px rgba(184, 20, 20, 0.2));
        }

        @keyframes float {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-16px); }
        }

        /* Floating badges around brain */
        .float-badge {
            position: absolute;
            background: white;
            border-radius: 12px;
            padding: 8px 14px;
            font-size: 0.75rem;
            font-weight: 700;
            box-shadow: 0 4px 20px rgba(0,0,0,0.12);
            z-index: 3;
            animation: floatBadge 3s ease-in-out infinite;
        }

        @keyframes floatBadge {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-8px); }
        }

        .float-badge.b1 { top: 10px; left: -20px; color: var(--orange); animation-delay: 0.5s; }
        .float-badge.b2 { top: 40px; right: -30px; color: var(--blue); animation-delay: 1s; }
        .float-badge.b3 { bottom: 40px; left: -30px; color: var(--green); animation-delay: 1.5s; }
        .float-badge.b4 { bottom: 20px; right: -20px; color: var(--purple); animation-delay: 0.2s; }

        /* ===== STATS ===== */
        .stats-section {
            background: linear-gradient(135deg, #1e293b 0%, #0f172a 100%);
            padding: 40px 24px;
        }

        .stats-inner {
            max-width: 1200px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 24px;
        }

        .stat-card {
            text-align: center;
            padding: 24px;
            border-radius: 16px;
            background: rgba(255,255,255,0.05);
            border: 1px solid rgba(255,255,255,0.08);
            transition: background 0.3s, transform 0.3s;
            animation: fadeInUp 0.6s ease both;
        }

        .stat-card:hover {
            background: rgba(255,255,255,0.1);
            transform: translateY(-4px);
        }

        .stat-card:nth-child(1) { animation-delay: 0.1s; }
        .stat-card:nth-child(2) { animation-delay: 0.2s; }
        .stat-card:nth-child(3) { animation-delay: 0.3s; }
        .stat-card:nth-child(4) { animation-delay: 0.4s; }

        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .stat-number {
            font-family: 'Nunito', sans-serif;
            font-size: 2.2rem;
            font-weight: 900;
            background: linear-gradient(135deg, var(--orange), var(--yellow));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .stat-label {
            color: rgba(255,255,255,0.6);
            font-size: 0.8rem;
            margin-top: 4px;
            font-weight: 500;
        }

        /* ===== CATEGORIES ===== */
        .categories-section {
            padding: 80px 24px;
            max-width: 1200px;
            margin: 0 auto;
        }

        .section-header {
            text-align: center;
            margin-bottom: 48px;
        }

        .section-tag {
            display: inline-block;
            background: #fff5f5;
            color: var(--red);
            font-size: 0.78rem;
            font-weight: 700;
            padding: 6px 16px;
            border-radius: 100px;
            margin-bottom: 12px;
            border: 1px solid #fecaca;
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
            max-width: 500px;
            margin: 0 auto;
            line-height: 1.7;
        }

        .category-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 24px;
        }

        .category-card {
            background: white;
            border-radius: 20px;
            padding: 32px 28px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.06);
            border: 1px solid #f1f5f9;
            transition: transform 0.3s, box-shadow 0.3s;
            cursor: pointer;
            position: relative;
            overflow: hidden;
            animation: fadeInUp 0.6s ease both;
        }

        .category-card:nth-child(1) { animation-delay: 0.1s; }
        .category-card:nth-child(2) { animation-delay: 0.2s; }
        .category-card:nth-child(3) { animation-delay: 0.3s; }

        .category-card::before {
            content: '';
            position: absolute;
            top: 0; left: 0; right: 0;
            height: 4px;
        }

        .category-card.orange::before { background: linear-gradient(90deg, var(--orange), var(--yellow)); }
        .category-card.cyan::before { background: linear-gradient(90deg, var(--cyan), var(--blue)); }
        .category-card.lime::before { background: linear-gradient(90deg, #84cc16, var(--green)); }

        .category-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 50px rgba(0,0,0,0.12);
        }

        .cat-icon {
            width: 56px; height: 56px;
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            margin-bottom: 20px;
        }

        .category-card.orange .cat-icon { background: #fff7ed; }
        .category-card.cyan .cat-icon { background: #ecfeff; }
        .category-card.lime .cat-icon { background: #f7fee7; }

        .cat-title {
            font-family: 'Nunito', sans-serif;
            font-size: 1.15rem;
            font-weight: 800;
            color: #1e293b;
            margin-bottom: 10px;
        }

        .cat-desc {
            color: #64748b;
            font-size: 0.88rem;
            line-height: 1.65;
            margin-bottom: 24px;
        }

        .cat-link {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            font-size: 0.85rem;
            font-weight: 700;
            text-decoration: none;
            transition: gap 0.2s;
        }

        .category-card.orange .cat-link { color: var(--orange); }
        .category-card.cyan .cat-link { color: var(--cyan); }
        .category-card.lime .cat-link { color: #65a30d; }

        .cat-link:hover { gap: 10px; }

        /* ===== MATERI CARDS ===== */
        .materi-section {
            padding: 0 24px 80px;
            max-width: 1200px;
            margin: 0 auto;
        }

        .materi-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 32px;
        }

        .materi-title {
            font-family: 'Nunito', sans-serif;
            font-size: 1.6rem;
            font-weight: 900;
            color: #1e293b;
        }

        .view-all {
            color: var(--red);
            font-weight: 700;
            font-size: 0.88rem;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 4px;
            transition: gap 0.2s;
        }
        .view-all:hover { gap: 8px; }

        .materi-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 24px;
        }

        .materi-card {
            background: white;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 4px 20px rgba(0,0,0,0.06);
            border: 1px solid #f1f5f9;
            transition: transform 0.3s, box-shadow 0.3s;
            animation: fadeInUp 0.6s ease both;
        }

        .materi-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 16px 40px rgba(0,0,0,0.12);
        }

        .materi-thumb {
            height: 160px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 3rem;
            position: relative;
            overflow: hidden;
        }

        .materi-thumb::after {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(to bottom, transparent 50%, rgba(0,0,0,0.1));
        }

        .materi-card:nth-child(1) .materi-thumb { background: linear-gradient(135deg, #ffecd2, #fcb69f); }
        .materi-card:nth-child(2) .materi-thumb { background: linear-gradient(135deg, #a1c4fd, #c2e9fb); }
        .materi-card:nth-child(3) .materi-thumb { background: linear-gradient(135deg, #d4fc79, #96e6a1); }

        .materi-body { padding: 20px; }

        .materi-kategori {
            font-size: 0.72rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.08em;
            margin-bottom: 8px;
        }

        .materi-card:nth-child(1) .materi-kategori { color: var(--orange); }
        .materi-card:nth-child(2) .materi-kategori { color: var(--blue); }
        .materi-card:nth-child(3) .materi-kategori { color: var(--green); }

        .materi-name {
            font-family: 'Nunito', sans-serif;
            font-size: 1rem;
            font-weight: 800;
            color: #1e293b;
            margin-bottom: 8px;
            line-height: 1.4;
        }

        .materi-meta {
            color: #94a3b8;
            font-size: 0.8rem;
            margin-bottom: 16px;
        }

        .materi-btn {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 8px 18px;
            border-radius: 100px;
            font-size: 0.8rem;
            font-weight: 700;
            text-decoration: none;
            transition: transform 0.2s, box-shadow 0.2s;
            border: none;
            cursor: pointer;
        }

        .materi-card:nth-child(1) .materi-btn { background: #fff7ed; color: var(--orange); }
        .materi-card:nth-child(2) .materi-btn { background: #eff6ff; color: var(--blue); }
        .materi-card:nth-child(3) .materi-btn { background: #f0fdf4; color: var(--green); }

        .materi-btn:hover { transform: translateX(2px); }

        /* ===== EMPTY STATE ===== */
        .empty-state {
            text-align: center;
            padding: 60px 24px;
            color: #94a3b8;
        }

        .empty-state .empty-icon { font-size: 4rem; margin-bottom: 16px; }
        .empty-state p { font-size: 0.95rem; }

        /* ===== BIMBINGAN BANNER ===== */
        .bimbingan-banner {
            margin: 0 24px 80px;
            max-width: 1152px;
            margin-left: auto;
            margin-right: auto;
            margin-bottom: 80px;
            background: linear-gradient(135deg, #1e293b 0%, #0f172a 100%);
            border-radius: 28px;
            padding: 48px 60px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 40px;
            position: relative;
            overflow: hidden;
        }

        .bimbingan-banner::before {
            content: '';
            position: absolute;
            top: -60px; right: -60px;
            width: 300px; height: 300px;
            background: radial-gradient(circle, rgba(230,51,41,0.2) 0%, transparent 70%);
        }

        .bimbingan-banner::after {
            content: '';
            position: absolute;
            bottom: -60px; left: 200px;
            width: 250px; height: 250px;
            background: radial-gradient(circle, rgba(249,115,22,0.15) 0%, transparent 70%);
        }

        .banner-text { position: relative; z-index: 2; }

        .banner-text h2 {
            font-family: 'Nunito', sans-serif;
            font-size: 1.8rem;
            font-weight: 900;
            color: white;
            margin-bottom: 12px;
        }

        .banner-text h2 span { color: var(--orange); }

        .banner-text p {
            color: rgba(255,255,255,0.65);
            font-size: 0.92rem;
            line-height: 1.7;
            max-width: 400px;
        }

        .banner-btn {
            position: relative;
            z-index: 2;
            flex-shrink: 0;
            background: linear-gradient(135deg, var(--red), #c0392b);
            color: white;
            padding: 14px 36px;
            border-radius: 100px;
            font-weight: 700;
            font-size: 0.95rem;
            text-decoration: none;
            box-shadow: 0 8px 25px rgba(230,51,41,0.4);
            transition: transform 0.2s, box-shadow 0.2s;
            white-space: nowrap;
        }

        .banner-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 12px 35px rgba(230,51,41,0.55);
        }

        /* ===== FOOTER ===== */
        footer {
            background: #1e293b;
            padding: 60px 24px 32px;
            color: rgba(255,255,255,0.7);
        }

        .footer-inner {
            max-width: 1200px;
            margin: 0 auto;
        }

        .footer-top {
            display: grid;
            grid-template-columns: 2fr 1fr 1fr 1fr;
            gap: 48px;
            margin-bottom: 48px;
        }

        .footer-brand .logo { color: white; margin-bottom: 16px; display: flex; }
        .footer-brand p { font-size: 0.85rem; line-height: 1.7; color: rgba(255,255,255,0.55); }

        .footer-col h4 {
            color: white;
            font-weight: 700;
            font-size: 0.9rem;
            margin-bottom: 16px;
        }

        .footer-col ul { list-style: none; }

        .footer-col ul li {
            margin-bottom: 10px;
        }

        .footer-col ul li a {
            color: rgba(255,255,255,0.55);
            text-decoration: none;
            font-size: 0.85rem;
            transition: color 0.2s;
        }

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

        .footer-school {
            color: var(--orange);
            font-weight: 700;
        }

        /* Scroll animation */
        .scroll-reveal {
            opacity: 0;
            transform: translateY(30px);
            transition: opacity 0.7s ease, transform 0.7s ease;
        }

        .scroll-reveal.visible {
            opacity: 1;
            transform: translateY(0);
        }
.menu-btn{
    display:none;
    font-size:26px;
    background:none;
    border:none;
    cursor:pointer;
}
        /* Responsive */
        @media (max-width: 768px) {
            .hero-inner { grid-template-columns: 1fr; text-align: center; }
            .hero h1 { font-size: 2rem; }
            .hero-image { order: -1; }
            .brain-container { width: 200px; height: 200px; }
            .brain-emoji {   width: 320px;  height: auto;     }
            .stats-inner { grid-template-columns: repeat(2, 1fr); }
            .category-grid, .materi-grid { grid-template-columns: 1fr; }
            .bimbingan-banner { flex-direction: column; padding: 40px; text-align: center; }
            .footer-top { grid-template-columns: 1fr 1fr; }
           

    .menu-btn{
        display:block;
    }
   

.nav-links a.active::after{
    display:none;
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
        .logo-img{
                width:40px;
                height:60px;
                object-fit:contain;
            }
           
    </style>
@endsection

@section('content')

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

             <ul class="nav-links" id="navMenu">
            <li><a href="{{ route('siswa.dashboard') }}">Home</a></li>
            <li><a href="{{ route('siswa.karir') }}" >Karir</a></li>
            <li><a href="{{ route('siswa.belajar') }}"class="active">Belajar</a></li>
            <li><a href="{{ route('siswa.pribadi') }}">Pribadi</a></li>
            <li><a href="{{ route('siswa.sosial') }}">Sosial</a></li>
            <li><a href="{{ route('siswa.konseling') }}">Konseling</a></li>
        </ul>
            @guest
                <li><a href="{{ route('login') }}">Login</a></li>
            @endguest
        </ul>

                 @auth
                <!-- Profile -->
                <div class="relative group">
                    <button class="w-9 h-9 rounded-full bg-gray-100 flex items-center justify-center hover:bg-gray-200 transition">
                        <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                        </svg>
                    </button>
                   <div class="absolute right-0 mt-2 w-64 bg-white rounded-xl shadow-lg opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 z-50 border border-gray-100">
                       <div class="px-4 py-3 border-b border-gray-100 ">
                           <p class="text-sm font-semibold text-gray-800 break-words mb-1">{{ auth()->user()->name }}</p>
                            <p class="text-xs text-gray-500 break-words">{{ auth()->user()->email }}</p>
                        </div>
                       @auth
                        @if(auth()->user()->guruBk|| auth()->user()->role === 'admin')
                            <a href="/admin" class="block px-4 py-2 text-gray-700 hover:bg-gray-50 text-sm">
                                Dashboard Admin
                            </a>
                        @endif
                            @if(auth()->user()->siswa)
                                <a href="{{ route('siswa.profile.edit') }}" class="block px-4 py-2 text-gray-700 hover:bg-gray-50 text-sm">
                                    Edit Profile
                                </a>
                            @endif
                        @endauth
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="w-full text-left px-4 py-2 text-gray-700 hover:bg-gray-50 text-sm">Logout</button>
                        </form>
                    </div>
                </div>
                @endauth
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero">
        <div class="hero-inner">
            <div class="hero-text">
                
                <h1>Sulit fokus, atur waktu, atau pahami <span>pelajaran?</span></h1>
                <p>Yuk konsultasi dengan Guru BK untuk solusi belajar yang lebih baik. </p>
                <a href="{{ route('siswa.konseling') ?? '#' }}" class="hero-cta">
                    Mulai Bimbingan
                    <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                    </svg>
                </a>
            </div>

           <div class="hero-image">
    <div class="brain-container">
                <div class="brain-bg"></div>
                  <img src="{{ asset('images/belajar.png') }}" alt="" class="brain-emoji ">
                <div class="float-badge b1">📚 Materi</div>
                <div class="float-badge b2">🎥 Video</div>
                <div class="float-badge b3">✏️ Latihan</div>
                <div class="float-badge b4">🏆 Ujian</div>
            </div>
        </div>
        </div>
    </section>

   
   

   <!-- Categories -->
<section>
    <div class="categories-section">
        <div class="section-header scroll-reveal">
            <div class="section-tag">📚 Dukungan Belajar</div>
            <h2 class="section-title">Panduan Belajar untuk Siswa</h2>
            <p class="section-sub">
                Temukan berbagai panduan yang membantu kamu memahami cara belajar yang lebih efektif,
                mengatur waktu dengan baik, dan menjaga semangat belajar di sekolah.
            </p>
        </div>

        <div class="category-grid">

            <div class="category-card orange scroll-reveal">
                <div class="cat-icon">🧠</div>
                <div class="cat-title">Strategi Belajar</div>
                <p class="cat-desc">
                    Pelajari berbagai strategi belajar yang dapat membantu kamu memahami materi
                    dengan lebih mudah, meningkatkan fokus, serta membuat proses belajar menjadi
                    lebih efektif dan tidak membosankan.
                </p>
            </div>

            <div class="category-card cyan scroll-reveal" style="transition-delay: 0.1s">
                <div class="cat-icon">⏰</div>
                <div class="cat-title">Manajemen Waktu</div>
                <p class="cat-desc">
                    Pelajari cara mengatur waktu antara belajar, kegiatan sekolah, dan waktu
                    istirahat agar kamu tetap produktif tanpa merasa terlalu terbebani oleh
                    tugas atau aktivitas harian.
                </p>
            </div>

            <div class="category-card lime scroll-reveal" style="transition-delay: 0.2s">
                <div class="cat-icon">💡</div>
                <div class="cat-title">Motivasi Belajar</div>
                <p class="cat-desc">
                    Temukan berbagai tips untuk meningkatkan motivasi belajar, membangun
                    kebiasaan positif, serta menjaga semangat agar kamu tetap percaya diri
                    dalam menghadapi tantangan di sekolah.
                </p>
            </div>

        </div>
    </div>
</section>

  <!-- Artikel Belajar Section -->
<section class="py-20 bg-gray-50">
    <div class="max-w-6xl mx-auto px-6">

        <h2 class="text-3xl font-extrabold text-gray-900 text-center mb-2">
            Artikel <span class="text-red-500">Belajar</span>
        </h2>

        <p class="text-gray-500 text-center mb-14">
            Baca artikel terbaru seputar strategi belajar dan pengembangan akademik
        </p>

        @php $materis = $materis ?? collect(); @endphp

        @if($materis->count() > 0)

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">

            @foreach($materis as $materi)

            <div class="bg-white rounded-2xl shadow-sm hover:shadow-xl transition overflow-hidden flex flex-col">

                <!-- Thumbnail -->
                <div class="h-48 w-full bg-gray-100">
                    @if($materi->thumbnail)
                        <img 
                        src="{{ asset('storage/' . $materi->thumbnail) }}"
                        alt="{{ $materi->judul }}"
                        class="w-full h-full object-cover">
                    @else
                        <div class="w-full h-full bg-gradient-to-br from-red-100 to-red-200 flex items-center justify-center">
                            <svg class="w-12 h-12 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/>
                            </svg>
                        </div>
                    @endif
                </div>

                <!-- Content -->
                <div class="p-6 flex flex-col flex-1">

                    <h4 class="font-bold text-gray-900 text-lg mb-2 line-clamp-2">
                        {{ $materi->judul }}
                    </h4>

                    <p class="text-gray-600 text-sm leading-relaxed line-clamp-3 mb-4">
                        {{ Str::limit(strip_tags($materi->konten), 120) }}
                    </p>

                    <div class="text-xs text-gray-400 flex items-center gap-2 mb-5">
                        <span>{{ optional($materi->guru)->nama ?? optional($materi->guru)->name ?? 'Guru BK' }}</span>
                        <span>•</span>
                        <span>{{ optional($materi->created_at)->format('d M Y') }}</span>
                    </div>

                    <a 
                    href="{{ route('materi.show', $materi->slug) }}"
                    class="mt-auto inline-flex items-center justify-center px-4 py-2 text-sm font-semibold text-white bg-red-500 rounded-lg hover:bg-red-600 transition">
                        Baca Artikel
                    </a>

                </div>

            </div>

            @endforeach

        </div>

        @else

        <div class="text-center py-16 text-gray-400">

            <svg class="w-16 h-16 mx-auto mb-4 opacity-30" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/>
            </svg>

            <p class="text-lg font-medium">Belum ada artikel belajar</p>
            <p class="text-sm mt-1">
                Artikel akan muncul di sini setelah ditambahkan oleh guru.
            </p>

        </div>

        @endif

    </div>
</section>
  
   <!-- Footer -->
   <footer class="bg-white border-t border-gray-100 py-12">
        <div class="max-w-6xl mx-auto px-6">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-10">
                <div>
                    <h4 class="font-bold text-red-500 mb-4 text-base">SMK Telkom Purwokerto</h4>
                    <div class="space-y-2 text-sm text-gray-500">
                        <p class="font-medium text-gray-700">Contact us</p>
                        <p>bkstematel@gmail.com</p>
                       <p>Jl. DI Panjaitan No.128</p>
                        <p>Purwokerto Selatan, Banyumas</p>
                        <p>Jawa Tengah 53147</p>
                        <p>Indonesia</p>
                    </div>
                    <div class="flex space-x-3 mt-4">
                        <a href="#" class="w-8 h-8 bg-gray-100 rounded-full flex items-center justify-center hover:bg-red-100 transition">
                            <svg class="w-4 h-4 text-gray-600" fill="currentColor" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                        </a>
                        <a href="#" class="w-8 h-8 bg-gray-100 rounded-full flex items-center justify-center hover:bg-red-100 transition">
                            <svg class="w-4 h-4 text-gray-600" fill="currentColor" viewBox="0 0 24 24"><path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433a2.062 2.062 0 01-2.063-2.065 2.064 2.064 0 112.063 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/></svg>
                        </a>
                        <a href="#" class="w-8 h-8 bg-gray-100 rounded-full flex items-center justify-center hover:bg-red-100 transition">
                            <svg class="w-4 h-4 text-gray-600" fill="currentColor" viewBox="0 0 24 24"><path d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z"/></svg>
                        </a>
                        <a href="#" class="w-8 h-8 bg-gray-100 rounded-full flex items-center justify-center hover:bg-red-100 transition">
                            <svg class="w-4 h-4 text-gray-600" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838a6.162 6.162 0 100 12.324 6.162 6.162 0 000-12.324zM12 16a4 4 0 110-8 4 4 0 010 8zm6.406-11.845a1.44 1.44 0 100 2.881 1.44 1.44 0 000-2.881z"/></svg>
                        </a>
                    </div>
                </div>

                <div>
                    <h4 class="font-bold text-gray-800 mb-4 text-sm">Layanan Kami</h4>
                    <ul class="space-y-2 text-sm text-gray-500">
                        <li><a href="{{ route('siswa.karir') }}" class="hover:text-red-500 transition">Karir</a></li>
                        <li><a href="{{ route('siswa.belajar') }}" class="hover:text-red-500 transition">Belajar</a></li>
                        <li><a href="{{ route('siswa.pribadi') }}" class="hover:text-red-500 transition">Pribadi</a></li>
                        <li><a href="{{ route('siswa.sosial') }}" class="hover:text-red-500 transition">Sosial</a></li>
                        <li><a href="{{ route('siswa.konseling') }}" class="hover:text-red-500 transition">Konseling</a></li>
                    </ul>
                </div>

                <div>
                    <h4 class="font-bold text-gray-800 mb-4 text-sm">About</h4>
                    <ul class="space-y-2 text-sm text-gray-500">
                      
                  
                        <li><a href="{{ route('siswa.dashboard') }}#guru" class="hover:text-red-500 transition">Tim Guru BK</a></li>
                        <li><a href="{{ route('siswa.dashboard') }}#motivasi" class="hover:text-red-500 transition">Motivasi Siswa</a></li>
                        <li><a href="{{ route('siswa.dashboard') }}#lulus" class="hover:text-red-500 transition">Perencanaan Karir</a></li>
                        <li><a href="{{ route('siswa.konseling') }}" class="hover:text-red-500 transition">Ajukan Konseling</a></li>
                        <li><a href="{{ route('siswa.profile.edit') }}" class="hover:text-red-500 transition">Profil Siswa</a></li>
                   
                    </ul>
                </div>
            </div>

            <div class="border-t border-gray-100 mt-10 pt-6 text-center text-xs text-gray-400">
                © {{ date('Y') }} SMK Telkom Purwokerto. All rights reserved.
            </div>
        </div>
    </footer>

    <script>
        // Scroll reveal animation
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('visible');
                }
            });
        }, { threshold: 0.1, rootMargin: '0px 0px -40px 0px' });

        document.querySelectorAll('.scroll-reveal').forEach(el => observer.observe(el));

        // Counter animation for stats
        const counters = document.querySelectorAll('.stat-number');
        const statsObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const target = entry.target;
                    const text = target.textContent;
                    const num = parseFloat(text.replace(/[^0-9.]/g, ''));
                    const suffix = text.replace(/[0-9.]/g, '');
                    let start = 0;
                    const duration = 1500;
                    const step = num / (duration / 16);
                    
                    const timer = setInterval(() => {
                        start += step;
                        if (start >= num) {
                            target.textContent = text;
                            clearInterval(timer);
                        } else {
                            target.textContent = (start % 1 === 0 ? Math.floor(start) : start.toFixed(1)) + suffix;
                        }
                    }, 16);
                    statsObserver.unobserve(target);
                }
            });
        }, { threshold: 0.5 });

        counters.forEach(c => statsObserver.observe(c));
        const menuBtn = document.getElementById("menuBtn");
        const navMenu = document.getElementById("navMenu");

        menuBtn.addEventListener("click", () => {
            navMenu.classList.toggle("show");
        });
    </script>
@endsection