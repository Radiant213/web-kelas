<nav class="navbar" id="navbar">
    <div class="nav-container">
        <div class="hamburger" id="hamburger-btn">
            <span></span>
            <span></span>
            <span></span>
        </div>

        <a href="{{ route('dashboard') }}" class="logo-container" style="text-decoration: none;">
            <img src="{{ asset('images/LogoKelas.png') }}" alt="Logo XI PPLG 2" class="logo-image">
            <div class="logo-text">XI PPLG 2</div>
        </a>

        <ul class="nav-menu" id="nav-menu">
            <li class="nav-item">
                <a href="{{ route('dashboard') }}" class="nav-link">Beranda</a>
            </li>
            <li class="nav-item">
                <a href="{{ route('dashboard') }}#about" class="nav-link">Tentang Kami</a>
            </li>
            <li class="nav-item">
                <a href="{{ route('dashboard') }}#structure" class="nav-link">Struktur Organisasi</a>
            </li>
            <li class="nav-item">
                <a href="{{ route('dashboard') }}#student-list" class="nav-link">Anggota Kelas</a>
            </li>
        </ul>

        <div class="user-section">
            @if($user)
                @php
                    $fullName = $user->studentProfile ? $user->studentProfile->full_name : $user->username;
                    $displayName = explode(' ', $fullName)[0];
                    $displayInitial = strtoupper(substr($fullName, 0, 1));
                @endphp

                <div class="user-info" id="user-info-btn">
                    @if(optional($user->studentProfile)->photo)
                        <img src="{{ asset('storage/photos/' . $user->studentProfile->photo) }}" alt="User Avatar" class="user-avatar" style="object-fit: cover;">
                    @else
                        <div class="user-avatar">{{ $displayInitial }}</div>
                    @endif
                    <div class="user-name desktop-only">{{ $displayName }}</div>
                    
                    <div class="user-dropdown" id="user-dropdown">
                        <div class="dropdown-header">
                            <div class="dropdown-user-name">{{ $fullName }}</div>
                            <div class="dropdown-user-nis">NIS: {{ $user->username }}</div>
                        </div>
                        
                        <a href="{{ route('profile.show') }}" class="dropdown-item">Profil</a>
                        
                        @if (Auth::user()->isAdmin() || Auth::user()->isTeacher())
                            <a href="{{ url('/admin') }}" class="dropdown-item">Admin Panel</a>
                        @endif

                        <a href="{{ route('profile.edit') }}" class="dropdown-item">Pengaturan</a>
                        
                        <div class="dropdown-divider"></div>
                        
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="dropdown-item" style="color: var(--danger);">
                                Keluar
                            </button>
                        </form>
                    </div>
                </div>
            @else
                <a href="{{ route('login') }}" class="btn-login">
                    Login
                </a>
            @endif
        </div>
    </div>
</nav>

