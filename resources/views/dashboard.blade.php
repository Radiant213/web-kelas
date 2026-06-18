<!DOCTYPE html>
<html lang="id">
@php
    $settings = \App\Models\GeneralSetting::first();
@endphp

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Kelas XI PPLG 2</title>
    <link rel="icon" type="image/png" href="{{ asset('images/LogoKelas.png') }}">
    <style>
        :root {
            --primary: #2563eb;
            --primary-dark: #1d4ed8;
            --secondary: #0ea5e9;
            --dark: #1e293b;
            --light: #f8fafc;
            --gray: #64748b;
            --success: #10b981;
            --warning: #f59e0b;
            --danger: #ef4444;

            /* Theme Variables */
            --bg-body: #f1f5f9;
            --bg-card: #ffffff;
            --text-main: #1e293b;
            --text-muted: #64748b;
            --border-color: #e2e8f0;
            --shadow-color: rgba(0, 0, 0, 0.1);
        }

        .dark {
            --bg-body: #0f172a;
            --bg-card: #1e293b;
            --text-main: #f8fafc;
            --text-muted: #94a3b8;
            --border-color: #334155;
            --shadow-color: rgba(0, 0, 0, 0.3);
            --light: #1e293b;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            scroll-behavior: smooth;
        }

        body {
            background-color: var(--bg-body);
            color: var(--text-main);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        /* Navbar Styles */
        .navbar {
            background: var(--bg-card);
            box-shadow: 0 2px 10px var(--shadow-color);
            padding: 0 20px;
            position: fixed;
            /* Fixed position for scroll effect */
            top: 0;
            width: 100%;
            z-index: 1000;
            transition: transform 0.3s ease-in-out;
        }

        .navbar.navbar-hidden {
            transform: translateY(-100%);
        }

        .nav-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            max-width: 1200px;
            margin: 0 auto;
            height: 70px;
        }

        .logo-container {
            display: flex;
            align-items: center;
        }

        .logo-image {
            height: 45px;
            width: auto;
            margin-right: 10px;
            border-radius: 8px; /* Optional: rounded corners */
        }

        .logo-text {
            font-size: 20px;
            font-weight: 700;
            color: var(--text-main);
        }

        .user-name {
            font-weight: 600;
            color: var(--text-main);
        }

        /* User Dropdown */
        .user-dropdown {
            position: absolute;
            top: 100%;
            right: 0;
            width: 220px;
            background: var(--bg-card);
            border: 1px solid var(--border-color);
            border-radius: 12px;
            box-shadow: 0 10px 25px var(--shadow-color);
            padding: 8px 0;
            display: none; /* Hidden by default */
            z-index: 1001;
            margin-top: 10px;
        }

        .user-dropdown.show {
            display: block;
            animation: fadeIn 0.2s ease-out;
        }

        .dropdown-header {
            padding: 10px 20px;
            border-bottom: 1px solid #f1f5f9;
            margin-bottom: 5px;
        }

        .dropdown-user-name {
            font-weight: 700;
            color: var(--text-main);
            font-size: 16px;
        }

        .dropdown-user-nis {
            font-size: 12px;
            color: var(--gray);
        }

        .dropdown-item {
            display: block;
            padding: 10px 20px;
            color: var(--text-main);
            text-decoration: none;
            font-size: 14px;
            transition: background 0.2s;
            cursor: pointer;
            width: 100%;
            text-align: left;
            border: none;
            background: none;
        }

        .dropdown-item:hover {
            background: var(--bg-body);
            color: var(--primary);
        }

        .dropdown-divider {
            height: 1px;
            background: #f1f5f9;
            margin: 5px 0;
        }

        .nav-menu {
            display: flex;
            list-style: none;
        }

        .nav-item {
            margin-left: 30px;
            position: relative;
        }

        .nav-link {
            text-decoration: none;
            color: var(--text-main);
            font-weight: 500;
            padding: 10px 0;
            transition: color 0.3s;
        }

        .nav-link:hover {
            color: var(--primary);
        }

        .nav-link.active {
            color: var(--primary);
        }

        .user-info {
            display: flex;
            align-items: center;
            cursor: pointer;
            position: relative; /* For dropdown positioning */
            padding: 5px 10px;
            border-radius: 8px;
            transition: background 0.2s;
        }

        .user-info:hover {
            background: var(--bg-body);
        }

        .user-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: var(--primary);
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 10px;
            font-weight: bold;
        }

        /* Hero Section with Class Photo */
        .hero-section {
            /* Ganti URL ini dengan foto kelas yang asli */
            background: linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.6)),
                url("{{ $settings && $settings->hero_image ? asset('storage/' . $settings->hero_image) : asset('images/foto-sekelas-pageawal.jpg') }}");
            background-size: cover;
            background-position: center;
            height: 100vh;
            /* Full height */
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            text-align: center;
            padding: 0 20px;
            position: relative;
        }

        .hero-content {
            max-width: 800px;
            animation: fadeIn 1s ease-out;
        }

        .hero-title {
            font-size: 48px;
            font-weight: 800;
            margin-bottom: 20px;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
            color: white; /* Hero text should stay white as it is on an image */
        }

        .hero-subtitle {
            font-size: 24px;
            margin-bottom: 40px;
            opacity: 0.9;
            font-weight: 300;
        }

        .hero-buttons {
            display: flex;
            justify-content: center;
            gap: 15px;
        }

        .btn-primary {
            background: var(--primary);
            color: white;
            border: none;
            padding: 15px 35px;
            border-radius: 50px;
            font-size: 18px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
            box-shadow: 0 4px 15px rgba(37, 99, 235, 0.4);
            text-decoration: none;
            display: inline-block;
        }

        .btn-primary:hover {
            background: var(--primary-dark);
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(37, 99, 235, 0.5);
        }

        /* About Section */
        .about-section {
            background: var(--bg-card);
            padding: 100px 20px;
        }

        .about-container {
            max-width: 1200px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 60px;
            align-items: center;
        }

        .about-text h2 {
            font-size: 36px;
            color: var(--text-main);
            margin-bottom: 20px;
            font-weight: 700;
        }

        .about-text p {
            font-size: 18px;
            color: var(--text-muted);
            line-height: 1.8;
            margin-bottom: 20px;
        }

        .about-image-card {
            background: var(--bg-card);
            padding: 15px;
            border-radius: 20px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
            transform: rotate(2deg);
            transition: transform 0.3s;
        }

        .about-image-card:hover {
            transform: rotate(0deg) scale(1.02);
        }

        .about-image {
            width: 100%;
            border-radius: 15px;
            height: 350px;
            object-fit: cover;
        }

        /* Main Content - Student Grid */
        .main-content {
            max-width: 1200px;
            margin: 0 auto;
            padding: 80px 20px;
            flex: 1;
        }

        .section-title-container {
            text-align: center;
            margin-bottom: 60px;
        }

        .section-title {
            font-size: 36px;
            color: var(--text-main);
            margin-bottom: 15px;
            font-weight: 700;
        }

        .section-subtitle {
            color: var(--text-muted);
            font-size: 18px;
        }

        .student-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 40px;
            margin-bottom: 40px;
        }

        /* Custom Scrollbar */
        .student-grid::-webkit-scrollbar {
            height: 10px;
        }

        .student-grid::-webkit-scrollbar-track {
            background: #f1f5f9;
            border-radius: 10px;
        }

        .student-grid::-webkit-scrollbar-thumb {
            background: #cbd5e1;
            border-radius: 10px;
            transition: background 0.3s;
        }

        .student-grid::-webkit-scrollbar-thumb:hover {
            background: var(--primary);
        }

        .student-card {
            background: var(--bg-card);
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            cursor: pointer;
            position: relative;
        }

        .student-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
        }

        .student-photo {
            width: 100%;
            aspect-ratio: 3/4;
            object-fit: cover;
            background-color: #e2e8f0;
        }

        .student-info {
            padding: 20px;
            text-align: center;
            min-height: 80px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .student-name {
            font-size: 18px;
            font-weight: 700;
            color: var(--text-main);
            margin-bottom: 5px;
        }

        .student-nis {
            font-size: 14px;
            color: var(--text-muted);
        }

        .card-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(37, 99, 235, 0.8);
            display: flex;
            align-items: center;
            justify-content: center;
            opacity: 0;
            transition: opacity 0.3s;
        }

        .student-card:hover .card-overlay {
            opacity: 1;
        }

        .view-profile-btn {
            color: white;
            border: 2px solid white;
            padding: 10px 25px;
            border-radius: 30px;
            font-weight: 600;
            text-decoration: none;
            transform: scale(0.8);
            transition: transform 0.3s;
        }

        .student-card:hover .view-profile-btn {
            transform: scale(1);
        }

        /* Pagination Styles */
        .pagination-container {
            display: flex;
            justify-content: center;
            gap: 10px;
            margin-top: 20px;
        }

        .page-btn {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            border: 2px solid var(--primary);
            background: var(--bg-card);
            color: var(--primary);
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .page-btn:hover,
        .page-btn.active {
            background: var(--primary);
            color: white;
        }

        /* Toggle Switch */
        .theme-switch {
            position: relative;
            display: inline-block;
            width: 50px;
            height: 24px;
        }

        .theme-switch input {
            opacity: 0;
            width: 0;
            height: 0;
        }

        .slider {
            position: absolute;
            cursor: pointer;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: #ccc;
            -webkit-transition: .4s;
            transition: .4s;
        }

        .slider:before {
            position: absolute;
            content: "";
            height: 16px;
            width: 16px;
            left: 4px;
            bottom: 4px;
            background-color: var(--bg-card);
            -webkit-transition: .4s;
            transition: .4s;
        }

        input:checked + .slider {
            background-color: var(--primary);
        }

        input:focus + .slider {
            box-shadow: 0 0 1px var(--primary);
        }

        input:checked + .slider:before {
            -webkit-transform: translateX(26px);
            -ms-transform: translateX(26px);
            transform: translateX(26px);
        }

        /* Rounded sliders */
        .slider.round {
            border-radius: 34px;
        }

        .slider.round:before {
            border-radius: 50%;
        }



        /* Animations */
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Responsive Design */
        
        /* Tablet & Small Laptop (max-width: 1200px) */
        @media (max-width: 1200px) {
            .student-grid {
                grid-template-columns: repeat(2, 1fr);
                gap: 30px;
            }
            
            .about-container {
                gap: 40px;
            }
        }

        /* Tablet (max-width: 992px) */
        @media (max-width: 992px) {
            .nav-menu {
                gap: 20px;
            }
            
            .hero-title {
                font-size: 42px;
            }
            
            .hero-subtitle {
                font-size: 20px;
            }
            
            .section-title {
                font-size: 32px;
            }
            
            .student-grid {
                grid-template-columns: repeat(2, 1fr);
                gap: 25px;
            }
        }

        /* Mobile & Small Tablet (max-width: 768px) */
        @media (max-width: 768px) {
            /* Navbar */
            .nav-container {
                padding: 0 15px;
            }
            
            .logo-text {
                font-size: 18px;
            }
            
            .nav-menu {
                display: none; /* Hide menu on mobile, show hamburger if needed */
            }
            
            .user-profile {
                gap: 8px;
            }
            
            .user-name {
                display: none; /* Hide name on mobile */
            }
            
            /* Hero Section */
            .hero-title {
                font-size: 36px;
            }

            .hero-subtitle {
                font-size: 18px;
            }
            
            .hero-buttons {
                flex-direction: column;
                width: 100%;
            }
            
            .btn-primary {
                width: 100%;
            }

            /* About Section */
            .about-container {
                grid-template-columns: 1fr;
                gap: 30px;
                padding: 0 15px;
            }
            
            .about-text h2 {
                font-size: 28px;
            }
            
            .about-text p {
                font-size: 15px;
            }

            /* Wali Kelas Section */
            .about-container {
                grid-template-columns: 1fr;
            }

            /* Student Grid */
            .student-grid {
                grid-template-columns: 1fr;
                gap: 20px;
            }
            
            .section-title {
                font-size: 28px;
            }
            
        }

        /* Small Mobile (max-width: 480px) */
        @media (max-width: 480px) {
            .hero-title {
                font-size: 28px;
            }

            .hero-subtitle {
                font-size: 16px;
            }
            
            .section-title {
                font-size: 24px;
            }
            
            .section-subtitle {
                font-size: 14px;
            }
            
            .logo-text {
                font-size: 16px;
            }
            
            .user-avatar {
                width: 35px;
                height: 35px;
            }
            
            .about-text h2 {
                font-size: 24px;
            }
            
            .btn-primary {
                padding: 12px 20px;
                font-size: 14px;
            }
        }
    </style>
    <script>
        // Apply theme immediately to prevent flash
        const theme = localStorage.getItem('theme') || 'system';
        if (theme === 'dark' || (theme === 'system' && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark');
        }
    </script>
</head>

<body>
    <!-- Navbar -->
    <x-navbar :user="$user" />

    <!-- Hero Section -->
    <section class="hero-section">
        <div class="hero-content">
            <h1 class="hero-title">KELUARGA BESAR XI PPLG 2</h1>
            <p class="hero-subtitle">Solidaritas Tanpa Batas, Koding Tanpa Henti.</p>
            <div class="hero-buttons">
                <a href="#about" class="btn-primary">Lihat Lebih Lanjut</a>
            </div>
        </div>
    </section>

    <!-- About Us Section -->
    <section id="about" class="about-section">
        <div class="about-container">
            <div class="about-text">
                <h2>Tentang Kelas Kami</h2>
                <p>
                    XI PPLG 2 bukan sekadar kelas, melainkan rumah kedua bagi kami. Di sini, kami belajar
                    mengembangkan perangkat lunak, membangun logika, dan menciptakan solusi digital masa depan.
                </p>
                <p>
                    Dengan semangat "Solidaritas Tanpa Batas", kami saling mendukung satu sama lain untuk mencapai
                    potensi terbaik kami. Dari coding hingga desain, kami siap berkarya!
                </p>
            </div>
            <div class="about-image-card">
                <!-- Foto sekelas -->
                <img src="{{ $settings && $settings->about_image ? asset('storage/' . $settings->about_image) : asset('images/foto-sekelas-pageTentangKami.jpg') }}"
                    alt="Foto Kelas XI PPLG 2" class="about-image">
            </div>
        </div>
    </section>

    <!-- Announcement Section -->
    @if($announcements->count() > 0)
    <section class="announcement-section" style="background: var(--bg-body); padding: 60px 20px;">
        <div class="about-container" style="display: block;">
            <div class="section-title-container">
                <h2 class="section-title">Pengumuman Kelas</h2>
                <p class="section-subtitle">Informasi terbaru seputar kegiatan dan agenda kelas</p>
            </div>

            <div class="announcement-grid" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 30px;">
                @foreach($announcements as $announcement)
                <div class="announcement-card" style="background: var(--bg-card); border-radius: 16px; padding: 25px; box-shadow: 0 4px 20px var(--shadow-color); transition: transform 0.3s; border-left: 5px solid var(--primary);">
                    <div class="announcement-header" style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 15px;">
                        <span class="announcement-date" style="font-size: 14px; color: var(--text-muted); background: var(--bg-body); padding: 5px 10px; border-radius: 20px;">
                            {{ $announcement->created_at->translatedFormat('d F Y') }}
                        </span>
                        <span class="announcement-author" style="font-size: 12px; color: var(--primary); font-weight: 600;">
                            {{ $announcement->author->username ?? 'Admin' }}
                        </span>
                    </div>
                    <h3 class="announcement-title" style="font-size: 20px; margin-bottom: 10px; color: var(--text-main);">{{ $announcement->title }}</h3>
                    <p class="announcement-content" style="color: var(--text-muted); line-height: 1.6; margin-bottom: 0;">
                        {{ Str::limit($announcement->content, 150) }}
                    </p>
                </div>
                @endforeach
            </div>
        </div>
    </section>
    @endif

    <!-- Wali Kelas Section -->
    @if($teacher)
    <section class="wali-kelas-section" style="background: var(--bg-card); padding: 100px 20px;">
        <div class="about-container">
            <div class="about-image-card" style="transform: rotate(-2deg); background: var(--bg-card);">
                <img src="{{ $settings && $settings->teacher_image ? asset('storage/' . $settings->teacher_image) : asset('images/FotoWalikelas.jpg') }}" 
                     alt="Foto Wali Kelas" 
                     class="about-image" 
                     style="height: 400px; object-position: top;">
            </div>

            <div class="about-text">
                <h2 style="color: var(--text-main); font-size: 36px; margin-bottom: 20px; font-weight: 700;">Wali Kelas Kami</h2>
                <p style="color: var(--text-muted); font-size: 18px; line-height: 1.8; margin-bottom: 30px;">
                    "{{ $settings && $settings->teacher_quote ? $settings->teacher_quote : 'Membimbing dan menginspirasi generasi developer masa depan. Bersama kita bangun fondasi yang kuat untuk kesuksesan di dunia teknologi.' }}"
                </p>
                
                <div style="display: flex; gap: 15px;">
                    <span style="background: #f0fdf4; color: var(--success); padding: 10px 25px; border-radius: 50px; font-weight: 600; font-size: 16px; display: inline-flex; align-items: center; gap: 8px; white-space: nowrap;">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                            <path d="M10.394 2.08a1 1 0 00-.788 0l-7 3a1 1 0 000 1.84L5.25 8.051a.999.999 0 01.356-.257l4-1.714a1 1 0 11.788 1.838L7.667 9.088l1.94.831a1 1 0 00.787 0l7-3a1 1 0 000-1.838l-7-3zM3.31 9.397L5 10.12v4.102a8.969 8.969 0 00-1.05-.174 1 1 0 01-.89-.89 11.115 11.115 0 01.25-3.762zM9.3 16.573A9.026 9.026 0 007 14.935v-3.957l1.818.78a3 3 0 002.364 0l5.508-2.361a11.026 11.026 0 01.25 3.762 1 1 0 01-.89.89 8.968 8.968 0 00-5.35 2.524 1 1 0 01-1.4 0zM6 18a1 1 0 001-1v-2.065a8.935 8.935 0 00-2-.712V17a1 1 0 001 1z" />
                        </svg>
                        Wali Kelas XI PPLG 2
                    </span>
                </div>
            </div>
        </div>
    </section>
    @endif

    <!-- Struktur Kelas Section -->
    <section id="structure" class="structure-section" style="background: var(--bg-body); padding: 80px 20px;">
        <div class="about-container" style="display: block; max-width: 1200px; margin: 0 auto;">
            <div class="section-title-container">
                <h2 class="section-title">Struktur Organisasi</h2>
                <p class="section-subtitle">Pilar-pilar penggerak kelas XI PPLG 2</p>
            </div>

            <div class="structure-container" style="max-width: 1000px; margin: 0 auto;">
                <!-- Ketua & Wakil -->
                <div class="structure-row" style="display: flex; justify-content: center; gap: 40px; margin-bottom: 50px; flex-wrap: wrap;">
                    @if($structure['ketua'])
                    <div class="structure-card" style="text-align: center;">
                        <a href="{{ $structure['ketua']->student ? route('student.show', $structure['ketua']->student?->user_id) : '#' }}" style="text-decoration: none;">
                            <div class="structure-photo-container" style="width: 150px; height: 150px; margin: 0 auto 15px; border-radius: 50%; overflow: hidden; border: 4px solid var(--primary); box-shadow: 0 10px 20px rgba(0,0,0,0.1); transition: transform 0.3s;">
                                @if($structure['ketua']->student && $structure['ketua']->student?->photo)
                                    <img src="{{ asset('storage/photos/' . $structure['ketua']->student?->photo) }}" style="width: 100%; height: 100%; object-fit: cover;">
                                @else
                                    <img src="https://ui-avatars.com/api/?name={{ urlencode($structure['ketua']->student?->full_name ?? $structure['ketua']->user?->username ?? 'Belum Ditentukan') }}&background=2563eb&color=fff" style="width: 100%; height: 100%; object-fit: cover;">
                                @endif
                            </div>
                            <h3 style="font-size: 18px; font-weight: 700; color: var(--text-main);">{{ $structure['ketua']->student?->full_name ?? $structure['ketua']->user?->username ?? 'Belum Ditentukan' }}</h3>
                            <p style="color: var(--primary); font-weight: 600;">Ketua Kelas</p>
                        </a>
                    </div>
                    @endif

                    @if($structure['wakil'])
                    <div class="structure-card" style="text-align: center;">
                        <a href="{{ $structure['wakil']->student ? route('student.show', $structure['wakil']->student?->user_id) : '#' }}" style="text-decoration: none;">
                            <div class="structure-photo-container" style="width: 150px; height: 150px; margin: 0 auto 15px; border-radius: 50%; overflow: hidden; border: 4px solid var(--secondary); box-shadow: 0 10px 20px rgba(0,0,0,0.1); transition: transform 0.3s;">
                                @if($structure['wakil']->student && $structure['wakil']->student?->photo)
                                    <img src="{{ asset('storage/photos/' . $structure['wakil']->student?->photo) }}" style="width: 100%; height: 100%; object-fit: cover;">
                                @else
                                    <img src="https://ui-avatars.com/api/?name={{ urlencode($structure['wakil']->student?->full_name ?? $structure['wakil']->user?->username ?? 'Belum Ditentukan') }}&background=0ea5e9&color=fff" style="width: 100%; height: 100%; object-fit: cover;">
                                @endif
                            </div>
                            <h3 style="font-size: 18px; font-weight: 700; color: var(--text-main);">{{ $structure['wakil']->student?->full_name ?? $structure['wakil']->user?->username ?? 'Belum Ditentukan' }}</h3>
                            <p style="color: var(--secondary); font-weight: 600;">Wakil Ketua</p>
                        </a>
                    </div>
                    @endif
                </div>

                <!-- Sekertaris & Bendahara -->
                <div class="structure-grid" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 40px; margin-bottom: 50px;">
                    <!-- Sekertaris -->
                    <div class="structure-group" style="background: var(--bg-card); padding: 30px; border-radius: 20px; box-shadow: 0 5px 15px var(--shadow-color);">
                        <h3 style="text-align: center; margin-bottom: 25px; color: var(--text-main); border-bottom: 2px solid #f1f5f9; padding-bottom: 10px;">Sekertaris</h3>
                        <div style="display: flex; justify-content: center; gap: 20px; flex-wrap: wrap;">
                            @foreach($structure['sekertaris'] as $sekertaris)
                            <div class="mini-structure-card" style="text-align: center; width: 120px;">
                                <a href="{{ $sekertaris->student ? route('student.show', $sekertaris->student?->user_id) : '#' }}" style="text-decoration: none; display: block;">
                                    <div style="width: 80px; height: 80px; margin: 0 auto 10px; border-radius: 50%; overflow: hidden; background: #f1f5f9; transition: transform 0.3s;" onmouseover="this.style.transform='scale(1.1)'" onmouseout="this.style.transform='scale(1)'">
                                        @if($sekertaris->student && $sekertaris->student?->photo)
                                            <img src="{{ asset('storage/photos/' . $sekertaris->student?->photo) }}" style="width: 100%; height: 100%; object-fit: cover;">
                                        @else
                                            <img src="https://ui-avatars.com/api/?name={{ urlencode($sekertaris->student?->full_name ?? $sekertaris->user?->username ?? 'Belum Ditentukan') }}&background=random&color=fff" style="width: 100%; height: 100%; object-fit: cover;">
                                        @endif
                                    </div>
                                    <p style="font-size: 14px; font-weight: 600; color: var(--text-main); line-height: 1.2;">{{ $sekertaris->student?->nickname ?? explode(' ', $sekertaris->student?->full_name)[0] }}</p>
                                    <p style="font-size: 12px; color: var(--text-muted);">{{ $sekertaris->role }}</p>
                                </a>
                            </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Bendahara -->
                    <div class="structure-group" style="background: var(--bg-card); padding: 30px; border-radius: 20px; box-shadow: 0 5px 15px var(--shadow-color);">
                        <h3 style="text-align: center; margin-bottom: 25px; color: var(--text-main); border-bottom: 2px solid #f1f5f9; padding-bottom: 10px;">Bendahara</h3>
                        <div style="display: flex; justify-content: center; gap: 20px; flex-wrap: wrap;">
                            @foreach($structure['bendahara'] as $bendahara)
                            <div class="mini-structure-card" style="text-align: center; width: 120px;">
                                <a href="{{ $bendahara->student ? route('student.show', $bendahara->student?->user_id) : '#' }}" style="text-decoration: none; display: block;">
                                    <div style="width: 80px; height: 80px; margin: 0 auto 10px; border-radius: 50%; overflow: hidden; background: #f1f5f9; transition: transform 0.3s;" onmouseover="this.style.transform='scale(1.1)'" onmouseout="this.style.transform='scale(1)'">
                                        @if($bendahara->student && $bendahara->student?->photo)
                                            <img src="{{ asset('storage/photos/' . $bendahara->student?->photo) }}" style="width: 100%; height: 100%; object-fit: cover;">
                                        @else
                                            <img src="https://ui-avatars.com/api/?name={{ urlencode($bendahara->student?->full_name ?? $bendahara->user?->username ?? 'Belum Ditentukan') }}&background=random&color=fff" style="width: 100%; height: 100%; object-fit: cover;">
                                        @endif
                                    </div>
                                    <p style="font-size: 14px; font-weight: 600; color: var(--text-main); line-height: 1.2;">{{ $bendahara->student?->nickname ?? explode(' ', $bendahara->student?->full_name)[0] }}</p>
                                    <p style="font-size: 12px; color: var(--text-muted);">{{ $bendahara->role }}</p>
                                </a>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <!-- Divisi -->
                <div class="structure-grid" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 40px;">
                    <!-- Tim IT -->
                    <div class="structure-group" style="background: var(--bg-card); padding: 30px; border-radius: 20px; box-shadow: 0 5px 15px var(--shadow-color);">
                        <h3 style="text-align: center; margin-bottom: 25px; color: var(--text-main); border-bottom: 2px solid #f1f5f9; padding-bottom: 10px;">Tim IT</h3>
                        <div style="display: flex; justify-content: center; gap: 20px; flex-wrap: wrap;">
                            @foreach($structure['tim_it'] as $it)
                            <div class="mini-structure-card" style="text-align: center; width: 100px;">
                                <a href="{{ $it->student ? route('student.show', $it->student?->user_id) : '#' }}" style="text-decoration: none; display: block;">
                                    <div style="width: 70px; height: 70px; margin: 0 auto 10px; border-radius: 50%; overflow: hidden; background: #f1f5f9; transition: transform 0.3s;" onmouseover="this.style.transform='scale(1.1)'" onmouseout="this.style.transform='scale(1)'">
                                        @if($it->student && $it->student?->photo)
                                            <img src="{{ asset('storage/photos/' . $it->student?->photo) }}" style="width: 100%; height: 100%; object-fit: cover;">
                                        @else
                                            <img src="https://ui-avatars.com/api/?name={{ urlencode($it->student?->full_name ?? $it->user?->username ?? 'Belum Ditentukan') }}&background=random&color=fff" style="width: 100%; height: 100%; object-fit: cover;">
                                        @endif
                                    </div>
                                    <p style="font-size: 13px; font-weight: 600; color: var(--text-main); line-height: 1.2;">{{ $it->student?->nickname ?? explode(' ', $it->student?->full_name)[0] }}</p>
                                </a>
                            </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Tim PDD -->
                    <div class="structure-group" style="background: var(--bg-card); padding: 30px; border-radius: 20px; box-shadow: 0 5px 15px var(--shadow-color);">
                        <h3 style="text-align: center; margin-bottom: 25px; color: var(--text-main); border-bottom: 2px solid #f1f5f9; padding-bottom: 10px;">Tim PDD</h3>
                        <div style="display: flex; justify-content: center; gap: 20px; flex-wrap: wrap;">
                            @foreach($structure['tim_pdd'] as $pdd)
                            <div class="mini-structure-card" style="text-align: center; width: 100px;">
                                <a href="{{ $pdd->student ? route('student.show', $pdd->student?->user_id) : '#' }}" style="text-decoration: none; display: block;">
                                    <div style="width: 70px; height: 70px; margin: 0 auto 10px; border-radius: 50%; overflow: hidden; background: #f1f5f9; transition: transform 0.3s;" onmouseover="this.style.transform='scale(1.1)'" onmouseout="this.style.transform='scale(1)'">
                                        @if($pdd->student && $pdd->student?->photo)
                                            <img src="{{ asset('storage/photos/' . $pdd->student?->photo) }}" style="width: 100%; height: 100%; object-fit: cover;">
                                        @else
                                            <img src="https://ui-avatars.com/api/?name={{ urlencode($pdd->student?->full_name ?? $pdd->user?->username ?? 'Belum Ditentukan') }}&background=random&color=fff" style="width: 100%; height: 100%; object-fit: cover;">
                                        @endif
                                    </div>
                                    <p style="font-size: 13px; font-weight: 600; color: var(--text-main); line-height: 1.2;">{{ $pdd->student?->nickname ?? explode(' ', $pdd->student?->full_name)[0] }}</p>
                                </a>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Student Grid Section -->
    <div id="student-list" class="main-content">
        <div class="section-title-container">
            <h2 class="section-title">Anggota Kelas</h2>
            <p class="section-subtitle">Mengenal lebih dekat 36 talenta masa depan</p>
        </div>

        <div class="student-grid" id="student-grid">
            @foreach ($students as $index => $student)
                <div class="student-card" data-index="{{ $index + 1 }}">
                    @if($student->studentProfile && $student->studentProfile->photo)
                        <img src="{{ asset('storage/photos/' . $student->studentProfile->photo) }}" 
                             alt="Foto {{ $student->studentProfile->full_name }}" 
                             class="student-photo">
                    @else
                        <img src="https://ui-avatars.com/api/?name={{ urlencode($student->studentProfile->full_name ?? $student->username) }}&background=2563eb&color=fff&size=280" 
                             alt="Foto {{ $student->studentProfile->full_name ?? $student->username }}" 
                             class="student-photo">
                    @endif
                    
                    <div class="student-info">
                        <h3 class="student-name">{{ $student->studentProfile->full_name ?? $student->username }}</h3>
                    </div>
                    <div class="card-overlay">
                        <a href="{{ route('student.show', $student->id) }}" class="view-profile-btn">Lihat Profil</a>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Pagination Controls -->
        <div class="pagination-container" id="pagination-controls">
            <!-- Buttons will be generated by JS -->
        </div>
    </div>

    <!-- Footer Component -->
    <x-footer />

    <script>

        // Pagination Script
        document.addEventListener('DOMContentLoaded', function() {
            const itemsPerPage = 6;
            // Fix: Select only student cards within the student-grid container to avoid counting structure cards
            const studentCards = document.querySelectorAll('#student-grid .student-card');
            const totalItems = studentCards.length;
            const totalPages = Math.ceil(totalItems / itemsPerPage);
            const paginationContainer = document.getElementById('pagination-controls');

            console.log('Total student cards:', totalItems);
            console.log('Total pages:', totalPages);
            console.log('Pagination container:', paginationContainer);

            // Only create pagination if we have items and container exists
            if (totalPages > 0 && paginationContainer) {
                function showPage(page) {
                    const start = (page - 1) * itemsPerPage;
                    const end = start + itemsPerPage;

                    studentCards.forEach((card, index) => {
                        if (index >= start && index < end) {
                            card.style.display = 'block';
                        } else {
                            card.style.display = 'none';
                        }
                    });

                    // Update active button
                    document.querySelectorAll('.page-btn').forEach(btn => {
                        btn.classList.remove('active');
                        if (parseInt(btn.dataset.page) === page) {
                            btn.classList.add('active');
                        }
                    });
                }

                // Generate Pagination Buttons
                for (let i = 1; i <= totalPages; i++) {
                    const btn = document.createElement('button');
                    btn.classList.add('page-btn');
                    btn.innerText = i;
                    btn.dataset.page = i;
                    btn.addEventListener('click', function() {
                        showPage(i);
                        // Optional: Scroll to top of grid
                        const studentListSection = document.getElementById('student-list');
                        if (studentListSection) {
                            studentListSection.scrollIntoView({
                                behavior: 'smooth'
                            });
                        }
                    });
                    paginationContainer.appendChild(btn);
                }

                console.log('Pagination buttons created:', totalPages);

                // Show first page initially
                if (totalPages > 0) {
                    showPage(1);
                }
            } else {
                console.warn('Pagination not initialized. totalPages:', totalPages, 'container:', paginationContainer);
            }
        });
    </script>
</body>

</html>