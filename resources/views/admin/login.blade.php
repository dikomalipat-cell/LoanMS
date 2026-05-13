<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Admin Login</title>
    @vite(['resources/css/app.css'])
</head>
<body class="antialiased">
    <div class="min-h-screen flex items-center justify-center bg-primary-dark">
        <div class="w-full max-w-md bg-primary shadow rounded p-6">
            <h1 class="text-2xl font-semibold mb-6">Login</h1>

            @if ($errors->any())
                <div class="mb-4 p-3 bg-red-50 text-red-700 rounded">
                    <ul class="list-disc pl-5">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}" class="space-y-4">
                @csrf

                <div>
                    <label class="block text-sm font-medium text-gray-700" for="email">Email</label>
                    <input
                        id="email"
                        name="email"
                        type="email"
                        value="{{ old('email') }}"
                        required
                        autofocus
                        autocomplete="username"
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                    />
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700" for="password">Password</label>
                    <input
                        id="password"
                        name="password"
                        type="password"
                        required
                        autocomplete="current-password"
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                    />
                </div>

                <button
                    type="submit"
                    class="w-full py-2 px-4 bg-indigo-600 text-white rounded hover:bg-indigo-700"
                >
                    Sign in
                </button>
            </form>
        </div>
    </div>
</body>
</html>

