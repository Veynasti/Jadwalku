<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    @vite(['resources/css/app.css', 'resources/js/app/js'])
</head>
<body class="relative min-h-screen">

    <div class="absolute inset-0 bg-cover bg-center"
        style="background-image: url('{{ asset('images/saxon-switzerland-national-park-forest-day-light-green-5k-3840x2160-41.jpg') }}');">
    </div>

    {{-- Overlay --}}
    <div class="absolute inset-0 bg-black/40"></div>

    {{-- iki sidebar --}}
    <div class="relative z-10 flex">

        <div class="w-64 bg-white/20 backdrop-blur-sm h-screen shadow-lg p-6 fixed">
            <h2 class="text-2xl font-bold mb-8 text-green-600">Jadwalku</h2>

            <ul class="space-y-4 mt-17">
                <li>
                    <a href="/dashboard" class="block px-3 py-2 font-semibold rounded hover:bg-green-600 text-white">
                        <i class="fas fa-th-large mr-3"></i>
                        Dashboard
                    </a>
                </li>
                <li>
                    <a href="#" class="block px-3 py-2 font-semibold rounded hover:bg-green-600 text-white">
                        <i class="fas fa-list-check mr-3"></i>
                        To-Do List
                    </a>
                </li>
                <li>
                    <a href="#" class="block px-3 py-2 font-semibold rounded hover:bg-green-600 text-white">
                        <i class="fas fa-calendar-alt mr-3"></i>
                        Kalender
                    </a>
                </li>
                <li>
                    <a href="#" class="block px-3 py-2 font-semibold rounded hover:bg-green-600 text-white">
                        <i class="fas fa-calendar-week mr-3"></i>
                        7 Hari Ke Depan
                    </a>
                </li>
                <li>
                    <a href="#" class="block px-3 py-2 font-semibold rounded hover:bg-green-600 text-white">
                        <i class="fas fa-user-circle mr-3"></i>
                        Profil
                    </a>
                </li>
            </ul>

            <form action="{{ route('logout') }}" method="POST" class="mt-110">
                @csrf
                <button class="w-full font-semibold bg-red-800 text-white py-2 rounded hover:bg-red-700">
                    Logout
                </button>
            </form>
        </div>

        <div class="ml-64 w-full">
            <div class="bg-white/80 ml-6 mt-4 mr-6 rounded-xl h-16 shadow flex items-center justify-between px-6">
                <h1 class="text-xl font-semibold text-gray-700">Dashboard</h1>

                <div class="text-gray-600 font-semibold">
                    Halo, {{ Auth::user()->name }}
                </div>
            </div>

            <div class="p-6">
                <div class="bg-white/80 mt-5 rounded shadow p-6">
                    <h2 class="text-xl font-bold mb-4">Selamat Datang</h2>
                    <p class="text-gray-700">
                        Iki dashboard utama tempat buat ngeliat kegiatannya wok, lanjut nanti lagi yaw
                    </p>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
