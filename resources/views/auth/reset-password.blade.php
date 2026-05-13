<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password | Loan Management System</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
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

        .btn-submit {
            width: 100%;
            padding: 14px;
            background: linear-gradient(135deg, #f5c518, #eab308);
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

        .btn-submit:hover {
            background: linear-gradient(135deg, #eab308, #ca8a04);
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(5, 150, 105, 0.5);
        }

        .btn-submit:active {
            transform: translateY(0);
        }
    </style>
</head>

<body>
    <div class="login-card">

        <!-- Logo / Brand -->
        <div class="text-center mb-6">
            <div class="inline-flex items-center justify-center w-16 h-16 bg-gold/20 rounded-2xl mb-4">
                <i class="fas fa-lock text-2xl text-gold"></i>
            </div>
            <h1 class="text-2xl font-bold text-gray-900">Reset Password</h1>
            <p class="text-slate-400 text-sm mt-2">Enter your new password below.</p>
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

        <form method="POST" action="{{ route('password.store') }}">
            @csrf

            <!-- Password Reset Token -->
            <input type="hidden" name="token" value="{{ $request->route('token') }}">

            <!-- Email -->
            <div class="mb-4">
                <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email Address</label>
                <div class="input-group">
                    <input type="email" name="email" id="email"
                        value="{{ old('email', $request->email) }}"
                        placeholder="you@example.com"
                        required autofocus autocomplete="username">
                    <i class="fas fa-envelope icon"></i>
                </div>
            </div>

            <!-- Password -->
            <div class="mb-4">
                <label for="password" class="block text-sm font-medium text-gray-700 mb-2">New Password</label>
                <div class="input-group">
                    <input type="password" name="password" id="password"
                        placeholder="••••••••"
                        required autocomplete="new-password">
                    <i class="fas fa-lock icon"></i>
                </div>
            </div>

            <!-- Confirm Password -->
            <div class="mb-6">
                <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-2">Confirm Password</label>
                <div class="input-group">
                    <input type="password" name="password_confirmation" id="password_confirmation"
                        placeholder="••••••••"
                        required autocomplete="new-password">
                    <i class="fas fa-lock icon"></i>
                </div>
            </div>

            <!-- Submit Button -->
            <button type="submit" class="btn-submit">
                <i class="fas fa-sync-alt mr-2"></i> Reset Password
            </button>
        </form>

    </div>
</body>
</html>
