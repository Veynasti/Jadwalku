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
            <div>
                <label class="block text-gray-400 font-medium mb-1">Nama</label>
                <input type="text" name="name" value="{{ old('name') }}"
                    class="w-full px-4 py-2 border rounded-lg focus:ring focus:ring-gray-700 outline-none" required>
            </div>

            <div>
                <label class="block text-gray-400 font-medium mb-1">Email</label>
                <input type="email" name="email" value="{{ old('email') }}"
                    class="w-full px-4 py-2 border rounded-lg focus:ring focus:ring-gray-700 outline-none" required>
            </div>

            <div>
                <label class="block text-gray-400 font-medium mb-1">Password</label>
                <input type="password" name="password"
                    class="w-full px-4 py-2 border rounded-lg focus:ring focus:ring-gray-700 outline-none" required>
            </div>

            <div>
                <label class="block text-gray-400 font-medium mb-1">Ulangi Password</label>
                <input type="password" name="password_confirmation"
                    class="w-full px-4 py-2 border rounded-lg focus:ring focus:ring-gray-700 outline-none" required>
            </div>

            <button class="w-full bg-green-600 text-white py-2 rounded-lg font-semibold hover:bg-green-700 duration-200">
                Register
            </button>
        </form>

        <p class="text-center text-sm mt-5 text-gray-400">
            Sudah punya akun?
            <a href="/login" class="text-green-600 hover:underline">Login di sini</a>
        </p>
    </div>

</body>
</html>
