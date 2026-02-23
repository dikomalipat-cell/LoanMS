<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>

    <!-- CSS -->
    <style>
        body {
            background-color: #FDFDFC;
            color: #1b1b18;
            font-family: 'Inter', sans-serif;
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            margin: 0;
        }

        .login-container {
            width: 100%;
            max-width: 400px;
            padding: 20px;
        }

        .login-card {
            background-color: #ffffff;
            border-radius: 20px;
            padding: 40px 30px;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        .login-card h2 {
            font-size: 2rem;
            margin-bottom: 10px;
        }

        .login-card p {
            color: #666;
            margin-bottom: 30px;
            font-size: 0.9rem;
        }

        .login-card label {
            display: block;
            text-align: left;
            margin-bottom: 5px;
            font-weight: 500;
        }

        .login-card input[type="email"],
        .login-card input[type="password"] {
            width: 100%;
            padding: 12px 15px;
            margin-bottom: 20px;
            border: 1px solid #9e1414;
            border-radius: 12px;
            outline: none;
            transition: all 0.3s ease;
        }

        .login-card input:focus {
            border-color: #FBBF24;
            box-shadow: 0 0 8px rgba(251, 191, 36, 0.5);
        }

        .remember-forgot {
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 0.85rem;
            margin-bottom: 25px;
        }

        .remember-forgot input[type="checkbox"] {
            margin-right: 5px;
        }

        .login-card button {
            width: 100%;
            padding: 12px;
            background-color: #FBBF24;
            color: #1b1b18;
            font-weight: 600;
            border: none;
            border-radius: 12px;
            cursor: pointer;
            transition: background 0.3s ease, transform 0.2s ease;
        }

        .login-card button:hover {
            background-color: #e5ac1c;
            transform: translateY(-2px);
        }

        .register-link {
            margin-top: 20px;
            font-size: 0.9rem;
        }

        .register-link a {
            color: #FBBF24;
            text-decoration: none;
            font-weight: 500;
        }

        .register-link a:hover {
            text-decoration: underline;
        }

        /* Dark mode */
        @media (prefers-color-scheme: dark) {
            body {
                background-color: #0a0a0a;
                color: #EDEDEC;
            }
            .login-card {
                background-color: #1b1b18;
                box-shadow: 0 8px 25px rgba(255, 255, 255, 0.05);
            }
            .login-card p,
            .remember-forgot {
                color: #ccc;
            }
            .login-card input[type="email"],
            .login-card input[type="password"] {
                background-color: #0a0a0a;
                border: 1px solid #555;
                color: #EDEDEC;
            }
            .login-card input:focus {
                box-shadow: 0 0 8px rgba(251, 191, 36, 0.5);
            }
        }
    </style>
</head>

<body>
    <div class="login-container">
        <div class="login-card">
            <h2>Welcome Back</h2>
            <p>Please login to your account</p>

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <!-- Email -->
                <label for="email">Email</label>
                <input type="email" name="email" id="email" value="{{ old('email') }}" required autofocus>

                <!-- Password -->
                <label for="password">Password</label>
                <input type="password" name="password" id="password" required>

                <!-- Remember Me -->
                <div class="remember-forgot">
                    <label><input type="checkbox" name="remember"> Remember me</label>
                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}">Forgot password?</a>
                    @endif
                </div>

                <!-- Login Button -->
                <button type="submit">Log In</button>
            </form>

            <!-- Register Link -->
            <p class="register-link">
                Don't have an account? <a href="{{ route('register') }}">Register</a>
            </p>
        </div>
    </div>
</body>
</html>