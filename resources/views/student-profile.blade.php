<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil {{ $student->studentProfile->full_name ?? $student->username }}</title>
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
        }

        body {
            background-color: var(--bg-body);
            color: var(--text-main);
            min-height: 100vh;
            padding: 40px 20px;
            transition: background-color 0.3s, color 0.3s;
        }

        .profile-container {
            max-width: 1000px;
            margin: 0 auto;
        }

        .back-button {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 10px 20px;
            background: var(--bg-card);
            color: var(--text-main);
            text-decoration: none;
            border-radius: 10px;
            font-weight: 600;
            margin-bottom: 20px;
            transition: all 0.3s;
            box-shadow: 0 2px 10px var(--shadow-color);
            border: 1px solid var(--border-color);
        }

        .back-button:hover {
            background: var(--primary);
            color: white;
            border-color: var(--primary);
            transform: translateX(-5px);
        }

        .profile-card {
            background: var(--bg-card);
            border-radius: 20px;
            box-shadow: 0 10px 30px var(--shadow-color);
            overflow: hidden;
            border: 1px solid var(--border-color);
        }

        .profile-header {
            padding: 40px;
            border-bottom: 1px solid var(--border-color);
            background: linear-gradient(to right, var(--bg-card), var(--bg-body));
        }

        .profile-title {
            font-size: 28px;
            font-weight: 700;
            color: var(--text-main);
            margin-bottom: 5px;
        }

        .profile-subtitle {
            color: var(--text-muted);
            font-size: 14px;
        }

        /* Layout Grid Utama */
        .profile-body {
            padding: 40px;
            display: grid;
            grid-template-columns: 280px 1fr; /* Sidebar tetap, Konten fleksibel */
            gap: 40px;
        }

        /* Sidebar (Foto & Nama) */
        .profile-sidebar {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 20px;
        }

        .profile-photo {
            width: 200px;
            height: 200px;
            border-radius: 50%;
            object-fit: cover;
            border: 4px solid var(--bg-card);
            box-shadow: 0 0 0 2px var(--border-color), 0 10px 25px var(--shadow-color);
            background-color: var(--bg-body);
        }

        .profile-identity {
            text-align: center;
            width: 100%;
        }

        .profile-name {
            font-size: 22px;
            font-weight: 700;
            color: var(--text-main);
            margin-bottom: 5px;
            word-wrap: break-word; /* Biar nama panjang ga jebol */
        }

        .profile-nis {
            font-size: 14px;
            color: var(--text-muted);
            font-weight: 500;
            background: var(--bg-body);
            padding: 4px 12px;
            border-radius: 15px;
            display: inline-block;
        }

        /* Konten Utama */
        .profile-main {
            display: flex;
            flex-direction: column;
            gap: 30px;
            min-width: 0; /* PENTING: Mencegah grid item overflow */
        }

        .info-section {
            display: flex;
            flex-direction: column;
            gap: 20px;
            padding: 25px;
            background: var(--bg-body); /* Sedikit beda dr card biar kontras */
            border-radius: 16px;
            border: 1px solid var(--border-color);
        }

        .section-title {
            font-size: 16px;
            font-weight: 700;
            color: var(--primary);
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 5px;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        
        .section-title::after {
            content: '';
            flex: 1;
            height: 1px;
            background: var(--border-color);
            opacity: 0.5;
        }

        .info-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
        }

        .info-field {
            display: flex;
            flex-direction: column;
            gap: 8px;
            min-width: 0; /* Mencegah flex child overflow */
        }

        .info-field.full-width {
            grid-column: 1 / -1;
        }

        .field-label {
            color: var(--text-muted);
            font-size: 12px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .field-value {
            color: var(--text-main);
            font-size: 15px;
            font-weight: 500;
            padding: 12px 16px;
            background: var(--bg-card);
            border-radius: 10px;
            border: 1px solid var(--border-color);
            
            /* Anti Jebol Style */
            word-wrap: break-word;
            word-break: break-word; 
            overflow-wrap: break-word;
        }

        /* Style khusus buat container social media biar wrap rapi */
        .social-links {
            display: flex; 
            gap: 10px; 
            align-items: center; 
            flex-wrap: wrap; /* Biar turun ke bawah kalau penuh */
        }

        .social-btn {
            text-decoration: none; 
            color: var(--text-main); 
            display: inline-flex; 
            align-items: center; 
            gap: 6px;
            padding: 6px 12px;
            background: var(--bg-body);
            border: 1px solid var(--border-color);
            border-radius: 8px;
            font-size: 13px;
            transition: all 0.2s;
        }

        .social-btn:hover {
            background: var(--border-color);
        }

        /* =========================================
           MOBILE RESPONSIVE STYLES
           ========================================= */
        @media (max-width: 900px) {
            .profile-body {
                grid-template-columns: 1fr; /* Jadi 1 kolom vertikal */
                gap: 30px;
            }

            .profile-sidebar {
                border-bottom: 1px solid var(--border-color);
                padding-bottom: 30px;
                width: 100%;
            }

            .profile-photo {
                width: 160px;
                height: 160px;
            }
        }

        @media (max-width: 640px) {
            body {
                padding: 15px 10px; /* Kurangi padding body */
            }

            .profile-header {
                padding: 25px 20px;
                text-align: center;
            }

            .profile-body {
                padding: 25px 20px;
            }

            .info-row {
                grid-template-columns: 1fr; /* Field jadi 1 kolom di HP */
                gap: 15px;
            }
            
            .info-section {
                padding: 15px; /* Padding card info lebih kecil */
            }

            .profile-title {
                font-size: 24px;
            }

            .field-value {
                font-size: 14px; /* Font isi lebih kecil dikit */
                padding: 10px 12px;
            }
        }
    </style>
</head>
<body>
    <div class="profile-container">
        <a href="{{ route('dashboard') }}" class="back-button">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd" />
            </svg>
            Kembali
        </a>

        <div class="profile-card">
            <div class="profile-header">
                <h1 class="profile-title">Profil Siswa</h1>
                <p class="profile-subtitle">Detail informasi anggota kelas</p>
            </div>

            <div class="profile-body">
                <div class="profile-sidebar">
                    @if($student->studentProfile && $student->studentProfile->photo)
                        <img src="{{ asset('storage/photos/' . $student->studentProfile->photo) }}" 
                             alt="Foto {{ $student->studentProfile->full_name }}" 
                             class="profile-photo">
                    @else
                        <img src="https://ui-avatars.com/api/?name={{ urlencode($student->studentProfile->full_name ?? $student->username) }}&background=2563eb&color=fff&size=400" 
                             alt="Avatar" 
                             class="profile-photo">
                    @endif

                    <div class="profile-identity">
                        <h2 class="profile-name">{{ $student->studentProfile->full_name ?? $student->username }}</h2>
                        <span class="profile-nis">NIS: {{ $student->username }}</span>
                    </div>
                </div>

                <div class="profile-main">
                    @if($student->studentProfile)
                    
                    <div class="info-section">
                        <h3 class="section-title">Informasi Pribadi</h3>
                        <div class="info-row">
                            <div class="info-field">
                                <label class="field-label">Nama Lengkap</label>
                                <div class="field-value">{{ $student->studentProfile->full_name }}</div>
                            </div>
                            <div class="info-field">
                                <label class="field-label">Nama Panggilan</label>
                                <div class="field-value">{{ $student->studentProfile->nickname ?? '-' }}</div>
                            </div>
                            <div class="info-field">
                                <label class="field-label">Jenis Kelamin</label>
                                <div class="field-value">{{ $student->studentProfile->gender == 'L' ? 'Laki-laki' : 'Perempuan' }}</div>
                            </div>
                            <div class="info-field">
                                <label class="field-label">Tempat, Tgl Lahir</label>
                                <div class="field-value">
                                    {{ $student->studentProfile->place_of_birth ?? '-' }}, 
                                    {{ $student->studentProfile->date_of_birth ? \Carbon\Carbon::parse($student->studentProfile->date_of_birth)->translatedFormat('d F Y') : '-' }}
                                </div>
                            </div>
                            <div class="info-field">
                                <label class="field-label">Anak Ke</label>
                                <div class="field-value">{{ $student->studentProfile->child_number ?? '-' }}</div>
                            </div>
                        </div>
                    </div>

                    <div class="info-section">
                        <h3 class="section-title">Lokasi</h3>
                        <div class="info-row">
                            <div class="info-field full-width">
                                <label class="field-label">Alamat Lengkap</label>
                                <div class="field-value">{{ $student->studentProfile->address }}</div>
                            </div>
                        </div>
                    </div>

                    <div class="info-section">
                        <h3 class="section-title">Akademik</h3>
                        <div class="info-row">
                            <div class="info-field">
                                <label class="field-label">Asal Sekolah</label>
                                <div class="field-value">{{ $student->studentProfile->origin_school ?? '-' }}</div>
                            </div>
                            <div class="info-field">
                                <label class="field-label">Kelas</label>
                                <div class="field-value">XI PPLG 2</div>
                            </div>
                        </div>
                    </div>

                    <div class="info-section">
                        <h3 class="section-title">Minat & Sosmed</h3>
                        <div class="info-row">
                            <div class="info-field full-width">
                                <label class="field-label">Media Sosial</label>
                                <div class="field-value social-links">
                                    @if($student->studentProfile->github_url)
                                        <a href="{{ $student->studentProfile->github_url }}" target="_blank" class="social-btn">
                                            <img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/github/github-original.svg" width="16" height="16" alt="GH"> GitHub
                                        </a>
                                    @endif
                                    @if($student->studentProfile->instagram_url)
                                        <a href="{{ $student->studentProfile->instagram_url }}" target="_blank" class="social-btn">
                                            <img src="https://upload.wikimedia.org/wikipedia/commons/e/e7/Instagram_logo_2016.svg" width="16" height="16" alt="IG"> Instagram
                                        </a>
                                    @endif
                                    @if($student->studentProfile->tiktok_url)
                                        <a href="{{ $student->studentProfile->tiktok_url }}" target="_blank" class="social-btn">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="currentColor"><path d="M19.59 6.69a4.83 4.83 0 0 1-3.77-4.25V2h-3.45v13.67a2.89 2.89 0 0 1-5.2 1.74 2.89 2.89 0 0 1 2.31-4.64 2.93 2.93 0 0 1 .88.13V9.4a6.84 6.84 0 0 0-1-.05A6.33 6.33 0 0 0 5 20.1a6.34 6.34 0 0 0 10.86-4.43v-7a8.16 8.16 0 0 0 4.77 1.52v-3.4a4.85 4.85 0 0 1-1-.1z"/></svg> TikTok
                                        </a>
                                    @endif
                                    @if(!$student->studentProfile->github_url && !$student->studentProfile->instagram_url && !$student->studentProfile->tiktok_url)
                                        <span style="color: var(--text-muted);">-</span>
                                    @endif
                                </div>
                            </div>
                            <div class="info-field full-width">
                                <label class="field-label">Bahasa Pemrograman</label>
                                <div class="field-value" style="display: flex; flex-wrap: wrap; gap: 8px;">
                                    @if($student->studentProfile->programming_languages)
                                        @foreach(explode(',', $student->studentProfile->programming_languages) as $lang)
                                            <span style="background: #e0f2fe; color: #0284c7; padding: 4px 12px; border-radius: 15px; font-size: 13px; font-weight: 600;">
                                                {{ trim($lang) }}
                                            </span>
                                        @endforeach
                                    @else
                                        -
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    @if($student->studentProfile->bio)
                    <div class="info-section">
                        <h3 class="section-title">Bio / Motto</h3>
                        <div class="field-value" style="line-height: 1.6; font-style: italic;">
                            "{{ $student->studentProfile->bio }}"
                        </div>
                    </div>
                    @endif
                    
                    @else
                    <div class="info-section" style="text-align: center; padding: 50px 20px;">
                        <div style="font-size: 40px; margin-bottom: 10px;">📋</div>
                        <h3 style="color: var(--text-main);">Profil Belum Lengkap</h3>
                        <p style="color: var(--text-muted);">Siswa ini belum mengisi data profilnya.</p>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <script>
        // Check Dark Mode
        if (localStorage.theme === 'dark' || (!('theme' in localStorage))) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark');
        }
    </script>
</body>
</html>