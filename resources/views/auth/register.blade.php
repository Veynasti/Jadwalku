<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register | Jadwalku</title>
    @vite('resources/css/app.css')
    @vite('resources/js/app.js')
</head>
{{-- <body class="bg-gray-100 flex items-center justify-center min-h-screen"> --}}
<div
    class="min-h-screen flex items-center justify-center p-4 bg-cover bg-center"
    style="background-image: url('{{ asset('images/saxon-switzerland-national-park-forest-day-light-green-5k-3840x2160-41.jpg') }}');"
>
    <div class="bg-white/20 backdrop-blur-md shadow-2xl p-8 w-full max-w-md rounded-xl">
        <h2 class="text-3xl font-bold text-center mb-6 text-green-600">Daftar</h2>

        @if($errors->any())
            <div class="bg-red-100 text-red-700 p-2 rounded mb-4 text-center">
                {{ $errors->first() }}
            </div>
        @endif

        <form action="/register" method="POST" class="space-y-4">
            @csrf
            <label class="block text-white/80 text-sm font-semibold mb-2">Nama</label>
            <div class="relative">
                <input type="text" name="name" placeholder="Masukkan nama lengkap"
                    class="w-full bg-white/10 text-white border border-white/30 rounded-lg py-2 px-4
                    focus:outline-none focus:ring-2 focus:ring-green-500 transition duration-150 ease-in-out" required>
            </div>

            <label class="block text-white/80 text-sm font-semibold mb-2">Email</label>
            <div class="relative">
                <input type="email" name="email" placeholder="andreas10@gmail.com"
                    class="w-full bg-white/10 text-white border border-white/30 rounded-lg py-2 px-4
                    focus:outline-none focus:ring-2 focus:ring-green-500 transition duration-150 ease-in-out" required>
            </div>

            <label class="block text-white/80 text-sm font-semibold mb-2">Password</label>
            <div class="relative">
                <input type="text" name="password" placeholder="minimal 6 karakter"
                    class="w-full bg-white/10 text-white border border-white/30 rounded-lg py-2 px-4
                    focus:outline-none focus:ring-2 focus:ring-green-500 transition duration-150 ease-in-out" required>
            </div>

            <label class="block text-white/80 text-sm font-semibold mb-2">Konfirmasi Password</label>
            <div class="relative">
                <input type="text" name="password_confirmation" placeholder="Ulangi password anda"
                    class="w-full bg-white/10 text-white border border-white/30 rounded-lg py-2 px-4
                    focus:outline-none focus:ring-2 focus:ring-green-500 transition duration-150 ease-in-out" required>
            </div>

            <button class="w-full bg-green-600 text-white py-2 rounded-lg font-semibold hover:bg-green-700 duration-200">
                Register
            </button>
        </form>

        <p class="text-center text-sm mt-5 text-gray-200">
            Sudah punya akun?
            <a href="/login" class="text-green-600 hover:underline">Login di sini</a>
        </p>
    </div>

</body>
</html>
