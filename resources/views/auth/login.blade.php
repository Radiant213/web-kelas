<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Kelas XI PPLG 2</title>
    <style>
        :root {
            --primary: #2563eb;
            --primary-dark: #1d4ed8;
            --secondary: #0ea5e9;
            --dark: #1e293b;
            --light: #f8fafc;
            --gray: #64748b;
            --success: #10b981;
            --danger: #ef4444;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            background: linear-gradient(135deg, #1e3a8a 0%, #0ea5e9 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .login-container {
            display: flex;
            max-width: 900px;
            width: 100%;
            background: white;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
        }

        .login-left {
            flex: 1;
            background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 100%);
            color: white;
            padding: 40px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            position: relative;
        }

        .login-right {
            flex: 1;
            padding: 40px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .logo-container {
            display: flex;
            align-items: center;
            margin-bottom: 30px;
        }

        .logo {
            width: 50px;
            height: 50px;
            background: white;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 15px;
        }

        .logo-icon {
            color: var(--primary);
            font-weight: bold;
            font-size: 24px;
        }

        .logo-text {
            font-size: 24px;
            font-weight: 700;
        }

        .welcome-title {
            font-size: 28px;
            margin-bottom: 15px;
        }

        .welcome-subtitle {
            font-size: 16px;
            opacity: 0.9;
            margin-bottom: 30px;
            line-height: 1.5;
        }

        .form-title {
            font-size: 24px;
            color: var(--dark);
            margin-bottom: 5px;
        }

        .form-subtitle {
            color: var(--gray);
            margin-bottom: 30px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-label {
            display: block;
            margin-bottom: 8px;
            font-weight: 500;
            color: var(--dark);
        }

        .form-input {
            width: 100%;
            padding: 12px 15px;
            border: 1px solid #d1d5db;
            border-radius: 8px;
            font-size: 16px;
            transition: all 0.3s;
        }

        .form-input:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
        }

        .input-with-icon {
            position: relative;
        }

        .input-icon {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--gray);
        }

        .input-with-icon .form-input {
            padding-left: 45px;
        }

        .login-button {
            width: 100%;
            padding: 12px;
            background: var(--primary);
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: background 0.3s;
            margin-top: 10px;
        }

        .login-button:hover {
            background: var(--primary-dark);
        }

        .error-message {
            color: var(--danger);
            font-size: 14px;
            margin-top: 5px;
        }

        .success-message {
            color: var(--success);
            font-size: 14px;
            margin-top: 5px;
        }

        .code-bg {
            position: absolute;
            bottom: 0;
            right: 0;
            opacity: 0.05;
            font-size: 120px;
            line-height: 1;
            pointer-events: none;
            user-select: none;
        }

        @media (max-width: 768px) {
            .login-container {
                flex-direction: column;
            }

            .login-left {
                padding: 30px;
            }

            .login-right {
                padding: 30px;
            }
        }
    </style>
</head>

<body>
    <div class="login-container">
        <div class="login-left">
            <div class="logo-container">
                <div class="logo">
                    <span class="logo-icon">P</span>
                </div>
                <div class="logo-text">Kelas XI PPLG 2</div>
            </div>

            <h1 class="welcome-title">Selamat Datang!</h1>
            <p class="welcome-subtitle">Masuk ke akun Anda untuk mengakses absen dan informasi kelas PPLG.</p>

            <div class="code-bg">
                &lt;/&gt;
            </div>
        </div>

        <div class="login-right">
            <h2 class="form-title">Masuk ke Akun</h2>
            <p class="form-subtitle">Gunakan NIS Anda untuk masuk</p>

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <!-- Session Status -->
                @if (session('status'))
                    <div class="success-message">{{ session('status') }}</div>
                @endif

                <!-- NIS Field -->
                <div class="form-group">
                    <label for="nis" class="form-label">NIS</label>
                    <div class="input-with-icon">
                        <span class="input-icon">👤</span>
                        <input id="nis" class="form-input" type="text" name="nis"
                            value="{{ old('nis') }}" required autofocus autocomplete="username"
                            placeholder="Masukkan NIS">
                    </div>
                    @if ($errors->has('nis'))
                        <div class="error-message">{{ $errors->first('nis') }}</div>
                    @endif
                </div>

                <!-- Password -->
                <div class="form-group">
                    <label for="password" class="form-label">Password</label>
                    <div class="input-with-icon">
                        <span class="input-icon">🔒</span>
                        <input id="password" class="form-input" type="password" name="password" required
                            autocomplete="current-password" placeholder="Masukkan password">
                    </div>
                    @if ($errors->has('password'))
                        <div class="error-message">{{ $errors->first('password') }}</div>
                    @endif
                </div>

                <!-- Login Button -->
                <button type="submit" class="login-button">
                    Masuk
                </button>
            </form>
        </div>
    </div>
</body>

</html>