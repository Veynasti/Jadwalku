@extends('layouts.app')

@section('title', 'Login')

@section('content')

<div
    class="min-h-screen flex items-center justify-center p-4 bg-cover bg-center"
    style="background-image: url('{{ asset('images/saxon-switzerland-national-park-forest-day-light-green-5k-3840x2160-41.jpg') }}');">

    {{-- MODIFIKASI: Tambahkan bg-white/50, backdrop-blur-md, dan shadow-2xl untuk efek blur --}}
    <div class="max-w-md w-full bg-white/20 backdrop-blur-md rounded-xl shadow-2xl overflow-hidden">

        <form class="p-8 space-y-6" method="POST" action="{{ route('login') }}">
            @csrf

            <div class="text-center">
                <h1 class="text-3xl font-bold text-green-600 mb-2">Selamat Datang</h1>
                <p class="text-gray-400">ayo masuk dan lihat jadwalmu!</p>
            </div>

            <div class="space-y-2">
                <label for="email" class="block text-sm font-medium text-gray-400">
                    Email
                </label>
                {{-- MODIFIKASI: Tambahkan div relative untuk menampung input dan ikon --}}
                <div class="relative">
                    <input
                        id="email"
                        name="email"
                        type="email"
                        required
                        autocomplete="email"
                        @class([
                            'w-full px-4 py-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-gray-800 transition duration-200 pr-10',
                            'border-red-500' => $errors->has('email'),
                            'border-black-200' => !$errors->has('email')
                        ])
                        placeholder="Enter your email"
                        value="{{ old('email') }}">

                    <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                        <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                        </svg>
                    </div>
                </div>
                @error('email')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="space-y-2">
                <label for="password" class="block text-sm font-medium text-gray-400">
                    Password
                </label>
                <div class="relative">
                    <input
                        id="password"
                        name="password"
                        type="password"
                        required
                        autocomplete="current-password"
                        @class([
                            'w-full px-4 py-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-gray-800 transition duration-200',
                            'border-red-500' => $errors->has('password'),
                            'border-black-200' => !$errors->has('password')
                        ])
                        placeholder="Enter your password">
                    {{-- Tambahkan Ikon Kunci (Password) di Kiri --}}
                    <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                    </div>

                    <button
                        type="button"
                        class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400 hover:text-gray-600 focus:outline-none"
                        onclick="togglePassword()">
                        <svg id="eye-icon" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                        </svg>
                    </button>
                </div>
                @error('password')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex items-center justify-between">
                <div class="flex items-center">
                    <input
                        id="remember"
                        name="remember"
                        type="checkbox"
                        class="h-4 w-4 text-green-500 focus:ring-green-500 border-gray-300 rounded"
                    >
                    <label for="remember" class="ml-2 block text-sm text-gray-500">
                        Ingatkan Saya
                    </label>
                </div>
            </div>

            <button
                type="submit"
                class="w-full bg-green-600 hover:bg-green-700 text-white font-semibold py-3 px-4 rounded-lg transition duration-200 focus:outline-none focus:ring-2 focus:ring-green-400 focus:ring-offset-2">
                Log in
            </button>

            <div class="text-center pt-4 border-t border-gray-200">
                <p class="text-sm text-gray-300">
                    Belum punya akun?
                    <a href="{{ route('register') }}" class="font-semibold text-green-500 hover:text-green-500 ml-1">
                        Daftar
                    </a>
                </p>
            </div>
        </form>
    </div>
</div>

<script>
// Fungsi togglePassword tidak berubah
function togglePassword() {
    const passwordInput = document.getElementById('password');
    const eyeIcon = document.getElementById('eye-icon');

    if (passwordInput.type === 'password') {
        passwordInput.type = 'text';
        eyeIcon.innerHTML = `
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"/>
        `;
    } else {
        passwordInput.type = 'password';
        eyeIcon.innerHTML = `
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
        `;
    }
}
</script>
@endsection
