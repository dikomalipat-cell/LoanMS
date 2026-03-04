<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register | Loan Management System</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');
        * { font-family: 'Inter', sans-serif; box-sizing: border-box; }

        body {
            background: linear-gradient(135deg, #064e3b 0%, #065f46 40%, #047857 100%);
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
            box-shadow: 0 25px 60px rgba(0,0,0,0.3), 0 0 0 1px rgba(255,255,255,0.1);
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
            border-color: #059669;
            background: #fff;
            box-shadow: 0 0 0 4px rgba(5, 150, 105, 0.1);
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
            color: #059669;
        }

        .btn-login {
            width: 100%;
            padding: 14px;
            background: linear-gradient(135deg, #059669, #047857);
            color: white;
            font-weight: 600;
            font-size: 1rem;
            border: none;
            border-radius: 12px;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(5, 150, 105, 0.4);
            letter-spacing: 0.3px;
        }

        .btn-login:hover {
            background: linear-gradient(135deg, #047857, #065f46);
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(5, 150, 105, 0.5);
        }

        .btn-login:active {
            transform: translateY(0);
        }

        .divider {
            display: flex;
            align-items: center;
            gap: 12px;
            margin: 20px 0;
            color: #9ca3af;
            font-size: 0.8rem;
        }

        .divider::before, .divider::after {
            content: '';
            flex: 1;
            height: 1px;
            background: #e5e7eb;
        }
    </style>
</head>

<body>
    <div class="login-card">

        <!-- Logo / Brand -->
        <div class="text-center mb-8">
            <div class="inline-flex items-center justify-center w-16 h-16 bg-green-100 rounded-2xl mb-4">
                <i class="fas fa-coins text-3xl text-green-600"></i>
            </div>
            <h1 class="text-2xl font-bold text-gray-900">Loan Management</h1>
            <p class="text-gray-500 text-sm mt-1">Create your account</p>
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

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <!-- Name -->
            <div class="mb-1">
                <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Full Name</label>
                <div class="input-group">
                    <input type="text" name="name" id="name"
                        value="{{ old('name') }}"
                        placeholder="Juan Dela Cruz"
                        required autofocus autocomplete="name">
                    <i class="fas fa-user icon"></i>
                </div>
            </div>

            <!-- Email -->
            <div class="mb-1">
                <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email Address</label>
                <div class="input-group">
                    <input type="email" name="email" id="email"
                        value="{{ old('email') }}"
                        placeholder="you@example.com"
                        required autocomplete="username">
                    <i class="fas fa-envelope icon"></i>
                </div>
            </div>

            <!-- Password -->
            <div class="mb-1">
                <label for="password" class="block text-sm font-medium text-gray-700 mb-2">Password</label>
                <div class="input-group">
                    <input type="password" name="password" id="password"
                        placeholder="••••••••"
                        required autocomplete="new-password">
                    <i class="fas fa-lock icon"></i>
                </div>
            </div>

            <!-- Confirm Password -->
            <div class="mb-1">
                <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-2">Confirm Password</label>
                <div class="input-group">
                    <input type="password" name="password_confirmation" id="password_confirmation"
                        placeholder="••••••••"
                        required autocomplete="new-password">
                    <i class="fas fa-lock icon"></i>
                </div>
            </div>

            <!-- Register Button -->
            <button type="submit" class="btn-login mt-4">
                <i class="fas fa-user-plus mr-2"></i> Create Account
            </button>
        </form>

        <!-- Login Link -->
        <p class="text-center text-sm text-gray-500 mt-6">
            Already have an account?
            <a href="{{ route('login') }}" class="text-green-600 font-semibold hover:underline">
                Sign in
            </a>
        </p>

    </div>
</body>
</html>
