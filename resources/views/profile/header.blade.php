<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Loan Management System</title>

  <!-- Tailwind CSS -->
  <script src="https://cdn.tailwindcss.com"></script>

  <!-- Font Awesome -->
  <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
</head>
<body class="bg-gray-100">

  <!-- DASHBOARD HEADER -->
  <header class="flex justify-between items-center bg-green-800 text-white px-6 py-4 shadow-md sticky top-0 z-50">

    <!-- Left: Logo / Title -->
    <div class="flex items-center space-x-3">
      <i class="fas fa-coins text-2xl"></i>
      <h1 class="text-xl font-semibold tracking-wide">
        Loan Management System
      </h1>
    </div>

    <!-- Right: Actions -->
    <div class="flex items-center space-x-5">

      <!-- Search -->
      <div class="relative hidden md:block">
        <input 
          type="text"
          placeholder="Search..."
          class="w-56 rounded-full px-4 py-2 text-gray-700 focus:outline-none focus:ring-2 focus:ring-green-400"
        >
        <i class="fas fa-search absolute right-4 top-1/2 -translate-y-1/2 text-gray-400"></i>
      </div>

      <!-- Home -->
      <a 
        href="{{ route('dashboard') }}" 
        class="flex items-center gap-1 hover:text-green-200 transition"
      >
        <i class="fas fa-home"></i>
        <span class="hidden sm:inline">Home</span>
      </a>

      <!-- Divider -->
      <span class="h-6 w-px bg-green-300 hidden sm:block"></span>

      <!-- Logout -->
      <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button 
          type="submit"
          class="flex items-center gap-1 hover:text-red-300 transition"
        >
          <i class="fas fa-sign-out-alt"></i>
          <span class="hidden sm:inline">Logout</span>
        </button>
      </form>

    </div>
  </header>

</body>
</html>