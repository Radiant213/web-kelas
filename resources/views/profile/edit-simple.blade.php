<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profil - XI PPLG 2</title>
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
            max-width: 800px;
            width: 100%;
            margin: 100px auto 40px;
            padding: 0 20px;
        }

        .page-header {
            text-align: center;
            margin-bottom: 40px;
        }

        .page-title {
            font-size: 28px;
            font-weight: 700;
            margin-bottom: 8px;
            color: var(--text-main);
        }

        .page-subtitle {
            color: var(--text-muted);
            font-size: 16px;
        }

        /* Content Area */
        .content-card {
            background: var(--bg-card);
            border-radius: 16px;
            padding: 40px;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05), 0 2px 4px -1px rgba(0, 0, 0, 0.03);
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
            justify-content: center;
        }

        .avatar-preview {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            object-fit: cover;
            border: 2px solid var(--border-color);
        }

        .avatar-actions {
            display: flex;
            flex-direction: column;
            gap: 8px;
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
            text-align: center;
        }

        .btn-upload:hover {
            background: #f9fafb;
            border-color: #d1d5db;
        }

        /* Buttons */
        .btn-primary {
            background: var(--primary);
            color: white;
            border: none;
            padding: 12px 30px;
            border-radius: 8px;
            font-weight: 600;
            font-size: 15px;
            cursor: pointer;
            transition: background 0.2s;
            width: 100%;
        }

        .btn-primary:hover {
            background: var(--primary-hover);
        }

        .btn-secondary {
            background: transparent;
            color: var(--text-muted);
            border: 1px solid var(--border-color);
            padding: 12px 30px;
            border-radius: 8px;
            font-weight: 600;
            font-size: 15px;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
            text-align: center;
            width: 100%;
        }

        .btn-secondary:hover {
            background: #f9fafb;
            color: var(--text-main);
        }

        .form-actions {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 16px;
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
            .form-row {
                grid-template-columns: 1fr;
            }
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
    <!-- Navbar -->
    <x-navbar :user="$user" />

    <div class="main-container">
        <div class="page-header">
            <h1 class="page-title">Edit Profil</h1>
            <p class="page-subtitle">Perbarui informasi profil kamu di sini</p>
        </div>

        <div class="content-card">
            <!-- Alerts -->
            @if (session('status') === 'profile-updated')
                <div class="alert alert-success">
                    <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                    Profil berhasil diperbarui!
                </div>
            @endif

            @if ($errors->any())
                <div class="alert alert-error">
                    <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    Gagal menyimpan profil. Periksa kembali data yang diisi.
                </div>
            @endif

            <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PATCH')

                <!-- Avatar -->
                <div class="avatar-section">
                    <img src="{{ $user->studentProfile && $user->studentProfile->photo ? asset('storage/photos/' . $user->studentProfile->photo) : 'https://ui-avatars.com/api/?name=' . urlencode($user->studentProfile->full_name ?? $user->username) }}" 
                         id="preview-img" class="avatar-preview">
                    <div class="avatar-actions">
                        <label class="btn-upload">
                            Upload Foto Baru
                            <input type="file" name="photo" style="display: none;" accept="image/*" onchange="previewPhoto(event)">
                        </label>
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
                    <textarea name="bio" class="form-textarea" placeholder="Ceritakan sedikit tentang dirimu atau motto hidupmu...">{{ old('bio', optional($user->studentProfile)->bio ?? '') }}</textarea>
                </div>

                <div class="form-group">
                    <label class="form-label">Link Media Sosial</label>
                    <div style="display: grid; gap: 12px;">
                        <input type="url" name="instagram_url" class="form-input" placeholder="Link Instagram (https://instagram.com/username)"
                               value="{{ old('instagram_url', optional($user->studentProfile)->instagram_url ?? '') }}">
                        <input type="url" name="github_url" class="form-input" placeholder="Link GitHub (https://github.com/username)"
                               value="{{ old('github_url', optional($user->studentProfile)->github_url ?? '') }}">
                        <input type="url" name="tiktok_url" class="form-input" placeholder="Link TikTok (https://tiktok.com/@username)"
                               value="{{ old('tiktok_url', optional($user->studentProfile)->tiktok_url ?? '') }}">
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label">Bahasa Pemrograman</label>
                    <input type="text" name="programming_languages" class="form-input" 
                           placeholder="Contoh: PHP, JavaScript, Python"
                           value="{{ old('programming_languages', optional($user->studentProfile)->programming_languages ?? '') }}">
                </div>

                <!-- Hidden fields -->
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
                    <label class="form-label">Kota</label>
                    <input type="text" name="city" class="form-input"
                           value="{{ old('city', optional($user->studentProfile)->city ?? '') }}">
                </div>

                <div class="form-group">
                    <label class="form-label">Asal Sekolah</label>
                    <input type="text" name="origin_school" class="form-input"
                           value="{{ old('origin_school', optional($user->studentProfile)->origin_school ?? '') }}">
                </div>

                <div class="form-actions">
                    <a href="{{ route('profile.show') }}" class="btn-secondary">Batal</a>
                    <button type="submit" class="btn-primary">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>

    <script>
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