<style>
    /* =========================================
       DEFAULT / DESKTOP STYLES
       ========================================= */
    .navbar {
        background: var(--bg-card);
        backdrop-filter: blur(10px);
        padding: 15px 0;
        position: fixed;
        width: 100%;
        top: 0;
        z-index: 1000;
        box-shadow: 0 4px 20px var(--shadow-color, rgba(0, 0, 0, 0.05));
        transition: transform 0.3s ease-in-out;
    }

    .navbar-hidden {
        transform: translateY(-100%);
    }

    .nav-container {
        max-width: 1200px;
        margin: 0 auto;
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 0 20px;
        position: relative;
    }

    /* Logo */
    .logo-container {
        display: flex;
        align-items: center;
        cursor: pointer;
        z-index: 1002;
    }
    .logo-image {
        height: 45px;
        width: auto;
        margin-right: 10px;
        border-radius: 8px;
    }
    .logo-text {
        font-size: 20px;
        font-weight: 700;
        color: var(--text-main, #111827);
        white-space: nowrap;
    }

    /* Nav Menu */
    .nav-menu {
        display: flex;
        list-style: none;
        margin: 0;
        padding: 0;
    }
    .nav-item { margin-left: 30px; }
    .nav-link {
        text-decoration: none;
        color: var(--text-main, #111827);
        font-weight: 500;
        padding: 10px 0;
        transition: color 0.3s;
    }
    .nav-link:hover { color: var(--primary, #2563eb); }

    /* User Section & Login */
    .user-section {
        display: flex;
        align-items: center;
    }
    .user-info {
        display: flex;
        align-items: center;
        cursor: pointer;
        position: relative;
        padding: 5px 10px;
        border-radius: 8px;
        transition: background 0.2s;
        z-index: 1001;
    }
    .user-info:hover { background: var(--bg-body); }
    .user-avatar {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        background: var(--primary, #2563eb);
        color: white;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-right: 10px;
        font-weight: bold;
        font-size: 18px;
    }
    .user-name { font-weight: 600; color: var(--text-main, #111827); }

    .btn-login {
        background: var(--primary, #2563eb);
        color: white;
        padding: 8px 20px;
        border-radius: 8px;
        text-decoration: none;
        font-weight: 600;
        transition: background 0.3s;
    }
    .btn-login:hover { background: var(--primary-dark, #1d4ed8); }

    /* Hamburger Default (Hidden) */
    .hamburger {
        display: none;
        cursor: pointer;
        z-index: 1002;
    }
    .hamburger span {
        display: block;
        width: 25px;
        height: 3px;
        background-color: var(--text-main, #111827);
        margin: 5px 0;
        border-radius: 2px;
        transition: all 0.3s ease;
    }
    /* Hamburger Animation X */
    .hamburger.active span:nth-child(1) { transform: rotate(45deg) translate(5px, 5px); }
    .hamburger.active span:nth-child(2) { opacity: 0; }
    .hamburger.active span:nth-child(3) { transform: rotate(-45deg) translate(7px, -6px); }

    /* Dropdown */
    .user-dropdown {
        position: absolute;
        top: 100%;
        right: 0;
        width: 220px;
        background: var(--bg-card);
        border: 1px solid var(--border-color);
        border-radius: 12px;
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        padding: 8px 0;
        display: none;
        z-index: 1003;
        margin-top: 10px;
    }
    .user-dropdown.show { display: block; animation: fadeIn 0.2s ease-out; }
    .dropdown-header { padding: 10px 20px; border-bottom: 1px solid var(--border-color); margin-bottom: 5px; }
    .dropdown-user-name { font-weight: 700; color: var(--text-main, #111827); font-size: 16px; }
    .dropdown-user-nis { font-size: 12px; color: var(--text-muted); }
    .dropdown-item { display: block; padding: 10px 20px; color: var(--text-main, #111827); text-decoration: none; font-size: 14px; transition: background 0.2s; width: 100%; text-align: left; border: none; background: none; }
    .dropdown-item:hover { background: var(--bg-body); color: var(--primary, #2563eb); }
    .dropdown-divider { height: 1px; background: var(--border-color); margin: 5px 0; }
    @keyframes fadeIn { from { opacity: 0; transform: translateY(10px); } to { opacity: 1; transform: translateY(0); } }

    /* =========================================
       MOBILE VERSION STYLES (UPDATED)
       ========================================= */
    @media (max-width: 768px) {
        .nav-container {
            padding: 0 15px;
            /* Container pake default flex, kita main order di children */
        }

        /* 1. HAMBURGER (KIRI) */
        .hamburger {
            display: block;
            order: 1; /* Urutan Pertama */
            margin-right: auto; /* Dorong elemen lain ke kanan */
        }

        /* 2. LOGO (TENGAH) */
        .logo-container {
            order: 2; /* Urutan Kedua */
            position: absolute; /* Trik Center Absolut */
            left: 50%;
            transform: translateX(-50%);
            white-space: nowrap;
        }
        .logo-text { font-size: 16px; display: block; }
        .logo-image { height: 35px; }

        /* 3. USER SECTION / LOGIN (KANAN) */
        .user-section {
            order: 3; /* Urutan Ketiga */
            margin-left: auto; /* Dorong ke pojok kanan */
        }

        /* Tampilan User Mobile */
        .user-info { padding: 0; }
        .user-avatar { margin: 0; width: 35px; height: 35px; }
        .desktop-only { display: none; } /* Umpetin nama user */

        /* Nav Menu (Drawer) */
        .nav-menu {
            position: fixed;
            left: -100%;
            top: 70px;
            flex-direction: column;
            background: var(--bg-card);
            width: 100%;
            text-align: center;
            transition: 0.3s;
            box-shadow: 0 10px 10px rgba(0,0,0,0.1);
            padding: 20px 0;
            border-top: 1px solid var(--border-color);
            z-index: 999;
        }
        .nav-menu.active { left: 0; }
        .nav-item { margin: 15px 0; }

        /* Dropdown User (Posisi Mobile) */
        .user-dropdown {
            position: fixed;
            top: 75px;
            right: 15px; /* Muncul di kanan, pas bawah avatar */
            width: 200px;
        }
    }
</style>

<script>
    // 1. Scroll Logic
    let lastScrollTop = 0;
    const navbar = document.getElementById('navbar');
    
    window.addEventListener('scroll', function() {
        let scrollTop = window.pageYOffset || document.documentElement.scrollTop;
        if (scrollTop > lastScrollTop) {
            navbar.classList.add('navbar-hidden');
            // Tutup menu saat scroll ke bawah
            closeAllMenus();
        } else {
            navbar.classList.remove('navbar-hidden');
        }
        lastScrollTop = scrollTop;
    });

    // Elements
    const hamburger = document.getElementById('hamburger-btn');
    const navMenu = document.getElementById('nav-menu');
    const userInfoBtn = document.getElementById('user-info-btn');
    const userDropdown = document.getElementById('user-dropdown');

    // Helper Function buat nutup semua
    function closeAllMenus() {
        if(navMenu) navMenu.classList.remove('active');
        if(hamburger) hamburger.classList.remove('active');
        if(userDropdown) userDropdown.classList.remove('show');
    }

    // 2. Hamburger Logic
    if(hamburger) {
        hamburger.addEventListener('click', function(e) {
            e.stopPropagation();
            // Toggle Hamburger
            hamburger.classList.toggle('active');
            navMenu.classList.toggle('active');
            
            // Pastikan dropdown user tertutup
            if(userDropdown) userDropdown.classList.remove('show');
        });
    }

    // 3. User Dropdown Logic
    if(userInfoBtn) {
        userInfoBtn.addEventListener('click', function(e) {
            e.stopPropagation();
            // Toggle Dropdown
            userDropdown.classList.toggle('show');
            
            // Pastikan hamburger menu tertutup
            if(navMenu) navMenu.classList.remove('active');
            if(hamburger) hamburger.classList.remove('active');
        });
    }

    // 4. Close on Click Outside
    document.addEventListener('click', function(e) {
        // Cek klik di luar user info
        if (userInfoBtn && !userInfoBtn.contains(e.target)) {
            if(userDropdown) userDropdown.classList.remove('show');
        }
        // Cek klik di luar hamburger
        if (hamburger && !hamburger.contains(e.target) && !navMenu.contains(e.target)) {
            hamburger.classList.remove('active');
            navMenu.classList.remove('active');
        }
    });
</script>