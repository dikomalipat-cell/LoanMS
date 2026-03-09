<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login | Loan Management System</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');
        * { font-family: 'Inter', sans-serif; box-sizing: border-box; }

        body {
            background: linear-gradient(135deg, #1e1b4b 0%, #312e81 40%, #3730a3 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 16px;
        }

        .login-card {
            background: rgba(255, 255, 255, 0.97);
            backdrop-filter: blur(20px);
            border-radius: 24px;
            box-shadow: 0 25px 60px rgba(0,0,0,0.4), 0 0 0 1px rgba(255,255,255,0.1);
            width: 100%;
            max-width: 420px;
            padding: 40px 36px;
            animation: slideUp 0.5s ease;
        }

        @keyframes slideUp {
            from { opacity: 0; transform: translateY(30px); }
            to   { opacity: 1; transform: translateY(0); }
        }

        .input-group {
            position: relative;
            margin-bottom: 20px;
        }

        .input-group input {
            width: 100%;
            padding: 14px 16px 14px 44px;
            border: 2px solid #e5e7eb;
            border-radius: 12px;
            font-size: 0.95rem;
            outline: none;
            transition: all 0.3s ease;
            background: #f9fafb;
            color: #111827;
        }

        .input-group input:focus {
            border-color: #7c3aed;
            background: #fff;
            box-shadow: 0 0 0 4px rgba(124, 58, 237, 0.1);
        }

        .input-group .icon {
            position: absolute;
            left: 14px;
            top: 50%;
            transform: translateY(-50%);
            color: #9ca3af;
            font-size: 0.9rem;
            transition: color 0.3s;
        }

        .input-group input:focus ~ .icon,
        .input-group:focus-within .icon {
            color: #7c3aed;
        }

        .btn-login {
            width: 100%;
            padding: 14px;
            background: linear-gradient(135deg, #7c3aed, #6d28d9);
            color: white;
            font-weight: 600;
            font-size: 1rem;
            border: none;
            border-radius: 12px;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(124, 58, 237, 0.4);
            letter-spacing: 0.3px;
        }

        .btn-login:hover {
            background: linear-gradient(135deg, #6d28d9, #5b21b6);
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(124, 58, 237, 0.5);
        }

        .btn-login:active {
            transform: translateY(0);
        }

        /* Login Type Toggle */
        .login-toggle {
            display: flex;
            background: #f3f4f6;
            border-radius: 12px;
            padding: 4px;
            margin-bottom: 24px;
        }

        .login-toggle a {
            flex: 1;
            text-decoration: none;
            padding: 12px;
            border-radius: 10px;
            font-weight: 600;
            font-size: 0.9rem;
            transition: all 0.3s ease;
            color: #6b7280;
            text-align: center;
        }

        .login-toggle a:hover:not(.bg-white) {
            color: #374151;
        }

        .login-toggle a.active {
            background: white;
            color: #7c3aed;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        }

        .mode-icon {
            margin-right: 6px;
        }
    </style>
</head>

<body>
    <div class="login-card">

        <!-- Login Type Toggle -->
        <div class="login-toggle">
            <a href="{{ route('profile.login') }}" id="btn-user" class="flex-1 text-center px-4 py-3 rounded-xl font-semibold text-sm transition-all duration-300 text-gray-500 hover:text-gray-700">
                <i class="fas fa-user mode-icon"></i>User
            </a>
            <a href="{{ route('admin.login') }}" id="btn-admin" class="flex-1 text-center px-4 py-3 rounded-xl font-semibold text-sm transition-all duration-300 bg-white text-purple-600 shadow-sm">
                <i class="fas fa-user-shield mode-icon"></i>Admin
            </a>
        </div>

        <!-- Logo / Brand -->
        <div class="text-center mb-6">
            <div class="inline-flex items-center justify-center w-16 h-16 bg-purple-100 rounded-2xl mb-4">
                <i class="fas fa-shield-alt text-3xl text-purple-600"></i>
            </div>
            <h1 class="text-2xl font-bold text-gray-900">Admin Portal</h1>
            <p class="text-gray-500 text-sm mt-1">Sign in to manage the system</p>
        </div>

        @if ($errors->any())
            <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-xl mb-5 text-sm flex items-start gap-2">
                <i class="fas fa-exclamation-circle mt-0.5 flex-shrink-0"></i>
                <div>
                    @foreach ($errors->all() as $error)
                        <p>{{ $error }}</p>
                    @endforeach
                </div>
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <!-- Hidden field for admin login type -->
            <input type="hidden" name="login_type" id="login_type" value="admin">

            <!-- Email -->
            <div class="mb-1">
                <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email Address</label>
                <div class="input-group">
                    <input type="email" name="email" id="email"
                        value="{{ old('email') }}"
                        placeholder="admin@example.com"
                        required autofocus autocomplete="email">
                    <i class="fas fa-envelope icon"></i>
                </div>
            </div>

            <!-- Password -->
            <div class="mb-1">
                <label for="password" class="block text-sm font-medium text-gray-700 mb-2">Password</label>
                <div class="input-group">
                    <input type="password" name="password" id="password"
                        placeholder="••••••••"
                        required autocomplete="current-password">
                    <i class="fas fa-lock icon"></i>
                </div>
            </div>

            <!-- Remember Me -->
            <div class="flex justify-between items-center mb-6 text-sm">
                <label class="flex items-center gap-2 cursor-pointer text-gray-600">
                    <input type="checkbox" name="remember"
                        class="w-4 h-4 rounded border-gray-300 text-purple-600 focus:ring-purple-500">
                    Remember me
                </label>
            </div>

            <!-- Login Button -->
            <button type="submit" class="btn-login">
                <i class="fas fa-sign-in-alt mr-2"></i> Admin Sign In
            </button>
        </form>

    </div>

    <script>
        // Set admin login type on load
        document.getElementById('login_type').value = 'admin';
    </script>
</body>
</html>
