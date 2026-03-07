<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pribadi - SMK Telkom</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700;800;900&family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        :root {
            --pink: #EC4899;
            --rose: #F43F5E;
            --purple: #8B5CF6;
            --violet: #7C3AED;
            --red: #E63329;
            --orange: #F97316;
            --fuchsia: #D946EF;
        }

        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            font-family: 'Poppins', sans-serif;
            background: #fdf4f8;
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

        .nav-links a.active { color: var(--rose); }

        .nav-links a.active::after {
            content: '';
            position: absolute;
            bottom: -2px; left: 0; right: 0;
            height: 2px;
            background: var(--rose);
            border-radius: 2px;
        }

        .profile-wrapper { position: relative; }

        .profile-btn {
            background: none;
            border: none;
            cursor: pointer;
            padding: 8px;
            border-radius: 50%;
            transition: background 0.2s;
        }
        .profile-btn:hover { background: #f1f5f9; }

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

        /* ===== HERO ===== */
        .hero {
            background: white;
            padding: 64px 24px 80px;
            position: relative;
            overflow: hidden;
        }

        .hero-blob {
            position: absolute;
            border-radius: 50%;
            filter: blur(60px);
            pointer-events: none;
            opacity: 0.5;
            animation: blobMove 8s ease-in-out infinite;
        }

        .blob1 {
            width: 400px; height: 400px;
            background: radial-gradient(circle, rgba(236,72,153,0.15), transparent);
            top: -100px; right: -80px;
            animation-delay: 0s;
        }

        .blob2 {
            width: 300px; height: 300px;
            background: radial-gradient(circle, rgba(139,92,246,0.12), transparent);
            bottom: -60px; left: -60px;
            animation-delay: 3s;
        }

        .blob3 {
            width: 200px; height: 200px;
            background: radial-gradient(circle, rgba(244,63,94,0.1), transparent);
            top: 50%; left: 40%;
            animation-delay: 1.5s;
        }

        @keyframes blobMove {
            0%, 100% { transform: scale(1) translate(0, 0); }
            33% { transform: scale(1.1) translate(20px, -15px); }
            66% { transform: scale(0.95) translate(-10px, 10px); }
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
            background: linear-gradient(135deg, #fdf2f8, #fce7f3);
            border: 1px solid #fbcfe8;
            border-radius: 100px;
            padding: 6px 16px;
            font-size: 0.8rem;
            font-weight: 600;
            color: var(--rose);
            margin-bottom: 20px;
        }

        .hero-badge .dot {
            width: 8px; height: 8px;
            background: var(--rose);
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
            background: linear-gradient(135deg, var(--rose), var(--fuchsia));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            position: relative;
        }

        .hero p {
            color: #64748b;
            font-size: 1rem;
            line-height: 1.7;
            margin-bottom: 32px;
        }

        .hero-cta {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            background: linear-gradient(135deg, var(--rose), #be185d);
            color: white;
            padding: 14px 32px;
            border-radius: 100px;
            font-weight: 700;
            font-size: 0.95rem;
            text-decoration: none;
            box-shadow: 0 8px 25px rgba(244,63,94,0.35);
            transition: transform 0.2s, box-shadow 0.2s;
        }

        .hero-cta:hover {
            transform: translateY(-2px);
            box-shadow: 0 12px 35px rgba(244,63,94,0.5);
        }

        .hero-cta:hover svg { transform: translateX(4px); }
        .hero-cta svg { transition: transform 0.2s; }

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
            width: 300px;
            height: 300px;
        }

        .brain-aura {
            position: absolute;
            inset: -30px;
            background: radial-gradient(circle, rgba(236,72,153,0.12) 0%, rgba(139,92,246,0.08) 50%, transparent 70%);
            border-radius: 50%;
            animation: aura 4s ease-in-out infinite;
        }

        @keyframes aura {
            0%, 100% { transform: scale(1); opacity: 0.8; }
            50% { transform: scale(1.15); opacity: 1; }
        }

        .stress-line {
            position: absolute;
            width: 3px;
            background: linear-gradient(to bottom, var(--rose), transparent);
            border-radius: 2px;
            transform-origin: bottom center;
            animation: stressWiggle 1.5s ease-in-out infinite;
            z-index: 3;
        }

        .sl1 { height: 30px; top: 10px; left: 80px; transform: rotate(-30deg); animation-delay: 0s; }
        .sl2 { height: 25px; top: 5px; left: 140px; transform: rotate(0deg); animation-delay: 0.3s; }
        .sl3 { height: 30px; top: 10px; right: 80px; transform: rotate(30deg); animation-delay: 0.6s; }
        .sl4 { height: 20px; top: 30px; left: 50px; transform: rotate(-50deg); animation-delay: 0.15s; }
        .sl5 { height: 20px; top: 30px; right: 50px; transform: rotate(50deg); animation-delay: 0.45s; }

        @keyframes stressWiggle {
            0%, 100% { transform: rotate(var(--r, 0deg)) scaleY(1); }
            50% { transform: rotate(calc(var(--r, 0deg) + 15deg)) scaleY(1.3); }
        }

        .brain-emoji {
            position: relative;
            z-index: 2;
            font-size: 180px;
            line-height: 300px;
            text-align: center;
            display: block;
            animation: stressed 2s ease-in-out infinite;
            filter: drop-shadow(0 20px 40px rgba(236,72,153,0.25));
        }

        @keyframes stressed {
            0%, 100% { transform: translateY(0) rotate(-2deg); }
            25% { transform: translateY(-8px) rotate(2deg); }
            50% { transform: translateY(-4px) rotate(-1deg); }
            75% { transform: translateY(-10px) rotate(3deg); }
        }

        .emo-badge {
            position: absolute;
            background: white;
            border-radius: 14px;
            padding: 8px 14px;
            font-size: 0.75rem;
            font-weight: 700;
            box-shadow: 0 6px 24px rgba(0,0,0,0.1);
            z-index: 4;
            animation: floatBadge 3s ease-in-out infinite;
        }

        @keyframes floatBadge {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-10px); }
        }

        .emo-badge.e1 { top: 20px; left: -10px; color: var(--rose); animation-delay: 0s; }
        .emo-badge.e2 { top: 60px; right: -20px; color: var(--purple); animation-delay: 0.7s; }
        .emo-badge.e3 { bottom: 60px; left: -20px; color: var(--fuchsia); animation-delay: 1.4s; }
        .emo-badge.e4 { bottom: 40px; right: -10px; color: #0ea5e9; animation-delay: 0.3s; }

        /* ===== MOOD TRACKER ===== */
        .mood-section {
            background: linear-gradient(135deg, var(--rose) 0%, var(--fuchsia) 50%, var(--purple) 100%);
            padding: 48px 24px;
            position: relative;
            overflow: hidden;
        }

        .mood-section::before {
            content: '';
            position: absolute;
            inset: 0;
            background: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.05'%3E%3Ccircle cx='30' cy='30' r='4'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
        }

        .mood-inner {
            max-width: 1200px;
            margin: 0 auto;
            position: relative;
            z-index: 2;
            display: grid;
            grid-template-columns: repeat(5, 1fr);
            gap: 16px;
            align-items: center;
        }

        .mood-label {
            grid-column: 1 / -1;
            text-align: center;
            color: rgba(255,255,255,0.9);
            font-size: 0.85rem;
            font-weight: 600;
            margin-bottom: 8px;
            letter-spacing: 0.08em;
            text-transform: uppercase;
        }

        .mood-card {
            background: rgba(255,255,255,0.15);
            border: 1px solid rgba(255,255,255,0.25);
            border-radius: 20px;
            padding: 20px 16px;
            text-align: center;
            cursor: pointer;
            transition: background 0.3s, transform 0.3s;
            backdrop-filter: blur(8px);
            animation: fadeInUp 0.5s ease both;
        }

        .mood-card:hover, .mood-card.active {
            background: rgba(255,255,255,0.3);
            transform: translateY(-6px) scale(1.05);
        }

        .mood-card:nth-child(2) { animation-delay: 0.05s; }
        .mood-card:nth-child(3) { animation-delay: 0.1s; }
        .mood-card:nth-child(4) { animation-delay: 0.15s; }
        .mood-card:nth-child(5) { animation-delay: 0.2s; }
        .mood-card:nth-child(6) { animation-delay: 0.25s; }

        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .mood-emoji { font-size: 2rem; margin-bottom: 8px; display: block; }
        .mood-text { color: white; font-size: 0.78rem; font-weight: 600; }

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
            background: linear-gradient(135deg, #fdf2f8, #fce7f3);
            color: var(--rose);
            font-size: 0.78rem;
            font-weight: 700;
            padding: 6px 16px;
            border-radius: 100px;
            margin-bottom: 12px;
            border: 1px solid #fbcfe8;
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

        .category-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 24px;
        }

        .category-card {
            background: white;
            border-radius: 24px;
            padding: 32px 28px;
            box-shadow: 0 4px 24px rgba(0,0,0,0.06);
            border: 1px solid #fdf2f8;
            transition: transform 0.3s, box-shadow 0.3s;
            cursor: pointer;
            position: relative;
            overflow: hidden;
        }

        .category-card::before {
            content: '';
            position: absolute;
            top: 0; left: 0; right: 0;
            height: 4px;
        }

        .category-card.pink::before { background: linear-gradient(90deg, var(--pink), var(--fuchsia)); }
        .category-card.red::before { background: linear-gradient(90deg, var(--rose), var(--orange)); }
        .category-card.purple::before { background: linear-gradient(90deg, var(--purple), #6366f1); }

        .category-card::after {
            content: '';
            position: absolute;
            bottom: -40px; right: -40px;
            width: 120px; height: 120px;
            border-radius: 50%;
            opacity: 0.06;
            transition: opacity 0.3s, transform 0.3s;
        }

        .category-card.pink::after { background: var(--pink); }
        .category-card.red::after { background: var(--rose); }
        .category-card.purple::after { background: var(--purple); }

        .category-card:hover::after { opacity: 0.12; transform: scale(1.3); }

        .category-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 50px rgba(236,72,153,0.12);
        }

        .cat-icon {
            width: 58px; height: 58px;
            border-radius: 18px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.6rem;
            margin-bottom: 20px;
            position: relative;
            z-index: 2;
        }

        .category-card.pink .cat-icon { background: linear-gradient(135deg, #fdf2f8, #fce7f3); }
        .category-card.red .cat-icon { background: linear-gradient(135deg, #fff1f2, #ffe4e6); }
        .category-card.purple .cat-icon { background: linear-gradient(135deg, #f5f3ff, #ede9fe); }

        .cat-title {
            font-family: 'Nunito', sans-serif;
            font-size: 1.15rem;
            font-weight: 800;
            color: #1e293b;
            margin-bottom: 10px;
            position: relative;
            z-index: 2;
        }

        .cat-desc {
            color: #64748b;
            font-size: 0.88rem;
            line-height: 1.65;
            margin-bottom: 24px;
            position: relative;
            z-index: 2;
        }

        .cat-link {
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

        .category-card.pink .cat-link { color: var(--pink); }
        .category-card.red .cat-link { color: var(--rose); }
        .category-card.purple .cat-link { color: var(--purple); }
        .cat-link:hover { gap: 10px; }

        /* ===== TIPS SECTION ===== */
        .tips-section {
            padding: 0 24px 80px;
            max-width: 1200px;
            margin: 0 auto;
        }

        .tips-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 32px;
        }

        .tips-title {
            font-family: 'Nunito', sans-serif;
            font-size: 1.6rem;
            font-weight: 900;
            color: #1e293b;
        }

        .tips-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
            margin-bottom: 32px;
        }

        .tip-card {
            background: white;
            border-radius: 20px;
            padding: 24px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.05);
            border: 1px solid #fdf2f8;
            transition: transform 0.3s, box-shadow 0.3s;
            cursor: pointer;
            position: relative;
            overflow: hidden;
        }

        .tip-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 16px 40px rgba(236,72,153,0.1);
        }

        .tip-card::before {
            content: '';
            position: absolute;
            top: 0; left: 0;
            width: 4px; height: 100%;
        }

        .tip-card:nth-child(1)::before { background: linear-gradient(to bottom, var(--pink), var(--fuchsia)); }
        .tip-card:nth-child(2)::before { background: linear-gradient(to bottom, var(--purple), #6366f1); }
        .tip-card:nth-child(3)::before { background: linear-gradient(to bottom, var(--rose), var(--orange)); }
        .tip-card:nth-child(4)::before { background: linear-gradient(to bottom, #0ea5e9, #06b6d4); }
        .tip-card:nth-child(5)::before { background: linear-gradient(to bottom, #22c55e, #84cc16); }
        .tip-card:nth-child(6)::before { background: linear-gradient(to bottom, var(--fuchsia), var(--purple)); }

        .tip-num {
            font-family: 'Nunito', sans-serif;
            font-size: 0.7rem;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 0.1em;
            margin-bottom: 10px;
            padding-left: 4px;
        }

        .tip-card:nth-child(1) .tip-num { color: var(--pink); }
        .tip-card:nth-child(2) .tip-num { color: var(--purple); }
        .tip-card:nth-child(3) .tip-num { color: var(--rose); }
        .tip-card:nth-child(4) .tip-num { color: #0ea5e9; }
        .tip-card:nth-child(5) .tip-num { color: #22c55e; }
        .tip-card:nth-child(6) .tip-num { color: var(--fuchsia); }

        .tip-emoji { font-size: 1.8rem; margin-bottom: 10px; display: block; }

        .tip-title {
            font-family: 'Nunito', sans-serif;
            font-size: 0.95rem;
            font-weight: 800;
            color: #1e293b;
            margin-bottom: 8px;
            padding-left: 4px;
        }

        .tip-desc {
            color: #64748b;
            font-size: 0.82rem;
            line-height: 1.6;
            padding-left: 4px;
        }

        /* ===== KONSELING BANNER ===== */
        .konseling-banner {
            max-width: 1200px;
            margin: 0 auto 80px;
            padding: 0 24px;
        }

        .banner-inner {
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

        .banner-inner::before {
            content: '';
            position: absolute;
            top: -80px; right: -80px;
            width: 350px; height: 350px;
            background: radial-gradient(circle, rgba(236,72,153,0.2) 0%, transparent 70%);
        }

        .banner-inner::after {
            content: '';
            position: absolute;
            bottom: -60px; left: 180px;
            width: 280px; height: 280px;
            background: radial-gradient(circle, rgba(139,92,246,0.15) 0%, transparent 70%);
        }

        .banner-text { position: relative; z-index: 2; }

        .banner-text h2 {
            font-family: 'Nunito', sans-serif;
            font-size: 1.8rem;
            font-weight: 900;
            color: white;
            margin-bottom: 12px;
        }

        .banner-text h2 span {
            background: linear-gradient(135deg, var(--pink), var(--fuchsia));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .banner-text p {
            color: rgba(255,255,255,0.65);
            font-size: 0.92rem;
            line-height: 1.7;
            max-width: 420px;
        }

        .banner-btn {
            position: relative;
            z-index: 2;
            flex-shrink: 0;
            background: linear-gradient(135deg, var(--rose), #be185d);
            color: white;
            padding: 14px 36px;
            border-radius: 100px;
            font-weight: 700;
            font-size: 0.95rem;
            text-decoration: none;
            box-shadow: 0 8px 25px rgba(244,63,94,0.4);
            transition: transform 0.2s, box-shadow 0.2s;
            white-space: nowrap;
        }

        .banner-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 12px 35px rgba(244,63,94,0.55);
        }

        /* ===== FOOTER ===== */
        footer {
            background: #1e293b;
            padding: 60px 24px 32px;
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

        .footer-school { color: var(--pink); font-weight: 700; }

        /* ===== SCROLL REVEAL ===== */
        .scroll-reveal {
            opacity: 0;
            transform: translateY(30px);
            transition: opacity 0.7s ease, transform 0.7s ease;
        }

        .scroll-reveal.visible {
            opacity: 1;
            transform: translateY(0);
        }

        /* Responsive */
        @media (max-width: 768px) {
            .hero-inner { grid-template-columns: 1fr; text-align: center; }
            .hero h1 { font-size: 2rem; }
            .hero-image { order: -1; }
            .brain-container { width: 220px; height: 220px; }
            .brain-emoji { font-size: 130px; line-height: 220px; }
            .mood-inner { grid-template-columns: repeat(3, 1fr); }
            .category-grid, .materi-grid, .tips-grid { grid-template-columns: 1fr; }
            .banner-inner { flex-direction: column; padding: 40px; text-align: center; }
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
                <li><a href="{{ route('siswa.pribadi') }}" class="active">Pribadi</a></li>
                <li><a href="{{ route('siswa.sosial') }}">Sosial</a></li>
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
        <div class="hero-blob blob1"></div>
        <div class="hero-blob blob2"></div>
        <div class="hero-blob blob3"></div>

        <div class="hero-inner">
            <div class="hero-text">
                <div class="hero-badge">
                    <span class="dot"></span>
                    Pengembangan Diri
                </div>
                <h1>Masih bingung dengan <span class="highlight">minat dan bakatmu?</span></h1>
                <p>Guru BK siap membantu kamu mengenali potensi diri. Yuk konsultasi dan temukan versi terbaik dari dirimu!</p>
                <a href="{{ route('siswa.konseling') }}" class="hero-cta">
                    Mulai Bimbingan
                    <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                    </svg>
                </a>
            </div>

            <div class="hero-image">
                <div class="brain-container">
                    <div class="brain-aura"></div>
                    <div class="stress-line sl1" style="--r:-30deg"></div>
                    <div class="stress-line sl2" style="--r:0deg"></div>
                    <div class="stress-line sl3" style="--r:30deg"></div>
                    <div class="stress-line sl4" style="--r:-50deg"></div>
                    <div class="stress-line sl5" style="--r:50deg"></div>
                    <span class="brain-emoji">🫨</span>
                    <div class="emo-badge e1">😰 Stres</div>
                    <div class="emo-badge e2">💭 Bingung</div>
                    <div class="emo-badge e3">💪 Semangat</div>
                    <div class="emo-badge e4">✨ Potensi</div>
                </div>
            </div>
        </div>
    </section>

    <!-- Mood Tracker -->
    <section class="mood-section">
        <div class="mood-inner">
            <div class="mood-label" style="grid-column: 1 / -1; margin-bottom: 16px;">
                💭 Bagaimana perasaanmu hari ini?
            </div>
            <div class="mood-card" onclick="selectMood(this)">
                <span class="mood-emoji">😊</span>
                <div class="mood-text">Senang</div>
            </div>
            <div class="mood-card" onclick="selectMood(this)">
                <span class="mood-emoji">😔</span>
                <div class="mood-text">Sedih</div>
            </div>
            <div class="mood-card" onclick="selectMood(this)">
                <span class="mood-emoji">😰</span>
                <div class="mood-text">Cemas</div>
            </div>
            <div class="mood-card" onclick="selectMood(this)">
                <span class="mood-emoji">😤</span>
                <div class="mood-text">Frustasi</div>
            </div>
            <div class="mood-card" onclick="selectMood(this)">
                <span class="mood-emoji">😴</span>
                <div class="mood-text">Lelah</div>
            </div>
        </div>
    </section>

    <!-- Layanan Pribadi -->
    <section>
        <div class="categories-section">
            <div class="section-header scroll-reveal">
                <div class="section-tag">💗 Layanan Pribadi</div>
                <h2 class="section-title">Dukungan untuk Dirimu</h2>
                <p class="section-sub">Dapatkan dukungan dan bimbingan untuk pengembangan pribadi, kesehatan mental, dan kesejahteraan kamu.</p>
            </div>

            <div class="category-grid">
                <div class="category-card pink scroll-reveal">
                    <div class="cat-icon">💬</div>
                    <div class="cat-title">Konsultasi Pribadi</div>
                    <p class="cat-desc">Bicarakan masalah pribadi kamu dengan konselor profesional kami. Semua percakapan bersifat rahasia.</p>
                    <a href="{{ route('siswa.konseling') }}" class="cat-link">
                        Konsultasi Sekarang
                        <svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                        </svg>
                    </a>
                </div>

                <div class="category-card red scroll-reveal" style="transition-delay:0.1s">
                    <div class="cat-icon">🧘</div>
                    <div class="cat-title">Kesehatan Mental</div>
                    <p class="cat-desc">Dukung kesehatan mental kamu dengan program wellness, mindfulness, dan self-care yang terstruktur.</p>
                    <a href="#materi-pribadi" class="cat-link">
                        Lihat Program
                        <svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                        </svg>
                    </a>
                </div>

                <div class="category-card purple scroll-reveal" style="transition-delay:0.2s">
                    <div class="cat-icon">🌟</div>
                    <div class="cat-title">Pengembangan Diri</div>
                    <p class="cat-desc">Ikuti program pengembangan diri untuk meningkatkan potensi dan menemukan versi terbaik dari dirimu.</p>
                    <a href="#materi-pribadi" class="cat-link">
                        Mulai Sekarang
                        <svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Tips Self-Care -->
    <section>
        <div class="tips-section">
            <div class="tips-header scroll-reveal">
                <h2 class="tips-title">💡 Tips Self-Care Harian</h2>
            </div>
            <div class="tips-grid">
                <div class="tip-card scroll-reveal">
                    <span class="tip-emoji">😴</span>
                    <div class="tip-num">Tip 01</div>
                    <div class="tip-title">Tidur Cukup</div>
                    <p class="tip-desc">Pastikan tidur 7-9 jam setiap malam untuk menjaga kesehatan fisik dan mental kamu.</p>
                </div>
                <div class="tip-card scroll-reveal" style="transition-delay:0.1s">
                    <span class="tip-emoji">🧘</span>
                    <div class="tip-num">Tip 02</div>
                    <div class="tip-title">Meditasi 5 Menit</div>
                    <p class="tip-desc">Luangkan 5 menit setiap pagi untuk meditasi atau pernapasan dalam agar pikiran lebih tenang.</p>
                </div>
                <div class="tip-card scroll-reveal" style="transition-delay:0.2s">
                    <span class="tip-emoji">📖</span>
                    <div class="tip-num">Tip 03</div>
                    <div class="tip-title">Journaling</div>
                    <p class="tip-desc">Tulis perasaan dan pikiranmu dalam jurnal harian. Ini membantu mengelola emosi dengan lebih baik.</p>
                </div>
                <div class="tip-card scroll-reveal" style="transition-delay:0.1s">
                    <span class="tip-emoji">🏃</span>
                    <div class="tip-num">Tip 04</div>
                    <div class="tip-title">Gerak Aktif</div>
                    <p class="tip-desc">Olahraga ringan 30 menit sehari terbukti meningkatkan suasana hati dan mengurangi stres.</p>
                </div>
                <div class="tip-card scroll-reveal" style="transition-delay:0.2s">
                    <span class="tip-emoji">🥗</span>
                    <div class="tip-num">Tip 05</div>
                    <div class="tip-title">Makan Bergizi</div>
                    <p class="tip-desc">Pola makan sehat mempengaruhi energi dan mood kamu sepanjang hari. Jangan skip sarapan!</p>
                </div>
                <div class="tip-card scroll-reveal" style="transition-delay:0.3s">
                    <span class="tip-emoji">👥</span>
                    <div class="tip-num">Tip 06</div>
                    <div class="tip-title">Cerita ke Orang Dipercaya</div>
                    <p class="tip-desc">Jangan simpan masalah sendiri. Berbagi dengan teman, keluarga, atau konselor bisa sangat membantu.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Artikel Pribadi Section -->
    <section class="py-16">
        <div class="max-w-6xl mx-auto px-6">
            <h2 class="text-3xl font-extrabold text-gray-900 mb-2 text-center">
                Artikel <span class="text-pink-500">Pribadi</span>
            </h2>
            <p class="text-gray-500 text-center mb-10">Baca artikel terbaru tentang pengembangan diri dan kesejahteraan mental</p>

            @php $materis = $materis ?? collect(); @endphp

            @if($materis->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                @foreach($materis as $materi)
                <div class="artikel-card">
                    <div class="w-28 h-20 rounded-xl overflow-hidden flex-shrink-0 bg-gray-100">
                        @if($materi->thumbnail)
                            <img src="{{ asset('storage/' . $materi->thumbnail) }}" alt="{{ $materi->judul }}" class="w-full h-full object-cover">
                        @else
                            <div class="w-full h-full bg-gradient-to-br from-pink-100 to-pink-200 flex items-center justify-center">
                                <svg class="w-8 h-8 text-pink-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/></svg>
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
                        <a href="{{ route('materi.show', $materi->slug) }}" class="text-xs font-bold text-pink-500 hover:text-pink-700 uppercase tracking-wide transition">Read More →</a>
                    </div>
                </div>
                @endforeach
            </div>
            @else
            <div class="text-center py-16 text-gray-400">
                <svg class="w-16 h-16 mx-auto mb-4 opacity-30" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/></svg>
                <p class="text-lg font-medium">Belum ada artikel pribadi</p>
                <p class="text-sm mt-1">Artikel akan muncul di sini setelah ditambahkan oleh guru.</p>
            </div>
            @endif
        </div>
    </section>

    <!-- Konseling Banner -->
    <div class="konseling-banner scroll-reveal">
        <div class="banner-inner">
            <div class="banner-text">
                <h2>Butuh seseorang untuk <span>diajak bicara?</span></h2>
                <p>Kamu tidak sendirian. Guru BK kami siap mendengarkan dan membantu kamu melewati setiap masalah pribadi dengan penuh empati.</p>
            </div>
            <a href="{{ route('siswa.konseling') }}" class="banner-btn">Konsultasi Sekarang 💗</a>
        </div>
    </div>

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

        // Mood selector
        function selectMood(card) {
            document.querySelectorAll('.mood-card').forEach(c => c.classList.remove('active'));
            card.classList.add('active');
        }

        // Staggered reveal for tip cards
        const tipObserver = new IntersectionObserver((entries) => {
            entries.forEach((entry, i) => {
                if (entry.isIntersecting) {
                    setTimeout(() => entry.target.classList.add('visible'), i * 80);
                }
            });
        }, { threshold: 0.1 });

        document.querySelectorAll('.tip-card').forEach(el => {
            el.classList.add('scroll-reveal');
            tipObserver.observe(el);
        });
    </script>

</body>
</html>