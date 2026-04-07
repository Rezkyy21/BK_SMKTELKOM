
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Konseling - SMK Telkom</title>

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700;800;900&family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

    <style>
            :root {
                --red: #E63329;
                --red-dark: #b91c1c;
                --teal: #dc2626;
                --cyan: #ef4444;
                --emerald: #f87171;
                --orange: #fb7185;
            }

        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
           font-family: 'Poppins', sans-serif;
            background: #f8fafc;
            overflow-x: hidden;
            -webkit-font-smoothing: antialiased;
                    
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

       .nav-link {
    position: relative;
    font-weight: 500;
    color: #374151;
    transition: color 0.2s;
}

.nav-link:hover { 
    color: #111; 
}

.nav-link.active {
    color: #e53e3e;
    font-weight: 700;
}

.nav-link.active::after {
    content: '';
    position: absolute;
    bottom: -4px;
    left: 0;
    right: 0;
    height: 2px;
    background: #e53e3e;
    border-radius: 2px;
}

.logo-img{
    width:40px;
    height:60px;
    object-fit:contain;
}
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
            border-bottom: 1px solid #f9f1f1;
            cursor: pointer;
            transition: background 0.15s;
        }
        .notif-item:hover { background: #fcf8f8; }
        .notif-item:last-child { border-bottom: none; }

        .notif-item-title {
            font-weight: 600;
            font-size: 0.85rem;
            color: #3b1e1e;
            margin-bottom: 2px;
        }

        .notif-item-desc {
            font-size: 0.78rem;
            color: #b89494;
            margin-bottom: 4px;
        }

        .notif-item-time {
            font-size: 0.73rem;
            color: #e1cbcb;
        }

        .notif-empty {
            padding: 32px 16px;
            text-align: center;
            color: #b89494;
            font-size: 0.85rem;
        }
        .dropdown-header { padding: 14px 16px; border-bottom: 1px solid #f9f1f1; }
        .dropdown-header .name { font-weight: 700; font-size: 0.88rem; color: #3b1e1e; }
        .dropdown-header .email { font-size: 0.78rem; color: #b89494; margin-top: 2px; }
        .dropdown-item {
            display: block; padding: 10px 16px; font-size: 0.85rem;
            color: #694747; text-decoration: none; transition: background 0.15s;
            font-family: 'Poppins', sans-serif;
        }
        .dropdown-item:hover { background: #f8fafc; }

        /* ===== HERO ===== */
        .hero {
            background: white;
            padding: 56px 24px 64px;
            position: relative;
            overflow: hidden;
            border-bottom: 1px solid #f9f1f1;
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
            background: radial-gradient(circle, rgba(184, 20, 20, 0.06), transparent);
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
            font-size: 2.8rem;
             letter-spacing: -0.02em;
            font-weight: 900;
            line-height: 1.2;
            color: #3b1e1e;
            margin-bottom: 14px;
        }

        .hero h1 .hl-red {
            background: linear-gradient(135deg, var(--red), var(--orange));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .hero p {
            color: #8b6464;
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
            border: 1px solid #f9f1f1;
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
            transition: all .3s ease;
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
            transform: translateY(-6px) scale(1.02);
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
            background: linear-gradient(135deg, var(--red), var(--orange));
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
           box-shadow: 0 6px 20px rgba(230,51,41,0.4);
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
            border: 2px solid #f9f1f1;
            border-radius: 18px;
            padding: 24px 20px;
            text-align: center;
            cursor: pointer;
            transition: all 0.25s;
            background: white;
        }

        .tipe-card:hover {
            border-color: var(--emerald);
            background: linear-gradient(135deg, #fdf0f0, #fbcccc);
            transform: translateY(-3px);
            box-shadow: 0 8px 24px rgba(184, 20, 20, 0.15);
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
        border-color: var(--red);
        box-shadow: 0 0 0 3px rgba(230,51,41,0.15);
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
            background: #3b1e1e;
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
.menu-btn{
    display:none;
    font-size:26px;
    background:none;
    border:none;
    cursor:pointer;
}
.nav-links{
    display:flex;
    align-items:center;
    gap:28px;
    list-style:none;
}
        /* Responsive */
        @media (max-width: 768px) {
            .hero-inner { grid-template-columns: 1fr; }
            .hero-steps { flex-wrap: wrap; justify-content: center; }
            .guru-grid { grid-template-columns: repeat(2, 1fr); }
            .tipe-grid { grid-template-columns: 1fr; }
            .footer-top { grid-template-columns: 1fr 1fr; }
            .hero h1 { font-size: 2rem; }


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
    display:none;
    border-top:1px solid #eee;
    gap:0;
    align-items:flex-start;
}

    .nav-links li{
        border-bottom:1px solid #f1f1f1;
    }

   .nav-links a{
    display:block;
    padding:14px 20px;
    text-align:left;
    width:100%;
}

    .nav-links.show{
        display:flex;
    }
        }

        @media (max-width: 480px) {
            .guru-grid { grid-template-columns: 1fr; }
        }
        .guru-avatar {
    position: relative;
    width: 70px;
    height: 70px;
    border-radius: 50%;
    overflow: hidden;
    display: flex;
    align-items: center;
    justify-content: center;
}

        .guru-card-recommended {
            max-width: 320px;
            margin: 0 auto;
            transform: scale(1.08);
            box-shadow: 0 16px 48px rgba(230,51,41,0.25);
            border: 2px solid var(--red) !important;
        }

        .guru-card-recommended .guru-avatar {
            width: 84px;
            height: 84px;
        }

        .guru-card-recommended .guru-name {
            font-size: 1rem;
            font-weight: 900;
        }

.guru-avatar-img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}
@keyframes spin {
    to { transform: rotate(360deg); }
}

@keyframes fadeInRow {
    from { opacity: 0; transform: translateX(-10px); }
    to { opacity: 1; transform: translateX(0); }
}
    </style>
</head>
<body>

    <!-- Navigation -->

            <!-- Logo -->
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

            <!-- Menu -->
           <ul class="nav-links" id="navMenu">
    <li><a href="{{ route('siswa.dashboard') }}" class="nav-link">Home</a></li>
    <li><a href="{{ route('siswa.karir') }}" class="nav-link">Karir</a></li>
    <li><a href="{{ route('siswa.belajar') }}" class="nav-link">Belajar</a></li>
    <li><a href="{{ route('siswa.pribadi') }}" class="nav-link">Pribadi</a></li>
    <li><a href="{{ route('siswa.sosial') }}" class="nav-link">Sosial</a></li>
    <li><a href="{{ route('siswa.konseling') }}" class="nav-link active">Konseling</a></li>
</ul>
            @guest
                <li><a href="{{ route('login') }}">Login</a></li>
            @endguest
        


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
    </div>
</nav>
    <!-- Hero -->
    <section class="hero ">
        <div class="hero-blob hb1"></div>
        <div class="hero-blob hb2"></div>

        <div class="hero-inner">
            <div>
                <div class="hero-badge">
                    <span class="dot"></span>
                   Konseling
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

        {{-- Notifications - Show Only Latest --}}
        @if(auth()->user()->unreadNotifications->count())
            @php 
                $latestNotif = auth()->user()->unreadNotifications->first();
                $waLink = null;
                $guruNama = 'Guru BK Anda';
                
                // Try 1: Direct wa_link from notification
                if (isset($latestNotif->data['wa_link']) && $latestNotif->data['wa_link']) {
                    $waLink = $latestNotif->data['wa_link'];
                    $guruNama = $latestNotif->data['guru_nama'] ?? $guruNama;
                }
                
                // Try 2: From booking if we have booking_id  
                // Use 'guru' not 'guruBk' because Jadwal relationship is 'guru'
                if (!$waLink && isset($latestNotif->data['booking_id'])) {
                    $booking = \App\Models\Booking::with('jadwal.guru')->find($latestNotif->data['booking_id']);
                    
                    if ($booking && $booking->jadwal && $booking->jadwal->guru) {
                        $guru = $booking->jadwal->guru;
                        if ($guru->no_whatsapp) {
                            $cleaned = preg_replace('/[^0-9]/', '', $guru->no_whatsapp);
                            if ($cleaned) {
                                $waLink = 'https://wa.me/' . $cleaned . '?text=' . urlencode('Halo ' . $guru->nama . ', saya ingin mengkonfirmasi jadwal konseling kami.');
                                $guruNama = $guru->nama;
                            }
                        }
                    }
                }
                
                // Try 3: Get ANY guru with wa from siswa's recent booking
                if (!$waLink && auth()->user()->siswa) {
                    $booking = \App\Models\Booking::where('siswa_id', auth()->user()->siswa->id)
                        ->with('jadwal.guru')
                        ->orderBy('id', 'desc')
                        ->first();
                    
                    if ($booking && $booking->jadwal && $booking->jadwal->guru && $booking->jadwal->guru->no_whatsapp) {
                        $guru = $booking->jadwal->guru;
                        $cleaned = preg_replace('/[^0-9]/', '', $guru->no_whatsapp);
                        if ($cleaned) {
                            $waLink = 'https://wa.me/' . $cleaned . '?text=' . urlencode('Halo ' . $guru->nama . ', saya ingin mengkonfirmasi jadwal konseling kami.');
                            $guruNama = $guru->nama;
                        }
                    }
                }
            @endphp
            <div style="margin-bottom:20px;">
                <!-- Booking Status Notification -->
                <div style="background: linear-gradient(135deg, #f0fdf4, #dcfce7); border: 2px solid #86efac; border-left: 5px solid #22c55e; border-radius: 12px; padding: 16px 18px; margin-bottom: 16px; color: #166534; position: relative;">
                    <button type="button" onclick="this.parentElement.style.display='none';" style="position: absolute; top: 12px; right: 12px; background: none; border: none; color: #22c55e; font-size: 1.2rem; cursor: pointer; padding: 0; width: 24px; height: 24px; display: flex; align-items: center; justify-content: center;">✕</button>
                    <div style="display: flex; align-items: center; gap: 10px; margin-bottom: 12px;">
                        @php
                            $notifStatus = $latestNotif->data['status'] ?? null;
                        @endphp
                        @if(in_array($notifStatus, ['menunggu', 'disetujui']) && (strpos($latestNotif->data['message'], 'disetujui') !== false || strpos($latestNotif->data['message'], 'diterima') !== false))
                            <svg width="20" height="20" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/>
                            </svg>
                            <strong style="font-size: 1rem;">✅ Booking Anda Telah Disetujui!</strong>
                        @else
                            <svg width="20" height="20" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 15h-2v-2h2v2zm0-4h-2V7h2v6z"/>
                            </svg>
                            <strong style="font-size: 1rem;">⚠️ Update Booking</strong>
                        @endif
                    </div>
                    <p style="font-size: 0.9rem; margin-bottom: 14px; color: #15803d;">{{ $latestNotif->data['message'] ?? 'Ada update untuk booking Anda.' }}</p>
                    
                    @if($waLink)
                        <a href="{{ $waLink }}" target="_blank" style="display: inline-flex; align-items: center; gap: 8px; background: #22c55e; color: white; padding: 11px 18px; border-radius: 8px; text-decoration: none; font-weight: 600; font-size: 0.9rem; transition: background 0.2s; cursor: pointer; border: none;">
                            <svg width="16" height="16" fill="white" viewBox="0 0 24 24">
                                <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347z"/>
                                <path d="M12 0C5.373 0 0 5.373 0 12c0 2.123.555 4.116 1.529 5.843L0 24l6.335-1.505A11.945 11.945 0 0012 24c6.627 0 12-5.373 12-12S18.627 0 12 0zm0 21.818a9.818 9.818 0 01-5.006-1.371l-.36-.214-3.732.886.939-3.618-.235-.373A9.818 9.818 0 012.182 12C2.182 6.58 6.58 2.182 12 2.182S21.818 6.58 21.818 12 17.42 21.818 12 21.818z"/>
                            </svg>
                            💬 Hubungi via WhatsApp
                        </a>
                    @else
                        <p style="font-size: 0.85rem; color: #15803d; margin: 0;">
                            <strong>ℹ️ Catatan:</strong> Silakan hubungi {{ $guruNama }} melalui nomor WhatsApp yang tersedia.
                        </p>
                    @endif
                </div>
            </div>
        @endif

        @if ($errors->any())
            <div class="alert-error">
                <ul style="list-style:disc;padding-left:16px;">
                    @foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach
                </ul>
            </div>
        @endif

        @if(session('error'))
            <div class="alert-error">⚠️ {{ session('error') }}</div>
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

                    <!-- Rekomendasi Guru BK -->
                    @if($recommendedGuru)
                    <div class="mb-8">
                        <div class="flex items-center justify-center gap-3 mb-6">
                            <div class="px-4 py-2 bg-red-100 text-red-700 rounded-full text-sm font-semibold border-2 border-red-200">
                                ⭐ Rekomendasi untuk Kamu
                            </div>
                        </div>
                        <div class="flex justify-center">
                            <div class="guru-card guru-card-recommended border-2 border-red-300"
                                 data-classes='@json($recommendedGuru->classRooms->values() ?? [])'
                                 id="guru-card-{{ $recommendedGuru->id }}"
                                 onclick="pilihGuru({{ $recommendedGuru->id }}, '{{ addslashes($recommendedGuru->nama) }}')">

                                <div class="guru-avatar">
                                    <div class="guru-avatar-ring"></div>

                                    @if($recommendedGuru->photo)
                                        <img
                                            src="{{ asset('storage/' . $recommendedGuru->photo) }}"
                                            alt="{{ $recommendedGuru->nama }}"
                                            class="guru-avatar-img">
                                    @else
                                        {{ strtoupper(substr($recommendedGuru->nama, 0, 1)) }}
                                        {{ strtoupper(substr(explode(' ', $recommendedGuru->nama)[1] ?? 'K', 0, 1)) }}
                                    @endif
                                </div>

                                <div class="guru-name">{{ $recommendedGuru->nama }}</div>

                                <div class="guru-select-tag">
                                    @if($recommendedGuru->jadwals && $recommendedGuru->jadwals->count() > 0)
                                        Lihat Jadwal
                                    @else
                                        Tidak ada jadwal
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Divider -->
                    <div class="flex items-center justify-center mb-8">
                        <div class="flex-1 h-px bg-gray-200"></div>
                        <div class="px-4 py-2 bg-gray-100 text-gray-700 rounded-full text-sm font-semibold mx-4">
                            👥 Semua Guru BK
                        </div>
                        <div class="flex-1 h-px bg-gray-200"></div>
                    </div>
                    @endif
                        <div class="guru-grid">
                            @forelse($otherGurus as $guru)
                                <div class="guru-card"
                                     data-classes='@json($guru->classRooms->values() ?? [])'
                                     id="guru-card-{{ $guru->id }}"
                                     onclick="pilihGuru({{ $guru->id }}, '{{ addslashes($guru->nama) }}')">

                                    <div class="guru-avatar">
                                        <div class="guru-avatar-ring"></div>

                                        @if($guru->photo)
                                            <img
                                                src="{{ asset('storage/' . $guru->photo) }}"
                                                alt="{{ $guru->nama }}"
                                                class="guru-avatar-img">
                                        @else
                                            {{ strtoupper(substr($guru->nama, 0, 1)) }}
                                            {{ strtoupper(substr(explode(' ', $guru->nama)[1] ?? 'K', 0, 1)) }}
                                        @endif
                                    </div>

                                    <div class="guru-name">{{ $guru->nama }}</div>

                                    <div class="guru-select-tag">
                                        @if($guru->jadwals && $guru->jadwals->count() > 0)
                                            Lihat Jadwal
                                        @else
                                            Tidak ada jadwal
                                        @endif
                                    </div>
                                </div>
                            @empty
                                <div class="empty-guru">
                                    <div>👩‍🏫</div>
                                    <div>Tidak ada guru BK lainnya tersedia.</div>
                                </div>
                            @endforelse
                        </div>
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
                Belum ada jadwal untuk guru ini. Coba pilih guru lain.
            </p>
        </div>

    </div><!-- /main-wrap -->

    <!-- Modal 1: Pilih Tipe Konseling -->
    <div id="modal-tipe" class="modal-overlay" onclick="if(event.target===this) tutupModalTipe()">
        <div class="modal-box" onclick="event.stopPropagation()">
            <div class="modal-header">
               
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
        <div class="modal-body space-y-5 py-6"> <!-- padding top & bottom ditambah -->

            <form id="form-booking" action="{{ route('siswa.konseling.store') }}" method="POST">
                @csrf
                <input type="hidden" name="guru_id" id="form_guru_id">
                <input type="hidden" name="jadwal_id" id="form_jadwal_id">
                <input type="hidden" name="tanggal" id="form_tanggal">
                <input type="hidden" name="tipe_konseling" id="form_tipe_konseling">

                <!-- Nama -->
                <div class="my-4"> <!-- margin top & bottom -->
                    <label class="text-sm font-semibold text-gray-700 mb-1 block">
                        Nama Siswa
                    </label>
                    <div class="flex items-center bg-gray-50 border border-gray-200 rounded-xl px-3 py-2">
                        <svg class="w-4 h-4 text-gray-400 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A7.968 7.968 0 0112 15c2.5 0 4.77 1.15 6.879 2.804M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                        <input type="text"
                               value="{{ auth()->user()->siswa->nama ?? auth()->user()->name ?? '' }}"
                               readonly
                               class="bg-transparent w-full text-sm text-gray-700 outline-none">
                    </div>
                </div>

                <!-- Kelas -->
                <div class="my-4">
                    <label class="text-sm font-semibold text-gray-700 mb-1 block">
                        Kelas
                    </label>
                    <input type="hidden" name="class_id" value="{{ $studentClass->id ?? '' }}">
                    <div class="flex items-center bg-gray-50 border border-gray-200 rounded-xl px-3 py-2">
                        <svg class="w-4 h-4 text-gray-400 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                        </svg>
                        <input type="text"
                               value="{{ $studentClass?->full_name ?? '-' }}"
                               readonly
                               class="bg-transparent w-full text-sm text-gray-700 outline-none">
                    </div>
                </div>
  
                <!-- TOPIK -->
                <div class="my-4">
                    <label class="text-sm font-semibold text-gray-700 mb-1 block">
                        Topik Konseling <span class="text-red-500">*</span>
                    </label>
                    <select name="topik_id"
                            class="w-full border border-gray-200 rounded-xl px-3 py-2 text-sm focus:ring-2 focus:ring-red-200 focus:border-red-400 transition"
                            required>
                        <option value="">Pilih Topik Konseling</option>
                        @foreach ($topiks as $topik)
                            <option value="{{ $topik->id }}">{{ $topik->nama_topik }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- CATATAN -->
                <div class="my-4">
                    <label class="text-sm font-semibold text-gray-700 mb-1 block">
                        Ceritakan masalahmu <span class="text-red-500">*</span>
                    </label>
                    <textarea name="catatan_siswa"
                              rows="4"
                              placeholder="Contoh: Saya ingin berdiskusi tentang pilihan kuliah setelah lulus..."
                              class="w-full border border-gray-200 rounded-xl px-3 py-2 text-sm focus:ring-2 focus:ring-red-200 focus:border-red-400 transition resize-none"
                              required></textarea>
                    <p class="text-xs text-gray-400 mt-1">
                        Minimal 10 karakter
                    </p>
                </div>

                <!-- INFO BOX -->
                <div class="bg-red-50 border border-red-100 rounded-xl p-3 text-xs text-red-600 my-4">
                    Permintaan konseling akan ditinjau oleh guru BK.  
                    Silakan tunggu konfirmasi setelah mengirim booking.
                </div>

                <!-- BUTTON -->
                <div class="flex gap-3 pt-2">
                    <button type="button"
                            onclick="tutupModalForm()"
                            class="flex-1 border border-gray-200 py-2 rounded-xl text-sm hover:bg-gray-50 transition">
                        Batal
                    </button>

                    <button type="submit"
                            class="flex-1 bg-red-500 text-white py-2 rounded-xl text-sm font-semibold hover:bg-red-600 transition">
                        Kirim Booking
                    </button>
                </div>

            </form>
        </div>
    </div>
</div>
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
        let selectedGuruId = null;
        let selectedGuruName = '';
        let slots = [];

        function pilihGuru(guruId, guruName) {
    selectedGuruId = guruId;
    selectedGuruName = guruName;
    

    // highlight card
    document.querySelectorAll('.guru-card').forEach(card => {
        card.classList.remove('active');
    });

    const selectedCard = document.getElementById('guru-card-' + guruId);
    selectedCard.classList.add('active');

    // ✅ AMBIL DATA KELAS DARI GURU
    const classes = JSON.parse(selectedCard.dataset.classes || '[]');

    const select = document.querySelector('select[name="class_id"]');
    const hiddenClassIdInput = document.querySelector('input[name="class_id"]');

    if (select) {
        // reset
        select.innerHTML = '<option value="">Pilih Kelas</option>';

        if (classes.length === 0) {
            select.innerHTML = '<option value="">Guru ini belum punya kelas</option>';
        } else {
            // isi dropdown
            classes.forEach(cls => {
                const option = document.createElement('option');
                option.value = cls.id;
                option.textContent = cls.full_name;
                select.appendChild(option);
            });
        }
    }

    // Set hidden class_id if present (student class is default)
    if (hiddenClassIdInput && hiddenClassIdInput.value === '') {
        hiddenClassIdInput.value = '{{ $studentClass->id ?? '' }}';
    }

    const wrap = document.getElementById('jadwal-wrap');
    wrap.classList.add('visible');

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
                        tbody.innerHTML = `<tr><td colspan="3" class="jadwal-placeholder">Belum ada jadwal tersedia untuk guru ini.</td></tr>`;
                        return;
                    }

                    slots.forEach((slot, i) => {
                        const tr = document.createElement('tr');
                        tr.style.animation = `fadeInRow 0.3s ease ${i * 0.06}s both`;

                        const isFull = slot.kuota <= 0;
                        const actionButton = isFull
                            ? '<button type="button" class="atur-btn" style="opacity:0.5;cursor:not-allowed;" disabled>Kuota Penuh</button>'
                            : `<button type="button" onclick="bukaAtur(${slot.jadwal_id}, '${slot.tanggal}')" class="atur-btn">Booking <svg width="13" height="13" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg></button>`;

                        tr.innerHTML = `
                            <td>
                                <div style="font-weight:600;color:#1e293b;">${slot.tanggal_label}</div>
                                <small style="color:#64748b;">Kuota: ${slot.kuota} siswa</small>
                            </td>
                            <td>
                                <span class="waktu-badge">
                                    🕐 ${slot.waktu_label}
                                </span>
                            </td>
                            <td style="text-align:right;">${actionButton}</td>`;

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

            // ✅ TAMBAHAN
            document.getElementById('form_guru_id').value = selectedGuruId;

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
   

   
  
        const menuBtn = document.getElementById("menuBtn");
        const navMenu = document.getElementById("navMenu");

        menuBtn.addEventListener("click", () => {
            navMenu.classList.toggle("show");
        });
   
 </script>
</body>
</html>





