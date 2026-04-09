@extends('layouts.siswa')

@section('title', 'Dashboard Siswa - SMK Telkom')

@section('styles')
<style>
    :root {
        --red: #dc2626;
        --orange: #ef4444;
        --teal: #b91c1c;
        --cyan: #f87171;
        --emerald: #7f1d1d;
        --yellow: #fca5a5;
    }

    * { margin: 0; padding: 0; box-sizing: border-box; }

    html { scroll-behavior: smooth; }

    body {
        font-family: 'Poppins', sans-serif;
        background: #2a0f0f;
        color: white;
        overflow-x: hidden;
    }

    /* ==============================
       NAVBAR
    ============================== */
    nav {
        position: fixed;
        top: 0; left: 0; right: 0;
        z-index: 200;
        background: rgba(42, 15, 15, 0.85);
        backdrop-filter: blur(20px);
        border-bottom: 1px solid rgba(255,255,255,0.06);
        animation: navSlide 0.6s ease both;
    }

    @keyframes navSlide {
        from { transform: translateY(-100%); opacity: 0; }
        to   { transform: translateY(0);      opacity: 1; }
    }

    .nav-inner {
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 28px;
        height: 64px;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .logo {
        display: flex;
        align-items: center;
        gap: 10px;
        text-decoration: none;
    }

    .logo-icon {
        width: 36px; height: 36px;
        background: linear-gradient(135deg, var(--red), var(--orange));
        border-radius: 10px;
        display: flex; align-items: center; justify-content: center;
        font-size: 1rem; color: white;
        box-shadow: 0 4px 14px rgba(230,51,41,0.4);
    }

    .logo-text {
        font-family: 'Poppins', sans-serif;
        font-weight: 750;
        font-size: 1.2rem;
        color: white;
    }

    .nav-links {
        display: flex;
        gap: 28px;
        list-style: none;
    }

    .nav-links a {
        text-decoration: none;
        color: rgba(255,255,255,0.55);
        font-weight: 600;
        font-size: 0.85rem;
        transition: color 0.25s;
        position: relative;
    }

    .nav-links a:hover { color: white; }
    .nav-links a.active { color: white; }
    .nav-links a.active::after {
        content: '';
        position: absolute;
        bottom: -4px; left: 0; right: 0;
        height: 2px;
        background: linear-gradient(90deg, var(--red), var(--orange));
        border-radius: 2px;
    }

    /* Profile dropdown */
    .profile-wrapper { position: relative; }

    .profile-btn {
        width: 36px; height: 36px;
        border-radius: 50%;
        background: rgba(255,255,255,0.08);
        border: 1px solid rgba(255,255,255,0.12);
        display: flex; align-items: center; justify-content: center;
        cursor: pointer;
        color: rgba(255,255,255,0.7);
        transition: all 0.2s;
    }

        .profile-btn:hover {
            background: rgba(255,255,255,0.15);
            color: white;
        }

        .profile-dropdown {
            position: absolute; right: 0; top: calc(100% + 10px);
            width: 210px;
            background: #3b1e1e;
            border: 1px solid rgba(255,255,255,0.1);
            border-radius: 14px;
            box-shadow: 0 16px 48px rgba(0,0,0,0.4);
            opacity: 0; visibility: hidden;
            transform: translateY(-8px);
            transition: all 0.2s;
            overflow: hidden;
        }

        .profile-wrapper:hover .profile-dropdown {
            opacity: 1; visibility: visible; transform: translateY(0);
        }

        .dropdown-header {
            padding: 14px 16px;
            border-bottom: 1px solid rgba(255,255,255,0.07);
        }

        .dropdown-header .dname {
            font-weight: 700;
            font-size: 0.87rem;
            color: white;
            margin: 1px;
        }

        .dropdown-header .demail {
            font-size: 0.75rem;
            color: rgba(255,255,255,0.4);
            margin-top: 2px;
        }

        .dropdown-item {
            display: block;
            padding: 10px 16px;
            font-size: 0.83rem;
            color: rgba(255,255,255,0.6);
            text-decoration: none;
            transition: all 0.15s;
            font-family: 'Poppins', sans-serif;
            border: none;
            background: none;
            width: 100%;
            text-align: left;
            cursor: pointer;
        }

        .dropdown-item:hover {
            background: rgba(255,255,255,0.06);
            color: white;
        }

        /* ==============================
           HERO
        ============================== */
        .hero {
            position: relative;
            min-height: 100vh;
            display: flex;
            align-items: center;
            overflow: hidden;
            padding-top: 64px;
        }

        /* Animated gradient mesh background */
        .hero-bg {
                    position: absolute;
                    inset: 0;
                    background:
                        radial-gradient(ellipse 80% 60% at 70% 30%, rgba(220,38,38,0.25) 0%, transparent 60%),
                        radial-gradient(ellipse 60% 50% at 20% 80%, rgba(239,68,68,0.18) 0%, transparent 60%),
                        radial-gradient(ellipse 50% 40% at 90% 90%, rgba(248,113,113,0.14) 0%, transparent 50%),
                        #2a0f0f;
                }

        @keyframes meshShift {
            0%   { filter: hue-rotate(0deg); }
            100% { filter: hue-rotate(15deg); }
        }

        /* Grid lines overlay */
        .hero-grid {
            position: absolute;
            inset: 0;
            background-image:
                linear-gradient(rgba(255,255,255,0.02) 1px, transparent 1px),
                linear-gradient(90deg, rgba(255,255,255,0.02) 1px, transparent 1px);
            background-size: 60px 60px;
            mask-image: radial-gradient(ellipse 80% 80% at 50% 50%, black 40%, transparent 100%);
        }

        /* Canvas for particles */
        #particles-canvas {
            position: absolute;
            inset: 0;
            pointer-events: none;
        }

        .hero-inner {
            position: relative;
            z-index: 10;
            max-width: 1200px;
            margin: 0 auto;
            padding: 80px 28px;
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 80px;
            align-items: center;
            width: 100%;
        }

        /* Left */
        .hero-left { animation: heroLeft 0.9s cubic-bezier(0.4,0,0.2,1) 0.2s both; }

        @keyframes heroLeft {
            from { opacity: 0; transform: translateX(-50px); }
            to   { opacity: 1; transform: translateX(0); }
        }

        .hero-eyebrow {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: rgba(230,51,41,0.12);
            border: 1px solid rgba(230,51,41,0.25);
            border-radius: 100px;
            padding: 6px 14px;
            font-size: 0.75rem;
            font-weight: 700;
            color: #fca5a5;
            letter-spacing: 0.05em;
            text-transform: uppercase;
            margin-bottom: 24px;
        }

        .eyebrow-dot {
            width: 6px; height: 6px;
            background: var(--red);
            border-radius: 50%;
            animation: pulse 2s infinite;
            box-shadow: 0 0 8px var(--red);
        }

        @keyframes pulse {
            0%, 100% { opacity: 1; transform: scale(1); }
            50% { opacity: 0.5; transform: scale(0.7); }
        }

        .hero-title {
            font-family: 'Nunito', sans-serif;
            font-size: clamp(2.4rem, 4vw, 3.4rem);
            font-weight: 900;
            line-height: 1.15;
            margin-bottom: 20px;
            color: white;
        }

        .hero-title .hl {
            background: linear-gradient(135deg, #fca5a5, var(--red), var(--orange));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            position: relative;
        }

        .hero-desc {
            font-size: 0.97rem;
            color: rgba(255,255,255,0.5);
            line-height: 1.8;
            margin-bottom: 36px;
            max-width: 420px;
        }

        .hero-btns {
            display: flex;
            gap: 14px;
            align-items: center;
            flex-wrap: wrap;
        }

        .btn-hero-primary {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            padding: 14px 32px;
            border-radius: 100px;
            background: linear-gradient(135deg, var(--red), var(--orange));
            color: white;
            font-weight: 700;
            font-size: 0.9rem;
            text-decoration: none;
            box-shadow: 0 8px 32px rgba(230,51,41,0.4);
            transition: all 0.25s;
            position: relative;
            overflow: hidden;
        }

        .btn-hero-primary::before {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(135deg, rgba(255,255,255,0.2), transparent);
            opacity: 0;
            transition: opacity 0.25s;
        }

        .btn-hero-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 14px 40px rgba(230,51,41,0.55);
        }

        .btn-hero-primary:hover::before { opacity: 1; }

        .btn-hero-ghost {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 13px 24px;
            border-radius: 100px;
            border: 1.5px solid rgba(255,255,255,0.15);
            color: rgba(255,255,255,0.7);
            font-weight: 600;
            font-size: 0.88rem;
            text-decoration: none;
            transition: all 0.25s;
        }

        .btn-hero-ghost:hover {
            border-color: rgba(255,255,255,0.4);
            color: white;
            background: rgba(255,255,255,0.06);
        }

        /* Hero stats */
        .hero-stats {
            display: flex;
            gap: 24px;
            margin-top: 44px;
            padding-top: 32px;
            border-top: 1px solid rgba(255,255,255,0.07);
        }

        .stat-item { text-align: center; }

        .stat-num {
            font-family: 'Nunito', sans-serif;
            font-size: 1.6rem;
            font-weight: 900;
            background: linear-gradient(135deg, white, rgba(255,255,255,0.7));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .stat-lbl {
            font-size: 0.72rem;
            color: rgba(255,255,255,0.35);
            font-weight: 500;
            margin-top: 2px;
        }

        .stat-divider {
            width: 1px;
            background: rgba(255,255,255,0.08);
            align-self: stretch;
        }

        /* Right: feature cards */
        .hero-right {
            animation: heroRight 0.9s cubic-bezier(0.4,0,0.2,1) 0.4s both;
        }

        @keyframes heroRight {
            from { opacity: 0; transform: translateX(50px); }
            to   { opacity: 1; transform: translateX(0); }
        }

        .feature-cards {
            display: flex;
            flex-direction: column;
            gap: 14px;
        }

        .fcard {
            background: rgba(255,255,255,0.04);
            border: 1px solid rgba(255,255,255,0.08);
            border-radius: 18px;
            padding: 20px 22px;
            display: flex;
            align-items: center;
            gap: 16px;
            transition: all 0.3s;
            animation: fcardIn 0.6s cubic-bezier(0.4,0,0.2,1) both;
            cursor: pointer;
            text-decoration: none;
        }

        .fcard:nth-child(1) { animation-delay: 0.5s; }
        .fcard:nth-child(2) { animation-delay: 0.65s; }
        .fcard:nth-child(3) { animation-delay: 0.8s; }

        @keyframes fcardIn {
            from { opacity: 0; transform: translateX(30px); }
            to   { opacity: 1; transform: translateX(0); }
        }

        .fcard:hover {
            background: rgba(255,255,255,0.08);
            border-color: rgba(255,255,255,0.18);
            transform: translateX(-6px);
        }

        .fcard-icon-wrap {
            width: 48px; height: 48px;
            border-radius: 14px;
            display: flex; align-items: center; justify-content: center;
            font-size: 1.3rem;
            flex-shrink: 0;
        }

        .fcard:nth-child(1) .fcard-icon-wrap { background: rgba(230,51,41,0.15); }
        .fcard:nth-child(2) .fcard-icon-wrap { background: rgba(20,184,166,0.15); }
        .fcard:nth-child(3) .fcard-icon-wrap { background: rgba(249,115,22,0.15); }

        .fcard-text { flex: 1; }

        .fcard-title {
            font-weight: 700;
            font-size: 0.9rem;
            color: white;
            margin-bottom: 3px;
        }

        .fcard-sub {
            font-size: 0.75rem;
            color: rgba(255,255,255,0.4);
        }

        .fcard-arrow {
            color: rgba(255,255,255,0.25);
            transition: all 0.25s;
        }

        .fcard:hover .fcard-arrow {
            color: white;
            transform: translateX(4px);
        }

        /* Floating decoration */
        .hero-deco {
            display: flex;
            gap: 10px;
            margin-top: 14px;
            justify-content: flex-end;
        }

        .deco-shape {
            border-radius: 16px;
            animation: decoFloat 4s ease-in-out infinite;
        }

        .deco-shape:nth-child(1) { width: 56px; height: 56px; background: rgba(230,51,41,0.2); animation-delay: 0s; }
        .deco-shape:nth-child(2) { width: 40px; height: 40px; background: rgba(20,184,166,0.15); animation-delay: 1s; align-self: flex-end; border-radius: 12px; }
        .deco-shape:nth-child(3) { width: 68px; height: 68px; background: rgba(249,115,22,0.12); animation-delay: 0.5s; }

        @keyframes decoFloat {
            0%, 100% { transform: translateY(0) rotate(0deg); }
            50% { transform: translateY(-8px) rotate(5deg); }
        }

        /* ==============================
           CONTENT SECTIONS (Light)
        ============================== */
        .section-light {
            background: #f8fafc;
            color: #3b1e1e;
        }

        .section-dark {
            background: #2a0f0f;
            color: white;
        }

        .section-mid {
            background: #f0fdfa;
            color: #3b1e1e;
        }

        /* ==============================
           GURU KONSELING
        ============================== */
        .guru-section {
            padding: 80px 28px;
            background: white;
        }

        .section-inner { max-width: 1200px; margin: 0 auto; }

        .section-head {
            text-align: center;
            margin-bottom: 52px;
        }

        .section-tag {
            display: inline-block;
            background: linear-gradient(135deg, #fff1f0, #fecaca);
            color: var(--red);
            font-size: 0.72rem;
            font-weight: 700;
            padding: 5px 14px;
            border-radius: 100px;
            margin-bottom: 12px;
            border: 1px solid #fecaca;
            letter-spacing: 0.07em;
            text-transform: uppercase;
        }

        .section-title {
            font-family: 'Nunito', sans-serif;
            font-size: 2.2rem;
            font-weight: 900;
            color: #3b1e1e;
            margin-bottom: 10px;
        }

        .section-title span { color: var(--red); }

        .section-sub {
            font-size: 0.92rem;
            color: #8b6464;
            max-width: 460px;
            margin: 0 auto;
            line-height: 1.7;
        }

        .guru-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 20px;
        }

        .guru-card {
            background: white;
            border-radius: 22px;
            overflow: hidden;
            border: 1px solid #f1f5f9;
            box-shadow: 0 4px 20px rgba(0,0,0,0.05);
            transition: all 0.35s cubic-bezier(0.4,0,0.2,1);
            cursor: pointer;
        }

        .guru-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 50px rgba(230,51,41,0.12);
            border-color: #fecaca;
        }

        .guru-thumb {
            height: 300px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2.5rem;
            position: relative;
            overflow: hidden;
        }

        .guru-card:nth-child(4n+1) .guru-thumb { background: linear-gradient(135deg, #ccfbf1, #99f6e4); }
        .guru-card:nth-child(4n+2) .guru-thumb { background: linear-gradient(135deg, #fecaca, #fca5a5); }
        .guru-card:nth-child(4n+3) .guru-thumb { background: linear-gradient(135deg, #fed7aa, #fdba74); }
        .guru-card:nth-child(4n) .guru-thumb { background: linear-gradient(135deg, #c7d2fe, #a5b4fc); }

        .guru-initials {
            font-family: 'Nunito', sans-serif;
            font-size: 2.4rem;
            font-weight: 900;
            color: white;
            width: 72px; height: 72px;
            border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
            text-shadow: 0 2px 8px rgba(0,0,0,0.15);
        }

        .guru-card:nth-child(4n+1) .guru-initials { background: linear-gradient(135deg, var(--teal), var(--cyan)); }
        .guru-card:nth-child(4n+2) .guru-initials { background: linear-gradient(135deg, var(--red), var(--orange)); }
        .guru-card:nth-child(4n+3) .guru-initials { background: linear-gradient(135deg, var(--orange), var(--yellow)); }
        .guru-card:nth-child(4n)   .guru-initials { background: linear-gradient(135deg, #6366f1, #8b5cf6); }

        .guru-info { padding: 16px; }

        .guru-name {
            font-family: 'Nunito', sans-serif;
            font-size: 0.95rem;
            font-weight: 800;
            color: #3b1e1e;
            margin-bottom: 4px;
        }

        .guru-nip {
            font-size: 0.75rem;
            color: #b89494;
            margin-bottom: 12px;
        }

        .guru-btn {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 8px 14px;
            background: #f8fafc;
            border-radius: 10px;
            font-size: 0.78rem;
            font-weight: 700;
            color: #64748b;
            text-decoration: none;
            transition: all 0.2s;
        }

        .guru-card:hover .guru-btn {
            background: linear-gradient(135deg, #fff1f0, #fecaca);
            color: var(--red);
        }

        /* ==============================
           MOTIVASI
        ============================== */
        .motivasi-section {
            padding: 80px 28px;
            background: #2a0f0f;
            position: relative;
            overflow: hidden;
        }

        .motivasi-section::before {
            content: '';
            position: absolute;
            inset: 0;
            background:
                radial-gradient(ellipse 50% 60% at 20% 50%, rgba(20,184,166,0.08) 0%, transparent 60%),
                radial-gradient(ellipse 50% 60% at 80% 50%, rgba(230,51,41,0.08) 0%, transparent 60%);
        }

        .motivasi-section .section-title { color: white; }
        .motivasi-section .section-sub { color: rgba(255,255,255,0.45); }
        .motivasi-section .section-tag {
            background: rgba(184, 20, 20, 0.15);
            color: #ea5e5e;
            border-color: rgba(184, 20, 20, 0.3);
        }

        /* Carousel */
        .carousel-wrap { overflow: hidden; }

        .carousel-track {
            display: flex;
            transition: transform 0.5s cubic-bezier(0.4,0,0.2,1);
        }

        .carousel-slide {
            min-width: 100%;
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 18px;
        }

        .quote-card {
            background: rgba(255,255,255,0.04);
            border: 1px solid rgba(255,255,255,0.07);
            border-radius: 22px;
            padding: 28px;
            position: relative;
            transition: all 0.3s;
        }

        .quote-card:hover {
            background: rgba(255,255,255,0.07);
            border-color: rgba(255,255,255,0.15);
            transform: translateY(-4px);
        }

        .quote-mark {
            font-size: 3rem;
            line-height: 1;
            font-family: 'Nunito', sans-serif;
            font-weight: 900;
            opacity: 0.2;
            margin-bottom: 8px;
        }

        .carousel-slide:nth-child(1) .quote-card:nth-child(1) .quote-mark { color: var(--cyan); }
        .carousel-slide:nth-child(1) .quote-card:nth-child(2) .quote-mark { color: #f472b6; }
        .carousel-slide:nth-child(1) .quote-card:nth-child(3) .quote-mark { color: var(--yellow); }

        .quote-text {
            font-size: 0.88rem;
            color: rgba(255,255,255,0.65);
            line-height: 1.75;
        }

        .quote-accent {
            position: absolute;
            bottom: 0; right: 0;
            width: 60px; height: 60px;
            border-radius: 22px 0 0 0;
            opacity: 0.06;
        }

        /* Dots */
        .carousel-dots {
            display: flex;
            justify-content: center;
            gap: 8px;
            margin-top: 36px;
        }

        .cdot {
            width: 8px; height: 8px;
            border-radius: 100px;
            background: rgba(255,255,255,0.2);
            cursor: pointer;
            transition: all 0.3s;
        }

        .cdot.active {
            background: var(--red);
            width: 24px;
            box-shadow: 0 0 10px rgba(230,51,41,0.5);
        }

        /* ==============================
           SETELAH LULUS
        ============================== */
        .lulus-section {
            padding: 80px 28px;
            background: white;
            position: relative;
            overflow: hidden;
        }

        .lulus-section::before {
            content: '';
            position: absolute;
            top: 0; left: 0; right: 0;
            height: 4px;
            background: linear-gradient(90deg, var(--red), var(--orange), var(--teal), var(--cyan));
        }

        .lulus-title {
            font-family: 'Nunito', sans-serif;
            font-size: 2.4rem;
            font-weight: 900;
            color: #1e293b;
            text-align: center;
            margin-bottom: 14px;
        }

        .lulus-title span { color: var(--red); }

        .lulus-sub {
            text-align: center;
            font-size: 0.92rem;
            color: #64748b;
            margin-bottom: 48px;
            line-height: 1.7;
        }

        .lulus-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
            max-width: 720px;
            margin: 0 auto;
        }

        .lulus-card {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 14px;
            padding: 32px 20px;
            border-radius: 22px;
            border: 2px solid #f1f5f9;
            background: white;
            text-decoration: none;
            transition: all 0.35s cubic-bezier(0.4,0,0.2,1);
            position: relative;
            overflow: hidden;
        }

        .lulus-card::before {
            content: '';
            position: absolute;
            inset: 0;
            opacity: 0;
            transition: opacity 0.3s;
        }

        .lulus-card:nth-child(1)::before { background: linear-gradient(135deg, #f0fdfa, #ccfbf1); }
        .lulus-card:nth-child(2)::before { background: linear-gradient(135deg, #fff1f0, #fecaca); }
        .lulus-card:nth-child(3)::before { background: linear-gradient(135deg, #fff7ed, #ffedd5); }

        .lulus-card:hover { transform: translateY(-8px); box-shadow: 0 20px 48px rgba(0,0,0,0.1); border-color: transparent; }
        .lulus-card:hover::before { opacity: 1; }
        .lulus-card:nth-child(1):hover { border-color: #99f6e4; }
        .lulus-card:nth-child(2):hover { border-color: #fca5a5; }
        .lulus-card:nth-child(3):hover { border-color: #fdba74; }

        .lulus-icon {
            width: 64px; height: 64px;
            border-radius: 20px;
            display: flex; align-items: center; justify-content: center;
            font-size: 1.8rem;
            position: relative;
            z-index: 1;
            transition: transform 0.3s;
        }

        .lulus-card:nth-child(1) .lulus-icon { background: linear-gradient(135deg, #ccfbf1, #99f6e4); }
        .lulus-card:nth-child(2) .lulus-icon { background: linear-gradient(135deg, #fecaca, #fca5a5); }
        .lulus-card:nth-child(3) .lulus-icon { background: linear-gradient(135deg, #fed7aa, #fdba74); }

        .lulus-card:hover .lulus-icon { transform: scale(1.1) rotate(-5deg); }

        .lulus-label {
            font-family: 'Nunito', sans-serif;
            font-size: 1.05rem;
            font-weight: 900;
            color: #1e293b;
            position: relative;
            z-index: 1;
        }

        .lulus-desc {
            font-size: 0.77rem;
            color: #64748b;
            text-align: center;
            line-height: 1.6;
            position: relative;
            z-index: 1;
        }

        .lulus-arrow {
            width: 32px; height: 32px;
            border-radius: 50%;
            background: #f1f5f9;
            display: flex; align-items: center; justify-content: center;
            color: #64748b;
            position: relative;
            z-index: 1;
            transition: all 0.25s;
        }

        .lulus-card:hover .lulus-arrow {
            background: white;
            color: #1e293b;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        }

        /* ==============================
           SCROLL REVEAL
        ============================== */
        .reveal {
            opacity: 0;
            transform: translateY(36px);
            transition: opacity 0.7s ease, transform 0.7s ease;
        }

        .reveal.visible {
            opacity: 1;
            transform: translateY(0);
        }

        .reveal-left {
            opacity: 0;
            transform: translateX(-36px);
            transition: opacity 0.7s ease, transform 0.7s ease;
        }

        .reveal-left.visible {
            opacity: 1;
            transform: translateX(0);
        }

        /* ==============================
           FOOTER
        ============================== */
        footer {
            background: #1e293b;
            padding: 60px 28px 32px;
        }

        .footer-inner { max-width: 1200px; margin: 0 auto; }

        .footer-top {
            display: grid;
            grid-template-columns: 2fr 1fr 1fr 1fr;
            gap: 48px;
            margin-bottom: 48px;
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

        .footer-brand p { font-size: 0.82rem; line-height: 1.75; color: rgba(255,255,255,0.4); }

        .footer-col h4 { color: white; font-weight: 700; font-size: 0.85rem; margin-bottom: 14px; }
        .footer-col ul { list-style: none; }
        .footer-col ul li { margin-bottom: 9px; }
        .footer-col ul li a { color: rgba(255,255,255,0.4); text-decoration: none; font-size: 0.82rem; transition: color 0.2s; }
        .footer-col ul li a:hover { color: rgba(255,255,255,0.9); }

        .footer-bottom {
            border-top: 1px solid rgba(255,255,255,0.07);
            padding-top: 24px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 0.78rem;
            color: rgba(255,255,255,0.3);
        }

        .footer-school { color: var(--teal); font-weight: 700; }

        /* ==============================
           RESPONSIVE
        ============================== */
             @media (max-width: 900px) {
            .hero-inner { grid-template-columns: 1fr; gap: 48px; text-align: center; }
            .hero-desc { margin: 0 auto 36px; }
            .hero-btns { justify-content: center; }
            .hero-stats { justify-content: center; }
            .guru-grid { grid-template-columns: repeat(2, 1fr); }
            .carousel-slide { grid-template-columns: 1fr; }
            .lulus-grid { grid-template-columns: 1fr; max-width: 360px; }
            .footer-top { grid-template-columns: 1fr 1fr; }
        }
  .menu-btn{
    display:none;
    font-size:22px;
    color:white;
    background:none;
    border:none;
    cursor:pointer;
}
        @media (max-width: 768px) {
            .nav-links { display: none; }
             .menu-btn{
                display:block;
            }
            .guru-grid { grid-template-columns: 1fr; }
            .footer-top { grid-template-columns: 1fr; }
            .hero-title { font-size: 2rem; }
            .guru-card{
    display:flex;
    align-items:center;
    padding:12px;
    
}

.guru-thumb{
    width:80px;
    height:80px;
    flex-shrink:0;
    border-radius:14px;
    overflow:hidden;
}

.guru-thumb img{
    width:100%;
    height:100%;
    object-fit:cover;
}

.guru-info{
    padding:0 0 0 14px;
    flex:1;
}

.guru-name{
    font-size:0.9rem;
}

.guru-btn{
    margin-top:6px;
    width:fit-content;
}

        }
       
         
 .logo-img{
                width:40px;
                height:60px;
                object-fit:contain;
            }
.mobile-menu{
    position:fixed;
    top:64px;
    left:0;
    right:0;
    background:#2a0f0f;
    display:flex;
    flex-direction:column;
    gap:10px;
    padding:20px;
    transform:translateY(-120%);
    transition:0.3s;
    z-index:150;
}

.mobile-menu a{
    color:white;
    text-decoration:none;
    padding:10px;
    border-radius:8px;
}

.mobile-menu a:hover{
    background:rgba(255,255,255,0.08);
}

.mobile-menu.active{
    transform:translateY(0);
}

    </style>
@endsection

@section('content')
    <!-- ==============================
         NAVBAR
    ============================== -->
    <nav>
        <div class="nav-inner">
          
               <div class="flex items-center space-x-3">
                      <button id="menuBtn" class="menu-btn">
                ☰
            </button>
                    <img src="{{ asset('images/telkom.png') }}" alt="Logo Telkom" class="logo-img">
               
                    <div>
                        <p class="font-bold text-white text-sm leading-tight">SMK Telkom</p>
                        <p class="text-white text-xs leading-tight">Purwokerto</p>
                    </div>
                </div>
                
          

           <ul class="nav-links">
    <li><a href="{{ route('siswa.dashboard') }}" class="active">Home</a></li>
    <li><a href="{{ route('siswa.karir') }}">Karir</a></li>
    <li><a href="{{ route('siswa.belajar') }}">Belajar</a></li>
    <li><a href="{{ route('siswa.pribadi') }}">Pribadi</a></li>
    <li><a href="{{ route('siswa.sosial') }}">Sosial</a></li>
    <li><a href="{{ route('siswa.konseling') }}">Konseling</a></li>
</ul>

@guest
<a href="{{ route('login') }}" class="text-white text-sm font-semibold">
    Login
</a>
@endguest
          

           @auth
        <div class="relative group profile-wrapper">
            <button class="profile-btn">
                <svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                </svg>
            </button>

            <div class="profile-dropdown absolute right-0 mt-2 w-64 rounded-xl shadow-lg opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 z-50 border border-gray-100 bg-[#3b1e1e]">
                <div class="dropdown-header px-4 py-3 border-b border-gray-100 ">
                    <p class="text-sm font-semibold text-white break-words mb-1">{{ auth()->user()->name }}</p>
                    <p class="text-xs text-gray-400 break-words">{{ auth()->user()->email }}</p>
                </div>
                @auth
                     @if(auth()->user()->guruBk|| auth()->user()->role === 'admin')
                    <a href="/admin" class="block px-4 py-2 text-white hover:bg-[#4b2929] text-sm">
                        Dashboard Admin
                    </a>
                @endif
                    @if(auth()->user()->siswa)
                        <a href="{{ route('siswa.profile.edit') }}" class="block px-4 py-2 text-white hover:bg-[#4b2929] text-sm">
                            Edit Profile
                        </a>
                    @endif
                @endauth
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="w-full text-left px-4 py-2 text-white hover:bg-[#4b2929] text-sm">Logout</button>
                </form>
            </div>
        </div>
        @endauth
        </div>
    </nav>
    <div id="mobileMenu" class="mobile-menu">
        <a href="{{ route('siswa.dashboard') }}">Home</a>
        <a href="{{ route('siswa.karir') }}">Karir</a>
        <a href="{{ route('siswa.belajar') }}">Belajar</a>
        <a href="{{ route('siswa.pribadi') }}">Pribadi</a>
        <a href="{{ route('siswa.sosial') }}">Sosial</a>
        <a href="{{ route('siswa.konseling') }}">Konseling</a>
    </div>
    <!-- ==============================
         HERO
    ============================== -->
    <section class="hero">
        <div class="hero-bg"></div>
        <div class="hero-grid"></div>
        <canvas id="particles-canvas"></canvas>

        <div class="hero-inner">
            <!-- Left -->
            <div class="hero-left">
                <div class="hero-eyebrow">
                    <span class="eyebrow-dot"></span>
                    Platform BK Digital
                </div>

                <h1 class="hero-title">
                    <span class="hl">Ruang Aman</span><br>
                    untuk Tumbuh<br>
                    dan Berkembang
                </h1>

                <p class="hero-desc">
                    Kami hadir untuk mendampingi siswa dalam menghadapi tantangan akademik, sosial, dan emosional. Bersama kita tumbuh lebih kuat.
                </p>

                <div class="hero-btns">
                    <div class="btn-hero-primary" role="button" aria-disabled="true">
                        Mulai Bimbingan
                        <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                        </svg>
                    </div>
                    <div class="btn-hero-ghost" role="button" aria-disabled="true">
                        Lihat Guru BK
                        <svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </div>
                </div>

                <div class="hero-stats">
                    
                </div>
            </div>

            <!-- Right -->
            <div class="hero-right">
                <div class="feature-cards">
                    <div class="fcard">
                        <div class="fcard-icon-wrap">💡</div>
                        <div class="fcard-text">
                            <div class="fcard-title">Tips & Pengembangan Diri</div>
                            <div class="fcard-sub">Tingkatkan potensi dirimu setiap hari</div>
                        </div>
                        <div class="fcard-arrow">→</div>
                    </div>
                    <div class="fcard">
                        <div class="fcard-icon-wrap">🎯</div>
                        <div class="fcard-text">
                            <div class="fcard-title">Konseling Minat & Bakat</div>
                            <div class="fcard-sub">Temukan jalur terbaik untuk masa depanmu</div>
                        </div>
                        <div class="fcard-arrow">→</div>
                    </div>
                    <div class="fcard">
                        <div class="fcard-icon-wrap">🧠</div>
                        <div class="fcard-text">
                            <div class="fcard-title">Konseling Kesehatan Mental</div>
                            <div class="fcard-sub">Ceritakan, kami siap mendengarkan</div>
                        </div>
                        <div class="fcard-arrow">→</div>
                    </div>
                </div>

                <div class="hero-deco">
                    <div class="deco-shape"></div>
                    <div class="deco-shape"></div>
                    <div class="deco-shape"></div>
                </div>
            </div>
        </div>
    </section>

    <!-- ==============================
         GURU KONSELING
    ============================== -->
    <section class="guru-section" id="guru">
        <div class="section-inner">
            <div class="section-head reveal">
               
                <h2 class="section-title"><span>Guru</span> Konseling</h2>
                <p class="section-sub">Mendengar, memahami, dan membantu kamu menemukan solusi terbaik.</p>
            </div>

            <div class="guru-grid">
                @forelse($gurus ?? [] as $guru)
                    <div class="guru-card reveal" style="transition-delay: {{ $loop->index * 0.1 }}s">
                        <div class="guru-thumb">
                            @if($guru->photo)
                                <img src="{{ asset('storage/'.$guru->photo) }}" alt="{{ $guru->nama }}">
                            @else
                                <div class="guru-initials">
                                    {{ strtoupper(substr($guru->nama, 0, 1)) }}{{ strtoupper(substr(explode(' ', $guru->nama)[1] ?? 'K', 0, 1)) }}
                                </div>
                            @endif
                        </div>
                        <div class="guru-info">
                            <div class="guru-name">{{ $guru->nama }}</div>
                           
                            <button type="button" class="guru-btn" aria-disabled="true">
                                Buat Jadwal
                                <svg width="12" height="12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                                </svg>
                            </button>
                        </div>
                    </div>
                @empty
                    {{-- Placeholder cards if no data --}}
                    @foreach([['T','K','Konseling Karir'],['A','N','Kesehatan Mental'],['B','S','Minat & Bakat'],['R','P','Pengembangan Diri']] as $i => $g)
                    <div class="guru-card reveal" style="transition-delay: {{ $i * 0.1 }}s">
                        <div class="guru-thumb">
                            <div class="guru-initials">{{ $g[0] }}{{ $g[1] }}</div>
                        </div>
                        <div class="guru-info">
                            <div class="guru-name">Guru BK {{ $i + 1 }}</div>
                           
                            <button type="button" class="guru-btn" aria-disabled="true">
                                Buat Jadwal
                                <svg width="12" height="12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                                </svg>
                            </button>
                        </div>
                    </div>
                    @endforeach
                @endforelse
            </div>
        </div>
    </section>

    <!-- ==============================
         MOTIVASI CAROUSEL
    ============================== -->
    <section class="motivasi-section" id="motivasi">
        <div class="section-inner" style="position:relative;z-index:2;">
            <div class="section-head reveal">
                <div class="section-tag">✨ Inspirasi Harian</div>
                <h2 class="section-title" style="color:white;">Kata <span style="color:var(--teal);">Motivasi</span></h2>
                <p class="section-sub">Semangat hari ini adalah fondasi kesuksesan esok hari.</p>
            </div>

            <div class="carousel-wrap">
                <div class="carousel-track" id="carousel">
                    <div class="carousel-slide">
                        <div class="quote-card">
                            <div class="quote-mark" style="color:var(--cyan);">"</div>
                            <p class="quote-text">Semangat belajar adalah kunci keberhasilan. Teruslah berusaha dan jangan menyerah pada setiap rintangan yang menghadang perjalananmu.</p>
                            <div class="quote-accent" style="background:var(--cyan);"></div>
                        </div>
                        <div class="quote-card">
                            <div class="quote-mark" style="color:#f472b6;">"</div>
                            <p class="quote-text">Setiap langkah kecil yang kamu ambil hari ini adalah investasi untuk masa depanmu yang lebih cerah dan penuh dengan peluang.</p>
                            <div class="quote-accent" style="background:#f472b6;"></div>
                        </div>
                        <div class="quote-card">
                            <div class="quote-mark" style="color:var(--yellow);">"</div>
                            <p class="quote-text">Percayalah pada kemampuanmu sendiri. Dengan tekad dan kerja keras, tidak ada yang tidak bisa kamu raih dalam hidupmu.</p>
                            <div class="quote-accent" style="background:var(--yellow);"></div>
                        </div>
                    </div>
                    <div class="carousel-slide">
                        <div class="quote-card">
                            <div class="quote-mark" style="color:var(--emerald);">"</div>
                            <p class="quote-text">Jangan takut untuk bermimpi besar. Setiap mimpi yang kamu miliki adalah benih dari kesuksesan yang akan kamu tuai di masa depan.</p>
                            <div class="quote-accent" style="background:var(--emerald);"></div>
                        </div>
                        <div class="quote-card">
                            <div class="quote-mark" style="color:var(--red);">"</div>
                            <p class="quote-text">Belajar dari kegagalan adalah tanda kecerdasan sejati. Setiap kesalahan membawamu selangkah lebih dekat menuju versi terbaik dirimu.</p>
                            <div class="quote-accent" style="background:var(--red);"></div>
                        </div>
                        <div class="quote-card">
                            <div class="quote-mark" style="color:#a78bfa;">"</div>
                            <p class="quote-text">Masa mudamu adalah waktu yang paling berharga. Gunakanlah dengan bijak untuk belajar, bertumbuh, dan mempersiapkan masa depanmu.</p>
                            <div class="quote-accent" style="background:#a78bfa;"></div>
                        </div>
                    </div>
                    <div class="carousel-slide">
                        <div class="quote-card">
                            <div class="quote-mark" style="color:#34d399;">"</div>
                            <p class="quote-text">Sukses bukan tentang seberapa cepat kamu sampai, tetapi tentang seberapa kuat kamu bertahan dan terus melangkah maju setiap harinya.</p>
                            <div class="quote-accent" style="background:#34d399;"></div>
                        </div>
                        <div class="quote-card">
                            <div class="quote-mark" style="color:#fb923c;">"</div>
                            <p class="quote-text">Lingkungan yang positif membentuk karakter yang kuat. Pilihlah teman-teman yang menginspirasi dan mendukung pertumbuhanmu.</p>
                            <div class="quote-accent" style="background:#fb923c;"></div>
                        </div>
                        <div class="quote-card">
                            <div class="quote-mark" style="color:var(--cyan);">"</div>
                            <p class="quote-text">Kesehatan mental sama pentingnya dengan prestasi akademik. Jaga keseimbangan antara belajar dan istirahat yang cukup untuk dirimu.</p>
                            <div class="quote-accent" style="background:var(--cyan);"></div>
                        </div>
                    </div>
                    <div class="carousel-slide">
                        <div class="quote-card">
                            <div class="quote-mark" style="color:#f472b6;">"</div>
                            <p class="quote-text">Jangan biarkan rasa takut menghalangi langkahmu. Keberanian bukan berarti tanpa rasa takut, tapi tetap melangkah meski takut.</p>
                            <div class="quote-accent" style="background:#f472b6;"></div>
                        </div>
                        <div class="quote-card">
                            <div class="quote-mark" style="color:var(--teal);">"</div>
                            <p class="quote-text">Setiap pagi adalah kesempatan baru. Bangunlah dengan tekad yang lebih kuat dari hari kemarin dan jadikan hari ini luar biasa.</p>
                            <div class="quote-accent" style="background:var(--teal);"></div>
                        </div>
                        <div class="quote-card">
                            <div class="quote-mark" style="color:var(--yellow);">"</div>
                            <p class="quote-text">Ilmu yang kamu dapatkan hari ini adalah cahaya yang akan menerangi jalan hidupmu di masa yang akan datang. Teruslah belajar!</p>
                            <div class="quote-accent" style="background:var(--yellow);"></div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="carousel-dots" id="dots">
                <div class="cdot active" onclick="goTo(0)"></div>
                <div class="cdot" onclick="goTo(1)"></div>
                <div class="cdot" onclick="goTo(2)"></div>
                <div class="cdot" onclick="goTo(3)"></div>
            </div>
        </div>
    </section>

    <!-- ==============================
         SETELAH LULUS
    ============================== -->
    <section class="lulus-section" id="lulus">
        <div class="section-inner">
            <h2 class="lulus-title reveal">Setelah Lulus <span>SMK</span> Akan?</h2>
            <p class="lulus-sub reveal">Apapun pilihanmu, kami siap mendampingi dan mempersiapkanmu sejak sekarang.</p>

            <div class="lulus-grid">
                <div class="lulus-card reveal">
                    <div class="lulus-icon">🎓</div>
                    <div class="lulus-label">Kuliah</div>
                    <div class="lulus-desc">Lanjutkan pendidikan ke perguruan tinggi impianmu</div>
                    <div class="lulus-arrow">
                        <svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                        </svg>
                    </div>
                </div>
                <div class="lulus-card reveal" style="transition-delay:0.1s">
                    <div class="lulus-icon">💻</div>
                    <div class="lulus-label">Kerja</div>
                    <div class="lulus-desc">Mulai karir profesionalmu di dunia industri</div>
                    <div class="lulus-arrow">
                        <svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                        </svg>
                    </div>
                </div>
                <div class="lulus-card reveal" style="transition-delay:0.2s">
                    <div class="lulus-icon">📈</div>
                    <div class="lulus-label">Wirausaha</div>
                    <div class="lulus-desc">Bangun bisnis impianmu dan jadilah pengusaha sukses</div>
                    <div class="lulus-arrow">
                        <svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                        </svg>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ==============================
         FOOTER
    ============================== -->
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
                      
                  
                        <li><a href="#guru" class="hover:text-red-500 transition">Tim Guru BK</a></li>
                        <li><a href="#motivasi" class="hover:text-red-500 transition">Motivasi Siswa</a></li>
                        <li><a href="#lulus" class="hover:text-red-500 transition">Perencanaan Karir</a></li>
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
    // ==============================
    // PARTICLE SYSTEM
    // ==============================
    const canvas = document.getElementById('particles-canvas');
    const ctx = canvas.getContext('2d');
    let particles = [];
    let animFrame;

    function resizeCanvas() {
        canvas.width  = window.innerWidth;
        canvas.height = window.innerHeight;
    }

    class Particle {
        constructor() { this.reset(); }
        reset() {
            this.x = Math.random() * canvas.width;
            this.y = Math.random() * canvas.height;
            this.size  = Math.random() * 1.8 + 0.5;
            this.speedX = (Math.random() - 0.5) * 0.4;
            this.speedY = (Math.random() - 0.5) * 0.4;
            this.opacity = Math.random() * 0.5 + 0.1;
           const colors = ['rgba(220,38,38,', 'rgba(239,68,68,', 'rgba(248,113,113,', 'rgba(255,255,255,'];
            this.color = colors[Math.floor(Math.random() * colors.length)];
        }
        update() {
    this.x += this.speedX;
    this.y += this.speedY;

    if (this.x < 0 || this.x > canvas.width) {
        this.speedX *= -1;
    }

    if (this.y < 0 || this.y > canvas.height) {
        this.speedY *= -1;
    }
}

draw() {
    ctx.fillStyle = this.color + this.opacity + ')';
    ctx.beginPath();
    ctx.arc(this.x, this.y, this.size, 0, Math.PI * 2);
    ctx.fill();
}
}

function initParticles() {
    particles = [];
    for (let i = 0; i < 80; i++) {
        particles.push(new Particle());
    }
}

function animateParticles() {
    ctx.clearRect(0, 0, canvas.width, canvas.height);

    particles.forEach(p => {
        p.update();
        p.draw();
    });

    animFrame = requestAnimationFrame(animateParticles);
}

window.addEventListener('resize', () => {
    resizeCanvas();
    initParticles();
});

resizeCanvas();
initParticles();
animateParticles();
    window.addEventListener('resize', () => { resizeCanvas(); initParticles(); });

    // Stop particles when hero not visible
    const heroEl = document.querySelector('.hero');
    const heroObs = new IntersectionObserver(entries => {
        if (entries[0].isIntersecting) {
            if (!animFrame) animateParticles();
        } else {
            cancelAnimationFrame(animFrame);
            animFrame = null;
        }
    }, { threshold: 0 });
    heroObs.observe(heroEl);

    // ==============================
    // COUNTER ANIMATION
    // ==============================
    function animateCounter(el, target, suffix = '') {
        let start = 0;
        const step = target / 60;
        const tick = () => {
            start = Math.min(start + step, target);
            const display = target >= 1000
                ? (start / 1000).toFixed(1) + 'K+'
                : Math.floor(start) + (suffix || '+');
            el.textContent = display;
            if (start < target) requestAnimationFrame(tick);
        };
        tick();
    }

    const statObs = new IntersectionObserver(entries => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const nums = entry.target.querySelectorAll('[data-count]');
                nums.forEach((el, i) => {
                    const val = parseInt(el.dataset.count);
                    const suffix = el.closest('.stat-item').querySelector('.stat-lbl').textContent.includes('%') ? '%' : '';
                    setTimeout(() => animateCounter(el, val, suffix), i * 200);
                });
                statObs.unobserve(entry.target);
            }
        });
    }, { threshold: 0.5 });

    statObs.observe(document.querySelector('.hero-stats'));

    // ==============================
    // CAROUSEL
    // ==============================
    let current = 0;
    const total = 4;
    let autoSlide;

    function goTo(index) {
        current = index;
        document.getElementById('carousel').style.transform = `translateX(-${index * 100}%)`;
        document.querySelectorAll('.cdot').forEach((d, i) => d.classList.toggle('active', i === index));
        resetAutoSlide();
    }

    function nextSlide() { goTo((current + 1) % total); }

    function resetAutoSlide() {
        clearInterval(autoSlide);
        autoSlide = setInterval(nextSlide, 4500);
    }

    resetAutoSlide();

    // Swipe support
    let touchStartX = 0;
    const carouselEl = document.getElementById('carousel');
    carouselEl.addEventListener('touchstart', e => { touchStartX = e.touches[0].clientX; });
    carouselEl.addEventListener('touchend', e => {
        const diff = touchStartX - e.changedTouches[0].clientX;
        if (Math.abs(diff) > 40) goTo(diff > 0 ? (current + 1) % total : (current - 1 + total) % total);
    });

    // ==============================
    // SCROLL REVEAL
    // ==============================
    const revealObs = new IntersectionObserver(entries => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('visible');
                revealObs.unobserve(entry.target);
            }
        });
    }, { threshold: 0.1, rootMargin: '0px 0px -40px 0px' });

    document.querySelectorAll('.reveal, .reveal-left').forEach(el => revealObs.observe(el));
    const menuBtn = document.getElementById("menuBtn");
const mobileMenu = document.getElementById("mobileMenu");

menuBtn.addEventListener("click", () => {
    mobileMenu.classList.toggle("active");
});
    </script>
@endsection