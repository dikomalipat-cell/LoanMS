

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Loan Management System')</title>
        <!-- Tailwind CSS -->
        <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
         <!-- Font Awesome -->
         <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>

    
</head>


<body class="bg-gray-100 font-sans text-gray-800">

    <div class="dashboard-container flex min-h-screen">

        {{-- Sidebar --}}
       @include('profile.partials.sidebar') 

        {{-- Main content --}}
        <div class="main-content flex-1 flex flex-col ml-64">
                {{-- Header --}}
                @include('profile.header')

            {{-- Page content --}}
            <main class="flex-1 p-6 overflow-x-auto">
                @yield('content')
            </main>

           
        </div>
    </div>


</body>
</html> 