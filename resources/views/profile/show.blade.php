<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile Saya - XI PPLG 2</title>
    <link rel="icon" type="image/png" href="{{ asset('images/LogoKelas.png') }}">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700;800&display=swap" rel="stylesheet">
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
            font-family: 'Inter', sans-serif;
            scroll-behavior: smooth;
        }

        body {
            background-color: var(--bg-body);
            color: var(--text-main);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        /* --- Navbar Styles (Fixing Broken CSS) --- */
        /* Pastikan class ini sinkron sama navbar component lu bang */
        .nav-menu {
            display: flex;
            list-style: none;
        }

        /* Profile Content Styles */
        .profile-container {
            max-width: 1000px;
            margin: 100px auto 60px; /* Top margin disesuaikan biar pas sama navbar fixed */
            padding: 0 20px;
            flex: 1;
            width: 100%;
        }

        .profile-header {
            background: var(--bg-card);
            border-radius: 20px;
            padding: 40px;
            box-shadow: 0 10px 30px var(--shadow-color);
            display: flex;
            align-items: center;
            gap: 40px;
            margin-bottom: 40px;
            border: 1px solid var(--border-color);
        }

        .profile-avatar-large {
            width: 150px;
            height: 150px;
            min-width: 150px; /* Biar ga gepeng */
            min-height: 150px;
            border-radius: 50%;
            background: var(--primary);
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 64px;
            font-weight: 800;
            border: 5px solid var(--bg-body);
            box-shadow: 0 0 0 2px var(--border-color);
            object-fit: cover;
        }

        .profile-info {
            flex: 1; /* Ambil sisa ruang */
        }

        .profile-info h1 {
            font-size: 36px;
            font-weight: 800;
            color: var(--text-main);
            margin-bottom: 10px;
            line-height: 1.2;
        }

        .profile-nis {
            font-size: 14px;
            color: var(--text-muted);
            margin-bottom: 20px;
            display: inline-block;
            background: var(--bg-body);
            padding: 6px 16px;
            border-radius: 20px;
            font-weight: 600;
            border: 1px solid var(--border-color);
        }

        .profile-bio {
            font-size: 16px;
            color: var(--text-muted);
            line-height: 1.6;
            max-width: 600px;
            margin-bottom: 25px;
        }

        .profile-details {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 30px;
        }

        .detail-card {
            background: var(--bg-card);
            padding: 30px;
            border-radius: 20px;
            box-shadow: 0 5px 20px var(--shadow-color);
            border: 1px solid var(--border-color);
        }

        .detail-card h3 {
            font-size: 18px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 20px;
            color: var(--primary);
            border-bottom: 2px solid var(--border-color);
            padding-bottom: 10px;
            font-weight: 700;
        }

        .detail-item {
            margin-bottom: 20px;
        }
        .detail-item:last-child { margin-bottom: 0; }

        .detail-label {
            font-size: 13px;
            color: var(--text-muted);
            margin-bottom: 6px;
            text-transform: uppercase;
            font-weight: 600;
        }

        .detail-value {
            font-size: 16px;
            font-weight: 500;
            color: var(--text-main);
            word-break: break-word; /* Biar text panjang turun ke bawah */
        }

        .edit-btn {
            background: var(--primary);
            color: white;
            text-decoration: none;
            padding: 12px 30px;
            border-radius: 12px;
            font-weight: 600;
            display: inline-block;
            transition: all 0.3s;
            box-shadow: 0 4px 12px rgba(37, 99, 235, 0.2);
        }

        .edit-btn:hover {
            background: var(--primary-dark);
            transform: translateY(-2px);
            box-shadow: 0 8px 16px rgba(37, 99, 235, 0.3);
        }



        /* =========================================
           MOBILE RESPONSIVE TWEAKS (Responsive Banget)
           ========================================= */
        @media (max-width: 768px) {
            /* 1. Header Profile Jadi Tumpuk */
            .profile-header {
                flex-direction: column;
                text-align: center;
                padding: 30px 20px;
                gap: 25px;
            }

            .profile-avatar-large {
                width: 120px;
                height: 120px;
                min-width: 120px;
                min-height: 120px;
                font-size: 40px;
            }

            .profile-info h1 {
                font-size: 28px; /* Kecilin dikit font nama */
            }

            .profile-bio {
                margin: 0 auto 25px auto; /* Center bio */
                font-size: 14px;
            }

            .edit-btn {
                width: 100%; /* Tombol full width biar gampang dipencet */
                text-align: center;
            }

            /* 2. Container & Margin */
            .profile-container {
                margin-top: 90px; /* Sesuaikan sama tinggi navbar mobile */
                padding: 0 15px;
            }

            /* 3. Grid Details Jadi 1 Kolom */
            .profile-details {
                grid-template-columns: 1fr;
                gap: 20px;
            }

        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
    <script>
        const theme = localStorage.getItem('theme') || 'system';
        if (theme === 'dark' || (theme === 'system' && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
        }
    </script>
</head>

<body>
    <x-navbar :user="$user" />

    @php
        $fullName = $user->studentProfile ? $user->studentProfile->full_name : $user->username;
        $displayInitial = strtoupper(substr($fullName, 0, 1));
    @endphp

    <div class="profile-container">
        <div class="profile-header">
            @if(optional($user->studentProfile)->photo)
                <img src="{{ asset('storage/photos/' . $user->studentProfile->photo) }}" alt="Profile Photo" class="profile-avatar-large">
            @else
                <div class="profile-avatar-large">
                    {{ $displayInitial }}
                </div>
            @endif
            
            <div class="profile-info">
                <h1>{{ $fullName }}</h1>
                <div class="profile-nis">NIS: {{ $user->username }}</div>
                <p class="profile-bio">
                    {{ optional($user->studentProfile)->bio ?? 'Belum ada bio. Tambahkan motto hidupmu di sini!' }}
                </p>
                <div style="display: flex; gap: 10px; flex-wrap: wrap;">
                    <a href="{{ route('profile.edit.simple') }}" class="edit-btn">Edit Profil</a>
                    @if($user->role === 'student')
                        <a href="{{ route('grades.index') }}" class="edit-btn" style="background: var(--success);">Lihat Nilai</a>
                    @endif
                </div>
            </div>
        </div>

        <div class="profile-details">
            <div class="detail-card">
                <h3>Informasi Pribadi</h3>
                <div class="detail-item">
                    <div class="detail-label">Tempat, Tanggal Lahir</div>
                    <div class="detail-value">
                        {{ optional($user->studentProfile)->place_of_birth ?? '-' }}, 
                        {{ optional($user->studentProfile)->date_of_birth ? \Carbon\Carbon::parse($user->studentProfile->date_of_birth)->translatedFormat('d F Y') : '-' }}
                    </div>
                </div>
                <div class="detail-item">
                    <div class="detail-label">Alamat</div>
                    <div class="detail-value">{{ optional($user->studentProfile)->address ?? '-' }}</div>
                </div>
                <div class="detail-item">
                    <div class="detail-label">Anak Ke-</div>
                    <div class="detail-value">{{ optional($user->studentProfile)->child_number ?? '-' }}</div>
                </div>
            </div>

            <div class="detail-card">
                <h3>Akademik</h3>
                <div class="detail-item">
                    <div class="detail-label">Asal Sekolah (SMP)</div>
                    <div class="detail-value">{{ optional($user->studentProfile)->origin_school ?? '-' }}</div>
                </div>
                <div class="detail-item">
                    <div class="detail-label">Kelas</div>
                    <div class="detail-value">XI PPLG 2</div>
                </div>
                <div class="detail-item">
                    <div class="detail-label">Status</div>
                    <div class="detail-value" style="color: var(--success); display: flex; align-items: center; gap: 5px;">
                        <span style="display:inline-block; width:8px; height:8px; background:var(--success); border-radius:50%;"></span>
                        Aktif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <x-footer />

    <script>
        let lastScrollTop = 0;
        const navbar = document.getElementById('navbar');

        if(navbar) {
            window.addEventListener('scroll', function() {
                let scrollTop = window.pageYOffset || document.documentElement.scrollTop;
                if (scrollTop > lastScrollTop) {
                    navbar.classList.add('navbar-hidden');
                } else {
                    navbar.classList.remove('navbar-hidden');
                }
                lastScrollTop = scrollTop;
            });
        }
    </script>
</body>
</html>