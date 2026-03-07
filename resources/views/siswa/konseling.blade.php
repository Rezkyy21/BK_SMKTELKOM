<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Konseling - SMK Telkom</title>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700;800;900&family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --red: #E63329;
            --red-dark: #c41230;
            --teal: #14b8a6;
            --cyan: #06b6d4;
            --emerald: #10b981;
            --orange: #F97316;
        }

        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            font-family: 'Poppins', sans-serif;
            background: #f8fafc;
            overflow-x: hidden;
        }

        /* ===== NAV ===== */
        nav {
            background: white;
            box-shadow: 0 2px 20px rgba(0,0,0,0.07);
            position: sticky;
            top: 0;
            z-index: 100;
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
            width: 40px; height: 40px;
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
        .nav-links a.active { color: var(--red); }
        .nav-links a.active::after {
            content: '';
            position: absolute;
            bottom: -2px; left: 0; right: 0;
            height: 2px;
            background: var(--red);
            border-radius: 2px;
        }

        .nav-right { display: flex; align-items: center; gap: 8px; }

        .profile-wrapper, .notif-wrapper { position: relative; }
        .profile-btn, .notif-btn {
            background: none; border: none; cursor: pointer;
            padding: 8px; border-radius: 50%;
            transition: background 0.2s;
            color: #64748b;
            position: relative;
        }
        .profile-btn:hover, .notif-btn:hover { background: #f1f5f9; }

        .notif-badge {
            position: absolute;
            top: 2px; right: 2px;
            width: 18px; height: 18px;
            background: var(--red);
            border: 2px solid white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.65rem;
            font-weight: 700;
            color: white;
        }

        .profile-dropdown, .notif-dropdown {
            position: absolute; right: 0; top: calc(100% + 8px);
            background: white; border-radius: 12px;
            box-shadow: 0 8px 32px rgba(0,0,0,0.12);
            width: 320px; opacity: 0; visibility: hidden;
            transform: translateY(-8px);
            transition: all 0.2s; z-index: 200;
            border: 1px solid #f1f5f9;
            max-height: 400px;
            overflow-y: auto;
        }
        .profile-wrapper:hover .profile-dropdown,
        .notif-wrapper:hover .notif-dropdown {
            opacity: 1; visibility: visible; transform: translateY(0);
        }

        .notif-dropdown {
            width: 340px;
        }

        .notif-item {
            padding: 12px 16px;
            border-bottom: 1px solid #f1f5f9;
            cursor: pointer;
            transition: background 0.15s;
        }
        .notif-item:hover { background: #f8fafc; }
        .notif-item:last-child { border-bottom: none; }

        .notif-item-title {
            font-weight: 600;
            font-size: 0.85rem;
            color: #1e293b;
            margin-bottom: 2px;
        }

        .notif-item-desc {
            font-size: 0.78rem;
            color: #94a3b8;
            margin-bottom: 4px;
        }

        .notif-item-time {
            font-size: 0.73rem;
            color: #cbd5e1;
        }

        .notif-empty {
            padding: 32px 16px;
            text-align: center;
            color: #94a3b8;
            font-size: 0.85rem;
        }
        .dropdown-header { padding: 14px 16px; border-bottom: 1px solid #f1f5f9; }
        .dropdown-header .name { font-weight: 700; font-size: 0.88rem; color: #1e293b; }
        .dropdown-header .email { font-size: 0.78rem; color: #94a3b8; margin-top: 2px; }
        .dropdown-item {
            display: block; padding: 10px 16px; font-size: 0.85rem;
            color: #475569; text-decoration: none; transition: background 0.15s;
            font-family: 'Poppins', sans-serif;
        }
        .dropdown-item:hover { background: #f8fafc; }

        /* ===== HERO ===== */
        .hero {
            background: white;
            padding: 56px 24px 64px;
            position: relative;
            overflow: hidden;
            border-bottom: 1px solid #f1f5f9;
        }

        .hero-blob {
            position: absolute;
            border-radius: 50%;
            filter: blur(80px);
            pointer-events: none;
        }

        .hb1 {
            width: 500px; height: 500px;
            background: radial-gradient(circle, rgba(230,51,41,0.07), transparent);
            top: -150px; right: -100px;
            animation: blobFloat 8s ease-in-out infinite;
        }
        .hb2 {
            width: 350px; height: 350px;
            background: radial-gradient(circle, rgba(20,184,166,0.06), transparent);
            bottom: -100px; left: -80px;
            animation: blobFloat 10s ease-in-out infinite reverse;
        }

        @keyframes blobFloat {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.1) translate(15px, -10px); }
        }

        .hero-inner {
            max-width: 1200px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: 1fr auto;
            align-items: center;
            gap: 48px;
            position: relative;
            z-index: 2;
        }

        .hero-badge {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: linear-gradient(135deg, #fff1f0, #ffe4e1);
            border: 1px solid #fecaca;
            border-radius: 100px;
            padding: 6px 16px;
            font-size: 0.78rem;
            font-weight: 700;
            color: var(--red);
            margin-bottom: 16px;
            letter-spacing: 0.02em;
        }

        .hero-badge .dot {
            width: 7px; height: 7px;
            background: var(--red);
            border-radius: 50%;
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0%, 100% { opacity: 1; transform: scale(1); }
            50% { opacity: 0.4; transform: scale(0.7); }
        }

        .hero h1 {
            font-family: 'Nunito', sans-serif;
            font-size: 2.6rem;
            font-weight: 900;
            line-height: 1.2;
            color: #1e293b;
            margin-bottom: 14px;
        }

        .hero h1 .hl-red {
            background: linear-gradient(135deg, var(--red), var(--orange));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .hero p {
            color: #64748b;
            font-size: 0.95rem;
            line-height: 1.75;
            max-width: 540px;
        }

        .hero-steps {
            display: flex;
            gap: 0;
            flex-shrink: 0;
        }

        .hero-step {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 8px;
            padding: 20px 28px;
            background: #f8fafc;
            border-radius: 16px;
            border: 1px solid #f1f5f9;
            position: relative;
            min-width: 110px;
            text-align: center;
        }

        .hero-step + .hero-step {
            margin-left: 8px;
        }

        .step-icon {
            width: 44px; height: 44px;
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.3rem;
        }

        .hero-step:nth-child(1) .step-icon { background: linear-gradient(135deg, #fff1f0, #fecaca); }
        .hero-step:nth-child(2) .step-icon { background: linear-gradient(135deg, #f0fdfa, #ccfbf1); }
        .hero-step:nth-child(3) .step-icon { background: linear-gradient(135deg, #fff7ed, #ffedd5); }

        .step-num {
            font-family: 'Nunito', sans-serif;
            font-size: 0.7rem;
            font-weight: 900;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            color: #94a3b8;
        }

        .step-label {
            font-size: 0.75rem;
            font-weight: 700;
            color: #475569;
            line-height: 1.3;
        }

        /* ===== MAIN CONTENT ===== */
        .main-wrap {
            max-width: 1200px;
            margin: 0 auto;
            padding: 48px 24px 80px;
        }

        /* Notifications */
        .notif-box {
            background: linear-gradient(135deg, #fffbeb, #fef3c7);
            border: 1px solid #fde68a;
            border-left: 4px solid #f59e0b;
            border-radius: 12px;
            padding: 14px 18px;
            margin-bottom: 8px;
            font-size: 0.88rem;
            color: #92400e;
            font-weight: 500;
        }

        .alert-error {
            background: #fef2f2;
            border: 1px solid #fecaca;
            border-radius: 12px;
            padding: 16px 18px;
            margin-bottom: 20px;
            color: #991b1b;
            font-size: 0.88rem;
        }

        .alert-success {
            background: #f0fdf4;
            border: 1px solid #bbf7d0;
            border-radius: 12px;
            padding: 16px 18px;
            margin-bottom: 20px;
            color: #166534;
            font-size: 0.88rem;
            font-weight: 500;
        }

        /* ===== SECTION LABEL ===== */
        .section-label {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 24px;
        }

        .section-label-badge {
            width: 32px; height: 32px;
            border-radius: 10px;
            background: linear-gradient(135deg, var(--red), var(--orange));
            color: white;
            font-family: 'Nunito', sans-serif;
            font-weight: 900;
            font-size: 0.85rem;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .section-label-text {
            font-family: 'Nunito', sans-serif;
            font-size: 1.25rem;
            font-weight: 900;
            color: #1e293b;
        }

        .section-label-sub {
            font-size: 0.82rem;
            color: #94a3b8;
            font-weight: 500;
            margin-left: auto;
        }

        /* ===== GURU GRID ===== */
        .guru-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(220px, 1fr));
            gap: 16px;
            margin-bottom: 48px;
        }

        .guru-card {
            background: white;
            border: 2px solid #f1f5f9;
            border-radius: 20px;
            padding: 24px 20px;
            cursor: pointer;
            transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            overflow: hidden;
            text-align: center;
        }

        .guru-card::before {
            content: '';
            position: absolute;
            top: 0; left: 0; right: 0;
            height: 3px;
            background: linear-gradient(90deg, var(--red), var(--orange));
            transform: scaleX(0);
            transform-origin: left;
            transition: transform 0.3s;
        }

        .guru-card:hover::before,
        .guru-card.active::before {
            transform: scaleX(1);
        }

        .guru-card:hover {
            border-color: #fecaca;
            box-shadow: 0 8px 32px rgba(230,51,41,0.1);
            transform: translateY(-4px);
        }

        .guru-card.active {
            border-color: var(--red);
            background: linear-gradient(135deg, #fff8f7, #fff1f0);
            box-shadow: 0 8px 32px rgba(230,51,41,0.15);
            transform: translateY(-4px);
        }

        /* Avatar with initials */
        .guru-avatar {
            width: 72px; height: 72px;
            border-radius: 50%;
            margin: 0 auto 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Nunito', sans-serif;
            font-size: 1.5rem;
            font-weight: 900;
            color: white;
            position: relative;
        }

        .guru-card:nth-child(4n+1) .guru-avatar { background: linear-gradient(135deg, #14b8a6, #06b6d4); }
        .guru-card:nth-child(4n+2) .guru-avatar { background: linear-gradient(135deg, #E63329, #F97316); }
        .guru-card:nth-child(4n+3) .guru-avatar { background: linear-gradient(135deg, #8b5cf6, #a855f7); }
        .guru-card:nth-child(4n+4) .guru-avatar { background: linear-gradient(135deg, #10b981, #22c55e); }

        .guru-avatar-ring {
            position: absolute;
            inset: -3px;
            border-radius: 50%;
            border: 2px solid transparent;
            transition: border-color 0.3s;
        }

        .guru-card.active .guru-avatar-ring {
            border-color: var(--red);
            opacity: 0.5;
        }

        .guru-card.active .guru-avatar {
            box-shadow: 0 0 0 4px rgba(230,51,41,0.15);
        }

        .guru-name {
            font-family: 'Nunito', sans-serif;
            font-size: 0.95rem;
            font-weight: 800;
            color: #1e293b;
            margin-bottom: 4px;
            line-height: 1.3;
        }

        .guru-nip {
            font-size: 0.75rem;
            color: #94a3b8;
            font-weight: 500;
        }

        .guru-select-tag {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            margin-top: 14px;
            padding: 6px 14px;
            border-radius: 100px;
            font-size: 0.75rem;
            font-weight: 700;
            background: #f1f5f9;
            color: #64748b;
            transition: all 0.25s;
        }

        .guru-card:hover .guru-select-tag {
            background: linear-gradient(135deg, #fff1f0, #fecaca);
            color: var(--red);
        }

        .guru-card.active .guru-select-tag {
            background: linear-gradient(135deg, var(--red), var(--orange));
            color: white;
        }

        /* Empty state */
        .empty-guru {
            text-align: center;
            padding: 48px;
            color: #94a3b8;
            font-size: 0.9rem;
            grid-column: 1/-1;
        }

        /* ===== JADWAL SECTION ===== */
        #jadwal-wrap {
            opacity: 0;
            transform: translateY(20px);
            transition: opacity 0.4s ease, transform 0.4s ease;
            pointer-events: none;
        }

        #jadwal-wrap.visible {
            opacity: 1;
            transform: translateY(0);
            pointer-events: all;
        }

        .jadwal-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 20px;
        }

        .jadwal-guru-info {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .jadwal-guru-dot {
            width: 10px; height: 10px;
            background: linear-gradient(135deg, var(--red), var(--orange));
            border-radius: 50%;
            animation: pulse 2s infinite;
        }

        .jadwal-title {
            font-family: 'Nunito', sans-serif;
            font-size: 1.15rem;
            font-weight: 800;
            color: #1e293b;
        }

        .jadwal-title span {
            color: var(--red);
        }

        .ganti-guru-btn {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 8px 16px;
            border-radius: 100px;
            border: 1.5px solid #e2e8f0;
            background: white;
            color: #64748b;
            font-size: 0.8rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s;
            font-family: 'Poppins', sans-serif;
        }

        .ganti-guru-btn:hover {
            border-color: #cbd5e1;
            background: #f8fafc;
            color: #1e293b;
        }

        /* Table */
        .jadwal-table-wrap {
            background: white;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 4px 24px rgba(0,0,0,0.06);
            border: 1px solid #f1f5f9;
        }

        .jadwal-table {
            width: 100%;
            border-collapse: collapse;
        }

        .jadwal-table thead {
            background: linear-gradient(135deg, #1e293b, #334155);
        }

        .jadwal-table thead th {
            padding: 14px 20px;
            text-align: left;
            font-size: 0.75rem;
            font-weight: 700;
            color: rgba(255,255,255,0.7);
            text-transform: uppercase;
            letter-spacing: 0.07em;
        }

        .jadwal-table thead th:last-child { text-align: right; }

        .jadwal-table tbody tr {
            border-bottom: 1px solid #f8fafc;
            transition: background 0.15s;
        }

        .jadwal-table tbody tr:last-child { border-bottom: none; }
        .jadwal-table tbody tr:hover { background: #fafbfc; }

        .jadwal-table td {
            padding: 16px 20px;
            font-size: 0.88rem;
            color: #475569;
        }

        .jadwal-table td:first-child { color: #1e293b; font-weight: 600; }
        .jadwal-table td:last-child { text-align: right; }

        .waktu-badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            background: #f0fdf4;
            color: #166534;
            border: 1px solid #bbf7d0;
            border-radius: 100px;
            padding: 4px 12px;
            font-size: 0.78rem;
            font-weight: 600;
        }

        .atur-btn {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 8px 20px;
            border-radius: 100px;
            background: linear-gradient(135deg, var(--teal), var(--cyan));
            color: white;
            font-size: 0.8rem;
            font-weight: 700;
            border: none;
            cursor: pointer;
            transition: all 0.2s;
            box-shadow: 0 4px 12px rgba(20,184,166,0.3);
            font-family: 'Poppins', sans-serif;
        }

        .atur-btn:hover {
            transform: translateY(-1px);
            box-shadow: 0 6px 20px rgba(20,184,166,0.4);
        }

        /* Loading/Empty row */
        .jadwal-placeholder {
            text-align: center;
            padding: 40px;
            color: #94a3b8;
            font-size: 0.9rem;
        }

        /* ===== MODALS ===== */
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

        .modal-overlay.open {
            display: flex;
            animation: fadeInOverlay 0.2s ease;
        }

        @keyframes fadeInOverlay {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        .modal-box {
            background: white;
            border-radius: 24px;
            box-shadow: 0 24px 80px rgba(0,0,0,0.2);
            max-width: 460px;
            width: 100%;
            animation: slideUp 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
        }

        .modal-box.wide { max-width: 580px; }

        @keyframes slideUp {
            from { opacity: 0; transform: translateY(24px) scale(0.97); }
            to { opacity: 1; transform: translateY(0) scale(1); }
        }

        .modal-header {
            padding: 24px 28px 20px;
            border-bottom: 1px solid #f1f5f9;
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            gap: 12px;
        }

        .modal-header-icon {
            width: 48px; height: 48px;
            border-radius: 16px;
            background: linear-gradient(135deg, #fff1f0, #fecaca);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.4rem;
            flex-shrink: 0;
        }

        .modal-header-text { flex: 1; }
        .modal-title {
            font-family: 'Nunito', sans-serif;
            font-size: 1.15rem;
            font-weight: 900;
            color: #1e293b;
            margin-bottom: 3px;
        }
        .modal-sub { font-size: 0.82rem; color: #94a3b8; }

        .modal-close {
            width: 32px; height: 32px;
            border-radius: 10px;
            background: #f1f5f9;
            border: none;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #64748b;
            transition: all 0.15s;
            flex-shrink: 0;
        }
        .modal-close:hover { background: #e2e8f0; color: #1e293b; }

        .modal-body { padding: 24px 28px; }

        /* Tipe cards */
        .tipe-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 14px; }

        .tipe-card {
            border: 2px solid #f1f5f9;
            border-radius: 18px;
            padding: 24px 20px;
            text-align: center;
            cursor: pointer;
            transition: all 0.25s;
            background: white;
        }

        .tipe-card:hover {
            border-color: var(--teal);
            background: linear-gradient(135deg, #f0fdfa, #ccfbf1);
            transform: translateY(-3px);
            box-shadow: 0 8px 24px rgba(20,184,166,0.15);
        }

        .tipe-icon {
            width: 56px; height: 56px;
            border-radius: 18px;
            background: #f8fafc;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.6rem;
            margin: 0 auto 12px;
        }

        .tipe-card:hover .tipe-icon { background: white; }

        .tipe-label {
            font-family: 'Nunito', sans-serif;
            font-size: 1rem;
            font-weight: 800;
            color: #1e293b;
            margin-bottom: 4px;
        }

        .tipe-desc { font-size: 0.75rem; color: #94a3b8; line-height: 1.5; }

        .modal-footer { padding: 0 28px 24px; }

        .btn-cancel {
            width: 100%;
            padding: 12px;
            border-radius: 100px;
            border: 1.5px solid #e2e8f0;
            background: white;
            color: #64748b;
            font-size: 0.85rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s;
            font-family: 'Poppins', sans-serif;
            margin-top: 12px;
        }

        .btn-cancel:hover { background: #f8fafc; color: #1e293b; }

        /* Form */
        .form-group { margin-bottom: 18px; }

        .form-label {
            display: block;
            font-size: 0.83rem;
            font-weight: 600;
            color: #374151;
            margin-bottom: 6px;
        }

        .form-label .req { color: var(--red); }

        .form-input,
        .form-select,
        .form-textarea {
            width: 100%;
            padding: 11px 14px;
            border: 1.5px solid #e5e7eb;
            border-radius: 12px;
            font-size: 0.88rem;
            font-family: 'Poppins', sans-serif;
            color: #1e293b;
            transition: border-color 0.2s, box-shadow 0.2s;
            background: white;
        }

        .form-input:focus,
        .form-select:focus,
        .form-textarea:focus {
            outline: none;
            border-color: var(--teal);
            box-shadow: 0 0 0 3px rgba(20,184,166,0.12);
        }

        .form-input.readonly {
            background: #f8fafc;
            color: #64748b;
        }

        .form-textarea { resize: none; line-height: 1.6; }
        .form-hint { font-size: 0.73rem; color: #94a3b8; margin-top: 4px; }

        .btn-submit {
            width: 100%;
            padding: 13px;
            border-radius: 12px;
            background: linear-gradient(135deg, var(--red), var(--orange));
            color: white;
            font-size: 0.9rem;
            font-weight: 700;
            border: none;
            cursor: pointer;
            transition: all 0.2s;
            font-family: 'Poppins', sans-serif;
            box-shadow: 0 6px 20px rgba(230,51,41,0.3);
        }

        .btn-submit:hover {
            transform: translateY(-1px);
            box-shadow: 0 10px 28px rgba(230,51,41,0.4);
        }

        .form-actions { display: grid; grid-template-columns: 1fr auto; gap: 10px; margin-top: 4px; }

        .btn-back {
            padding: 13px 20px;
            border-radius: 12px;
            border: 1.5px solid #e2e8f0;
            background: white;
            color: #64748b;
            font-size: 0.88rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s;
            font-family: 'Poppins', sans-serif;
        }
        .btn-back:hover { background: #f8fafc; }

        /* ===== FOOTER ===== */
        footer {
            background: #1e293b;
            padding: 56px 24px 28px;
            margin-top: 0;
        }

        .footer-inner { max-width: 1200px; margin: 0 auto; }

        .footer-top {
            display: grid;
            grid-template-columns: 2fr 1fr 1fr 1fr;
            gap: 48px;
            margin-bottom: 40px;
        }

        .footer-brand p { font-size: 0.82rem; line-height: 1.75; color: rgba(255,255,255,0.45); margin-top: 12px; }
        .footer-logo { display: flex; align-items: center; gap: 10px; color: white; font-family: 'Nunito', sans-serif; font-weight: 900; font-size: 1.1rem; text-decoration: none; }

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
            .hero-inner { grid-template-columns: 1fr; }
            .hero-steps { flex-wrap: wrap; justify-content: center; }
            .guru-grid { grid-template-columns: repeat(2, 1fr); }
            .tipe-grid { grid-template-columns: 1fr; }
            .footer-top { grid-template-columns: 1fr 1fr; }
            .hero h1 { font-size: 2rem; }
        }

        @media (max-width: 480px) {
            .guru-grid { grid-template-columns: 1fr; }
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
                <li><a href="{{ route('siswa.sosial') }}">Sosial</a></li>
                <li><a href="{{ route('siswa.konseling') }}" class="active">Konseling</a></li>
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

        <div class="hero-inner">
            <div>
                <div class="hero-badge">
                    <span class="dot"></span>
                    Layanan Konseling
                </div>
                <h1>Pilih <span class="hl-red">Guru BK</span><br>yang Tepat Untukmu</h1>
                <p>Setiap orang butuh ruang aman untuk bercerita. Pilih Guru BK yang siap mendengarkan dan membantu mencari solusi terbaik untukmu.</p>
            </div>

            <div class="hero-steps">
                <div class="hero-step">
                    <div class="step-icon">👤</div>
                    <div class="step-num">Step 1</div>
                    <div class="step-label">Pilih<br>Guru BK</div>
                </div>
                <div class="hero-step">
                    <div class="step-icon">📅</div>
                    <div class="step-num">Step 2</div>
                    <div class="step-label">Pilih<br>Jadwal</div>
                </div>
                <div class="hero-step">
                    <div class="step-icon">✅</div>
                    <div class="step-num">Step 3</div>
                    <div class="step-label">Kirim<br>Booking</div>
                </div>
            </div>
        </div>
    </section>

    <!-- Main Content -->
    <div class="main-wrap">

        {{-- Notifications --}}
        @if(auth()->user()->unreadNotifications->count())
            <div style="margin-bottom:20px;">
                @foreach(auth()->user()->unreadNotifications as $notif)
                    <div class="notif-box">
                        🔔 {{ $notif->data['message'] ?? 'Anda memiliki notifikasi baru.' }}
                    </div>
                @endforeach
                @php auth()->user()->unreadNotifications->markAsRead(); @endphp
            </div>
        @endif

        @if ($errors->any())
            <div class="alert-error">
                <ul style="list-style:disc;padding-left:16px;">
                    @foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach
                </ul>
            </div>
        @endif

        @if (session('success'))
            <div class="alert-success">✅ {{ session('success') }}</div>
        @endif

        <!-- Step 1: Pilih Guru BK -->
        <div class="section-label">
            <div class="section-label-badge">1</div>
            <div class="section-label-text">Pilih Guru BK</div>
            <div class="section-label-sub">Klik kartu guru untuk melihat jadwal tersedia</div>
        </div>

        <div class="guru-grid">
            @forelse($gurus as $guru)
                <div class="guru-card" id="guru-card-{{ $guru->id }}" onclick="pilihGuru({{ $guru->id }}, '{{ addslashes($guru->nama) }}')">
                    <div class="guru-avatar">
                        <div class="guru-avatar-ring"></div>
                        {{ strtoupper(substr($guru->nama, 0, 1)) }}{{ strtoupper(substr(explode(' ', $guru->nama)[1] ?? 'K', 0, 1)) }}
                    </div>
                    <div class="guru-name">{{ $guru->nama }}</div>
                    <div class="guru-nip">{{ $guru->nip ?? 'Guru BK' }}</div>
                    <div class="guru-select-tag">
                        <svg width="12" height="12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                        Lihat Jadwal
                    </div>
                </div>
            @empty
                <div class="empty-guru">
                    <div style="font-size:2.5rem;margin-bottom:10px;">👩‍🏫</div>
                    <div>Tidak ada guru BK tersedia saat ini.</div>
                </div>
            @endforelse
        </div>

        <!-- Step 2: Jadwal -->
        <div id="jadwal-wrap">
            <div class="section-label" style="margin-bottom:20px;">
                <div class="section-label-badge">2</div>
                <div class="section-label-text">
                    Jadwal <span id="guru-label" style="color:var(--red);"></span>
                </div>
                <button class="ganti-guru-btn" onclick="batalPilihGuru()">
                    <svg width="13" height="13" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                    </svg>
                    Ganti Guru
                </button>
            </div>

            <div class="jadwal-table-wrap">
                <table class="jadwal-table">
                    <thead>
                        <tr>
                            <th>📅 Hari, Tanggal</th>
                            <th>🕐 Waktu</th>
                            <th style="text-align:right;">Booking</th>
                        </tr>
                    </thead>
                    <tbody id="jadwal-body">
                        <tr>
                            <td colspan="3" class="jadwal-placeholder">
                                Pilih guru BK untuk melihat jadwal tersedia.
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <p id="jadwal-kosong" style="display:none; padding:20px 0; color:#94a3b8; font-size:0.88rem; text-align:center;">
                😔 Belum ada jadwal untuk guru ini. Coba pilih guru lain.
            </p>
        </div>

    </div><!-- /main-wrap -->

    <!-- Modal 1: Pilih Tipe Konseling -->
    <div id="modal-tipe" class="modal-overlay" onclick="if(event.target===this) tutupModalTipe()">
        <div class="modal-box" onclick="event.stopPropagation()">
            <div class="modal-header">
                <div class="modal-header-icon">🎯</div>
                <div class="modal-header-text">
                    <div class="modal-title">Tipe Konseling</div>
                    <div class="modal-sub">Pilih jenis konseling yang sesuai kebutuhanmu</div>
                </div>
                <button class="modal-close" onclick="tutupModalTipe()">
                    <svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
            <div class="modal-body">
                <div class="tipe-grid">
                    <div class="tipe-card" onclick="pilihTipe('individu')">
                        <div class="tipe-icon">🙋</div>
                        <div class="tipe-label">Individu</div>
                        <div class="tipe-desc">Sesi pribadi antara kamu dan guru BK secara one-on-one</div>
                    </div>
                    <div class="tipe-card" onclick="pilihTipe('kelompok')">
                        <div class="tipe-icon">👥</div>
                        <div class="tipe-label">Kelompok</div>
                        <div class="tipe-desc">Sesi bersama beberapa siswa dengan topik yang sama</div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn-cancel" onclick="tutupModalTipe()">Batalkan</button>
            </div>
        </div>
    </div>

    <!-- Modal 2: Form Booking -->
    <div id="modal-form" class="modal-overlay" onclick="if(event.target===this) tutupModalForm()" style="overflow-y:auto;">
        <div class="modal-box wide" onclick="event.stopPropagation()" style="margin:auto;">
            <div class="modal-header">
                <div class="modal-header-icon">📝</div>
                <div class="modal-header-text">
                    <div class="modal-title">Form Booking Konseling</div>
                    <div class="modal-sub">Isi data dengan lengkap dan jelas</div>
                </div>
                <button class="modal-close" onclick="tutupModalForm()">
                    <svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
            <div class="modal-body" style="padding-bottom:8px;">
                <form id="form-booking" action="{{ route('siswa.konseling.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="jadwal_id" id="form_jadwal_id">
                    <input type="hidden" name="tanggal" id="form_tanggal">
                    <input type="hidden" name="tipe_konseling" id="form_tipe_konseling">

                    <div class="form-group">
                        <label class="form-label">Nama Siswa</label>
                        <input type="text"
                               value="{{ auth()->user()->siswa->nama ?? auth()->user()->name ?? '' }}"
                               readonly
                               class="form-input readonly">
                    </div>

                    <div class="form-group">
                        <label class="form-label">Kelas <span class="req">*</span></label>
                        @php $userKelas = auth()->user()->siswa->kelas ?? null; @endphp
                        <select id="form_kelas" name="kelas" class="form-select" {{ $userKelas ? 'disabled' : '' }} required>
                            @if($userKelas)
                                <option value="{{ $userKelas }}" selected>{{ $userKelas }}</option>
                            @else
                                <option value="">-- Pilih Kelas --</option>
                                @foreach(['X-A','X-B','X-C','XI-A','XI-B','XI-C','XII-A','XII-B','XII-C'] as $k)
                                    <option value="{{ $k }}">{{ $k }}</option>
                                @endforeach
                            @endif
                        </select>
                        @if($userKelas)
                            <input type="hidden" name="kelas" value="{{ $userKelas }}">
                        @endif
                    </div>

                    <div class="form-group">
                        <label class="form-label">Topik Konseling <span class="req">*</span></label>
                        <select name="topik_id" id="form_topik_id" class="form-select" required>
                            <option value="">-- Pilih Topik --</option>
                            @foreach ($topiks as $topik)
                                <option value="{{ $topik->id }}">{{ $topik->nama_topik }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Hal yang ingin dibicarakan <span class="req">*</span></label>
                        <textarea name="catatan_siswa" id="form_catatan" rows="4"
                                  placeholder="Ceritakan masalah atau topik yang ingin kamu diskusikan dengan guru BK..."
                                  class="form-textarea"
                                  required minlength="10" maxlength="1000"></textarea>
                        <div class="form-hint">Minimal 10 karakter, maksimal 1000 karakter</div>
                    </div>

                    <div class="form-actions">
                        <button type="submit" class="btn-submit">
                            Kirim Permintaan Booking ✉️
                        </button>
                        <button type="button" onclick="tutupModalForm()" class="btn-back">Batal</button>
                    </div>
                </form>
            </div>
            <div style="padding:0 28px 20px;"></div>
        </div>
    </div>

    <!-- Footer -->
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
        let selectedGuruId = null;
        let selectedGuruName = '';
        let slots = [];

        function pilihGuru(guruId, guruName) {
            selectedGuruId = guruId;
            selectedGuruName = guruName;

            // Update card styles
            document.querySelectorAll('.guru-card').forEach(card => {
                card.classList.remove('active');
            });
            document.getElementById('guru-card-' + guruId).classList.add('active');

            // Update label
            document.getElementById('guru-label').textContent = guruName;

            // Show jadwal section with animation
            const wrap = document.getElementById('jadwal-wrap');
            wrap.classList.add('visible');

            // Scroll to jadwal
            setTimeout(() => {
                wrap.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
            }, 100);

            loadJadwal(guruId);
        }

        function batalPilihGuru() {
            selectedGuruId = null;
            selectedGuruName = '';
            document.querySelectorAll('.guru-card').forEach(card => card.classList.remove('active'));
            document.getElementById('jadwal-wrap').classList.remove('visible');
            document.getElementById('jadwal-body').innerHTML = '<tr><td colspan="3" class="jadwal-placeholder">Pilih guru BK untuk melihat jadwal tersedia.</td></tr>';
        }

        function loadJadwal(guruId) {
            const tbody = document.getElementById('jadwal-body');
            const kosong = document.getElementById('jadwal-kosong');

            tbody.innerHTML = `
                <tr>
                    <td colspan="3" class="jadwal-placeholder">
                        <div style="display:flex;align-items:center;justify-content:center;gap:10px;">
                            <div style="width:18px;height:18px;border:2.5px solid #e2e8f0;border-top-color:var(--teal);border-radius:50%;animation:spin 0.7s linear infinite;"></div>
                            Memuat jadwal...
                        </div>
                    </td>
                </tr>`;
            kosong.style.display = 'none';

            fetch('{{ url("/api/guru") }}/' + guruId + '/jadwals')
                .then(r => {
                    if (!r.ok) throw new Error('HTTP ' + r.status);
                    return r.json();
                })
                .then(data => {
                    slots = data.slots || [];
                    tbody.innerHTML = '';

                    if (slots.length === 0) {
                        tbody.innerHTML = `<tr><td colspan="3" class="jadwal-placeholder">😔 Belum ada jadwal tersedia untuk guru ini.</td></tr>`;
                        return;
                    }

                    slots.forEach((slot, i) => {
                        const tr = document.createElement('tr');
                        tr.style.animation = `fadeInRow 0.3s ease ${i * 0.06}s both`;
                        tr.innerHTML = `
                            <td>
                                <div style="font-weight:600;color:#1e293b;">${slot.tanggal_label}</div>
                            </td>
                            <td>
                                <span class="waktu-badge">
                                    🕐 ${slot.waktu_label}
                                </span>
                            </td>
                            <td style="text-align:right;">
                                <button type="button" onclick="bukaAtur(${slot.jadwal_id}, '${slot.tanggal}')" class="atur-btn">
                                    Booking
                                    <svg width="13" height="13" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                                    </svg>
                                </button>
                            </td>`;
                        tbody.appendChild(tr);
                    });
                })
                .catch(err => {
                    tbody.innerHTML = `<tr><td colspan="3" class="jadwal-placeholder" style="color:#ef4444;">❌ Gagal memuat jadwal. Silakan coba lagi.</td></tr>`;
                });
        }

        function bukaAtur(jadwalId, tanggal) {
            document.getElementById('form_jadwal_id').value = jadwalId;
            document.getElementById('form_tanggal').value = tanggal;
            document.getElementById('modal-tipe').classList.add('open');
        }

        function pilihTipe(tipe) {
            document.getElementById('form_tipe_konseling').value = tipe;
            tutupModalTipe();
            document.getElementById('modal-form').classList.add('open');
        }

        function tutupModalTipe() {
            document.getElementById('modal-tipe').classList.remove('open');
        }

        function tutupModalForm() {
            document.getElementById('modal-form').classList.remove('open');
        }

        // Keyboard close
        document.addEventListener('keydown', e => {
            if (e.key === 'Escape') {
                tutupModalTipe();
                tutupModalForm();
            }
        });
    </script>

    <style>
        @keyframes spin {
            to { transform: rotate(360deg); }
        }
        @keyframes fadeInRow {
            from { opacity: 0; transform: translateX(-10px); }
            to { opacity: 1; transform: translateX(0); }
        }
    </style>

</body>
</html>