<!DOCTYPE html>
<html lang="en">
<script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Jadwalku')</title>

    <link rel="icon" type="image/png" href="{{ asset('images/11zon_cropped.png') }}">
    {{-- ICONS --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    {{-- VITE --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>

<body class="h-screen overflow-hidden">

    {{-- Background Fixed --}}
    <div class="fixed inset-0 bg-cover bg-center z-0"
        style="background-image: url('{{ asset('images/saxon-switzerland-national-park-forest-day-light-green-5k-3840x2160-41.jpg') }}');">
    </div>
    <div class="fixed inset-0 bg-black/40 z-0"></div>

    {{-- Wrapper Utama --}}
    <div class="relative z-10 flex h-screen">

        {{-- Sidebar --}}
        <aside class="w-64 bg-white/20 backdrop-blur-sm h-screen shadow-lg p-10 shrink-0">
            <h2 class="text-2xl font-bold mb-8 text-center text-green-600">Jadwalku</h2>

            <ul class="space-y-5">
                <li>
                    <a href="{{ route('dashboard') }}"
                        class="block px-3 py-2 font-semibold rounded transition-colors
                        {{ request()->routeIs('dashboard') ? 'bg-green-600 text-white' : 'text-white hover:bg-green-600' }}">
                        <i class="fas fa-th-large mr-3"></i> Dashboard
                    </a>
                </li>
                <li>
                    <a href="{{ route('tasks.index') }}"
                        class="block px-3 py-2 font-semibold rounded transition-colors
                        {{ request()->routeIs('tasks.index') ? 'bg-green-600 text-white' : 'text-white hover:bg-green-600' }}">
                        <i class="fas fa-list-check mr-3"></i> To-Do List
                    </a>
                </li>
                <li>
                    <a href="{{ route('tasks.schedule') }}"
                        class="block px-3 py-2 font-semibold rounded transition-colors
                        {{ request()->routeIs('tasks.schedule') ? 'bg-green-600 text-white' : 'text-white hover:bg-green-600' }}">
                        <i class="fas fa-calendar-week mr-3"></i> 7 Hari Ke Depan
                    </a>
                </li>
                <li>
                    <a href="{{ route('tasks.history') }}"
                        class="block px-3 py-2 font-semibold rounded transition-colors
                        {{ request()->routeIs('tasks.history') ? 'bg-green-600 text-white' : 'text-white hover:bg-green-600' }}">
                        <i class="fas fa-calendar-week mr-3"></i> Riwayat
                    </a>
                </li>
            </ul>


            {{-- Logout --}}
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="mt-20">
                @csrf
                <button type="button"
                    onclick="logoutConfirm()"
                    class="w-full font-semibold bg-red-800 text-white py-2 rounded hover:bg-red-700 transition-colors mt-90">
                    Logout
                </button>
            </form>
            
            <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

            <script>
            function logoutConfirm() {
                Swal.fire({
                    title: "Yakin ingin logout?",
                    text: "Kamu akan keluar dari akun ini.",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#d33",
                    cancelButtonColor: "#3085d6",
                    confirmButtonText: "Logout",
                    cancelButtonText: "Batal"
                }).then((result) => {
                    if (result.isConfirmed) {
                        document.getElementById("logout-form").submit();
                    }
                });
            }
            </script>
        </aside>

        {{-- Main Content --}}
        <main class="flex-1 h-screen overflow-y-auto">
            <section class="p-6">
                @yield('content')
            </section>
        </main>
    </div>
</body>
</html>
