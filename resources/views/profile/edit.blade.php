<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Settings - XI PPLG 2</title>
    <link rel="icon" type="image/png" href="{{ asset('images/LogoKelas.png') }}">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary: #2563eb;
            --primary-hover: #1d4ed8;
            --bg-body: #f3f4f6;
            --bg-card: #ffffff;
            --text-main: #111827;
            --text-muted: #6b7280;
            --border-color: #e5e7eb;
            --danger: #ef4444;
            --success: #10b981;
            --shadow-color: rgba(0, 0, 0, 0.05);
        }

        .dark {
            --bg-body: #0f172a;
            --bg-card: #1e293b;
            --text-main: #f8fafc;
            --text-muted: #94a3b8;
            --border-color: #334155;
            --shadow-color: rgba(0, 0, 0, 0.3);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Inter', sans-serif;
        }

        body {
            background-color: var(--bg-body);
            color: var(--text-main);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        /* Navbar */
        .navbar {
            background: var(--bg-card);
            border-bottom: 1px solid var(--border-color);
            padding: 0 20px;
            height: 64px;
            display: flex;
            align-items: center;
            position: fixed;
            top: 0;
            width: 100%;
            z-index: 50;
        }

        .nav-container {
            max-width: 1200px;
            width: 100%;
            margin: 0 auto;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logo-container {
            display: flex;
            align-items: center;
            gap: 12px;
            text-decoration: none;
            color: var(--text-main);
        }

        .logo-image {
            height: 32px;
            width: auto;
        }

        .logo-text {
            font-weight: 700;
            font-size: 18px;
        }

        .nav-link {
            color: var(--text-muted);
            text-decoration: none;
            font-weight: 500;
            font-size: 14px;
            transition: color 0.2s;
        }

        .nav-link:hover {
            color: var(--primary);
        }

        /* Main Layout */
        .main-container {
            max-width: 1100px;
            width: 100%;
            margin: 100px auto 40px;
            padding: 0 20px;
        }

        .page-title {
            font-size: 24px;
            font-weight: 700;
            margin-bottom: 30px;
            color: var(--text-main);
        }

        .settings-layout {
            display: grid;
            grid-template-columns: 240px 1fr;
            gap: 40px;
            align-items: start;
        }

        /* Sidebar */
        .sidebar {
            display: flex;
            flex-direction: column;
            gap: 4px;
        }

        .sidebar-item {
            padding: 10px 16px;
            border-radius: 8px;
            color: var(--text-muted);
            text-decoration: none;
            font-weight: 500;
            font-size: 14px;
            cursor: pointer;
            transition: all 0.2s;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .sidebar-item:hover {
            background-color: var(--bg-body);
            color: var(--text-main);
        }

        .sidebar-item.active {
            background-color: #eff6ff;
            color: var(--primary);
        }

        /* Content Area */
        .content-card {
            background: var(--bg-card);
            border-radius: 16px;
            padding: 40px;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05), 0 2px 4px -1px rgba(0, 0, 0, 0.03);
        }

        .tab-content {
            display: none;
            animation: fadeIn 0.3s ease;
        }

        .tab-content.active {
            display: block;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(5px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .section-header {
            margin-bottom: 32px;
        }

        .section-title {
            font-size: 20px;
            font-weight: 700;
            margin-bottom: 8px;
        }

        /* Forms */
        .form-group {
            margin-bottom: 24px;
        }

        .form-label {
            display: block;
            font-size: 13px;
            font-weight: 600;
            color: var(--text-main);
            margin-bottom: 8px;
        }

        .form-input, .form-textarea, .form-select {
            width: 100%;
            padding: 10px 14px;
            border: 1px solid var(--border-color);
            border-radius: 8px;
            font-size: 14px;
            color: var(--text-main);
            transition: all 0.2s;
            background: var(--bg-card);
        }

        .form-input:focus, .form-textarea:focus, .form-select:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
        }

        .form-textarea {
            resize: vertical;
            min-height: 100px;
        }

        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 24px;
        }

        .helper-text {
            font-size: 12px;
            color: var(--text-muted);
            margin-top: 6px;
        }

        /* Avatar Upload */
        .avatar-section {
            display: flex;
            align-items: center;
            gap: 24px;
            margin-bottom: 32px;
        }

        .avatar-preview {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            object-fit: cover;
            border: 2px solid var(--border-color);
        }

        .avatar-actions {
            display: flex;
            gap: 12px;
        }

        .btn-upload {
            background: var(--bg-card);
            border: 1px solid var(--border-color);
            padding: 8px 16px;
            border-radius: 6px;
            font-size: 13px;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.2s;
        }

        .btn-upload:hover {
            background: var(--bg-body);
            border-color: var(--border-color);
        }

        /* Buttons */
        .btn-primary {
            background: var(--primary);
            color: white;
            border: none;
            padding: 10px 24px;
            border-radius: 8px;
            font-weight: 500;
            font-size: 14px;
            cursor: pointer;
            transition: background 0.2s;
        }

        .btn-primary:hover {
            background: var(--primary-hover);
        }

        .btn-secondary {
            background: transparent;
            color: var(--text-muted);
            border: none;
            padding: 10px 24px;
            font-weight: 500;
            font-size: 14px;
            cursor: pointer;
            text-decoration: none;
        }

        .btn-secondary:hover {
            color: var(--text-main);
        }

        .form-actions {
            display: flex;
            justify-content: flex-end;
            gap: 12px;
            margin-top: 40px;
            padding-top: 24px;
            border-top: 1px solid var(--border-color);
        }

        /* Alerts */
        .alert {
            padding: 14px 16px;
            border-radius: 8px;
            font-size: 14px;
            margin-bottom: 24px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .alert-success {
            background: #ecfdf5;
            color: #065f46;
            border: 1px solid #a7f3d0;
        }

        .alert-error {
            background: #fef2f2;
            color: #991b1b;
            border: 1px solid #fecaca;
        }

        @media (max-width: 768px) {
            .settings-layout {
                grid-template-columns: 1fr;
                gap: 24px;
            }

            .sidebar {
                flex-direction: row;
                overflow-x: auto;
                padding-bottom: 10px;
            }

            .sidebar-item {
                white-space: nowrap;
            }

            .form-row {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>

<body>
    <!-- Navbar -->
    <x-navbar :user="$user" />

    <div class="main-container">
        <h1 class="page-title">Settings</h1>

        <div class="settings-layout">
            <!-- Sidebar -->
            <div class="sidebar">
                <div class="sidebar-item active" onclick="switchTab('account')">
                    Akun
                </div>
                <div class="sidebar-item" onclick="switchTab('password')">
                    Kata Sandi
                </div>
                <div class="sidebar-item" onclick="switchTab('appearance')">
                    Tampilan
                </div>
            </div>

            <!-- Content -->
            <div class="content-card">
                <!-- Alerts -->
                @if (session('status') === 'profile-updated')
                    <div class="alert alert-success">
                        <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                        Perubahan berhasil disimpan
                    </div>
                @endif
                
                @if (session('status') === 'password-updated')
                    <div class="alert alert-success">
                        <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                        Kata sandi berhasil diperbarui
                    </div>
                @endif

                @if ($errors->any())
                    <div class="alert alert-error">
                        <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        Mohon periksa form untuk kesalahan
                    </div>
                @endif

                <!-- Account Tab -->
                <div id="account-tab" class="tab-content active">
                    <div class="section-header">
                        <h2 class="section-title">Akun</h2>
                        <p style="color: var(--text-muted); font-size: 14px;">Kelola informasi profil dan detail publik Anda</p>
                    </div>

                    <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')

                        <!-- Avatar -->
                        <div class="avatar-section">
                            <img src="{{ $user->studentProfile && $user->studentProfile->photo ? asset('storage/photos/' . $user->studentProfile->photo) : 'https://ui-avatars.com/api/?name=' . urlencode($user->studentProfile->full_name ?? $user->username) }}" 
                                 id="preview-img" class="avatar-preview">
                            <div>
                                <h3 style="font-size: 14px; font-weight: 600; margin-bottom: 8px;">Foto Profil</h3>
                                <div class="avatar-actions">
                                    <label class="btn-upload">
                                        Unggah
                                        <input type="file" name="photo" style="display: none;" accept="image/*" onchange="previewPhoto(event)">
                                    </label>
                                    @if($user->studentProfile && $user->studentProfile->photo)
                                        <button type="button" class="btn-upload" style="color: var(--danger); border-color: #fecaca;">Hapus</button>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group">
                                <label class="form-label">Nama Lengkap</label>
                                <input type="text" name="full_name" class="form-input" 
                                       value="{{ old('full_name', optional($user->studentProfile)->full_name ?? '') }}" required>
                                @error('full_name') <p class="helper-text" style="color: var(--danger)">{{ $message }}</p> @enderror
                            </div>
                            <div class="form-group">
                                <label class="form-label">Nama Panggilan</label>
                                <input type="text" name="nickname" class="form-input" 
                                       value="{{ old('nickname', optional($user->studentProfile)->nickname ?? '') }}">
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group">
                                <label class="form-label">Tempat Lahir</label>
                                <input type="text" name="place_of_birth" class="form-input" 
                                       value="{{ old('place_of_birth', optional($user->studentProfile)->place_of_birth ?? '') }}" required>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Tanggal Lahir</label>
                                <input type="date" name="date_of_birth" class="form-input" 
                                       value="{{ old('date_of_birth', optional($user->studentProfile)->date_of_birth ?? '') }}" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="form-label">Bio / Motto</label>
                            <textarea name="bio" class="form-textarea" placeholder="Ceritakan tentang dirimu...">{{ old('bio', optional($user->studentProfile)->bio ?? '') }}</textarea>
                        </div>

                        <div class="form-group">
                            <label class="form-label">Link Sosial Media</label>
                            <div style="display: grid; gap: 12px;">
                                <input type="url" name="instagram_url" class="form-input" placeholder="Link Instagram"
                                       value="{{ old('instagram_url', optional($user->studentProfile)->instagram_url ?? '') }}">
                                <input type="url" name="tiktok_url" class="form-input" placeholder="Link TikTok"
                                       value="{{ old('tiktok_url', optional($user->studentProfile)->tiktok_url ?? '') }}">
                                <input type="url" name="github_url" class="form-input" placeholder="Link GitHub"
                                       value="{{ old('github_url', optional($user->studentProfile)->github_url ?? '') }}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="form-label">Kota</label>
                            <input type="text" name="city" class="form-input"
                                   value="{{ old('city', optional($user->studentProfile)->city ?? '') }}">
                        </div>

                        <div class="form-group">
                            <label class="form-label">Programming Languages</label>
                            <input type="text" name="programming_languages" class="form-input" 
                                   placeholder="e.g. PHP, JavaScript, Python"
                                   value="{{ old('programming_languages', optional($user->studentProfile)->programming_languages ?? '') }}">
                        </div>

                        <!-- Hidden fields for required but less important data in this view -->
                        <div class="form-row">
                            <div class="form-group">
                                <label class="form-label">Jenis Kelamin</label>
                                <select name="gender" class="form-select">
                                    <option value="L" {{ (optional($user->studentProfile)->gender ?? 'L') == 'L' ? 'selected' : '' }}>Laki-laki</option>
                                    <option value="P" {{ (optional($user->studentProfile)->gender ?? '') == 'P' ? 'selected' : '' }}>Perempuan</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Anak Ke-</label>
                                <input type="number" name="child_number" class="form-input" min="1"
                                       value="{{ old('child_number', optional($user->studentProfile)->child_number ?? 1) }}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="form-label">Alamat</label>
                            <textarea name="address" class="form-textarea" rows="3">{{ old('address', optional($user->studentProfile)->address ?? '') }}</textarea>
                        </div>

                        <div class="form-group">
                            <label class="form-label">Asal Sekolah</label>
                            <input type="text" name="origin_school" class="form-input"
                                   value="{{ old('origin_school', optional($user->studentProfile)->origin_school ?? '') }}">
                        </div>

                        <div class="form-actions">
                            <button type="submit" class="btn-primary">Simpan Perubahan</button>
                        </div>
                    </form>
                </div>

                <!-- Password Tab -->
                <div id="password-tab" class="tab-content">
                    <div class="section-header">
                        <h2 class="section-title">Kata Sandi</h2>
                        <p style="color: var(--text-muted); font-size: 14px;">Perbarui kata sandi untuk menjaga keamanan akun</p>
                    </div>

                    <form method="post" action="{{ route('password.update') }}">
                        @csrf
                        @method('put')

                        <div class="form-group">
                            <label class="form-label">Kata Sandi Saat Ini</label>
                            <input type="password" name="current_password" class="form-input" autocomplete="current-password">
                            @error('current_password', 'updatePassword') <p class="helper-text" style="color: var(--danger)">{{ $message }}</p> @enderror
                        </div>

                        <div class="form-group">
                            <label class="form-label">Kata Sandi Baru</label>
                            <input type="password" name="password" class="form-input" autocomplete="new-password">
                            @error('password', 'updatePassword') <p class="helper-text" style="color: var(--danger)">{{ $message }}</p> @enderror
                        </div>

                        <div class="form-group">
                            <label class="form-label">Konfirmasi Kata Sandi Baru</label>
                            <input type="password" name="password_confirmation" class="form-input" autocomplete="new-password">
                        </div>

                        <div class="form-actions">
                            <button type="submit" class="btn-primary">Perbarui Kata Sandi</button>
                        </div>
                    </form>
                </div>

                <!-- Appearance Tab -->
                <div id="appearance-tab" class="tab-content">
                    <div class="section-header">
                        <h2 class="section-title">Tampilan</h2>
                        <p style="color: var(--text-muted); font-size: 14px;">Sesuaikan tampilan aplikasi</p>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Theme</label>
                        <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 16px;">
                            <label style="cursor: pointer;">
                                <input type="radio" name="theme" value="light" onchange="setTheme('light')" style="display: none;">
                                <div class="theme-card" id="theme-light" style="border: 2px solid var(--border-color); border-radius: 8px; padding: 16px; text-align: center;">
                                    <div style="width: 100%; height: 80px; background: #f3f4f6; border-radius: 4px; margin-bottom: 8px; position: relative;">
                                        <div style="position: absolute; top: 8px; left: 8px; width: 60%; height: 8px; background: white; border-radius: 2px;"></div>
                                    </div>
                                    <span style="font-size: 14px; font-weight: 500;">Terang</span>
                                </div>
                            </label>
                            
                            <label style="cursor: pointer;">
                                <input type="radio" name="theme" value="dark" onchange="setTheme('dark')" style="display: none;">
                                <div class="theme-card" id="theme-dark" style="border: 2px solid var(--border-color); border-radius: 8px; padding: 16px; text-align: center;">
                                    <div style="width: 100%; height: 80px; background: #1f2937; border-radius: 4px; margin-bottom: 8px; position: relative;">
                                        <div style="position: absolute; top: 8px; left: 8px; width: 60%; height: 8px; background: #374151; border-radius: 2px;"></div>
                                    </div>
                                    <span style="font-size: 14px; font-weight: 500;">Gelap</span>
                                </div>
                            </label>

                            <label style="cursor: pointer;">
                                <input type="radio" name="theme" value="system" onchange="setTheme('system')" style="display: none;">
                                <div class="theme-card" id="theme-system" style="border: 2px solid var(--border-color); border-radius: 8px; padding: 16px; text-align: center;">
                                    <div style="width: 100%; height: 80px; background: linear-gradient(90deg, #f3f4f6 50%, #1f2937 50%); border-radius: 4px; margin-bottom: 8px;"></div>
                                    <span style="font-size: 14px; font-weight: 500;">Sistem</span>
                                </div>
                            </label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function switchTab(tabName) {
            // Update Sidebar
            document.querySelectorAll('.sidebar-item').forEach(item => {
                item.classList.remove('active');
            });
            event.currentTarget.classList.add('active');

            // Update Content
            document.querySelectorAll('.tab-content').forEach(content => {
                content.classList.remove('active');
            });
            document.getElementById(tabName + '-tab').classList.add('active');
        }

        function setTheme(theme) {
            localStorage.setItem('theme', theme);
            updateThemeUI(theme);
            
            // Apply theme to document (simplified logic for demo)
            if (theme === 'dark' || (theme === 'system' && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
                document.documentElement.classList.add('dark');
                // You would typically toggle a class on the body or html tag here
                // For now, we'll just update the UI selection
            } else {
                document.documentElement.classList.remove('dark');
            }
        }

        function updateThemeUI(theme) {
            // Reset borders
            document.querySelectorAll('.theme-card').forEach(card => {
                card.style.borderColor = '';
                card.style.backgroundColor = '';
                card.style.border = '2px solid var(--border-color)';
            });
            
            // Highlight selected
            const selectedCard = document.getElementById('theme-' + theme);
            if (selectedCard) {
                selectedCard.style.border = '2px solid var(--primary)';
                selectedCard.style.backgroundColor = 'rgba(37, 99, 235, 0.1)';
            }
        }

        // Initialize theme on load
        document.addEventListener('DOMContentLoaded', () => {
            const savedTheme = localStorage.getItem('theme') || 'system';
            setTheme(savedTheme);
        });

        function previewPhoto(event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('preview-img').src = e.target.result;
                }
                reader.readAsDataURL(file);
            }
        }
    </script>
</body>
</html>